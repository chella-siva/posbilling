@extends('layouts.app')
@section('title',  __('invoice.edit_quotation_layout'))

@section('content')
<style type="text/css">



</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('invoice.edit_quotation_layout')</h1>
</section>

<!-- Main content -->
<section class="content">
{!! Form::open(['url' => action([\App\Http\Controllers\QuotationLayoutController::class, 'update'], [$quotation_layout->id]), 'method' => 'put', 
  'id' => 'add_quotation_layout_form', 'files' => true]) !!}

  @php
    $product_custom_fields = !empty($quotation_layout->product_custom_fields) ? $quotation_layout->product_custom_fields : [];
    $contact_custom_fields = !empty($quotation_layout->contact_custom_fields) ? $quotation_layout->contact_custom_fields : [];
    $location_custom_fields = !empty($quotation_layout->location_custom_fields) ? $quotation_layout->location_custom_fields : [];
    $custom_labels = json_decode(session('business.custom_labels'), true);
  @endphp
  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
         <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('name', __('invoice.layout_name') . ':*') !!}
                  {!! Form::text('name', $quotation_layout->name, ['class' => 'form-control', 'required',
                  'placeholder' => __('invoice.layout_name')]); !!}
              </div>
          </div>
    
          <div class="col-sm-6">
            <div class="form-group">
              {!! Form::label('design', __('lang_v1.design') . ':*') !!}
                {!! Form::select('design', $designs, $quotation_layout->design, ['class' => 'form-control']); !!}
                <span class="help-block">
                  @lang('lang_v1.used_for_browser_based_printing')
                </span>
            </div>
  
            <div class="form-group @if($quotation_layout->design != 'columnize-taxes') hide @endif" id="columnize-taxes">
              <div class="col-md-3">
                <input type="text" class="form-control" 
                name="table_tax_headings[]" required="required" placeholder="tax 1 name" value="{{$quotation_layout->table_tax_headings[0]}}"
                @if($quotation_layout->design != 'columnize-taxes') disabled @endif>
                @show_tooltip(__('lang_v1.tooltip_columnize_taxes_heading'))
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" 
                name="table_tax_headings[]" placeholder="tax 2 name" 
                value="{{$quotation_layout->table_tax_headings[1]}}"
                @if($quotation_layout->design != 'columnize-taxes') disabled @endif>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" 
                name="table_tax_headings[]" placeholder="tax 3 name"
                value="{{$quotation_layout->table_tax_headings[2]}}"
                @if($quotation_layout->design != 'columnize-taxes') disabled @endif>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" 
                name="table_tax_headings[]" placeholder="tax 4 name"
                value="{{$quotation_layout->table_tax_headings[3]}}"
                @if($quotation_layout->design != 'columnize-taxes') disabled @endif>
              </div>
  
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="col-sm-6">
              <div class="form-group">
                  <div class="checkbox">
                  <label>
                      {!! Form::checkbox('show_letter_head', 1, $quotation_layout->show_letter_head, 
                          ['class' => 'input-icheck', 'id' => 'show_letter_head']); !!} 
                          @lang('lang_v1.show_letter_head')</label>
                  </div>
              </div>

              <div class="">
                @php $image = $quotation_layout->letter_head;  @endphp
                <div class=" image-container letter_head_input" style="max-height: 300px;">
                    @if ($image && file_exists(public_path('uploads/invoice_logos/' . $image)))
                        <img src="{{ asset('uploads/invoice_logos/' . $image) }}" alt="Product Image" style="height: auto;">
                        <!-- Close button to remove image -->
                        <button style="position: absolute;top: 0;right: 0;" type="button" class="btn btn-danger" onclick="removeImage()" title="Remove image">X</button>
                    @else
                        <img src="{{ asset('img/default.png') }}" alt="Default Image" style="width: 150px; height: auto;">
                    @endif
                </div>
          </div>

          </div>
    
          
    
            <div class="col-sm-4 letter_head_input">
                <div class="form-group">
                    {!! Form::label('letter_head', __('lang_v1.letter_head') . ':') !!}
                    {!! Form::file('letter_head', ['accept' => 'image/*']); !!}
                    <span class="help-block">@lang('lang_v1.letter_head_help') <br> @lang('lang_v1.invoice_logo_help', ['max_size' => '1 MB']) <br> @lang('lang_v1.letter_head_help2')</span>
                </div>
            </div>
      </div>
 
      <div class="row hide-for-letterhead">
        <!-- Logo -->

        <div class="col-sm-4">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_logo', 1, $quotation_layout->show_logo, ['class' => 'input-icheck']); !!} @lang('invoice.show_logo')</label>
              </div>
          </div>
          <div class=" ">
              @php $image1 = $quotation_layout->logo; @endphp
          <div class="form-group">
            <div class="image-container" style="height: 150px; max-width: 150px;"> <!-- Increased the size of the image container -->
              <div class="checkbox">
                  @if ($image1 && file_exists(public_path('uploads/invoice_logos/' . $image1)))
                      <img src="{{ asset('uploads/invoice_logos/' . $image1) }}" alt="Product Image" style="width: 150px; height: auto;">
                      <!-- Close button to remove image -->
                      <button style="position: absolute;top: 0;right: 0;" type="button" class="btn btn-danger" onclick="removeImagelogo()" title="Remove Image">X</button>
                  @else
                    <label>
                      <img src="{{ asset('img/default.png') }}" alt="Default Image" style="width: 150px; height: auto;">
                  @endif
              </div>
            </div>
          </div>
        </div>

        </div> 
    
        <div class="col-sm-8">
          <div class="form-group">
            {!! Form::label('logo', __('invoice.invoice_logo') . ':') !!}
            {!! Form::file('logo', ['accept' => 'image/*']); !!}
            <span class="help-block">@lang('lang_v1.invoice_logo_help', ['max_size' => '1 MB'])<br> @lang('lang_v1.invoice_logo_help2')</span>

          </div>
        </div>
        
      </div>

            <div class="row">
            
                <div class="col-sm-12">
                  <div class="form-group">
                    {!! Form::label('header_text', __('invoice.header_text') . ':' ) !!}
                      {!! Form::textarea('header_text', $quotation_layout->header_text, ['class' => 'form-control',
                      'placeholder' => __('invoice.header_text'), 'rows' => 3]); !!}
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-4">
                  <div class="form-group">
                    {!! Form::label('sub_heading_line1', __('lang_v1.sub_heading_line', ['_number_' => 1]) . ':' ) !!}
                    {!! Form::text('sub_heading_line1', $quotation_layout->sub_heading_line1, ['class' => 'form-control',
                      'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 1]) ]); !!}
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    {!! Form::label('sub_heading_line2', __('lang_v1.sub_heading_line', ['_number_' => 2]) . ':' ) !!}
                    {!! Form::text('sub_heading_line2', $quotation_layout->sub_heading_line2, ['class' => 'form-control',
                      'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 2]) ]); !!}
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    {!! Form::label('sub_heading_line3', __('lang_v1.sub_heading_line', ['_number_' => 3]) . ':' ) !!}
                    {!! Form::text('sub_heading_line3', $quotation_layout->sub_heading_line3, ['class' => 'form-control',
                      'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 3]) ]); !!}
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-4">
                  <div class="form-group">
                    {!! Form::label('sub_heading_line4', __('lang_v1.sub_heading_line', ['_number_' => 4]) . ':' ) !!}
                    {!! Form::text('sub_heading_line4', $quotation_layout->sub_heading_line4, ['class' => 'form-control',
                      'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 4]) ]); !!}
                  </div>
                </div>                
                <div class="col-sm-4">
                  <div class="form-group">
                    {!! Form::label('sub_heading_line5', __('lang_v1.sub_heading_line', ['_number_' => 5]) . ':' ) !!}
                    {!! Form::text('sub_heading_line5', $quotation_layout->sub_heading_line5, ['class' => 'form-control',
                      'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 5]) ]); !!}
                  </div>
                </div>
          </div>
    
        </div>
      </div>

  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('invoice_heading', __('invoice.invoice_heading') . ':' ) !!}
            {!! Form::text('invoice_heading', $quotation_layout->invoice_heading, ['class' => 'form-control',
              'placeholder' => __('invoice.invoice_heading') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('invoice_heading_not_paid', __('invoice.invoice_heading_not_paid') . ':' ) !!}
            {!! Form::text('invoice_heading_not_paid', $quotation_layout->invoice_heading_not_paid, ['class' => 'form-control',
              'placeholder' => __('invoice.invoice_heading_not_paid') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('invoice_heading_paid', __('invoice.invoice_heading_paid') . ':' ) !!}
            {!! Form::text('invoice_heading_paid', $quotation_layout->invoice_heading_paid, ['class' => 'form-control',
              'placeholder' => __('invoice.invoice_heading_paid') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('proforma_heading', __('lang_v1.proforma_heading') . ':' ) !!}
            @show_tooltip(__('lang_v1.tooltip_proforma_heading'))
            {!! Form::text('common_settings[proforma_heading]', !empty($quotation_layout->common_settings['proforma_heading']) ? $quotation_layout->common_settings['proforma_heading'] : null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.proforma_heading'), 'id' => 'proforma_heading' ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('quotation_heading', __('lang_v1.quotation_heading') . ':' ) !!}@show_tooltip(__('lang_v1.tooltip_quotation_heading'))
            {!! Form::text('quotation_heading', $quotation_layout->quotation_heading, ['class' => 'form-control', 'placeholder' => __('lang_v1.quotation_heading') ]); !!}
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('sales_order_heading', __('lang_v1.sales_order_heading') . ':' ) !!}
            {!! Form::text('common_settings[sales_order_heading]', !empty($quotation_layout->common_settings['sales_order_heading']) ? $quotation_layout->common_settings['sales_order_heading'] : null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.sales_order_heading'), 'id' => 'sales_order_heading' ]); !!}
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('invoice_no_prefix', __('invoice.invoice_no_prefix') . ':' ) !!}
            {!! Form::text('invoice_no_prefix', $quotation_layout->invoice_no_prefix, ['class' => 'form-control',
              'placeholder' => __('invoice.invoice_no_prefix') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('quotation_no_prefix', __('lang_v1.quotation_no_prefix') . ':' ) !!}
            {!! Form::text('quotation_no_prefix', $quotation_layout->quotation_no_prefix, ['class' => 'form-control',
              'placeholder' => __('lang_v1.quotation_no_prefix') ]); !!}
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('date_label', __('lang_v1.date_label') . ':' ) !!}
            {!! Form::text('date_label', $quotation_layout->date_label, ['class' => 'form-control',
              'placeholder' => __('lang_v1.date_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('due_date_label', __('lang_v1.due_date_label') . ':' ) !!}
            {!! Form::text('common_settings[due_date_label]', !empty($quotation_layout->common_settings['due_date_label']) ? $quotation_layout->common_settings['due_date_label'] : null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.due_date_label'), 'id' => 'due_date_label' ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[show_due_date]', 1, !empty($quotation_layout->common_settings['show_due_date']), ['class' => 'input-icheck']); !!} @lang('lang_v1.show_due_date')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('date_time_format', __('lang_v1.date_time_format') . ':' ) !!}
            {!! Form::text('date_time_format', $quotation_layout->date_time_format, ['class' => 'form-control',
              'placeholder' => __('lang_v1.date_time_format') ]); !!} 
              <p class="help-block">{!! __('lang_v1.date_time_format_help') !!}</p>
          </div>
        </div>
        @php
        $sell_custom_field_1_label = !empty($custom_labels['sell']['custom_field_1']) ? $custom_labels['sell']['custom_field_1'] : '';

        $sell_custom_field_2_label = !empty($custom_labels['sell']['custom_field_2']) ? $custom_labels['sell']['custom_field_2'] : '';

        $sell_custom_field_3_label = !empty($custom_labels['sell']['custom_field_3']) ? $custom_labels['sell']['custom_field_3'] : '';

        $sell_custom_field_4_label = !empty($custom_labels['sell']['custom_field_4']) ? $custom_labels['sell']['custom_field_4'] : '';
      @endphp
        @if (!empty($sell_custom_field_1_label))
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[sell_custom_fields1]', 1, !empty($quotation_layout->common_settings['sell_custom_fields1']), ['class' => 'input-icheck']); !!} {{ $custom_labels['sell']['custom_field_1'] ?? __('lang_v1.product_custom_field1') }}</label>
            </div>
          </div>
        </div>
        @endif
        @if (!empty($sell_custom_field_2_label))
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[sell_custom_fields2]', 1, !empty($quotation_layout->common_settings['sell_custom_fields2']), ['class' => 'input-icheck']); !!} {{ $custom_labels['sell']['custom_field_2'] ?? __('lang_v1.product_custom_field2') }}</label>
            </div>
          </div>
        </div>
        @endif
        @if (!empty($sell_custom_field_3_label))
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[sell_custom_fields3]', 1, !empty($quotation_layout->common_settings['sell_custom_fields3']), ['class' => 'input-icheck']); !!} {{ $custom_labels['sell']['custom_field_3'] ?? __('lang_v1.product_custom_field3') }}</label>
            </div>
          </div>
        </div>
        @endif
        @if (!empty($sell_custom_field_4_label))
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[sell_custom_fields4]', 1, !empty($quotation_layout->common_settings['sell_custom_fields4']), ['class' => 'input-icheck']); !!} {{ $custom_labels['sell']['custom_field_4'] ?? __('lang_v1.product_custom_field4') }}</label>
            </div>
          </div>
        </div>
        @endif
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('sales_person_label', __('lang_v1.sales_person_label') . ':' ) !!}
            {!! Form::text('sales_person_label', $quotation_layout->sales_person_label, ['class' => 'form-control',
            'placeholder' => __('lang_v1.sales_person_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('commission_agent_label', __('lang_v1.commission_agent_label') . ':' ) !!}
            {!! Form::text('commission_agent_label', $quotation_layout->commission_agent_label, ['class' => 'form-control',
            'placeholder' => __('lang_v1.commission_agent_label') ]); !!}
          </div>
        </div>
        <div class="clearfix"></div>
        
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_business_name', 1, $quotation_layout->show_business_name, ['class' => 'input-icheck']); !!} @lang('invoice.show_business_name')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_location_name', 1, $quotation_layout->show_location_name, ['class' => 'input-icheck']); !!} @lang('invoice.show_location_name')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_sales_person', 1, $quotation_layout->show_sales_person, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_sales_person')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_commission_agent', 1, $quotation_layout->show_commission_agent, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_commission_agent')</label>
              </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
          <h4>@lang('lang_v1.fields_for_customer_details'):</h4>
        </div>
       <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_customer', 1, $quotation_layout->show_customer, ['class' => 'input-icheck']); !!} @lang('invoice.show_customer')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('customer_label', __('invoice.customer_label') . ':' ) !!}
            {!! Form::text('customer_label', $quotation_layout->customer_label, ['class' => 'form-control',
              'placeholder' => __('invoice.customer_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_client_id', 1, $quotation_layout->show_client_id, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_client_id')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('client_id_label', __('lang_v1.client_id_label') . ':' ) !!}
            {!! Form::text('client_id_label', $quotation_layout->client_id_label, ['class' => 'form-control',
              'placeholder' => __('lang_v1.client_id_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('client_tax_label', __('lang_v1.client_tax_label') . ':' ) !!}
            {!! Form::text('client_tax_label', $quotation_layout->client_tax_label, ['class' => 'form-control',
            'placeholder' => __('lang_v1.client_tax_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_reward_point', 1, $quotation_layout->show_reward_point, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_reward_point')</label>
              </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('contact_custom_fields[]', 'custom_field1', in_array('custom_field1', $contact_custom_fields), ['class' => 'input-icheck']); !!} {{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('contact_custom_fields[]', 'custom_field2', in_array('custom_field2', $contact_custom_fields), ['class' => 'input-icheck']); !!} {{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('contact_custom_fields[]', 'custom_field3', in_array('custom_field3', $contact_custom_fields), ['class' => 'input-icheck']); !!} {{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('contact_custom_fields[]', 'custom_field4', in_array('custom_field4', $contact_custom_fields), ['class' => 'input-icheck']); !!} {{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }}</label>
          </div>
        </div>
      </div>        

      </div>
      <div class="row hide-for-letterhead">
      <div class="col-sm-12">
            <h4>@lang('invoice.fields_to_be_shown_in_address'):</h4>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_landmark', 1, $quotation_layout->show_landmark, ['class' => 'input-icheck']); !!} @lang('business.landmark')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_city', 1, $quotation_layout->show_city, ['class' => 'input-icheck']); !!} @lang('business.city')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_state', 1, $quotation_layout->show_state, ['class' => 'input-icheck']); !!} @lang('business.state')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_country', 1, $quotation_layout->show_country, ['class' => 'input-icheck']); !!} @lang('business.country')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_zip_code', 1, $quotation_layout->show_zip_code, ['class' => 'input-icheck']); !!} @lang('business.zip_code')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('location_custom_fields[]', 'custom_field1', in_array('custom_field1', $location_custom_fields), ['class' => 'input-icheck']); !!} {{ $custom_labels['location']['custom_field_1'] ?? __('lang_v1.location_custom_field1') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('location_custom_fields[]', 'custom_field2', in_array('custom_field2', $location_custom_fields), ['class' => 'input-icheck']); !!} {{ $custom_labels['location']['custom_field_2'] ?? __('lang_v1.location_custom_field2') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('location_custom_fields[]', 'custom_field3', in_array('custom_field3', $location_custom_fields), ['class' => 'input-icheck']); !!} {{ $custom_labels['location']['custom_field_3'] ?? __('lang_v1.location_custom_field3') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('location_custom_fields[]', 'custom_field4', in_array('custom_field4', $location_custom_fields), ['class' => 'input-icheck']); !!} {{ $custom_labels['location']['custom_field_4'] ?? __('lang_v1.location_custom_field4') }}</label>
          </div>
        </div>
      </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label>@lang('invoice.fields_to_shown_for_communication'):</label>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_mobile_number', 1, $quotation_layout->show_mobile_number, ['class' => 'input-icheck']); !!} @lang('invoice.show_mobile_number')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_alternate_number', 1, $quotation_layout->show_alternate_number, ['class' => 'input-icheck']); !!} @lang('invoice.show_alternate_number')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>{!! Form::checkbox('show_email', 1, $quotation_layout->show_email, ['class' => 'input-icheck']); !!} @lang('invoice.show_email')</label>
            </div>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>{!! Form::checkbox('show_website', 1, $quotation_layout->show_website, ['class' => 'input-icheck']); !!} Website</label>               
            </div>
          </div>
        </div>
        
        <div class="col-sm-12">
          <div class="form-group">
            <label>@lang('invoice.fields_to_shown_for_tax'):</label>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_tax_1', 1, $quotation_layout->show_tax_1, ['class' => 'input-icheck']); !!} @lang('invoice.show_tax_1')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_tax_2', 1, $quotation_layout->show_tax_2, ['class' => 'input-icheck']); !!} @lang('invoice.show_tax_2')</label>
              </div>
          </div>
        </div>
      </div>
    
    </div>
    </div>
  
  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('table_product_label', __('lang_v1.product_label') . ':' ) !!}
            {!! Form::text('table_product_label', $quotation_layout->table_product_label, ['class' => 'form-control',
              'placeholder' => __('lang_v1.product_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('table_qty_label', __('lang_v1.qty_label') . ':' ) !!}
            {!! Form::text('table_qty_label', $quotation_layout->table_qty_label, ['class' => 'form-control',
              'placeholder' => __('lang_v1.qty_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('table_unit_price_label', __('lang_v1.unit_price_label') . ':' ) !!}
            {!! Form::text('table_unit_price_label', $quotation_layout->table_unit_price_label, ['class' => 'form-control',
              'placeholder' => __('lang_v1.unit_price_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('table_subtotal_label', __('lang_v1.subtotal_label') . ':' ) !!}
            {!! Form::text('table_subtotal_label', $quotation_layout->table_subtotal_label, ['class' => 'form-control',
              'placeholder' => __('lang_v1.subtotal_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('cat_code_label', __('lang_v1.cat_code_label') . ':' ) !!}
            {!! Form::text('cat_code_label', $quotation_layout->cat_code_label, ['class' => 'form-control', 'placeholder' => 'HSN or Category Code' ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('total_quantity_label', __('lang_v1.total_quantity_label') . ':' ) !!}
            {!! Form::text('common_settings[total_quantity_label]', !empty($quotation_layout->common_settings['total_quantity_label']) ? $quotation_layout->common_settings['total_quantity_label'] : null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.total_quantity_label'), 'id' => 'total_quantity_label' ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('item_discount_label', __('lang_v1.item_discount_label') . ':' ) !!}
            {!! Form::text('common_settings[item_discount_label]', !empty($quotation_layout->common_settings['item_discount_label']) ? $quotation_layout->common_settings['item_discount_label'] : null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.item_discount_label'), 'id' => 'item_discount_label' ]); !!}
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('discounted_unit_price_label', __('lang_v1.discounted_unit_price_label') . ':' ) !!}
            {!! Form::text('common_settings[discounted_unit_price_label]', !empty($quotation_layout->common_settings['discounted_unit_price_label']) ? $quotation_layout->common_settings['discounted_unit_price_label'] : null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.discounted_unit_price_label'), 'id' => 'discounted_unit_price_label' ]); !!}
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>{!! Form::checkbox('show_mrp', 1, $quotation_layout->show_mrp, ['class' => 'input-icheck']); !!} Show MRP</label>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>{!! Form::checkbox('show_tax', 1, $quotation_layout->show_tax, ['class' => 'input-icheck']); !!} Show Tax</label>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>{!! Form::checkbox('show_unit', 1, $quotation_layout->show_unit, ['class' => 'input-icheck']); !!} Show Unit</label>
            </div>
          </div>
        </div>
        
         <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>{!! Form::checkbox('show_savedvalue', 1, $quotation_layout->show_savedvalue, ['class' => 'input-icheck']); !!} Show Saved value</label>
            </div>
          </div>
        </div>
        
           <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('savedvalue_lable', 'Savedvalue label' . ':' ) !!}
            {!! Form::text('savedvalue_lable', $quotation_layout->savedvalue_lable, ['class' => 'form-control', 'placeholder' => 'Savedvalue label' ]); !!}
          </div>
        </div>
        
         <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>{!! Form::checkbox('show_signature', 1, $quotation_layout->show_signature, ['class' => 'input-icheck']); !!} Show Signature</label>
            </div>
          </div>
        </div>
        
       <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('signature_image', 'Signature Image:') !!}
            {!! Form::file('signature_image', ['class' => 'form-control']); !!}
    
            @if(!empty($quotation_layout->signature_image))
                <br>
                <img src="{{ asset('uploads/signature_image/' . $quotation_layout->signature_image) }}" 
                     alt="Signature Image" width="100">
            @endif
        </div>
    </div>
        
        <div class="col-sm-12">
          <h4>@lang('lang_v1.product_details_to_be_shown'):</h4>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_brand', 1, $quotation_layout->show_brand, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_brand')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_sku', 1, $quotation_layout->show_sku, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_sku')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_cat_code', 1, $quotation_layout->show_cat_code, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_cat_code')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
              {!! Form::checkbox('show_sale_description', 1, $quotation_layout->show_sale_description, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_sale_description')</label>
            </div>
            <p class="help-block">@lang('lang_v1.product_imei_or_sn')</p>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[show_product_description]', 1, !empty($quotation_layout->common_settings['show_product_description']), ['class' => 'input-icheck']); !!} @lang('lang_v1.show_product_description')</label>
              </div>
          </div>
        </div>
         
        @if(request()->session()->get('business.enable_product_expiry') == 1)
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  {!! Form::checkbox('show_expiry', 1, $quotation_layout->show_expiry, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_product_expiry')</label>
                </div>
            </div>
          </div>
        @endif
        @if(request()->session()->get('business.enable_lot_number') == 1)
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  {!! Form::checkbox('show_lot', 1, $quotation_layout->show_lot, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_lot_number')</label>
                </div>
            </div>
          </div>
        @endif

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_image', 1, !empty($quotation_layout->show_image), ['class' => 'input-icheck']); !!} @lang('lang_v1.show_product_image')</label>
              </div>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[show_warranty_name]', 1, !empty($quotation_layout->common_settings['show_warranty_name']), ['class' => 'input-icheck']); !!} @lang('lang_v1.show_warranty_name')</label>
              </div>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[show_warranty_exp_date]', 1, !empty($quotation_layout->common_settings['show_warranty_exp_date']), ['class' => 'input-icheck']); !!} @lang('lang_v1.show_warranty_exp_date')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[show_warranty_description]', 1, !empty($quotation_layout->common_settings['show_warranty_description']), ['class' => 'input-icheck']); !!} @lang('lang_v1.show_warranty_description')</label>
              </div>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[show_base_unit_details]', 1, !empty($quotation_layout->common_settings['show_base_unit_details']), ['class' => 'input-icheck']); !!} @lang('lang_v1.show_base_unit_details')</label>
              </div>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('product_custom_fields[]', 'product_custom_field1', in_array('product_custom_field1', $product_custom_fields), ['class' => 'input-icheck']); !!} {{ $custom_labels['product']['custom_field_1'] ?? __('lang_v1.product_custom_field1') }}</label>
            </div>
          </div>
        </div>

        <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('product_custom_fields[]', 'product_custom_field2', in_array('product_custom_field2', $product_custom_fields), ['class' => 'input-icheck']); !!} {{ $custom_labels['product']['custom_field_2'] ?? __('lang_v1.product_custom_field2') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('product_custom_fields[]', 'product_custom_field3', in_array('product_custom_field3', $product_custom_fields), ['class' => 'input-icheck']); !!} {{ $custom_labels['product']['custom_field_3'] ?? __('lang_v1.product_custom_field3') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('product_custom_fields[]', 'product_custom_field4', in_array('product_custom_field4', $product_custom_fields), ['class' => 'input-icheck']); !!} {{ $custom_labels['product']['custom_field_4'] ?? __('lang_v1.product_custom_field4') }}</label>
          </div>
        </div>
      </div>

      </div>

    </div>
  </div>
  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('sub_total_label', __('invoice.sub_total_label') . ':' ) !!}
            {!! Form::text('sub_total_label', $quotation_layout->sub_total_label, ['class' => 'form-control',
              'placeholder' => __('invoice.sub_total_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('discount_label', __('invoice.discount_label') . ':' ) !!}
            {!! Form::text('discount_label', $quotation_layout->discount_label, ['class' => 'form-control',
              'placeholder' => __('invoice.discount_label') ]); !!}
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('tax_label', __('invoice.tax_label') . ':' ) !!}
            {!! Form::text('tax_label', $quotation_layout->tax_label, ['class' => 'form-control',
              'placeholder' => __('invoice.tax_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('total_label', __('invoice.total_label') . ':' ) !!}
            {!! Form::text('total_label', $quotation_layout->total_label, ['class' => 'form-control',
              'placeholder' => __('invoice.total_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('total_items_label', __('lang_v1.total_items_label') . ':' ) !!}
            {!! Form::text('common_settings[total_items_label]', !empty($quotation_layout->common_settings['total_items_label']) ? $quotation_layout->common_settings['total_items_label'] : null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.total_items_label'), 'id' => 'total_items_label' ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('round_off_label', __('lang_v1.round_off_label') . ':' ) !!}
            {!! Form::text('round_off_label', $quotation_layout->round_off_label, ['class' => 'form-control',
              'placeholder' => __('lang_v1.round_off_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('total_due_label', __('invoice.total_due_label') . ' (' . __('lang_v1.current_sale') . '):' ) !!}
            {!! Form::text('total_due_label', $quotation_layout->total_due_label, ['class' => 'form-control',
              'placeholder' => __('invoice.total_due_label') ]); !!}
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('paid_label', __('invoice.paid_label') . ':' ) !!}
            {!! Form::text('paid_label', $quotation_layout->paid_label, ['class' => 'form-control',
              'placeholder' => __('invoice.paid_label') ]); !!}
          </div>
        </div>
        
        <div class="clearfix"></div>

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_payments', 1, $quotation_layout->show_payments, ['class' => 'input-icheck']); !!} @lang('invoice.show_payments')</label>
              </div>
          </div>
        </div>

        <!-- Barcode -->
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_barcode', 1, $quotation_layout->show_barcode, ['class' => 'input-icheck']); !!} @lang('invoice.show_barcode')</label>
              </div>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
              <label>
                {!! Form::checkbox('common_settings[show_total_in_words]', 1, !empty($quotation_layout->common_settings['show_total_in_words']), ['class' => 'input-icheck']); !!} @lang('lang_v1.show_total_in_words')</label> @show_tooltip(__('lang_v1.show_in_word_help'))
                @if(!extension_loaded('intl'))
                  <p class="help-block">@lang('lang_v1.enable_php_intl_extension')</p>
                @endif
          </div>
        </div> 

        <div class="col-sm-3">
          <div class="form-group">
            {!! Form::label('word_format', __('lang_v1.word_format') . ':') !!} 
            @show_tooltip(__('lang_v1.word_format_help'))
            {!! Form::select('common_settings[num_to_word_format]', ['international' => __('lang_v1.international'), 'indian' => __('lang_v1.indian')], $quotation_layout->common_settings['num_to_word_format'] ?? 'international', ['class' => 'form-control', 'id' => 'word_format']); !!}
          </div>
        </div>

        <div class="clearfix"></div>
        
        <div class="col-sm-4">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_previous_bal', 1, $quotation_layout->show_previous_bal, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_previous_bal_due')</label>
                @show_tooltip(__('lang_v1.previous_bal_due_help'))
              </div>
          </div>
        </div>
        
        <div class="col-sm-4">
          <div class="form-group">
            {!! Form::label('prev_bal_label', __('invoice.total_due_label') . ' (' . __('lang_v1.all_sales') . '):' ) !!}
            {!! Form::text('prev_bal_label', $quotation_layout->prev_bal_label, ['class' => 'form-control',
              'placeholder' => __('invoice.total_due_label') ]); !!}
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            {!! Form::label('change_return_label', __('lang_v1.change_return_label') . ':' ) !!} @show_tooltip(__('lang_v1.change_return_help'))
            {!! Form::text('change_return_label', $quotation_layout->change_return_label, ['class' => 'form-control',
              'placeholder' => __('lang_v1.change_return_label') ]); !!}
          </div>
        </div>
        
        <div class="clearfix"></div>
        
        <div class="col-sm-4">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('show_opening_bal', 1, $quotation_layout->show_opening_bal, ['class' => 'input-icheck']); !!} Show Opening Balance Due</label>
                @show_tooltip('Show Opening Balance Due')
              </div>
          </div>
        </div> 

        <div class="col-sm-4">
          <div class="form-group">
            {!! Form::label('opening_bal_label',  __('Total Opening Balance Lable') . ' (' . __('lang_v1.all_sales') . '):' ) !!}
            {!! Form::text('opening_bal_label', $quotation_layout->opening_bal_label, ['class' => 'form-control',
              'placeholder' => __('invoice.total_due_label') ]); !!}
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            {!! Form::label('tax_summary_label', __('lang_v1.tax_summary_label') . ':' ) !!}
            {!! Form::text('common_settings[tax_summary_label]', !empty($quotation_layout->common_settings['tax_summary_label']) ? $quotation_layout->common_settings['tax_summary_label'] : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.tax_summary_label'), 'id' => 'tax_summary_label' ]); !!}
          </div>
        </div>
        
        <div class="clearfix"></div>

        <div class="col-sm-4 @if($quotation_layout->design != 'slim') hide @endif" id="hide_price_div">
          <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('common_settings[hide_price]', 1, !empty($quotation_layout->common_settings['hide_price']), ['class' => 'input-icheck']); !!} @lang('lang_v1.hide_all_prices')</label>
              </div>
          </div>
        </div>
 

      </div>
    </div>
  </div>
  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
        
        <div class="col-sm-6 hide">
          <div class="form-group">
            {!! Form::label('highlight_color', __('invoice.highlight_color') . ':' ) !!}
            {!! Form::text('highlight_color', $quotation_layout->highlight_color, ['class' => 'form-control',
              'placeholder' => __('invoice.highlight_color') ]); !!}
          </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-12 hide">
          <hr/>
        </div>
        
        <div class="col-sm-12">
          <div class="form-group">
            {!! Form::label('footer_text', __('invoice.footer_text') . ':' ) !!}
              {!! Form::textarea('footer_text', $quotation_layout->footer_text, ['class' => 'form-control',
              'placeholder' => __('invoice.footer_text'), 'rows' => 3]); !!}
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-group">
            {!! Form::label('bank_details', __('invoice.bank_details') . ':' ) !!}
              {!! Form::textarea('bank_details', $quotation_layout->bank_details, ['class' => 'form-control',
              'placeholder' => __('invoice.bank_details'), 'rows' => 3]); !!}
          </div>
        </div>

        @if(empty($quotation_layout->is_default))
        <div class="col-sm-6">
          <div class="form-group">
            <br>
            <div class="checkbox">
              <label>
                {!! Form::checkbox('is_default', 1, $quotation_layout->is_default, ['class' => 'input-icheck']); !!} @lang('barcode.set_as_default')</label>
            </div>
          </div>
        </div>
        @endif
        
      </div>
    </div>
  </div>
</div>


@component('components.widget', ['class' => 'box-solid', 'title' => __('lang_v1.qr_code')])
  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('show_qr_code', 1, $quotation_layout->show_qr_code, ['class' => 'input-icheck']); !!} @lang('lang_v1.show_qr_code')</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('common_settings[show_qr_code_label]', 1, !empty($quotation_layout->common_settings['show_qr_code_label']), ['class' => 'input-icheck']); !!} @lang('lang_v1.show_labels')</label>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('common_settings[zatca_qr]', 1, !empty($quotation_layout->common_settings['zatca_qr']), ['class' => 'input-icheck']); !!} @lang('lang_v1.zatca_qr')</label>
                @show_tooltip(__('lang_v1.zatca_qr_help'))
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
      <h4>@lang('lang_v1.fields_to_be_shown'):</h4>
    </div>
    @php
      $qr_code_fields = empty($quotation_layout->qr_code_fields) ? [] : $quotation_layout->qr_code_fields;
    @endphp
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('qr_code_fields[]', 'business_name', in_array('business_name', $qr_code_fields), ['class' => 'input-icheck']); !!} @lang('business.business_name')</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('qr_code_fields[]', 'address', in_array('address', $qr_code_fields), ['class' => 'input-icheck']); !!} @lang('lang_v1.business_location_address')</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('qr_code_fields[]', 'tax_1', in_array('tax_1', $qr_code_fields), ['class' => 'input-icheck']); !!} @lang('lang_v1.business_tax_1')</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('qr_code_fields[]', 'tax_2', in_array('tax_2', $qr_code_fields), ['class' => 'input-icheck']); !!} @lang('lang_v1.business_tax_2')</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('qr_code_fields[]', 'invoice_no', in_array('invoice_no', $qr_code_fields), ['class' => 'input-icheck']); !!} @lang('sale.invoice_no')</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('qr_code_fields[]', 'invoice_datetime', in_array('invoice_datetime', $qr_code_fields), ['class' => 'input-icheck']); !!} @lang('lang_v1.invoice_datetime')</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('qr_code_fields[]', 'subtotal', in_array('subtotal', $qr_code_fields), ['class' => 'input-icheck']); !!} @lang('sale.subtotal')</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('qr_code_fields[]', 'total_amount', in_array('total_amount', $qr_code_fields), ['class' => 'input-icheck']); !!} @lang('lang_v1.total_amount_with_tax')</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('qr_code_fields[]', 'total_tax', in_array('total_tax', $qr_code_fields), ['class' => 'input-icheck']); !!} @lang('lang_v1.total_tax')</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('qr_code_fields[]', 'customer_name', in_array('customer_name', $qr_code_fields), ['class' => 'input-icheck']); !!} @lang('sale.customer_name')</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('qr_code_fields[]', 'invoice_url', in_array('invoice_url', $qr_code_fields), ['class' => 'input-icheck']); !!} @lang('lang_v1.view_invoice_url')</label>
        </div>
      </div>
    </div>

  </div>
  @endcomponent
@if(!empty($enabled_modules) && in_array('types_of_service', $enabled_modules) )
    @include('types_of_service.invoice_layout_settings', ['module_info' => $quotation_layout->module_info])
@endif
<!-- Call restaurant module if defined -->
@include('restaurant.partials.invoice_layout', ['module_info' => $quotation_layout->module_info, 'edit_il' => true])

@if(Module::has('Repair'))
  @include('repair::layouts.partials.invoice_layout_settings', ['module_info' => $quotation_layout->module_info, 'edit_il' => true])
@endif


<div class="box box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">@lang('lang_v1.layout_credit_note')</h3>
  </div>

  <div class="box-body">
    <div class="row">
      
      <div class="col-sm-3">
        <div class="form-group">
          {!! Form::label('cn_heading', __('lang_v1.cn_heading') . ':' ) !!}
          {!! Form::text('cn_heading', $quotation_layout->cn_heading, ['class' => 'form-control', 'placeholder' => __('lang_v1.cn_heading') ]); !!}
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          {!! Form::label('cn_no_label', __('lang_v1.cn_no_label') . ':' ) !!}
          {!! Form::text('cn_no_label', $quotation_layout->cn_no_label, ['class' => 'form-control', 'placeholder' => __('lang_v1.cn_no_label') ]); !!}
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          {!! Form::label('cn_amount_label', __('lang_v1.cn_amount_label') . ':' ) !!}
          {!! Form::text('cn_amount_label', $quotation_layout->cn_amount_label, ['class' => 'form-control', 'placeholder' => __('lang_v1.cn_amount_label') ]); !!}
        </div>
      </div>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12 text-center">
    <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white tw-dw-btn-lg">@lang('messages.update')</button>
  </div>
</div>

  {!! Form::close() !!}
</section>
<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">
  __page_leave_confirmation('#add_quotation_layout_form');
    $(document).on('ifChanged', '#show_letter_head', function() {
        letter_head_changed();
    });

    function letter_head_changed() {
        if($('#show_letter_head').is(":checked")) {
            $('.hide-for-letterhead').addClass('hide');
            $('.letter_head_input').removeClass('hide');
        } else {
            $('.hide-for-letterhead').removeClass('hide');
            $('.letter_head_input').addClass('hide');
        }
    }

  

    $(document).ready(function(){
        letter_head_changed();

        function removeImagelogo() {
    // Confirm the user wants to remove the image
    if (confirm('Are you sure you want to remove the image?')) {
        // Make an AJAX request to remove the image
        $.ajax({
            url: '{{ route("invoice.remove-logoimage", $quotation_layout->id) }}',  // Define this route in web.php
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',  // CSRF token for security
                invlayid: '{{ $quotation_layout->id }}', // Pass the product ID
            },
            success: function(response) {
                if (response.success) {
                    // On success, remove the image and close button
                    $('.image-container').html('<img src="{{ asset('img/default.png') }}" alt="Default Image" style="width: 150px; height: auto;">');
                    alert('Image removed successfully.');
                } else {
                    alert('There was an error removing the image.');
                }
            },
            error: function() {
                alert('Error while removing the image.');
            }
        });
    }
    }
    
    function removeImage() {
    // Confirm the user wants to remove the image
    if (confirm('Are you sure you want to remove the image?')) {
        // Make an AJAX request to remove the image
        $.ajax({
            url: '{{ route("invoice.remove-letterheadimage", $quotation_layout->id) }}',  // Define this route in web.php
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',  // CSRF token for security
                invlayid: '{{ $quotation_layout->id }}', // Pass the product ID
            },
            success: function(response) {
                if (response.success) {
                    // On success, remove the image and close button
                    $('.image-container').html('<img src="{{ asset('img/default.png') }}" alt="Default Image" style="width: 150px; height: auto;">');
                    alert('Image removed successfully.');
                } else {
                    alert('There was an error removing the image.');
                }
            },
            error: function() {
                alert('Error while removing the image.');
            }
        });
    }
    }
    
    })
</script>
@endsection