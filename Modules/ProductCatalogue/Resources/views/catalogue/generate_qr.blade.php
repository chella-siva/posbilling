@extends('layouts.app')
@section('title', __( 'productcatalogue::lang.catalogue_qr' ))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang( 'productcatalogue::lang.catalogue_qr' )</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-7">
    	@component('components.widget', ['class' => 'box-solid'])
            <div class="form-group">
                {!! Form::label('location_id', __('purchase.business_location').':') !!}
                {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); !!}
            </div>
            <div class="form-group">
                {!! Form::label('color', __('productcatalogue::lang.qr_code_color').':') !!}
                {!! Form::text('color', '#000000', ['class' => 'form-control']); !!}
            </div>
            <div class="form-group">
                {!! Form::label('title', __('productcatalogue::lang.title').':') !!}
                {!! Form::text('title', $business->name, ['class' => 'form-control']); !!}
            </div>
            <div class="form-group">
                {!! Form::label('subtitle', __('productcatalogue::lang.subtitle').':') !!}
                {!! Form::text('subtitle', __('productcatalogue::lang.product_catalogue'), ['class' => 'form-control']); !!}
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('add_logo', 1, true, ['id' => 'show_logo', 'class' => 'input-icheck']); !!} @lang('productcatalogue::lang.show_business_logo_on_qrcode')
                    </label>
                </div>
            </div>
            <button type="button" class="tw-dw-btn tw-dw-btn-primary tw-dw-btn-sm tw-text-white" id="generate_qr">@lang('productcatalogue::lang.generate_qr')</button>
        @endcomponent

        @component('components.widget', ['class' => 'box-solid'])
            <div class="row">
                <div class="col-md-12">
                    <h4>@lang('productcatalogue::lang.setting'):</h4>
                    {!! Form::open(['url' => action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'productCatalogueSetting']), 'method' => 'post']) !!}
                        {!! Form::label('is_show', __('productcatalogue::lang.outofstock_products').':') !!}
                        <div class="form-inline">
                        <div class="form-group">
                        @php
                            $settings = json_decode($business->productcatalogue_settings);
                            $is_show = $settings->is_show ?? '';
                        @endphp
                            <div class="checkbox">
                                <label>
                                    {!! Form::radio('is_show', 1, $is_show == 1 ? true : false, ['id' => 'show_logo', 'class' => 'input-icheck', 'required']); !!} @lang('productcatalogue::lang.show')
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {!! Form::radio('is_show', 0, $is_show == 0 ? true : false, ['id' => 'show_logo', 'class' => 'input-icheck', 'required']); !!} @lang('productcatalogue::lang.hide')
                                </label>
                            </div>
                        </div>
                    </div> <br>
                    <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-dw-btn-sm tw-text-white" id="">@lang('productcatalogue::lang.save')</button>
                {!! Form::close() !!}
                </div>
            </div>
        @endcomponent
        

        @component('components.widget', ['class' => 'box-solid'])
            <div class="row">
                <div class="col-md-12">
                    <strong>@lang('lang_v1.instruction'):</strong>
                    <table class="table table-striped">
                        <tr>
                            <td>1</td>
                            <td>@lang( 'productcatalogue::lang.catalogue_instruction_1' )</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>@lang( 'productcatalogue::lang.catalogue_instruction_2' )</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>@lang( 'productcatalogue::lang.catalogue_instruction_3' )</td>
                        </tr>
                    </table>
                </div>
            </div>
        @endcomponent
        </div>
        <div class="col-md-5">
            @component('components.widget', ['class' => 'box-solid'])

                <div class="text-center">
                    <div id="qrcode"></div>
                    <span id="catalogue_link"></span>
                    <br>
                    <a href="#" class="tw-dw-btn tw-dw-btn-success tw-text-white hide" id="download_image">@lang( 'productcatalogue::lang.download_image' )</a>
                </div>
            @endcomponent
        </div>
    </div>
</section>
@stop
@section('javascript')
<script src="{{ asset('modules/productcatalogue/plugins/easy.qrcode.min.js') }}"></script>
<script type="text/javascript">
    (function($) {
        "use strict";

    $(document).ready( function(){
        $('#color').colorpicker();
    });
    
    $(document).on('click', '#generate_qr', function(e){
        $('#qrcode').html('');
        if ($('#location_id').val()) {
            var link = "{{url('catalogue/' . session('business.id'))}}/" + $('#location_id').val();
            var color = '#000000';
            if ($('#color').val().trim() != '') {
                color = $('#color').val();
            }
            var opts = {
                text: link,
                margin: 4,
                width: 256,
                height: 256,
                quietZone: 20,
                colorDark: color,
                colorLight: "#ffffffff", 
            }

            if ($('#title').val().trim() !== '') {
                opts.title = $('#title').val();
                opts.titleFont = "bold 18px Arial";
                opts.titleColor = "#004284";
                opts.titleBackgroundColor = "#ffffff";
                opts.titleHeight = 60;
                opts.titleTop = 20;
            }

            if ($('#subtitle').val().trim() !== '') {
                opts.subTitle = $('#title').val();
                opts.subTitleFont = "14px Arial";
                opts.subTitleColor = "#4F4F4F";
                opts.subTitleTop = 40;
            }

            if ($('#show_logo').is(':checked')) {
                opts.logo = "{{asset( 'uploads/business_logos/' . $business->logo)}}";
            }

            new QRCode(document.getElementById("qrcode"), opts);
            $('#catalogue_link').html('<a target="_blank" href="'+ link +'">Link</a>');
            $('#download_image').removeClass('hide');
            $('#qrcode').find('canvas').attr('id', 'qr_canvas')

            
        } else {
            alert("{{__('productcatalogue::lang.select_business_location')}}")
        }
    });
    })(jQuery);

    $('#download_image').click(function(e) {
        e.preventDefault();
        var link = document.createElement('a');
        link.download = 'qrcode.png';
        link.href = document.getElementById('qr_canvas').toDataURL()
        link.click();
    });
</script>
@endsection