<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link rel="stylesheet" href="style.css"> -->
        <title>Receipt-{{$receipt_details->invoice_no}}</title>
    </head>
    <body>
        <div class="ticket">
        	@if(empty($receipt_details->letter_head))
				@if(!empty($receipt_details->logo))
					<div class="text-box centered text-center">
						<img style="max-height: 60px; width: auto; margin:0 auto;" src="{{$receipt_details->logo}}" alt="Logo">
					</div>
				@endif
				<div class="text-box">
				<!-- Logo -->
				<p class="centered text-center">
					<!-- Header text -->
					@if(!empty($receipt_details->header_text))
						<div class="headings text-center">{!! $receipt_details->header_text !!}</div>
						<!-- <br/> -->
					@endif

					<!-- business information here -->
					@if(!empty($receipt_details->display_name))
						<div class="headings text-center">
						{{$receipt_details->display_name}}
						</div>
						<!-- <br/> -->
					@endif
					
					@if(!empty($receipt_details->address))
					<div class="text-center">{!! $receipt_details->address !!}</div>
						<!-- <br/> -->
					@endif

					@if(!empty($receipt_details->contact))
					<div class="text-center">{!! $receipt_details->contact !!}</div>
					@endif

					<!-- @if(!empty($receipt_details->contact) && !empty($receipt_details->website))
					, 
					@endif
					@if(!empty($receipt_details->website))
						{{ $receipt_details->website }}
					@endif -->
					
					@if(!empty($receipt_details->contact) && !empty($receipt_details->website))
					 
					@endif

					@if(!empty($receipt_details->website))
					<div class="text-center">{{ $receipt_details->website }}</div>
					@endif

					@if(!empty($receipt_details->location_custom_fields))
						<div class="text-center">{{ $receipt_details->location_custom_fields }}</div>
					@endif

					@if(!empty($receipt_details->sub_heading_line1))
					<div class="text-center">{{ $receipt_details->sub_heading_line1 }}</div>
					@endif
					@if(!empty($receipt_details->sub_heading_line2))
					<div class="text-center">{{ $receipt_details->sub_heading_line2 }}</div>
					@endif
					@if(!empty($receipt_details->sub_heading_line3))
					<div class="text-center">{{ $receipt_details->sub_heading_line3 }}</div>
					@endif
					@if(!empty($receipt_details->sub_heading_line4))
					<div class="text-center">{{ $receipt_details->sub_heading_line4 }}</div>
					@endif		
					@if(!empty($receipt_details->sub_heading_line5))
					<div class="text-center">{{ $receipt_details->sub_heading_line5 }}</div>
					@endif

					@if(!empty($receipt_details->tax_info1))
						<div class="text-center">{{ $receipt_details->tax_label1 }} {{ $receipt_details->tax_info1 }}</div>
					@endif

					@if(!empty($receipt_details->tax_info2))
					<div class="text-center">{{ $receipt_details->tax_label2 }} {{ $receipt_details->tax_info2 }}</div>
					@endif
				@endif
					<!-- Title of receipt -->
					@if(!empty($receipt_details->invoice_heading))
					<div class="text-center"><span class="sub-headings">{!! $receipt_details->invoice_heading !!}</span></div>
					@endif
				</p>
				</div>
				@if(!empty($receipt_details->letter_head))
					<div class="text-box">
						<img style="width: 100%;margin-bottom: 10px;" src="{{$receipt_details->letter_head}}">
					</div>
				@endif
			<div class="border-top textbox-info">
				<div class="f-left"><span>{!! $receipt_details->invoice_no_prefix !!}:</span></div>
				<div class="f-right">
					{{$receipt_details->invoice_no}}
				</div>
			</div>
			<div class="textbox-info">
				<div class="f-left"><span>{!! $receipt_details->date_label !!}:</span></div>
				<div class="f-right">
					{{$receipt_details->invoice_date}}
				</div>
			</div>
			
			@if(!empty($receipt_details->due_date_label))
				<div class="textbox-info">
					<div class="f-left"><span>{{$receipt_details->due_date_label}}:</span></div>
					<div class="f-right">{{$receipt_details->due_date ?? ''}}</div>
				</div>
			@endif

			@if(!empty($receipt_details->sales_person_label))
				<div class="textbox-info">
					<div class="f-left"><span>{{$receipt_details->sales_person_label}}:</span></div>
				
					<div class="f-right">{{$receipt_details->sales_person}}</div>
				</div>
			@endif
			@if(!empty($receipt_details->commission_agent_label))
				<div class="textbox-info">
					<div class="f-left"><span>{{$receipt_details->commission_agent_label}}:</span></div>
				
					<div class="f-right">{{$receipt_details->commission_agent}}</div>
				</div>
			@endif

			@if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
				<div class="textbox-info">
					<div class="f-left"><span>{{$receipt_details->brand_label}}:</span></div>
				
					<div class="f-right">{{$receipt_details->repair_brand}}</div>
				</div>
			@endif

			@if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
				<div class="textbox-info">
					<div class="f-left"><span>{{$receipt_details->device_label}}:</span></div>
				
					<div class="f-right">{{$receipt_details->repair_device}}</div>
				</div>
			@endif
			
			@if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
				<div class="textbox-info">
					<div class="f-left"><span>{{$receipt_details->model_no_label}}:</span></div>
				
					<div class="f-right">{{$receipt_details->repair_model_no}}</div>
				</div>
			@endif
			
			@if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
				<div class="textbox-info">
					<div class="f-left"><span>{{$receipt_details->serial_no_label}}:</span></div>
				
					<div class="f-right">{{$receipt_details->repair_serial_no}}</div>
				</div>
			@endif

			@if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
				<div class="textbox-info">
					<div class="f-left"><span>
						{!! $receipt_details->repair_status_label !!}:
					</span></div>
					<div class="f-right">
						{{$receipt_details->repair_status}}
					</div>
				</div>
        	@endif

        	@if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
	        	<div class="textbox-info">
	        		<div class="f-left"><span>
	        			{!! $receipt_details->repair_warranty_label !!}:
	        		</span></div>
	        		<div class="f-right">
	        			{{$receipt_details->repair_warranty}}
	        		</div>
	        	</div>
        	@endif

        	<!-- Waiter info -->
			@if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
	        	<div class="textbox-info">
	        		<div class="f-left"><span>
	        			{!! $receipt_details->service_staff_label !!}:
	        		</span></div>
	        		<div class="f-right">
	        			{{$receipt_details->service_staff}}
					</div>
	        	</div>
	        @endif

	        @if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
	        	<div class="textbox-info">
	        		<div class="f-left"><span>
	        			@if(!empty($receipt_details->table_label))
							<b>{!! $receipt_details->table_label !!}:</b>
						@endif
	        		</span></div>
	        		<div class="f-right">
	        			{{$receipt_details->table}}
	        		</div>
	        	</div>
	        @endif
	        
	        @if(!empty($receipt_details->types_of_service)) 
					
					<div class="textbox-info">
    	        		<div class="f-left"><span>{!! $receipt_details->types_of_service_label !!}
    	        		</span></div>
    	        		<div class="f-right">
    	        			{{$receipt_details->types_of_service}}:
    	        		</div>
    	        			<!-- Waiter info -->
    	        		@if(!empty($receipt_details->types_of_service_custom_fields))
							@foreach($receipt_details->types_of_service_custom_fields as $key => $value)
								<br><span>{{$key}}: </span> {{$value}}
							@endforeach
						@endif
    	        	</div>
	        	
				@endif

			@if (!empty($receipt_details->sell_custom_field_1_value))
				<div class="textbox-info">
					<div class="f-left"><span>{!! $receipt_details->sell_custom_field_1_label !!}:</span></div>
					<div class="f-right">
						{{$receipt_details->sell_custom_field_1_value}}
					</div>
				</div>
			@endif
			@if (!empty($receipt_details->sell_custom_field_2_value))
				<div class="textbox-info">
					<div class="f-left"><span>{!! $receipt_details->sell_custom_field_2_label !!}:</span></div>
					<div class="f-right">
						{{$receipt_details->sell_custom_field_2_value}}
					</div>
				</div>
			@endif
			@if (!empty($receipt_details->sell_custom_field_3_value))
				<div class="textbox-info">
					<div class="f-left"><span>{!! $receipt_details->sell_custom_field_3_label !!}:</span></div>
					<div class="f-right">
						{{$receipt_details->sell_custom_field_3_value}}
					</div>
				</div>
			@endif
			@if (!empty($receipt_details->sell_custom_field_4_value))
				<div class="textbox-info">
					<div class="f-left"><span>{!! $receipt_details->sell_custom_field_4_label !!}:</span></div>
					<div class="f-right">
						{{$receipt_details->sell_custom_field_4_value}}
					</div>
				</div>
			@endif

	        <!-- customer info -->
	        <div class="textbox-info">
	        	<!-- <div class="f-left" style="vertical-align: top;"><span>
	        		{{$receipt_details->customer_label ?? ''}}
	        	</span></div>

	        	<div class="f-right">
	        		@if(!empty($receipt_details->customer_info))
	        			<div class="bw">
						{!! $receipt_details->customer_info !!}
						</div>
					@endif
	        	</div> -->

			<table style="width: 100%;">
    <tr>
        <td style="vertical-align: top;">
            <span>{{$receipt_details->customer_label ?? ''}}</span>
        </td>
        <td style="vertical-align: top; text-align: right;">
            @if(!empty($receipt_details->customer_info))
                <div class="bw" style="line-height: 10px;">
                    {!! $receipt_details->customer_info !!}
                </div>
            @endif
        </td>
    </tr>
</table>



	        </div>
			
			@if(!empty($receipt_details->client_id_label))
				<div class="textbox-info">
					<div class="f-left"><span>
						{{ $receipt_details->client_id_label }}:
					</span></div>
					<div class="f-right">
						{{ $receipt_details->client_id }}
					</div>
				</div>
			@endif
			
			@if(!empty($receipt_details->customer_tax_label))
				<div class="textbox-info">
					<div class="f-left"><span>
						{{ $receipt_details->customer_tax_label }}:
					</span></div>
					<div class="f-right">
						{{ $receipt_details->customer_tax_number }}
					</div>
				</div>
			@endif

			@if(!empty($receipt_details->customer_custom_fields))
				<div class="textbox-info">
					<div class="centered">
						{!! $receipt_details->customer_custom_fields !!}
					</div>
				</div>
			@endif
			
			@if(!empty($receipt_details->customer_rp_label))
				<div class="textbox-info">
					<div class="f-left"><span>
						{{ $receipt_details->customer_rp_label }}:
					</span></div>
					<div class="f-right">
						{{ $receipt_details->customer_total_rp }}
					</div>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_1_label))
				<div class="textbox-info">
					<div class="f-left"><span>
						{!!$receipt_details->shipping_custom_field_1_label!!} :
					</span></div>
					<div class="f-right">
						{!!$receipt_details->shipping_custom_field_1_value ?? ''!!}
					</div>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_2_label))
				<div class="textbox-info">
					<div class="f-left"><span>
						{!!$receipt_details->shipping_custom_field_2_label!!}: 
					</span></div>
					<div class="f-right">
						{!!$receipt_details->shipping_custom_field_2_value ?? ''!!}
					</div>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_3_label))
				<div class="textbox-info">
					<div class="f-left"><span>
						{!!$receipt_details->shipping_custom_field_3_label!!}: 
					</span></div>
					<div class="f-right">
						{!!$receipt_details->shipping_custom_field_3_value ?? ''!!}
					</div>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_4_label))
				<div class="textbox-info">
					<div class="f-left"><span>
						{!!$receipt_details->shipping_custom_field_4_label!!}: 
					</span></div>
					<div class="f-right">
						{!!$receipt_details->shipping_custom_field_4_value ?? ''!!}
					</div>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_5_label))
				<div class="textbox-info">
					<div class="f-left"><span>
						{!!$receipt_details->shipping_custom_field_5_label!!}: 
					</span></div>
					<div class="f-right">
						{!!$receipt_details->shipping_custom_field_5_value ?? ''!!}
					</div>
				</div>
			@endif
			@if(!empty($receipt_details->sale_orders_invoice_no))
				<div class="textbox-info">
					<div class="f-left"><span>
						@lang('restaurant.order_no'):
					</span></div>
					<div class="f-right">
						{!!$receipt_details->sale_orders_invoice_no ?? ''!!}
					</div>
				</div>
			@endif

			@if(!empty($receipt_details->sale_orders_invoice_date))
				<div class="textbox-info">
					<div class="f-left"><span>
						@lang('lang_v1.order_dates'):
					</span></div>
					<div class="f-right">
						{!!$receipt_details->sale_orders_invoice_date ?? ''!!}
					</div>
				</div>
			@endif

			<!-- <div class="border-bottom">&nbsp;</div> -->
            <table class="border-bottom border-top width-100 table-f-12 mb-0">
                <thead class="border-bottom">
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
                        <th class="serial_number" width="5%">#</th>
                        <th class="description" width="{{$p_width}}%">
                        	{{$receipt_details->table_product_label}}
                        </th>
                        <th class="quantity text-center" width="8%">
                        	{{$receipt_details->table_qty_label}}
                        </th>
						<th class="mrp text-center" width="8%">
                        	MRP
                        </th>
                        @if(empty($receipt_details->hide_price))
                        <th class="unit_price text-center" width="8%">
                        	{{$receipt_details->table_unit_price_label}}
                        </th>
                        @if(!empty($receipt_details->discounted_unit_price_label))
							<th class="text-center" width="8%">
								{{$receipt_details->discounted_unit_price_label}}
							</th>
						@endif
                        @if(!empty($receipt_details->item_discount_label))
							<th class="text-center" width="8%">{{$receipt_details->item_discount_label}}</th>
						@endif
                        <th class="price text-right" width="12%">{{$receipt_details->table_subtotal_label}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
					@php $savedval = 0; @endphp
                	@forelse($receipt_details->lines as $line)
	                    <tr>
	                        <td class="serial_number" style="vertical-align: middle;">
	                        	{{$loop->iteration}}
	                        </td>
	                        <td class="description">
	                        	{{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
	                        	@if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif @if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
	                        	@if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
	                        	@if(!empty($line['product_description']))
	                            	<div class="f-8">
	                            		{!!$line['product_description']!!}
	                            	</div>
	                            @endif
	                        	@if(!empty($line['sell_line_note']))
	                        	<br>
	                        	<span class="f-8">
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
	                        <!-- <td class="quantity text-right">{{$line['quantity']}} {{$line['units']}} @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                            <br>
							<small>
                            	{{$line['quantity']}} x {{$line['base_unit_multiplier']}} = {{$line['orig_quantity']}} {{$line['base_unit_name']}}
                            </small>
                            @endif</td> -->
							<td class="quantity text-center">{{$line['quantity']}} @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                            
							<small>
                            	{{$line['quantity']}} x {{$line['base_unit_multiplier']}} = {{$line['orig_quantity']}} {{$line['base_unit_name']}}
                            </small>
                            @endif</td>
							<td class= "text-center"> {{$line['mrp']}} </td>
							@php
                           $mrp = is_numeric(str_replace(',', '', $line['mrp'])) ? (float)str_replace(',', '', $line['mrp']) : 0;
                            $unit_price = is_numeric(str_replace(',', '', $line['unit_price'])) ? (float)str_replace(',', '', $line['unit_price']) : 0;
                            
                            $savedval += ($mrp != 0) ? ($mrp - $unit_price) : 0;


							@endphp


	                        @if(empty($receipt_details->hide_price))
	                        <td class="unit_price text-center">{{$line['unit_price_inc_tax']}} </td>

	                        @if(!empty($receipt_details->discounted_unit_price_label))
								<td class="text-center">
									{{$line['unit_price_inc_tax']}} 
								</td>
							@endif

	                        @if(!empty($receipt_details->item_discount_label))
								<td class="text-center">
									{{$line['total_line_discount'] ?? '0.00'}}
									@if(!empty($line['line_discount_percent']))
								 		({{$line['line_discount_percent']}}%)
									@endif
								</td>
							@endif
	                        <td class="price text-right">{{$line['line_total']}}</td>
	                        @endif
	                    </tr>
	                    @if(!empty($line['modifiers']))
							@foreach($line['modifiers'] as $modifier)
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
			                            {{$modifier['name']}} {{$modifier['variation']}} 
			                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
			                            @if(!empty($modifier['sell_line_note']))({!!$modifier['sell_line_note']!!}) @endif 
			                        </td>
									<td class="text-center">{{$modifier['quantity']}} {{$modifier['units']}} </td>
									@if(empty($receipt_details->hide_price))
									<td class="text-center">{{$modifier['unit_price_inc_tax']}}</td>
									@if(!empty($receipt_details->discounted_unit_price_label))
										<td class="text-center">{{$modifier['unit_price_exc_tax']}}</td>
									@endif
									@endif
								</tr>
							@endforeach
						@endif
                    @endforeach
                    <!-- <tr>
                    	<td @if(!empty($receipt_details->item_discount_label)) colspan="6" @else colspan="5" @endif>&nbsp;</td>
                    	@if(!empty($receipt_details->discounted_unit_price_label))
    					<td></td>
    					@endif
                    </tr> -->
                </tbody>
            </table>
			@if(!empty($receipt_details->total_quantity_label))
				<div class="flex-box">
					<div class="width-50 text-right">
						{!! $receipt_details->total_quantity_label !!}:
					</div>
					<div class="width-50 text-right">
						{{$receipt_details->total_quantity}}
					</div>
				</div>
			@endif
			@if(!empty($receipt_details->total_items_label))
				<div class="flex-box">
					<div class="width-50 text-right">
						{!! $receipt_details->total_items_label !!}:
					</div>
					<div class="width-50 text-right">
						{{$receipt_details->total_items}}
					</div>
				</div>
			@endif
			@if(empty($receipt_details->hide_price))
                <div class="flex-box">
                    <div class="width-50 text-right sub-headings2">
                    	{!! $receipt_details->subtotal_label !!}
                    </div>
                    <div class="width-50 text-right sub-headings2">
                    	{{$receipt_details->subtotal}}
                    </div>
                </div>

                <!-- Shipping Charges -->
				@if(!empty($receipt_details->shipping_charges))
					<div class="flex-box">
						<div class="width-50 text-right">
							{!! $receipt_details->shipping_charges_label !!}:
						</div>
						<div class="width-50 text-right">
							{{$receipt_details->shipping_charges}}
						</div>
					</div>
				@endif

				@if(!empty($receipt_details->packing_charge))
					<div class="flex-box">
						<div class="width-50 text-right">
							{!! $receipt_details->packing_charge_label !!}:
						</div>
						<div class="width-50 text-right">
							{{$receipt_details->packing_charge}}
						</div>
					</div>
				@endif

				<!-- Discount -->
				@if( !empty($receipt_details->discount) )
					<div class="flex-box">
						<div class="width-50 text-right">
							{!! $receipt_details->discount_label !!}
						</div>

						<div class="width-50 text-right">
							(-) {{$receipt_details->discount}}
						</div>
					</div>
				@endif

				@if( !empty($receipt_details->total_line_discount) )
					<div class="flex-box">
						<div class="width-50 text-right">
							{!! $receipt_details->line_discount_label !!}:
						</div>

						<div class="width-50 text-right">
							(-) {{$receipt_details->total_line_discount}}
						</div>
					</div>
				@endif

				@if( !empty($receipt_details->additional_expenses) )
					@foreach($receipt_details->additional_expenses as $key => $val)
						<div class="flex-box">
							<div class="width-50 text-right">
								{{$key}}:
							</div>

							<div class="width-50 text-right">
								(+) {{$val}}
							</div>
						</div>
					@endforeach
				@endif

				@if(!empty($receipt_details->reward_point_label) )
					<div class="flex-box">
						<div class="width-50 text-right">
							{!! $receipt_details->reward_point_label !!}:
						</div>

						<div class="width-50 text-right">
							(-) {{$receipt_details->reward_point_amount}}
						</div>
					</div>
				@endif

				@if( !empty($receipt_details->tax) )
					<div class="flex-box">
						<div class="width-50 text-right">
							{!! $receipt_details->tax_label !!}
						</div>
						<div class="width-50 text-right">
							(+) {{$receipt_details->tax}}
						</div>
					</div>
				@endif

				@if( $receipt_details->round_off_amount > 0)
					<div class="flex-box">
						<div class="width-50 text-right">
							{!! $receipt_details->round_off_label !!} 
						</div>
						<div class="width-50 text-right">
							{{$receipt_details->round_off}}
						</div>
					</div>
				@endif

				<div class="flex-box">
					<div class="width-50 text-right tbold">
						{!! $receipt_details->total_label !!}
					</div>
					<div class="width-50 text-right tbold">
						{{$receipt_details->total}}
					</div>
				</div>

				
				@if(!empty($receipt_details->total_in_words))
				<div colspan="2" class="text-right mb-0">
					<small>
					({{$receipt_details->total_in_words}})
					</small>
				</div>
				@endif
				@if(!empty($receipt_details->payments))
					@foreach($receipt_details->payments as $payment)
						<div class="flex-box">
							<div class="width-50 text-right">{{$payment['method']}} ({{$payment['date']}}): </div>
							<div class="width-50 text-right">{{$payment['amount']}}</div>
						</div>
					@endforeach
				@endif

				<!-- Total Paid-->
				@if(!empty($receipt_details->total_paid))
					<div class="flex-box">
						<div class="width-50 text-right">
							{!! $receipt_details->total_paid_label !!}:
						</div>
						<div class="width-50 text-right">
							{{$receipt_details->total_paid}}
						</div>
					</div>
				@endif
				
					@if(!empty($receipt_details->show_opening_bal) && $receipt_details->openbal_due != 0)
					<div class="flex-box">
						<div class="width-50 text-right">
							{!! $receipt_details->opening_bal_label !!}:
						</div>
						<div class="width-50 text-right">
					        {{ $receipt_details->openbal_due }}
						</div>
					</div>
				@endif

				<!-- Total Due-->
				@if(!empty($receipt_details->total_due) && !empty($receipt_details->total_due_label))
					<div class="flex-box">
						<div class="width-50 text-right">
							{!! $receipt_details->total_due_label !!}:
						</div>
						<div class="width-50 text-right">
							{{$receipt_details->total_due}}
						</div>
					</div>
				@endif

				@if(!empty($receipt_details->all_due))
					<div class="flex-box">
						<div class="width-50 text-right">
							{!! $receipt_details->all_bal_label !!}:
						</div>
						<div class="width-50 text-right">
							{{$receipt_details->all_due}}
						</div>
					</div>
				@endif
				
				
				
			@endif
            <div class="border-bottom width-100"> </div>
            @if(empty($receipt_details->hide_price) && !empty($receipt_details->tax_summary_label) )
	            <!-- tax -->
	            @if(!empty($receipt_details->taxes))
	            	<table class="border-bottom width-100 table-f-12">
	            		<tr>
	            			<th colspan="2" class="text-center">{{$receipt_details->tax_summary_label}}</th>
	            		</tr>
	            		@foreach($receipt_details->taxes as $key => $val)
	            			<tr>
	            				<td class="left text-left">{{$key}}</td>
	            				<td class="right text-right">{{$val}}</td>
	            			</tr>
	            		@endforeach
	            	</table>
	            @endif
            @endif

            @if($receipt_details->show_savedvalue == 1)
			<div class="center-block">
				<div class="text-center">
					<h6>{{$receipt_details->savedvalue_lable}}: ₹ {{$savedval}}</h6>
				</div>
			</div>
            @endif
            
            @if($receipt_details->show_signature == 1)
			<div class="center-block">
				<div class="text-center">
			        <img style="max-height: 60px; width: auto; margin:0 auto;" src="{{$receipt_details->signature_image}}" alt="Logo">
				</div>
			</div>
            @endif

            @if(!empty($receipt_details->additional_notes))
	            <p class="centered">
	            	{!! nl2br($receipt_details->additional_notes) !!}
				</p>
            @endif

            {{-- Barcode --}}
			@if($receipt_details->show_barcode)
				<br/>
				<img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
			@endif

			@if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
				<img class="center-block mt-5" src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE')}}">
			@endif
			
			@if(!empty($receipt_details->footer_text))
				<p class="centered">
					{!! $receipt_details->footer_text !!}
				</p>
			@endif

			<div class="border-bottom width-100"> </div>
			<div class="center-block mt-0 mb-5"><i>Powered by - Namma Billing</i></div>
			
        </div>
        <!-- <button id="btnPrint" class="hidden-print">Print</button>
        <script src="script.js"></script> -->
    </body>
</html>

<style type="text/css">
.f-8 {
	font-size: 8px !important;
}
body {
	color: #000000;
}
@media print {
	* {
    	font-size: 12px;
    	/* font-family: 'Times New Roman'; */
		/* font-family: "Barlow Condensed", sans-serif; */
		font-family: "Sofia Sans Condensed", sans-serif;
    	/* font-family: "Mohave", sans-serif; */
		/* font-family: "Inria Sans", sans-serif; */
    	/* word-break: break-all; */
		/* font-weight:400; */
	}
	.f-8 {
		font-size: 8px !important;
	}
	
.headings{
	font-size: 14px;
	font-weight: 600;
	text-transform: uppercase;
	white-space: normal;
}

.sub-headings{
	font-size: 12px !important;
	font-weight: 500 !important;
}
.tbold{
	font-weight:600;
	font-size:14px;
}
.border-top{
    border-top: .1px dashed #242424;
}
.border-bottom{
	border-bottom: .1px dashed #242424;
}
.bb-lg {
	border-bottom: .1px solid lightgray;
}
.border-bottom-dotted{
	border-bottom: 1px dotted darkgray;
}

td.serial_number, th.serial_number{
	/* width: 5%; */
    max-width: 5%; 
	vertical-align: top !important;

}

td.description,
th.description {
    /* width: 35%; */
    max-width: 35%;
	line-height:12px !important;
}

td.quantity,
th.quantity {
    /* width: 15%; */
    max-width: 15%;
    /* word-break: break-all; */
}
td.unit_price, th.unit_price{
	/* width: 25%; */
    max-width: 25%;
    /* word-break: break-all; */
}

td.price,
th.price {
    /* width: 20%; */
    max-width: 20%;
    /* word-break: break-all; */
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 100%;
    max-width: 100%;
}

img {
    max-width: inherit;
    width: auto;
}

    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}


.table-info {
	width: 100%;
}
.table-info tr:first-child td, .table-info tr:first-child th {
	padding-top: 5px;
}
.table-info th {
	text-align: left;
}
.table-info td {
	text-align: right;
}
.logo {
	float: left;
	width:35%;
	padding: 10px;
}

.text-with-image {
	float: left;
	width:65%;
}
.text-box {
	width: 100%;
	height: auto;
}

.textbox-info {
	clear: both;
}
.textbox-info p {
	margin-bottom: 0px
}
.flex-box {
	display: flex;
	width: 100%;
}
.flex-box p {
	width: 50%;
	margin-bottom: 0px;
	white-space: nowrap;
}

.table-f-12 th, .table-f-12 td {
	font-size: 12px;
	/* word-break: break-word; */
}

.bw {
	/* word-break: break-word; */
}
</style>