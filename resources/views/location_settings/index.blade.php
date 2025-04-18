@extends('layouts.app')
@section('title', __('messages.business_location_settings'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang( 'messages.business_location_settings' ) - {{$location->name}}</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">@lang('receipt.receipt_settings')</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>@lang( 'receipt.receipt_settings')
                                <small>@lang( 'receipt.receipt_settings_mgs')</small>
                            </h4>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['url' => route('location.settings_update', [$location->id]), 'method' => 'post', 'id' => 'bl_receipt_setting_form']) !!}

                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('print_receipt_on_invoice', __('receipt.print_receipt_on_invoice') . ':') !!}
                                @show_tooltip(__('tooltip.print_receipt_on_invoice'))
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-file-alt"></i>
                                    </span>
                                    {!! Form::select('print_receipt_on_invoice', $printReceiptOnInvoice, $location->print_receipt_on_invoice, ['class' => 'form-control select2', 'required']); !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('receipt_printer_type', __('receipt.receipt_printer_type') . ':*') !!} @show_tooltip(__('tooltip.receipt_printer_type'))
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-print"></i>
                                    </span>
                                    {!! Form::select('receipt_printer_type', $receiptPrinterType, $location->receipt_printer_type, ['class' => 'form-control select2', 'required']); !!}
                                </div>
                                @if(config('app.env') == 'demo')
                                    <span class="help-block">Only Browser based option is enabled in demo.</span>
                                @endif
                                
                            </div>
                        </div>

                        <div class="col-sm-4" 
                            id="location_printer_div">
                            <div class="form-group">
                                {!! Form::label('printer_id', __('printer.receipt_printers') . ':*') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-share-alt"></i>
                                    </span>
                                    {!! Form::select('printer_id', $printers, $location->printer_id, ['class' => 'form-control select2', 'required']); !!}
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>

                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('invoice_layout_id', __('invoice.invoice_layout') . ':*') !!} @show_tooltip(__('tooltip.invoice_layout'))
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                    </span>
                                    {!! Form::select('invoice_layout_id', $invoice_layouts, $location->invoice_layout_id, ['class' => 'form-control select2', 'required']); !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('pos_layout_id', __('invoice.pos_layout') . ':*') !!} @show_tooltip(__('tooltip.pos_layout'))
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                    </span>
                                    {!! Form::select('pos_layout_id', $pos_layouts, $location->pos_layout_id, ['class' => 'form-control select2', 'required']); !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('quotation_layout_id', __('invoice.quotation_layout') . ':*') !!} @show_tooltip(__('tooltip.quotation_layout'))
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                    </span>
                                    {!! Form::select('quotation_layout_id', $quotation_layouts, $location->quotation_layout_id, ['class' => 'form-control select2', 'required']); !!}
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('invoice_scheme_id', __('invoice.invoice_scheme') . ':*') !!} @show_tooltip(__('tooltip.invoice_scheme'))
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                    </span>
                                    {!! Form::select('invoice_scheme_id', $invoice_schemes, $location->invoice_scheme_id, ['class' => 'form-control select2', 'required']); !!}
                                </div>
                            </div>
                        </div>


                        

                        <div class="row">
                            <div class="col-sm-12">
                                <button class="tw-dw-btn tw-dw-btn-primary tw-text-white pull-right" type="submit">@lang('messages.update')</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
    </div>
	
    <div class="modal fade invoice_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal fade invoice_edit_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

@endsection
