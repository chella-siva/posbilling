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
						<img style="max-height: 70px; width: auto; margin:0 auto;" src="{{$receipt_details->logo}}" alt="Logo">
					</div>
				@endif
				<div class="text-box">
				<p class="centered">
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
					
					@if(!empty($receipt_details->contact) && !empty($receipt_details->website))
					 
					@endif
					<!-- @if(!empty($receipt_details->website))
						{{ $receipt_details->website }}</p>
					@endif -->

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
				</p>
				</div>
			@endif
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
	        	<div style="vertical-align: top;">
					<span>
	        		{{$receipt_details->customer_label ?? ''}}
	        		</span>
				</div>
	        	<div>
	        		@if(!empty($receipt_details->customer_info))
	        			<div class="bw">
						{!! $receipt_details->customer_info !!}
						</div>
					@endif
	        	</div>

				<!-- <p class="f-left"><span>
					{{$receipt_details->customer_label ?? ''}}
					</span></p>

					<p class="f-right">
						@if(!empty($receipt_details->customer_info))
							<span>
							{!! $receipt_details->customer_info !!}
							</span>
						@endif
					</p> -->
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
						{!!$receipt_details->shipping_custom_field_1_label!!}:
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
			<!-- <div class="bb-lg mt-15 mb-5"></div> -->
			<!-- <div class="border-bottom">&nbsp;</div> -->
            <table style="padding-top: 0px !important mt-2" class="border-bottom width-100 table-f-12" style="width:100%;">
				<thead class="border-top border-bottom" style="background-color:#E8F3FD!important;">
                    <tr>
                        <th class="serial_number">
							<span class="pull-left"># {{$receipt_details->table_product_label}}</span>
							<span class="pull-right">{{$receipt_details->table_subtotal_label}}</span>
						</th>				
						
                        <!-- <th class="price text-right">{{$receipt_details->table_subtotal_label}}</th> -->
                    </tr>
                </thead>
                <tbody>
                    @php $savedval = 0; @endphp
                	@forelse($receipt_details->lines as $line)
	                    <tr class="bb-lgs" style="border-bottom:0.1px dashed #ccc !important;" >
	                        <td class="description">
	                        	<div style="display:flex; width: 100%;">
	                        		<p class="mb-0 mt-0" style="white-space: nowrap;">{{$loop->iteration}}.&nbsp;</p>
	                        		<p class="text-left mb-0 mt-0 pull-left">{{$line['name']}}  
			                        	@if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif @if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
			                        	@if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
			                        	@if(!empty($line['product_description']))
			                        		<br>
			                            	<span class="f-8">
			                            		{!!$line['product_description']!!}
			                            	</span>
			                            @endif
										<small>
											{!!$line['serial_nos']!!}
										</small>
			                        	@if(!empty($line['sell_line_note']))
			                        	<br>
	                        			<span class="f-8">
			                        	{!!$line['sell_line_note']!!}
			                        	</span>
			                        	@endif 
			                        	@if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif 
			                        	@if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif

			                        	@if(!empty($line['variation']))
			                        		, {{$line['product_variation']}} {{$line['variation']}}
			                        	@endif
			                        	@if(!empty($line['warranty_name']))
			                            	, 
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
				                            	1 {{$line['units']}} = {{$line['base_unit_multiplier']}} {{$line['base_unit_name']}} <br> {{$line['quantity']}} x {{$line['base_unit_multiplier']}} = {{$line['orig_quantity']}} {{$line['base_unit_name']}} <br>
                            					{{$line['base_unit_price']}} x {{$line['orig_quantity']}} = {{$line['line_total']}}
				                            </small>
				                            @endif
	                        		</p>
	                        	</div> 

                        	@php
                           $mrp = is_numeric(str_replace(',', '', $line['mrp'])) ? (float)str_replace(',', '', $line['mrp']) : 0;
                            $unit_price = is_numeric(str_replace(',', '', $line['unit_price'])) ? (float)str_replace(',', '', $line['unit_price']) : 0;
                            
                            $savedval += ($mrp != 0) ? ($mrp - $unit_price) : 0;


							@endphp

	                        	<div style="display:flex; width: 100%;">
	                        		<p class="text-left quantity m-0 bw" style="direction: ltr;width: 100%;">&nbsp;&nbsp;&nbsp;
										<span class="pull-lefts">
											<small>{{$line['quantity']}} 
											@if(empty($receipt_details->hide_price))
											x {{$line['unit_price_inc_tax']}}
											
											@if(!empty($line['total_line_discount']) && $line['total_line_discount'] != 0)
												- {{$line['total_line_discount']}}
											@endif
											@endif
											</small>
										</span>

										<span class="pull-right" >
											@if(empty($receipt_details->hide_price))
											<span class="text-right price m-0 bw">{{$line['line_total']}}</span>
											@endif
										</span>
	                        		</p> 
	                        		
	                        	</div>

								
								
	                        </td>
							<!-- <td>
								@if(empty($receipt_details->hide_price))
	                        		<p class="text-right price m-0 bw">{{$line['line_total']}}</p>
	                        		@endif
							</td> -->
	                    </tr>
	                    @if(!empty($line['modifiers']))
							@foreach($line['modifiers'] as $modifier)
								<tr style="border-bottom:0.1px dashed #ccc !important;" >
									<td>										
										<div style="display:flex;">
											<p style="width: 5px;" class="m-0"></p>
	                        				<p class="text-left width-60 m-0" style="margin:0;">
												<small>{{$modifier['name']}} 
	                        					@if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
			                            		@if(!empty($modifier['sell_line_note']))({!!$modifier['sell_line_note']!!}) @endif
												</small>
												
												<small>{{$modifier['variation']}}</small> 
											</p>

											<p class="width-40 quantity">
												<small class="pull-left">{{$modifier['quantity']}}
	                        					@if(empty($receipt_details->hide_price))
	                        					x {{$modifier['unit_price_inc_tax']}}
	                        					@endif
												</small>
												<small class="pull-right text-right price">{{$modifier['line_total']}}</small> 
	                        				</p>
	                        				<!-- <p class="text-left width-40 m-0">
												<small>{{$modifier['variation']}}</small> 
	                        				</p> -->
	                        			</div>	
	                        			<!-- <div style="display:flex;">
	                        				<p style="width: 15px;"></p>
	                        				<p class="text-left width-50 quantity">
												<small>{{$modifier['quantity']}}
	                        					@if(empty($receipt_details->hide_price))
	                        					x {{$modifier['unit_price_inc_tax']}}
	                        					@endif
												</small> 
	                        				</p>
	                        				<p class="text-right width-50 price">
											<small>{{$modifier['line_total']}}</small> 
	                        				</p>
	                        			</div>		 -->
										                            
			                        </td>
			                    </tr>
							@endforeach
						@endif
                    @endforeach
                </tbody>
            </table>
			<div class="border-bottom width-100"> </div>
            @if(!empty($receipt_details->total_quantity_label))
				<div class="flex-box">
					<div class="width-50 text-left">
						{!! $receipt_details->total_quantity_label !!}:
					</div>
					<div class="width-50 text-right">
						{{$receipt_details->total_quantity}}
					</div>
				</div>
			@endif
			@if(!empty($receipt_details->total_items_label))
				<div class="flex-box">
					<div class="width-50 text-left">
						{!! $receipt_details->total_items_label !!}:
					</div>
					<div class="width-50 text-right">
						{{$receipt_details->total_items}}
					</div>
				</div>
			@endif
			@if(empty($receipt_details->hide_price))
            <div class="flex-box">
                <div class="width-50 text-left">
                	<span>{!! $receipt_details->subtotal_label !!}</span>
                </div>
                <div class="width-50 text-right">
                	<span>{{$receipt_details->subtotal}}</span>
                </div>
            </div>

            <!-- Shipping Charges -->
			@if(!empty($receipt_details->shipping_charges))
				<div class="flex-box">
					<div class="width-50 text-left">
						{!! $receipt_details->shipping_charges_label !!}:
					</div>
					<div class="width-50 text-right">
						{{$receipt_details->shipping_charges}}
					</div>
				</div>
			@endif

			@if(!empty($receipt_details->packing_charge))
				<div class="flex-box">
					<div class="width-50 text-left">
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
					<div class="width-50 text-left">
						{!! $receipt_details->discount_label !!}:
					</div>

					<div class="width-50 text-right">
						(-) {{$receipt_details->discount}}
					</div>
				</div>
			@endif
			
			@if( !empty($receipt_details->total_line_discount) )
				<div class="flex-box">
					<div class="width-50 text-left">
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
						<div class="width-50 text-left">
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
					<div class="width-50 text-left">
						{!! $receipt_details->reward_point_label !!}:
					</div>

					<div class="width-50 text-right">
						(-) {{$receipt_details->reward_point_amount}}
					</div>
				</div>
			@endif

			@if( !empty($receipt_details->tax) )
				<div class="flex-box">
					<div class="width-50 text-left">
						{!! $receipt_details->tax_label !!}
					</div>
					<div class="width-50 text-right">
						(+) {{$receipt_details->tax}}
					</div>
				</div>
			@endif

			@if( $receipt_details->round_off_amount > 0)
				<div class="flex-box">
					<div class="width-50 text-left">
						{!! $receipt_details->round_off_label !!}
					</div>
					<div class="width-50 text-right">
						{{$receipt_details->round_off}}
					</div>
				</div>
			@endif

			<div class="flex-box">
				<div class="width-50 text-left">
					<span class="tbold">{!! $receipt_details->total_label !!}</span>
				</div>
				<div class="width-50 text-right">
					<span class="tbold">{{$receipt_details->total}}</span>
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
						<!-- <p class="width-50 text-left">{{$payment['method']}} ({{$payment['date']}}) </p> -->
						<div class="width-50 text-left">{{$payment['method']}} ({{$payment['date']}}): </div>
						<div class="width-50 text-right">{{$payment['amount']}}</div>
					</div>
				@endforeach
			@endif
            <!-- Total Paid-->
				@if(!empty($receipt_details->total_paid))
					<div class="flex-box">
						<div class="width-50 text-left">
							{!! $receipt_details->total_paid_label !!}:
						</div>
						<div class="width-50 text-right">
							{{$receipt_details->total_paid}}
						</div>
					</div>
				@endif
							@if(!empty($receipt_details->show_opening_bal) && $receipt_details->openbal_due != 0)
					<div class="flex-box">
						<div class="width-50 text-left">
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
						<div class="width-50 text-left">
							{!! $receipt_details->total_due_label !!}:
						</div>
						<div class="width-50 text-right">
							{{$receipt_details->total_due}} 
						</div>
					</div>
				@endif

				@if(!empty($receipt_details->all_due))
					<div class="flex-box">
						<div class="width-50 text-left">
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

            @if(!empty($receipt_details->additional_notes))
	            <p class="centered" >
	            	{!! nl2br($receipt_details->additional_notes) !!}
	            </p>
            @endif

            {{-- Barcode --}}
			@if($receipt_details->show_barcode)
				<br/>
				<img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
			@endif
			
			  @if($receipt_details->show_signature)
                    @if(!empty($receipt_details->signature_image))
                        <img style="max-height: 100px; width: auto;" src="{{$receipt_details->signature_image}}" class="img img-responsive center-block">
                    @endif
                @endif

			@if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
				<img class="center-block mt-5" src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE')}}">
			@endif

			@if(!empty($receipt_details->footer_text))
				<div class="centered">
					{!! $receipt_details->footer_text !!}
				</div>
			@endif
			<div class="border-bottom width-100"> </div>
			<div class="center-block mt-0 mb-12"><i>Powered by - Namma Billing</i></div>
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
		word-break: break-all;
		-webkit-print-color-adjust: exact;
	}
	.f-8 {
		font-size: 8px !important;
	}

.headings{
	font-size: 16px;
	font-weight: 600;
	text-transform: uppercase;
}
.tbold{
	font-weight:600;
	font-size:16px;
}
.sub-headings{
	font-size: 15px;
	font-weight: 500;
}

.border-top{
    border-top: .1px dashed #242424;
}
.border-bottom{
	border-bottom: 0.1px dashed #242424;
	/* border-bottom-style: dashed;
    border-width: 0.1px; */
}

.border-bottom-dotted{
	border-bottom: .1px dotted darkgray;
}

td.serial_number, th.serial_number{
	width: 5%;
    max-width: 5%;
}

td.description,
th.description {
    width: 35%;
    max-width: 35%;
}

td.quantity,
th.quantity {
    width: 15%;
    max-width: 15%;
    word-break: break-all;
}
td.unit_price, th.unit_price{
	width: 25%;
    max-width: 25%;
    word-break: break-all;
}

td.price,
th.price {
    width: 20%;
    max-width: 20%;
    word-break: break-all;
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
	padding-top: 8px;
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
.m-0 {
	margin:0;
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
	word-break: break-word;
}

.bw {
	word-break: break-word;
}
.bb-lg {
	border-bottom: .1px solid lightgray;
}
</style>