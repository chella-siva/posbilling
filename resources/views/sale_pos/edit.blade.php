@extends('layouts.app')

@section('title', __('sale.pos_sale'))

@section('content')
<section class="content no-print">
    <input type="hidden" id="amount_rounding_method" value="{{$pos_settings['amount_rounding_method'] ?? ''}}">
    @if(!empty($pos_settings['allow_overselling']))
        <input type="hidden" id="is_overselling_allowed">
    @endif
    @if(session('business.enable_rp') == 1)
        <input type="hidden" id="reward_point_enabled">
    @endif
    @php
        $is_discount_enabled = $pos_settings['disable_discount'] != 1 ? true : false;
        $is_rp_enabled = session('business.enable_rp') == 1 ? true : false;
    @endphp
    {!! Form::open(['url' => action([\App\Http\Controllers\SellPosController::class, 'update'], [$transaction->id]), 'method' => 'post', 'id' => 'edit_pos_sell_form' ]) !!}
    {{ method_field('PUT') }}
    <div class="row mb-12">
        <div class="col-md-12 tw-pt-0 tw-mb-14">
            <div class="row tw-flex lg:tw-flex-row md:tw-flex-col sm:tw-flex-col tw-flex-col tw-items-start md:tw-gap-4">
                <div class="tw-px-3 tw-w-full  lg:tw-px-0 lg:tw-pr-0 @if(empty($pos_settings['hide_product_suggestion'])) lg:tw-w-[60%]  @else lg:tw-w-[100%] @endif">
                    <div class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-rounded-2xl tw-bg-white tw-mb-2 md:tw-mb-8 tw-p-2">
                        <div class="box-body pb-0 p-0">
                            {!! Form::hidden('location_id', $transaction->location_id, ['id' => 'location_id', 'data-receipt_printer_type' => !empty($location_printer_type) ? $location_printer_type : 'browser', 'data-default_payment_accounts' => $transaction->location->default_payment_accounts]); !!}
                            <!-- sub_type -->
                            {!! Form::hidden('sub_type', isset($sub_type) ? $sub_type : null) !!}
                            <input type="hidden" id="item_addition_method" value="{{$business_details->item_addition_method}}">
                                @include('sale_pos.partials.pos_form_edit')

                                @include('sale_pos.partials.pos_form_totals', ['edit' => true])

                                @include('sale_pos.partials.payment_modal')

                                @if(empty($pos_settings['disable_suspend']))
                                    @include('sale_pos.partials.suspend_note_modal')
                                @endif

                                @if(empty($pos_settings['disable_recurring_invoice']))
                                    @include('sale_pos.partials.recurring_invoice_modal')
                                @endif
                            </div>
                            @if(!empty($only_payment))
                                <div class="overlay"></div>
                            @endif
                        </div>
                    </div>
                @if(empty($pos_settings['hide_product_suggestion'])  && !isMobile() && empty($only_payment))
                    <div class="col-md-5 no-padding">
                        @include('sale_pos.partials.pos_sidebar')
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('sale_pos.partials.pos_form_actions', ['edit' => true])
    {!! Form::close() !!}
    
    
<!-- Serial No. Modal -->
<div class="modal fade" id="serialModal" tabindex="-1" role="dialog" aria-labelledby="serialModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Serial Numbers</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="serialForm">
            <div class="form-group">
                <input type="text" class="form-control serial-search" id="serialSearch" placeholder="Search serial numbers...">
            </div>
            <div id="serialList"></div>
        </form>
        </div>
      <div class="modal-footer">
        <button type="button" id="saveSerialSelection" class="btn btn-success">Save Selection</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</section>

<!-- This will be printed -->
<section class="invoice print_section" id="receipt_section">
</section>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    @include('contact.create', ['quick_add' => true])
</div>
@if(empty($pos_settings['hide_product_suggestion']) && isMobile())
    @include('sale_pos.partials.mobile_product_suggestions')
@endif
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>

@include('sale_pos.partials.configure_search_modal')

@include('sale_pos.partials.recent_transactions_modal')

@include('sale_pos.partials.weighing_scale_modal')

@stop

@section('javascript')
<script>
  const serverSerials = @json($serialArrays ?? []);
</script>

<script>
    let allSerials = []; // All serials fetched from server
    let selectedSerials = [];
    let fetchedSerials = []; // Serial numbers currently checked in the modal

    $(document).on('click', '.open-serial-modal', function () {
        const productId = $(this).data('product-id');
        const variationId = $(this).data('variation-id');
        const locationId = $(this).data('location-id');
        $('#serialModal').data('product-id', productId);

        // Start with server serials (if any)
        allSerials = serverSerials[productId] || [];
        console.log(serverSerials);

        $.ajax({
            url: '/get-serials',
            method: 'GET',
            data: {
                product_id: productId,
                variation_id: variationId,
                location_id: locationId
            },
            success: function (response) {
                 fetchedSerials = response.serials || [];
                
                let oldSerials = [];

                if (Array.isArray(serverSerials[productId])) {
                    oldSerials = serverSerials[productId];
                }

                // Merge oldSerials into fetchedSerials if not present
                oldSerials.forEach(serial => {
                    if (!fetchedSerials.includes(serial)) {
                        fetchedSerials.push(serial);
                    }
                });

                // Set selectedSerials to oldSerials to pre-check them
                selectedSerials = oldSerials;

                // Render serials with checked boxes for selectedSerials
                renderSerials(fetchedSerials);

                $('#serialModal').modal('show');
            },
            error: function () {
                alert('Failed to fetch serials');
            }
        });
    });

    function renderSerials(serials) {
        let serialHtml = '';
        const productId = $('#serialModal').data('product-id');

        if (serials.length === 0) {
            serialHtml = '<p>No serial numbers found.</p>';
        } else {
            serials.forEach(function(serial, index) {
                const isChecked = selectedSerials.includes(serial) ? 'checked' : '';
                serialHtml += `
                    <div class="form-check">
                        <input class="form-check-input serial-check" type="checkbox" value="${serial}" id="serial_${index}" ${isChecked}>
                        <label class="form-check-label" for="serial_${index}">${serial}</label>
                    </div>`;
            });
        }

        $('#serialList').html(serialHtml);
    }

    // Update selectedSerials live when user clicks checkbox
    $(document).on('change', '.serial-check', function() {
        const val = $(this).val();
        if ($(this).is(':checked')) {
            if (!selectedSerials.includes(val)) {
                selectedSerials.push(val);
            }
        } else {
            selectedSerials = selectedSerials.filter(s => s !== val);
        }
    });

    // Search functionality
  $(document).on('input', '#serialSearch', function() {
    const query = $(this).val().toLowerCase();

    // Combine both arrays and remove duplicates
    const combinedSerials = Array.from(new Set([...allSerials, ...fetchedSerials]));

    // Filter matching and non-matching
    const filtered = combinedSerials.filter(serial => serial.toLowerCase().includes(query));
    const nonMatching = combinedSerials.filter(serial => !serial.toLowerCase().includes(query));

    // Show matching first, then non-matching
    const sorted = [...filtered, ...nonMatching];

    renderSerials(sorted);
});


    $('#saveSerialSelection').click(function() {
        const productId = $('#serialModal').data('product-id');

        // Save selectedSerials to localStorage
        localStorage.setItem(`product_${productId}_serials`, JSON.stringify(selectedSerials));

        // Update quantity input and hidden serial input
        const qty = selectedSerials.length;
        $(`input[name="products[${productId}][quantity]"]`).val(qty);

        $(`#serial_nos_${productId}`).val(selectedSerials.join(','));

        $('#serialModal').modal('hide');
    });

</script>

<script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/printer.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/opening_stock.js?v=' . $asset_v) }}"></script>
@include('sale_pos.partials.keyboard_shortcuts')

@if(in_array('tables' ,$enabled_modules) || in_array('modifiers' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules))
    <script src="{{ asset('js/restaurant.js?v=' . $asset_v) }}"></script>
@endif

@if(!empty($pos_module_data))
    @foreach($pos_module_data as $key => $value)
        @if(!empty($value['module_js_path']))
            @includeIf($value['module_js_path'], ['view_data' => $value['view_data']])
        @endif
    @endforeach
@endif

@endsection

@section('css')
<style type="text/css">
    /*CSS to print receipts*/
    .print_section{
        display: none;
    }
    @media print{
        .print_section{
            display: block !important;
        }
    }
    @page {
        size: 3.1in auto;/* width height */
        height: auto !important;
        margin-top: 0mm;
        margin-bottom: 0mm;
    }
    .overlay {
        background: rgba(255,255,255,0) !important;
        cursor: not-allowed;
    }
</style>
@if(!empty($pos_module_data))
    @foreach($pos_module_data as $key => $value)
        @if(!empty($value['module_css_path']))
            @includeIf($value['module_css_path'])
        @endif
    @endforeach
@endif
@endsection
