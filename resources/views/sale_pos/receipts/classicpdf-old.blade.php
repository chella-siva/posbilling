<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Receipt-{{$receipt_details->invoice_no}}</title>
    </head>
    <body>
        <div style="border: 1px solid #000; padding: 10px;">
            @if(empty($receipt_details->letter_head))
                @if(!empty($receipt_details->logo))
                    <div style="text-align: center;">
                        <img style="max-height: 60px; width: auto; margin: 0 auto;" src="{{$receipt_details->logo}}" alt="Logo">
                    </div>
                @endif
                <div>
                    <!-- Logo -->
                    <p style="text-align: center;">
                        <!-- Header text -->
                        @if(!empty($receipt_details->header_text))
                            <div style="text-align: center; font-size: 18px; font-weight: bold;">{!! $receipt_details->header_text !!}</div>
                        @endif

                        <!-- business information here -->
                        @if(!empty($receipt_details->display_name))
                            <div style="text-align: center; font-size: 16px; font-weight: bold;">{{$receipt_details->display_name}}</div>
                        @endif
                        
                        @if(!empty($receipt_details->address))
                            <div style="text-align: center;">{!! $receipt_details->address !!}</div>
                        @endif

                        @if(!empty($receipt_details->contact))
                            <div style="text-align: center;">{!! $receipt_details->contact !!}</div>
                        @endif

                        @if(!empty($receipt_details->website))
                            <div style="text-align: center;">{{ $receipt_details->website }}</div>
                        @endif

                        @if(!empty($receipt_details->location_custom_fields))
                            <div style="text-align: center;">{{ $receipt_details->location_custom_fields }}</div>
                        @endif

                        @if(!empty($receipt_details->sub_heading_line1))
                            <div style="text-align: center;">{{ $receipt_details->sub_heading_line1 }}</div>
                        @endif
                        @if(!empty($receipt_details->sub_heading_line2))
                            <div style="text-align: center;">{{ $receipt_details->sub_heading_line2 }}</div>
                        @endif
                        @if(!empty($receipt_details->sub_heading_line3))
                            <div style="text-align: center;">{{ $receipt_details->sub_heading_line3 }}</div>
                        @endif
                        @if(!empty($receipt_details->sub_heading_line4))
                            <div style="text-align: center;">{{ $receipt_details->sub_heading_line4 }}</div>
                        @endif        
                        @if(!empty($receipt_details->sub_heading_line5))
                            <div style="text-align: center;">{{ $receipt_details->sub_heading_line5 }}</div>
                        @endif

                        @if(!empty($receipt_details->tax_info1))
                            <div style="text-align: center;">{{ $receipt_details->tax_label1 }} {{ $receipt_details->tax_info1 }}</div>
                        @endif

                        @if(!empty($receipt_details->tax_info2))
                            <div style="text-align: center;">{{ $receipt_details->tax_label2 }} {{ $receipt_details->tax_info2 }}</div>
                        @endif
                    </p>
                </div>
                @if(!empty($receipt_details->letter_head))
                    <div>
                        <img style="width: 100%; margin-bottom: 10px;" src="{{$receipt_details->letter_head}}">
                    </div>
                @endif
            <div style="border-top: 1px solid #000; padding: 10px;">
                <div style="float: left; width: 50%;"><span>{!! $receipt_details->invoice_no_prefix !!}:</span></div>
                <div style="float: right; width: 50%; text-align: right;">
                    {{$receipt_details->invoice_no}}
                </div>
            </div>
            <div style="padding: 10px;">
                <div style="float: left; width: 50%;"><span>{!! $receipt_details->date_label !!}:</span></div>
                <div style="float: right; width: 50%; text-align: right;">
                    {{$receipt_details->invoice_date}}
                </div>
            </div>
            
            @if(!empty($receipt_details->due_date_label))
                <div style="padding: 10px;">
                    <div style="float: left; width: 50%;"><span>{{$receipt_details->due_date_label}}:</span></div>
                    <div style="float: right; width: 50%; text-align: right;">{{$receipt_details->due_date ?? ''}}</div>
                </div>
            @endif

            @if(!empty($receipt_details->sales_person_label))
                <div style="padding: 10px;">
                    <div style="float: left; width: 50%;"><span>{{$receipt_details->sales_person_label}}:</span></div>
                
                    <div style="float: right; width: 50%; text-align: right;">{{$receipt_details->sales_person}}</div>
                </div>
            @endif
            @if(!empty($receipt_details->commission_agent_label))
                <div style="padding: 10px;">
                    <div style="float: left; width: 50%;"><span>{{$receipt_details->commission_agent_label}}:</span></div>
                
                    <div style="float: right; width: 50%; text-align: right;">{{$receipt_details->commission_agent}}</div>
                </div>
            @endif

            @if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
                <div style="padding: 10px;">
                    <div style="float: left; width: 50%;"><span>{{$receipt_details->brand_label}}:</span></div>
                
                    <div style="float: right; width: 50%; text-align: right;">{{$receipt_details->repair_brand}}</div>
                </div>
            @endif

            @if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
                <div style="padding: 10px;">
                    <div style="float: left; width: 50%;"><span>{{$receipt_details->device_label}}:</span></div>
                
                    <div style="float: right; width: 50%; text-align: right;">{{$receipt_details->repair_device}}</div>
                </div>
            @endif
            
            @if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
                <div style="padding: 10px;">
                    <div style="float: left; width: 50%;"><span>{{$receipt_details->model_no_label}}:</span></div>
                
                    <div style="float: right; width: 50%; text-align: right;">{{$receipt_details->repair_model_no}}</div>
                </div>
            @endif
            
            @if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
                <div style="padding: 10px;">
                    <div style="float: left; width: 50%;"><span>{{$receipt_details->serial_no_label}}:</span></div>
                
                    <div style="float: right; width: 50%; text-align: right;">{{$receipt_details->repair_serial_no}}</div>
                </div>
            @endif

            @if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
                <div style="padding: 10px;">
                    <div style="float: left; width: 50%;"><span>{!! $receipt_details->repair_status_label !!}:</span></div>
                    <div style="float: right; width: 50%; text-align: right;">
                        {{$receipt_details->repair_status}}
                    </div>
                </div>
            @endif

            @if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
                <div style="padding: 10px;">
                    <div style="float: left; width: 50%;"><span>{!! $receipt_details->repair_warranty_label !!}:</span></div>
                    <div style="float: right; width: 50%; text-align: right;">
                        {{$receipt_details->repair_warranty}}
                    </div>
                </div>
            @endif

            <!-- Waiter info -->
            @if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
                <div style="padding: 10px;">
                    <div style="float: left; width: 50%;"><span>{!! $receipt_details->service_staff_label !!}:</span></div>
                    <div style="float: right; width: 50%; text-align: right;">
                        {{$receipt_details->service_staff}}
                    </div>
                </div>
            @endif
			@if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>
                @if(!empty($receipt_details->table_label))
                    <b>{!! $receipt_details->table_label !!}:</b>
                @endif
            </span>
        </div>
        <div style="flex: 1; text-align: right;">
            {{$receipt_details->table}}
        </div>
    </div>
@endif


@if(!empty($receipt_details->types_of_service)) 
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>{!! $receipt_details->types_of_service_label !!}</span>
        </div>
        <div style="flex: 1; text-align: right;">
            {{$receipt_details->types_of_service}}:
        </div>
    </div>
    @if(!empty($receipt_details->types_of_service_custom_fields))
        @foreach($receipt_details->types_of_service_custom_fields as $key => $value)
            <div style="margin-left: 20px; margin-bottom: 5px;">
                <span>{{$key}}: </span> {{$value}}
            </div>
        @endforeach
    @endif
@endif

@if (!empty($receipt_details->sell_custom_field_1_value))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>{!! $receipt_details->sell_custom_field_1_label !!}:</span>
        </div>
        <div style="flex: 1; text-align: right;">
            {{$receipt_details->sell_custom_field_1_value}}
        </div>
    </div>
@endif
@if (!empty($receipt_details->sell_custom_field_2_value))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>{!! $receipt_details->sell_custom_field_2_label !!}:</span>
        </div>
        <div style="flex: 1; text-align: right;">
            {{$receipt_details->sell_custom_field_2_value}}
        </div>
    </div>
@endif
@if (!empty($receipt_details->sell_custom_field_3_value))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>{!! $receipt_details->sell_custom_field_3_label !!}:</span>
        </div>
        <div style="flex: 1; text-align: right;">
            {{$receipt_details->sell_custom_field_3_value}}
        </div>
    </div>
@endif
@if (!empty($receipt_details->sell_custom_field_4_value))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>{!! $receipt_details->sell_custom_field_4_label !!}:</span>
        </div>
        <div style="flex: 1; text-align: right;">
            {{$receipt_details->sell_custom_field_4_value}}
        </div>
    </div>
@endif

<!-- customer info -->
<div style="display: flex; margin-bottom: 5px;">
    <div style="vertical-align: top; flex: 1;">
        <span>{{$receipt_details->customer_label ?? ''}}</span>
    </div>
    <div style="flex: 1; text-align: right; line-height: 10px;">
        @if(!empty($receipt_details->customer_info))
            <div>{!! $receipt_details->customer_info !!}</div>
        @endif
    </div>
</div>

@if(!empty($receipt_details->client_id_label))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>{{ $receipt_details->client_id_label }}:</span>
        </div>
        <div style="flex: 1; text-align: right;">
            {{ $receipt_details->client_id }}
        </div>
    </div>
@endif

@if(!empty($receipt_details->customer_tax_label))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>{{ $receipt_details->customer_tax_label }}:</span>
        </div>
        <div style="flex: 1; text-align: right;">
            {{ $receipt_details->customer_tax_number }}
        </div>
    </div>
@endif

@if(!empty($receipt_details->customer_custom_fields))
    <div style="text-align: center; margin-bottom: 5px;">
        {!! $receipt_details->customer_custom_fields !!}
    </div>
@endif

@if(!empty($receipt_details->customer_rp_label))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>{{ $receipt_details->customer_rp_label }}:</span>
        </div>
        <div style="flex: 1; text-align: right;">
            {{ $receipt_details->customer_total_rp }}
        </div>
    </div>
@endif

@if(!empty($receipt_details->shipping_custom_field_1_label))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>{!!$receipt_details->shipping_custom_field_1_label!!} :</span>
        </div>
        <div style="flex: 1; text-align: right;">
            {!!$receipt_details->shipping_custom_field_1_value ?? ''!!}
        </div>
    </div>
@endif
@if(!empty($receipt_details->shipping_custom_field_2_label))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>{!!$receipt_details->shipping_custom_field_2_label!!}: </span>
        </div>
        <div style="flex: 1; text-align: right;">
            {!!$receipt_details->shipping_custom_field_2_value ?? ''!!}
        </div>
    </div>
@endif
@if(!empty($receipt_details->shipping_custom_field_3_label))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>{!!$receipt_details->shipping_custom_field_3_label!!}: </span>
        </div>
        <div style="flex: 1; text-align: right;">
            {!!$receipt_details->shipping_custom_field_3_value ?? ''!!}
        </div>
    </div>
@endif
@if(!empty($receipt_details->shipping_custom_field_4_label))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>{!!$receipt_details->shipping_custom_field_4_label!!}: </span>
        </div>
        <div style="flex: 1; text-align: right;">
            {!!$receipt_details->shipping_custom_field_4_value ?? ''!!}
        </div>
    </div>
@endif
@if(!empty($receipt_details->shipping_custom_field_5_label))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>{!!$receipt_details->shipping_custom_field_5_label!!}: </span>
        </div>
        <div style="flex: 1; text-align: right;">
            {!!$receipt_details->shipping_custom_field_5_value ?? ''!!}
        </div>
    </div>
@endif
@if(!empty($receipt_details->sale_orders_invoice_no))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>@lang('restaurant.order_no'):</span>
        </div>
        <div style="flex: 1; text-align: right;">
            {!!$receipt_details->sale_orders_invoice_no ?? ''!!}
        </div>
    </div>
@endif

@if(!empty($receipt_details->sale_orders_invoice_date))
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <div style="flex: 1;">
            <span>@lang('lang_v1.order_dates'):</span>
        </div>
        <div style="flex: 1; text-align: right;">
            {!!$receipt_details->sale_orders_invoice_date ?? ''!!}
        </div>
    </div>
@endif


			<!-- <div style="border-bottom: 1px solid #000;">&nbsp;</div> -->
<table style="border-bottom: 1px solid #000; border-top: 1px solid #000; width: 100%; font-size: 12px; margin-bottom: 0;">
    <thead style="border-bottom: 1px solid #000;">
        @php
            $p_width = 55;
        @endphp
        @if(!empty($receipt_details->item_discount_label))
            @php
                $p_width -= 10;
            @endphp
        @endif
        @if(!empty($receipt_details->discounted_unit_price_label))
            @php
                $p_width -= 10;
            @endphp
        @endif

        <tr>
            <th style="width: 5%; text-align: center;">#</th>
            <th style="width: {{$p_width}}%; text-align: left;">
                {{$receipt_details->table_product_label}}
            </th>
            <th style="width: 8%; text-align: center;">
                {{$receipt_details->table_qty_label}}
            </th>
            @if($receipt_details->show_mrp != 0)
            <th style="width: 8%; text-align: center;">
                MRP
            </th>
            @endif
            @if(empty($receipt_details->hide_price))
            <th style="width: 8%; text-align: center;">
                {{$receipt_details->table_unit_price_label}}
            </th>
            @if(!empty($receipt_details->discounted_unit_price_label))
                <th style="width: 8%; text-align: center;">
                    {{$receipt_details->discounted_unit_price_label}}
                </th>
            @endif
            @if(!empty($receipt_details->item_discount_label))
                <th style="width: 8%; text-align: center;">{{$receipt_details->item_discount_label}}</th>
            @endif
            <th style="width: 12%; text-align: right;">{{$receipt_details->table_subtotal_label}}</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @php $savedval = 0; @endphp
        @forelse($receipt_details->lines as $line)
        <tr>
            <td style="text-align: center; vertical-align: middle;">
                {{$loop->iteration}}
            </td>
            <td style="text-align: left;">
                {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
                @if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif 
                @if(!empty($line['brand'])), {{$line['brand']}} @endif 
                @if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
                @if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
                @if(!empty($line['product_description']))
                    <div style="font-size: 8px;">
                        {!!$line['product_description']!!}
                    </div>
                @endif
                @if(!empty($line['sell_line_note']))
                    <br>
                    <span style="font-size: 8px;">
                    {!!$line['sell_line_note']!!}
                    </span>
                @endif 
                @if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif 
                @if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif
                @if(!empty($line['warranty_name']))
                    <br>
                    <small>
                        {{$line['warranty_name']}}
                    </small>
                @endif
                @if(!empty($line['warranty_exp_date']))
                    <small>
                        - {{@format_date($line['warranty_exp_date'])}}
                    </small>
                @endif
                @if(!empty($line['warranty_description']))
                    <small> {{$line['warranty_description'] ?? ''}}</small>
                @endif

                @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                    <br><small>
                        1 {{$line['units']}} = {{$line['base_unit_multiplier']}} {{$line['base_unit_name']}} <br>
                        {{$line['base_unit_price']}} x {{$line['orig_quantity']}} = {{$line['line_total']}}
                    </small>
                @endif
            </td>
            <td style="text-align: center;">
                {{$line['quantity']}} 
                @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                    <small>
                        {{$line['quantity']}} x {{$line['base_unit_multiplier']}} = {{$line['orig_quantity']}} {{$line['base_unit_name']}}
                    </small>
                @endif
            </td>
            @if($receipt_details->show_mrp != 0)
            <td style="text-align: center;"> {{$line['mrp']}} </td>
            @endif
            @php
                $savedval += (is_numeric($line['mrp']) ? (float)$line['mrp'] : 0) - (is_numeric($line['line_total']) ? (float)$line['line_total'] : 0);
            @endphp

            @if(empty($receipt_details->hide_price))
            <td style="text-align: center;">{{$line['unit_price_before_discount']}} </td>

            @if(!empty($receipt_details->discounted_unit_price_label))
                <td style="text-align: center;">
                    {{$line['unit_price_inc_tax']}} 
                </td>
            @endif

            @if(!empty($receipt_details->item_discount_label))
                <td style="text-align: center;">
                    {{$line['total_line_discount'] ?? '0.00'}}
                    @if(!empty($line['line_discount_percent']))
                         ({{$line['line_discount_percent']}}%)
                    @endif
                </td>
            @endif
            <td style="text-align: right;">{{$line['line_total']}}</td>
            @endif
        </tr>
        @if(!empty($line['modifiers']))
            @foreach($line['modifiers'] as $modifier)
            <tr>
                <td style="padding-left: 20px;">&nbsp;</td>
                <td style="text-align: left;">
                    {{$modifier['name']}} {{$modifier['variation']}} 
                    @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif 
                    @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
                    @if(!empty($modifier['sell_line_note']))({!!$modifier['sell_line_note']!!}) @endif 
                </td>
                <td style="text-align: center;">{{$modifier['quantity']}} {{$modifier['units']}} </td>
                @if(empty($receipt_details->hide_price))
                <td style="text-align: center;">{{$modifier['unit_price_inc_tax']}}</td>
                @if(!empty($receipt_details->discounted_unit_price_label))
                    <td style="text-align: center;">{{$modifier['unit_price_exc_tax']}}</td>
                @endif
                @endif
            </tr>
            @endforeach
        @endif
        @endforeach
    </tbody>
</table>

<table style="width: 100%; border-collapse: collapse;">
    @if(!empty($receipt_details->total_quantity_label))
        <tr>
            <td style="text-align: right; width: 50%;">{!! $receipt_details->total_quantity_label !!}:</td>
            <td style="text-align: right; width: 50%;">{{$receipt_details->total_quantity}}</td>
        </tr>
    @endif

    @if(!empty($receipt_details->total_items_label))
        <tr>
            <td style="text-align: right; width: 50%;">{!! $receipt_details->total_items_label !!}:</td>
            <td style="text-align: right; width: 50%;">{{$receipt_details->total_items}}</td>
        </tr>
    @endif

    @if(empty($receipt_details->hide_price))
        <tr>
            <td style="text-align: right; font-weight: bold;">{!! $receipt_details->subtotal_label !!}</td>
            <td style="text-align: right; font-weight: bold;">{{$receipt_details->subtotal}}</td>
        </tr>
    @endif

    @if(!empty($receipt_details->shipping_charges))
        <tr>
            <td style="text-align: right;">{!! $receipt_details->shipping_charges_label !!}:</td>
            <td style="text-align: right;">{{$receipt_details->shipping_charges}}</td>
        </tr>
    @endif

    @if(!empty($receipt_details->packing_charge))
        <tr>
            <td style="text-align: right;">{!! $receipt_details->packing_charge_label !!}:</td>
            <td style="text-align: right;">{{$receipt_details->packing_charge}}</td>
        </tr>
    @endif

    @if( !empty($receipt_details->discount) )
        <tr>
            <td style="text-align: right;">{!! $receipt_details->discount_label !!}</td>
            <td style="text-align: right;">(-) {{$receipt_details->discount}}</td>
        </tr>
    @endif

    @if( !empty($receipt_details->total_line_discount) )
        <tr>
            <td style="text-align: right;">{!! $receipt_details->line_discount_label !!}:</td>
            <td style="text-align: right;">(-) {{$receipt_details->total_line_discount}}</td>
        </tr>
    @endif

    @if( !empty($receipt_details->additional_expenses) )
        @foreach($receipt_details->additional_expenses as $key => $val)
            <tr>
                <td style="text-align: right;">{{$key}}:</td>
                <td style="text-align: right;">(+) {{$val}}</td>
            </tr>
        @endforeach
    @endif

    @if(!empty($receipt_details->reward_point_label) )
        <tr>
            <td style="text-align: right;">{!! $receipt_details->reward_point_label !!}:</td>
            <td style="text-align: right;">(-) {{$receipt_details->reward_point_amount}}</td>
        </tr>
    @endif
</table>
<table style="width: 100%; border-collapse: collapse;">
    @if(!empty($receipt_details->tax))
        <tr>
            <td style="text-align: right; width: 50%;">{!! $receipt_details->tax_label !!}</td>
            <td style="text-align: right; width: 50%;">(+) {{$receipt_details->tax}}</td>
        </tr>
    @endif

    @if($receipt_details->round_off_amount > 0)
        <tr>
            <td style="text-align: right; width: 50%;">{!! $receipt_details->round_off_label !!}</td>
            <td style="text-align: right; width: 50%;">{{$receipt_details->round_off}}</td>
        </tr>
    @endif

    <tr style="font-weight: bold;">
        <td style="text-align: right;">{!! $receipt_details->total_label !!}</td>
        <td style="text-align: right;">{{$receipt_details->total}}</td>
    </tr>

    @if(!empty($receipt_details->total_in_words))
        <tr>
            <td colspan="2" style="text-align: right;"><small>({{$receipt_details->total_in_words}})</small></td>
        </tr>
    @endif

    @if(!empty($receipt_details->payments))
        @foreach($receipt_details->payments as $payment)
            <tr>
                <td style="text-align: right;">{{$payment['method']}} ({{$payment['date']}}):</td>
                <td style="text-align: right;">{{$payment['amount']}}</td>
            </tr>
        @endforeach
    @endif

    @if(!empty($receipt_details->total_paid))
        <tr>
            <td style="text-align: right;">{!! $receipt_details->total_paid_label !!}:</td>
            <td style="text-align: right;">{{$receipt_details->total_paid}}</td>
        </tr>
    @endif

    @if(!empty($receipt_details->show_opening_bal) && $receipt_details->openbal_due != 0)
        <tr>
            <td style="text-align: right;">{!! $receipt_details->opening_bal_label !!}:</td>
            <td style="text-align: right;">{{$receipt_details->openbal_due}}</td>
        </tr>
    @endif

    @if(!empty($receipt_details->total_due) && !empty($receipt_details->total_due_label))
        <tr>
            <td style="text-align: right;">{!! $receipt_details->total_due_label !!}:</td>
            <td style="text-align: right;">{{$receipt_details->total_due}}</td>
        </tr>
    @endif

    @if(!empty($receipt_details->all_due))
        <tr>
            <td style="text-align: right;">{!! $receipt_details->all_bal_label !!}:</td>
            <td style="text-align: right;">{{$receipt_details->all_due}}</td>
        </tr>
    @endif
</table>

<!-- Border Line -->
<div style="border-bottom: 1px solid #000; width: 100%; margin-top: 10px;"></div>

<!-- Tax Summary -->
@if(empty($receipt_details->hide_price) && !empty($receipt_details->tax_summary_label))
    @if(!empty($receipt_details->taxes))
        <table style="border-bottom: 1px solid #000; width: 100%; font-size: 12px; margin-top: 10px;">
            <tr>
                <th colspan="2" style="text-align: center;">{{$receipt_details->tax_summary_label}}</th>
            </tr>
            @foreach($receipt_details->taxes as $key => $val)
                <tr>
                    <td style="text-align: left;">{{$key}}</td>
                    <td style="text-align: right;">{{$val}}</td>
                </tr>
            @endforeach
        </table>
    @endif
@endif

                @endif

@if($receipt_details->show_savedvalue == 1)
    <div style="text-align: center;">
        <h6>{{$receipt_details->savedvalue_lable}}: ₹ {{$savedval}}</h6>
    </div>
@endif

@if(!empty($receipt_details->additional_notes))
    <p style="text-align: center;">
        {!! nl2br($receipt_details->additional_notes) !!}
    </p>
@endif

{{-- Barcode --}}
@if($receipt_details->show_barcode)
    <br/>
    <img style="display: block; margin-left: auto; margin-right: auto;" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
@endif

@if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
    <img style="display: block; margin-left: auto; margin-right: auto; margin-top: 20px;" src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE')}}">
@endif

@if(!empty($receipt_details->footer_text))
    <p style="text-align: center;">
        {!! $receipt_details->footer_text !!}
    </p>
@endif

<div style="border-bottom: 1px solid #000; width: 100%;"> </div>
<div style="text-align: center; margin-top: 0; margin-bottom: 20px;">
    <i>Powered by - Namma Billing</i>
</div>

<!-- Continue the rest of the code as you did above with inline styles for other sections -->

        <!-- <button id="btnPrint" class="hidden-print">Print</button>
        <script src="script.js"></script> -->
    </body>
</html>
