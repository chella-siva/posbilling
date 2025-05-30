<div class="modal-dialog modal-xl" role="document">
	<div class="modal-content">
	{!! Form::open(['url' => action([\App\Http\Controllers\OpeningStockController::class, 'save']), 'method' => 'post', 'id' => 'add_opening_stock_form' ]) !!}
	{!! Form::hidden('product_id', $product->id); !!}
		<div class="modal-header">
		    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      <h4 class="modal-title" id="modalTitle">@lang('lang_v1.add_opening_stock')</h4>
	    </div>
	    <div class="modal-body">
			@include('opening_stock.form-part')
		</div>
		<div class="modal-footer">
			<button type="button" class="tw-dw-btn tw-dw-btn-primary tw-text-white" id="add_opening_stock_btn">@lang('messages.save')</button>
		    <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white no-print" data-dismiss="modal">@lang( 'messages.close' )</button>
		 </div>
	 {!! Form::close() !!}
	</div>
</div>


