@extends('layouts.app')
@section('title', __('lang_v1.purchase_return'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('lang_v1.purchase_return')</h1>
</section>

<!-- Main content -->
<section class="content">
	{!! Form::open(['url' => action([\App\Http\Controllers\PurchaseReturnController::class, 'store']), 'method' => 'post', 'id' => 'purchase_return_form' ]) !!}
	{!! Form::hidden('transaction_id', $purchase->id); !!}

	@component('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.parent_purchase')])
		<div class="row">
			<div class="col-sm-4">
				<strong>@lang('purchase.ref_no'):</strong> {{ $purchase->ref_no }} <br>
				<strong>@lang('messages.date'):</strong> {{@format_date($purchase->transaction_date)}}
			</div>
			<div class="col-sm-4">
				<strong>@lang('purchase.supplier'):</strong> {{ $purchase->contact->name }} <br>
				<strong>@lang('purchase.business_location'):</strong> {{ $purchase->location->name }}
			</div>
		</div>
	@endcomponent

	@component('components.widget', ['class' => 'box-primary'])
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					{!! Form::label('ref_no', __('purchase.ref_no').':') !!}
					{!! Form::text('ref_no', !empty($purchase->return_parent->ref_no) ? $purchase->return_parent->ref_no : null, ['class' => 'form-control']); !!}
				</div>
			</div>
			<div class="clearfix"></div>
			<hr>
			<div class="col-sm-12">
				<table class="table bg-gray" id="purchase_return_table">
		          	<thead>
			            <tr class="bg-green">
			              	<th>#</th>
			              	<th>@lang('product.product_name')</th>
			              	<th>@lang('sale.unit_price')</th>
			              	<th>@lang('purchase.purchase_quantity')</th>
			              	<th>@lang('lang_v1.quantity_left')</th>
			              	<th>@lang('lang_v1.return_quantity')</th>
			              	<th>@lang('lang_v1.return_subtotal')</th>
			            </tr>
			        </thead>
			        <tbody>
			            @php $retunrserials = [];  @endphp
			          	@foreach($purchase->purchase_lines as $purchase_line)
			          	@php
                            $retunrserials = json_decode($purchase_line->return_serial_nos, true) ?? [];
			          		$unit_name = $purchase_line->product->unit->short_name;

			          		$check_decimal = 'false';
			                if($purchase_line->product->unit->allow_decimal == 0){
			                    $check_decimal = 'true';
			                }

			          		if(!empty($purchase_line->sub_unit->base_unit_multiplier)) {
			          			$unit_name = $purchase_line->sub_unit->short_name;

			          			if($purchase_line->sub_unit->allow_decimal == 0){
			                    	$check_decimal = 'true';
			                	} else {
			                		$check_decimal = 'false';
			                	}
			          		}

			          		$qty_available = $purchase_line->quantity - $purchase_line->quantity_sold - $purchase_line->quantity_adjusted;
			          	@endphp
			            <tr>
			              	<td>{{ $loop->iteration }}</td>
			              	<td>
			                	{{ $purchase_line->product->name }}
			                 	@if( $purchase_line->product->type == 'variable')
			                  	- {{ $purchase_line->variations->product_variation->name}}
			                  	- {{ $purchase_line->variations->name}}
			                 	@endif
			              	</td>
			              	<td><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->purchase_price_inc_tax }}</span></td>
			              	<td><span class="display_currency" data-is_quantity="true" data-currency_symbol="false">{{ $purchase_line->quantity }}</span> {{$unit_name}}</td>
			              	<td><span class="display_currency" data-currency_symbol="false" data-is_quantity="true">{{ $qty_available }}</span> {{$unit_name}}</td>
			              	<td>
			              		@php
					                $check_decimal = 'false';
					                if($purchase_line->product->unit->allow_decimal == 0){
					                    $check_decimal = 'true';
					                }
					            @endphp
					           <div class="input-group">
                                <input type="text"
                                    name="returns[{{$purchase_line->id}}]"
                                    id="return_qty_{{$purchase_line->id}}"
                                    value="{{ @format_quantity($purchase_line->quantity_returned) }}"
                                    class="form-control input-sm input_number return_qty input_quantity"
                                    data-rule-abs_digit="{{ $check_decimal }}" 
                                    data-msg-abs_digit="@lang('lang_v1.decimal_value_not_allowed')"
                                    @if($purchase_line->product->enable_stock)
                                        data-rule-max-value="{{ $qty_available }}"
                                        data-msg-max-value="@lang('validation.custom-messages.quantity_not_available', ['qty' => $purchase_line->formatted_qty_available, 'unit' => $unit_name ])"
                                    @endif
                                >
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-sm select-serials-btn" data-purchase-line-id="{{ $purchase_line->id }}">
                                        Serial No.
                                    </button>
                                </span>
                                <input type="hidden" name="return_serials[{{$purchase_line->id}}]"  id="return_serials_{{$purchase_line->id}}">

                            </div>
                            
                            <!-- Hidden input to store selected serials -->
                            <input type="hidden" name="serials[{{$purchase_line->id}}]" class="selected-serials" id="selected_serials_{{$purchase_line->id}}" value="{{ $purchase_line->serial_nos }}">

					            <input type="hidden" class="unit_price" value="{{@num_format($purchase_line->purchase_price_inc_tax)}}">
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
			<div class="col-sm-4">
				<strong>@lang('lang_v1.total_return_tax'): </strong>
				<span id="total_return_tax"></span> @if(!empty($purchase->tax))({{$purchase->tax->name}} - {{$purchase->tax->amount}}%)@endif
				@php
					$tax_percent = 0;
					if(!empty($purchase->tax)){
						$tax_percent = $purchase->tax->amount;
					}
				@endphp
				{!! Form::hidden('tax_id', $purchase->tax_id); !!}
				{!! Form::hidden('tax_amount', 0, ['id' => 'tax_amount']); !!}
				{!! Form::hidden('tax_percent', $tax_percent, ['id' => 'tax_percent']); !!}
			</div>
		</div>
		<div class="row">
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
	@endcomponent

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
        <div id="serialModalBody" class="row"></div>
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
<script type="text/javascript">
	$(document).ready( function(){
		$('form#purchase_return_form').validate();
		update_purchase_return_total();
	});
	$(document).on('change', 'input.return_qty', function(){
		update_purchase_return_total()
	});

	function update_purchase_return_total(){
		var net_return = 0;
		$('table#purchase_return_table tbody tr').each( function(){
			var quantity = __read_number($(this).find('input.return_qty'));
			var unit_price = __read_number($(this).find('input.unit_price'));
			var subtotal = quantity * unit_price;
			$(this).find('.return_subtotal').text(__currency_trans_from_en(subtotal, true));
			net_return += subtotal;
		});
		var tax_percent = $('input#tax_percent').val();
		var total_tax = __calculate_amount('percentage', tax_percent, net_return);
		var net_return_inc_tax = total_tax + net_return;

		$('input#tax_amount').val(total_tax);
		$('span#total_return_tax').text(__currency_trans_from_en(total_tax, true));
		$('span#net_return').text(__currency_trans_from_en(net_return_inc_tax, true));
	}
</script>
<script>
$(document).ready(function () {
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

    // selectedSerialsMap: map lineId => array of serials selected
    let selectedSerialsMap = {};

    // If returnserverSerials is a plain array, we don't know which lineId to assign to.
    // So, leave selectedSerialsMap empty initially,
    // or if you can, populate it here with lineIds.

    let currentLineId = null;

    $('.select-serials-btn').click(function () {
    currentLineId = $(this).data('purchase-line-id');

    $.ajax({
        method: 'GET',
        url: '/get-serials-for-return/' + currentLineId,
        success: function (response) {
            if (response.success) {
                let html = '';
                // Use returnserverSerials globally (ignores per-line)
                // const alreadySelected = selectedSerialsMap[currentLineId] || [];

              // Merge arrays (avoid duplicates)
                const mergedSerials = [...new Set([...response.serials, ...returnserverSerials])];
                console.log(mergedSerials);
                
               mergedSerials.forEach(serial => {
                  const isChecked = returnserverSerials.includes(serial) ? 'checked' : '';
                  html += `
                    <div class="col-md-3 serial-box">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="serial-checkbox" value="${serial}" ${isChecked}> ${serial}
                      </label>
                    </div>`;
                });


                $('#serialModalBody').html(html);
                $('#serialModal').modal('show');
            } else {
                alert('Failed to load serials.');
            }
        },
        error: function () {
            alert('Error fetching serials.');
        }
    });
});


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



$('#confirm_serial_selection').on('click', function () {
    const row_index = $(this).data('row_index');
    const checked = $(`.serial-checkbox[data-row="${row_index}"]:checked`);
    const serials = checked.map(function () {
        return this.value;
    }).get();

    selected_serials[row_index] = serials;

    $(`#qty_${row_index}`).val(serials.length); // update qty

    $('#serialModal').modal('hide');
});
});
		</script>
	
@endsection
