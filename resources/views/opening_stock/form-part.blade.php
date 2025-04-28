<div class="row">
	<div class="col-sm-12">
		@forelse($locations as $key => $value)
		<div class="box box-solid">
			<div class="box-header">
	            <h3 class="box-title">@lang('sale.location'): {{$value}}</h3>
	        </div>
			<div class="box-body">
				<div class="row tw-overflow-scroll">
					<div class="col-sm-12">
						<table class="table table-condensed table-bordered text-center table-responsive table-striped add_opening_stock_table">
								<thead>
								<tr class="bg-green">
									<th>@lang( 'product.product_name' )</th>
									<th>@lang( 'lang_v1.quantity_left' )</th>
									<th>@lang( 'purchase.unit_cost_before_tax' )</th>
									@if($enable_expiry == 1 && $product->enable_stock == 1)
										<th>Exp. Date</th>
									@endif
									@if($enable_lot == 1)
										<th>@lang( 'lang_v1.lot_number' )</th>
									@endif
									<th>@lang( 'purchase.subtotal_before_tax' )</th>
									<th>@lang( 'lang_v1.date' )</th>
									<th>@lang( 'brand.note' )</th>
									<th>&nbsp;</th>
								</tr>
								</thead>
								<tbody>
@php
	$subtotal = 0;
@endphp
@foreach($product->variations as $variation)
	@if(empty($purchases[$key][$variation->id]))
		@php
			$purchases[$key][$variation->id][] = ['quantity' => 0, 
			'purchase_price' => $variation->default_purchase_price,
			'purchase_line_id' => null,
			'lot_number' => null,
			'transaction_date' => null,
			'purchase_line_note' => null,
			'secondary_unit_quantity' => 0
			]
		@endphp
	@endif

@foreach($purchases[$key][$variation->id] as $sub_key => $var)
	@php

	$purchase_line_id = $var['purchase_line_id'];

	$qty = $var['quantity'];

	$purcahse_price = $var['purchase_price'];

	$row_total = $qty * $purcahse_price;

	$subtotal += $row_total;
	$lot_number = $var['lot_number'];
	$transaction_date = $var['transaction_date'];
	$purchase_line_note = $var['purchase_line_note'];
	@endphp

<tr>
	<td>
		{{ $product->name }} @if( $product->type == 'variable' ) (<b>{{ $variation->product_variation->name }}</b> : {{ $variation->name }}) @endif

		@if(!empty($purchase_line_id))
			{!! Form::hidden('stocks[' . $key . '][' . $variation->id . '][' . $sub_key . '][purchase_line_id]', $purchase_line_id); !!}
		@endif
	</td>
	<td>
	<div class="input-group">
		{!! Form::text('stocks[' . $key . '][' . $variation->id . '][' . $sub_key . '][quantity]', @format_quantity($qty), ['class' => 'form-control input-sm input_number purchase_quantity input_quantity', 'required', 'id' => 'quantity_'.$key.'_'.$variation->id.'_'.$sub_key]) !!}
		<span class="input-group-addon">
			{{ $product->unit->short_name }}
		</span>
		<span class="input-group-btn">
			<button type="button" class="btn btn-sm btn-primary open-serial-modal" data-product-id="{{$variation->product_id}}" data-variation-id="{{$variation->id}}" data-key="{{$key}}" data-subkey="{{$sub_key}}"><i class="fa fa-barcode"></i> Serial No</button>
		</span>
		</div>

		@if(!empty($product->second_unit))
			<br>
            <span>
            @lang('lang_v1.quantity_in_second_unit', ['unit' => $product->second_unit->short_name])*:</span><br>
            {!! Form::text('stocks[' . $key . '][' . $variation->id . '][' . $sub_key . '][secondary_unit_quantity]', @format_quantity($var['secondary_unit_quantity']) , ['class' => 'form-control input-sm input_number input_quantity', 'required']); !!}
		@endif
	</td>
<td>
	{!! Form::text('stocks[' . $key . '][' . $variation->id . '][' . $sub_key . '][purchase_price]', @num_format($purcahse_price) , ['class' => 'form-control input-sm input_number unit_price', 'required']); !!}
</td>

@if($enable_expiry == 1 && $product->enable_stock == 1)
	<td>
		{!! Form::text('stocks[' . $key . '][' . $variation->id . '][' . $sub_key . '][exp_date]', !empty($var['exp_date']) ? @format_date($var['exp_date']) : null , ['class' => 'form-control input-sm os_exp_date', 'readonly']); !!}
	</td>
@endif

@if($enable_lot == 1)
	<td>
		{!! Form::text('stocks[' . $key . '][' . $variation->id . '][' . $sub_key . '][lot_number]', $lot_number , ['class' => 'form-control input-sm']); !!}
	</td>
@endif
	<td>
		<span class="row_subtotal_before_tax">{{@num_format($row_total)}}</span>
	</td>
	<td>
		<div class="input-group date">
		{!! Form::text('stocks[' . $key . '][' . $variation->id . '][' . $sub_key . '][transaction_date]', $transaction_date , ['class' => 'form-control input-sm os_date', 'readonly']); !!}
		</div>
	</td>
	<td>
		{!! Form::textarea('stocks[' . $key . '][' . $variation->id . '][' . $sub_key . '][purchase_line_note]', $purchase_line_note , ['class' => 'form-control input-sm', 'rows' => 3 ]); !!}
	</td>
	<td>
		@if($loop->index == 0)
			<button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline  tw-dw-btn-primary add_stock_row" data-sub-key="{{ count($purchases[$key][$variation->id])}}" 
				data-row-html='<tr>
					<td>
						{{ $product->name }} @if( $product->type == "variable" ) (<b>{{ $variation->product_variation->name }}</b> : {{ $variation->name }}) @endif
					</td>
					<td>
					<div class="input-group">
	              		<input class="form-control input-sm input_number purchase_quantity" required="" name="stocks[{{$key}}][{{$variation->id}}][__subkey__][quantity]" type="text" value="0">
			              <span class="input-group-addon">
			                {{ $product->unit->short_name }}
			              </span>
	        			</div>
					</td>
	<td>
		<input class="form-control input-sm input_number unit_price" required="" name="stocks[{{$key}}][{{$variation->id}}][__subkey__][purchase_price]" type="text" value="{{@num_format($purcahse_price)}}">
	</td>

	@if($enable_expiry == 1 && $product->enable_stock == 1)
	<td>
		<input class="form-control input-sm os_exp_date" required="" name="stocks[{{$key}}][{{$variation->id}}][__subkey__][exp_date]" type="text" readonly>
	</td>
	@endif

	@if($enable_lot == 1)
	<td>
		<input class="form-control input-sm" name="stocks[{{$key}}][{{$variation->id}}][__subkey__][lot_number]" type="text">
	</td>
	@endif
	<td>
		<span class="row_subtotal_before_tax">
			0.00
		</span>
	</td>
	<td>
		<div class="input-group date">
			<input class="form-control input-sm os_date" name="stocks[{{$key}}][{{$variation->id}}][__subkey__][transaction_date]" type="text" readonly>
		</div>
	</td>
	<td>
		<textarea rows="3" class="form-control input-sm" name="stocks[{{$key}}][{{$variation->id}}][__subkey__][purchase_line_note]"></textarea>
	</td>
	<td>&nbsp;</td></tr>'
	><i class="fa fa-plus"></i></button>
	@else
		&nbsp;
	@endif
			</td>
			</tr>
		@endforeach
	@endforeach
								</tbody>
								<tfoot>
								<tr>
									<td colspan="@if($enable_expiry == 1 && $product->enable_stock == 1 && $enable_lot == 1) 5 @elseif(($enable_expiry == 1 && $product->enable_stock == 1) || $enable_lot == 1) @else 3 @endif"></td>
									<td><strong>@lang( 'lang_v1.total_amount_exc_tax' ): </strong> <span id="total_subtotal">{{@num_format($subtotal)}}</span>
									<input type="hidden" id="total_subtotal_hidden" value=0>
									</td>
								</tr>
								</tfoot>
						</table>
						
					</div>
				</div>
			</div>
		</div> <!--box end-->
		@empty
    		<h3>@lang( 'lang_v1.product_not_assigned_to_any_location' )</h3>
		@endforelse
	</div>
</div>
<!-- Serial No Modal -->
<!-- Serial No Modal -->
<div class="modal fade" id="serialNoModal" tabindex="-1" role="dialog" aria-labelledby="serialNoModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="serialNoModalLabel">Add Serial Numbers</h4>
      </div>
      <div class="modal-body">
        <div class="input-group mb-2">
          <input type="text" id="serial-input" class="form-control" placeholder="Enter Serial No">
          <div class="input-group-append">
            <button class="btn btn-success btn-add-serial" type="button"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <div id="serial-list" class="mt-2">
          <!-- Serial numbers will appear here -->
        </div>
        <small class="text-muted">Press Enter or Click + to add serial numbers. Click (x) to remove.</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save-serials">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

@section('javascript')
<!-- Load jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Load Bootstrap JS next (required for modal) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
var currentProductId, currentVariationId, currentKey, currentSubKey;
var serials = []; // store serials here

// When Serial No button is clicked
$(document).on('click', '.open-serial-modal', function() {
    currentProductId = $(this).data('product-id');
    currentVariationId = $(this).data('variation-id');
    currentKey = $(this).data('key');
    currentSubKey = $(this).data('subkey');

    serials = []; // reset serials
    updateSerialDisplay();

    // Fetch the serial numbers for this product and variation
    $.ajax({
        url: '{{ route("product_serials.get", ["product_id" => "__product_id__", "variation_id" => "__variation_id__"]) }}'
            .replace('__product_id__', currentProductId)
            .replace('__variation_id__', currentVariationId),
        method: 'GET',
        success: function(response) {
            // Populate the serials array with the fetched serial numbers
            serials = response.serials || [];
            updateSerialDisplay(); // Update the display with fetched serials
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while fetching serial numbers.'
            });
        }
    });

    $('#serialNoModal').modal('show');
});

// Function to update the serial numbers display in the modal
function updateSerialDisplay() {
    var html = '';
    serials.forEach(function(serial, index){
        html += '<span class="badge badge-primary m-1">'+serial+' <a href="#" class="text-white remove-serial" data-index="'+index+'">&times;</a></span>';
    });
    $('#serial-list').html(html);
}

// Remove serial number
$(document).on('click', '.remove-serial', function(e){
    e.preventDefault();
    var index = $(this).data('index');
    serials.splice(index, 1);
    updateSerialDisplay();
});

// Add serial number on input enter or button click
$(document).on('keypress', '#serial-input', function(e) {
    if (e.which == 13) { // Enter key
        e.preventDefault();
        addSerial();
    }
});
$(document).on('click', '.btn-add-serial', function() {
    addSerial();
});

// Add serial to list
function addSerial() {
    var serial = $('#serial-input').val().trim();
    if(serial !== ''){
        serials.push(serial);
        $('#serial-input').val('');
        updateSerialDisplay();
    }
}

// Update serial numbers display
function updateSerialDisplay() {
    var html = '';
    serials.forEach(function(serial, index){
        html += '<span class="badge badge-primary m-1">'+serial+' <a href="#" class="text-white remove-serial" data-index="'+index+'">&times;</a></span>';
    });
    $('#serial-list').html(html);
}

// Remove serial number
$(document).on('click', '.remove-serial', function(e){
    e.preventDefault();
    var index = $(this).data('index');
    serials.splice(index, 1);
    updateSerialDisplay();
});

$(document).on('click', '.save-serials', function() {
	if(serials.length > 0){
        // update quantity based on serials count (Add instead of Replace)
        // var quantityInput = $('#quantity_'+currentKey+'_'+currentVariationId+'_'+currentSubKey);
        // var existingQuantity = parseFloat(quantityInput.val()) || 0;
        // var newQuantity = existingQuantity + serials.length;
        // quantityInput.val(newQuantity);
		var quantityInput = $('#quantity_'+currentKey+'_'+currentVariationId+'_'+currentSubKey);
        quantityInput.val(serials.length);

        // Save into database via AJAX
        $.ajax({
            url: '{{ route("product_serials.store") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: currentProductId,
                variation_id: currentVariationId,
                serials: serials
            },
            success: function(response){
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Serial numbers saved successfully!'
                });
                $('#serialNoModal').modal('hide');
            },
            error: function(xhr){
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let messages = Object.values(xhr.responseJSON.errors)
                                          .flat()
                                          .join('<br>');

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: messages
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An unexpected error occurred while saving serial numbers.'
                    });
                }
            }
        });
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'No Serial Numbers',
            text: 'Please enter at least one Serial No.'
        });
    }
});


</script>
@endsection

