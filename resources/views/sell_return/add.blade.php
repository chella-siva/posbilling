@extends('layouts.app')
@section('title', __('lang_v1.sell_return'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('lang_v1.sell_return')</h1>
</section>

<!-- Main content -->
<section class="content no-print">

    {!! Form::hidden('location_id', $sell->location->id, ['id' => 'location_id', 'data-receipt_printer_type' => $sell->location->receipt_printer_type ]); !!}

    {!! Form::open(['url' => action([\App\Http\Controllers\SellReturnController::class, 'store']), 'method' => 'post', 'id' => 'sell_return_form' ]) !!}
    {!! Form::hidden('transaction_id', $sell->id); !!}
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">@lang('lang_v1.parent_sale')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-4">
                    <strong>@lang('sale.invoice_no'):</strong> {{ $sell->invoice_no }} <br>
                    <strong>@lang('messages.date'):</strong> {{@format_date($sell->transaction_date)}}
                </div>
                <div class="col-sm-4">
                    <strong>@lang('contact.customer'):</strong> {{ $sell->contact->name }} <br>
                    <strong>@lang('purchase.business_location'):</strong> {{ $sell->location->name }}
                </div>
            </div>
        </div>
    </div>
    <div class="box box-solid">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('invoice_no', __('sale.invoice_no').':') !!}
                        {!! Form::text('invoice_no', !empty($sell->return_parent->invoice_no) ? $sell->return_parent->invoice_no : null, ['class' => 'form-control']); !!}
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        {!! Form::label('transaction_date', __('messages.date') . ':*') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            @php
                            $transaction_date = !empty($sell->return_parent->transaction_date) ? $sell->return_parent->transaction_date : 'now';
                            @endphp
                            {!! Form::text('transaction_date', @format_datetime($transaction_date), ['class' => 'form-control', 'readonly', 'required']); !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <table class="table bg-gray" id="sell_return_table">
                        <thead>
                            <tr class="bg-green">
                                <th>#</th>
                                <th>@lang('product.product_name')</th>
                                <th>@lang('sale.unit_price')</th>
                                <th>@lang('lang_v1.sell_quantity')</th>
                                <th>@lang('lang_v1.return_quantity')</th>
                                <th>@lang('lang_v1.return_subtotal')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $retunrserials = [];  @endphp
                            @foreach($sell->sell_lines as $index => $sell_line)
                            @php
                            $retunrserials = json_decode($sell_line->return_serial_nos, true) ?? [];

                        // Remove surrounding double quotes from each value, if any
                        $retunrserials = array_map(function($serial) {
                            return trim($serial, '"');
                        }, $retunrserials);

                            $check_decimal = 'false';
                            if($sell_line->product->unit->allow_decimal == 0){
                                $check_decimal = 'true';
                            }

                            $unit_name = $sell_line->product->unit->short_name;

                            if(!empty($sell_line->sub_unit)) {
                                $unit_name = $sell_line->sub_unit->short_name;

                                if($sell_line->sub_unit->allow_decimal == 0){
                                    $check_decimal = 'true';
                                } else {
                                    $check_decimal = 'false';
                                }
                            }
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $sell_line->product->name }}
                                    @if( $sell_line->product->type == 'variable')
                                        - {{ $sell_line->variations->product_variation->name}}
                                        - {{ $sell_line->variations->name}}
                                    @endif
                                    <br>
                                    {{ $sell_line->variations->sub_sku }}
                                </td>
                                <td><span class="display_currency" data-currency_symbol="true">{{ $sell_line->unit_price_inc_tax }}</span></td>
                                <td>{{ $sell_line->formatted_qty }} {{$unit_name}}</td>

                                <td>
                                    <input type="text" name="products[{{$loop->index}}][quantity]" value="{{@format_quantity($sell_line->quantity_returned)}}" class="form-control input-sm input_number return_qty input_quantity" data-rule-abs_digit="{{$check_decimal}}" data-msg-abs_digit="@lang('lang_v1.decimal_value_not_allowed')" data-rule-max-value="{{$sell_line->quantity}}" data-msg-max-value="@lang('validation.custom-messages.quantity_not_available', ['qty' => $sell_line->formatted_qty, 'unit' => $unit_name ])">
                                    <input name="products[{{$loop->index}}][unit_price_inc_tax]" type="hidden" class="unit_price" value="{{@num_format($sell_line->unit_price_inc_tax)}}">
                                    <input name="products[{{$loop->index}}][sell_line_id]" type="hidden" value="{{$sell_line->id}}">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-info btn-sm select-serials-btn" data-purchase-line-id="{{ $sell_line->id }}"  data-row_index="{{ $index }}">
                                            Serial No.
                                        </button>
                                    </span>
                                    <input type="hidden" name="return_serials[{{$sell_line->id}}]"  id="return_serials_{{$sell_line->id}}">
                                    <input type="hidden" name="serials[{{$sell_line->id}}]" class="selected-serials" id="selected_serials_{{$sell_line->id}}" value="{{ $sell_line->serial_nos }}">
                                </td>
                                <td>
                                    <div class="return_subtotal"></div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                @php
                $discount_type = !empty($sell->return_parent->discount_type) ? $sell->return_parent->discount_type : $sell->discount_type;
                $discount_amount = !empty($sell->return_parent->discount_amount) ? $sell->return_parent->discount_amount : $sell->discount_amount;
                @endphp
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('discount_type', __( 'purchase.discount_type' ) . ':') !!}
                        {!! Form::select('discount_type', [ '' => __('lang_v1.none'), 'fixed' => __( 'lang_v1.fixed' ), 'percentage' => __( 'lang_v1.percentage' )], $discount_type, ['class' => 'form-control']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('discount_amount', __( 'purchase.discount_amount' ) . ':') !!}
                        {!! Form::text('discount_amount', @num_format($discount_amount), ['class' => 'form-control input_number']); !!}
                    </div>
                </div>
            </div>
            @php
            $tax_percent = 0;
            if(!empty($sell->tax)){
                $tax_percent = $sell->tax->amount;
            }
            @endphp
            {!! Form::hidden('tax_id', $sell->tax_id); !!}
            {!! Form::hidden('tax_amount', 0, ['id' => 'tax_amount']); !!}
            {!! Form::hidden('tax_percent', $tax_percent, ['id' => 'tax_percent']); !!}
            <div class="row">
                <div class="col-sm-12 text-right">
                    <strong>@lang('lang_v1.total_return_discount'):</strong>
                    &nbsp;(-) <span id="total_return_discount"></span>
                </div>
                <div class="col-sm-12 text-right">
                    <strong>@lang('lang_v1.total_return_tax') - @if(!empty($sell->tax))({{$sell->tax->name}} - {{$sell->tax->amount}}%)@endif : </strong>
                    &nbsp;(+) <span id="total_return_tax"></span>
                </div>
                <div class="col-sm-12 text-right">
                    <strong>@lang('lang_v1.return_total'): </strong>&nbsp;
                    <span id="net_return">0</span>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white pull-right">@lang('messages.save')</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <!-- Serial Numbers Modal -->
    <div class="modal fade" id="serialModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Select Serial Numbers</h4>
          </div>
          <div class="modal-body">
            <input type="text" id="serialSearch" class="form-control mb-3" placeholder="Search Serial No.">
            <div id="serial_list_body" class="row"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="applySelectedSerials">Apply</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

</section>
@stop

@section('javascript')
<script src="{{ asset('js/printer.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/sell_return.js?v=' . $asset_v) }}"></script>
<script type="text/javascript">
      const returnserverSerials = @json($retunrserials ?? []);
      console.log(returnserverSerials);
    let selectedSerialsMap = {};

    $(document).ready(function() {
        $('form#sell_return_form').validate();
        update_sell_return_total();
        //Date picker
        // $('#transaction_date').datepicker({
        //     autoclose: true,
        //     format: datepicker_date_format
        // });
    });

    $(document).on('change', 'input.return_qty, #discount_amount, #discount_type', function() {
        update_sell_return_total();
    });

    function update_sell_return_total() {
        var net_return = 0;
        $('table#sell_return_table tbody tr').each(function() {
            var quantity = __read_number($(this).find('input.return_qty'));
            var unit_price = __read_number($(this).find('input.unit_price'));
            var subtotal = quantity * unit_price;
            $(this).find('.return_subtotal').text(__currency_trans_from_en(subtotal, true));
            net_return += subtotal;
        });
        var discount = 0;
        if ($('#discount_type').val() == 'fixed') {
            discount = __read_number($("#discount_amount"));
        } else if ($('#discount_type').val() == 'percentage') {
            var discount_percent = __read_number($("#discount_amount"));
            discount = __calculate_amount('percentage', discount_percent, net_return);
        }
        discounted_net_return = net_return - discount;

        var tax_percent = $('input#tax_percent').val();
        var total_tax = __calculate_amount('percentage', tax_percent, discounted_net_return);
        var net_return_inc_tax = total_tax + discounted_net_return;

        $('input#tax_amount').val(total_tax);
        $('#total_return_discount').text(__currency_trans_from_en(discount, true));
        $('#total_return_tax').text(__currency_trans_from_en(total_tax, true));
        $('#net_return').text(__currency_trans_from_en(net_return_inc_tax, true));
    }

    /****************** Serial Numbers selection for Returns ******************/

    // Declare globally before usage

    $(document).ready(function () {
        // Initialize selectedSerialsMap from hidden inputs on page load
        $('[id^=selected_serials_]').each(function () {
            const lineId = this.id.split('_').pop();
            const serials = $(this).val();
            if (serials) {
                selectedSerialsMap[lineId] = serials.split(',');
            } else {
                selectedSerialsMap[lineId] = [];
            }
        });

        let currentLineId = null;
        let returnserverSerialsRaw = @json($retunrserials ?? '[]'); // might be stringified JSON or array
        let returnserverSerials = [];
    
        try {
            if (typeof returnserverSerialsRaw === 'string') {
                returnserverSerials = JSON.parse(returnserverSerialsRaw);
            } else {
                returnserverSerials = returnserverSerialsRaw;
            }
        } catch(e) {
            returnserverSerials = [];
            console.error('Error parsing returnserverSerials', e);
        }
    
        console.log('Parsed returnserverSerials:', returnserverSerials);

        // When clicking the "Serial No." button

        $(document).on('click', '.select-serials-btn', function () {
            const purchase_line_id = $(this).data('purchase-line-id');
            console.log(purchase_line_id);
            const row_index = $(this).data('row_index');
        
            currentLineId = $(this).data('purchase-line-id');
            console.log(currentLineId);
        
            $('#serialModal').modal('show');
            $('#serial_list_body').html('<p>Loading...</p>');
        
            $.ajax({
                url: `/get-serials-for-returnsell/${purchase_line_id}`,
                type: 'GET',
                success: function (data) {
                    let html = '<div class="row">';
                    const selected = selectedSerialsMap[row_index] || [];
                    console.log(data.serials);
                    const mergedSerials = [...new Set([...data.serials, ...returnserverSerials])];

        
                    mergedSerials.forEach((serial) => {
                        // Remove surrounding quotes if present
                       serial = serial.replace(/[\[\]"']/g, '').trim();

                        const checked = (selected.includes(serial) || returnserverSerials.includes(serial)) ? 'checked' : '';
                        html += `
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="serial-checkbox" data-row="${row_index}" value="${serial}" ${checked}>
                                    ${serial}
                                </label>
                            </div>
                        `;
                    });
        
                    html += '</div>';
                    $('#serial_list_body').html(html);
                },
                error: function (xhr) {
                    $('#serial_list_body').html('<p>Error loading serials.</p>');
                    console.error('Serial load error:', xhr.responseText);
                }
            });
        });



        // Search/filter serial numbers inside modal
        $('#serialSearch').on('keyup', function () {
            let keyword = $(this).val().toLowerCase();
            $('.serial-box').each(function () {
                let text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(keyword));
            });
        });

        // Apply selected serial numbers when clicking apply button
//   $('#applySelectedSerials').click(function () {
//     let selected = [];

//     $('.serial-checkbox:checked').each(function () {
//         const value = $(this).val().replace(/^"(.*)"$/, '$1');
//         selected.push(value);
//         console.log('Selected serial:', value);
//     });
//     console.log(currentLineId);
//     selectedSerialsMap[currentLineId] = selected;

//     $('#return_serials_' + currentLineId).val(selected.join(','));
//     $('#return_qty_' + currentLineId).val(selected.length).trigger('change');

//     console.log(`Line ${currentLineId} - Serials:`, selected);

//     $('#serialModal').modal('hide');
// });
$('#applySelectedSerials').click(function () {
    let selected = [];
    let allSerials = [];

    $('.serial-checkbox').each(function () {
        const value = $(this).val().replace(/^"(.*)"$/, '$1');
        allSerials.push(value);

        if ($(this).is(':checked')) {
            selected.push(value);
            console.log('Selected serial:', value);
        }
    });

    console.log('Current Line ID:', currentLineId);
    
    // Store selected serials (checked)
    selectedSerialsMap[currentLineId] = selected;

    // Update hidden inputs
    $('#return_serials_' + currentLineId).val(selected.join(',')); // for return_serials[]
    $('#return_qty_' + currentLineId).val(selected.length).trigger('change');

    // NEW: also store all serials (checked + unchecked)
    $('#selected_serials_' + currentLineId).val(JSON.stringify(allSerials)); // for serials[]

    console.log(`Line ${currentLineId} - Selected Serials:`, selected);
    console.log(`Line ${currentLineId} - All Serials:`, allSerials);

    $('#serialModal').modal('hide');
});



    });
</script>
@stop
