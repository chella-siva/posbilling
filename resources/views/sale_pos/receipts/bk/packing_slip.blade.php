<table style="width:99.5%;">
    <thead>
        <tr>
            <td>
                <p class="text-right  font-30">@lang('lang_v1.packing_slip')</p>
            </td>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>
                <!-- business information here -->
				<div class="">
					
					<div class="td"> 
						<div class="wrap">
							<!-- Logo -->
							@if(!empty($receipt_details->logo))
							<div class="td"style="width:25%;vertical-align:middle;">
								
								<img style="max-height: 120px; width: auto; margin:0 auto;" src="{{$receipt_details->logo}}" class="img"> 
								
							</div>
							@endif

							<div class="td" style="width:40%">
								<!-- Shop & Location Name  -->
								@if(!empty($receipt_details->display_name))
								<p>
									<span style="font-size:16px; font-weight:600; color:black;">{{$receipt_details->display_name}}</span>
									
									@if(!empty($receipt_details->address))
									<br />{!! $receipt_details->address !!}
									@endif

									@if(!empty($receipt_details->contact))
									<br />{!! $receipt_details->contact !!}
									@endif

									@if(!empty($receipt_details->website))
									<br />{{ $receipt_details->website }}
									@endif

									@if(!empty($receipt_details->tax_info1))
									<br />{{ $receipt_details->tax_label1 }} {{ $receipt_details->tax_info1 }}
									@endif

									@if(!empty($receipt_details->tax_info2))
									<br />{{ $receipt_details->tax_label2 }} {{ $receipt_details->tax_info2 }}
									@endif

									@if(!empty($receipt_details->location_custom_fields))
									<br />{{ $receipt_details->location_custom_fields }}
									@endif
								</p>
								@endif
							</div>
							<div class="td" style="vertical-align:middle;" style="width:35%">
								<p class="text-center" style="font-size:18px; font-weight:600; color:black;">
									@if(!empty($receipt_details->invoice_no_prefix))
									<span class="" style="font-size:18px; font-weight:normal;">{!! $receipt_details->invoice_no_prefix !!}:</span>
									@endif

									<br>{{$receipt_details->invoice_no}}
								</p>
								<hr>
								<!-- Date-->
								@if(!empty($receipt_details->date_label))
								<p class="text-center" style="font-size:18px; font-weight:600; color:black;">
									<span class="" style="font-size:18px; font-weight:normal;">
										{{$receipt_details->date_label}}:
									</span>

									<br>{{$receipt_details->invoice_date}}
								</p>
								@endif
							</div>
						</div>
					</div>

					<div class="td"> 
						<div class="wrap">
							<div class="td" style="width:50%;width:5%!important;border-top-style:solid;border-top-width:0pt;border-top-color:#113F67;border-left-style:solid;border-left-width:1pt;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:1pt;border-right-color:#113F67">
								@if(!empty($receipt_details->customer_label))
								<b>{{ $receipt_details->customer_label }}:</b><br />
								@endif

								<!-- customer info -->
								<!-- @if(!empty($receipt_details->customer_name))
									{{ $receipt_details->customer_name }}:<br>
								@endif -->
								@if(!empty($receipt_details->customer_info))
								{!! $receipt_details->customer_info !!}
								@endif
								@if(!empty($receipt_details->client_id_label))
								<br />
								<strong>{{ $receipt_details->client_id_label }}:</strong> {{ $receipt_details->client_id }}
								@endif
								@if(!empty($receipt_details->customer_tax_label))
								<br />
								<strong>{{ $receipt_details->customer_tax_label }}:</strong>
								{{ $receipt_details->customer_tax_number }}
								@endif
								@if(!empty($receipt_details->customer_custom_fields))
								<br />{!! $receipt_details->customer_custom_fields !!}
								@endif
								@if(!empty($receipt_details->sales_person_label))
								<br />
								<strong>{{ $receipt_details->sales_person_label }}:</strong>
								{{ $receipt_details->sales_person }}
								@endif
							</div>
							<div class="td" style="width:5%!important;border-top-style:solid;border-top-width:0pt;border-top-color:#113F67;border-left-style:solid;border-left-width:1pt;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:1pt;border-right-color:#113F67">
								<strong style="color:#0070C0!important;font-style:italic;text-align:left;">@lang('lang_v1.shipping_address'):</strong><br> 
								
								{!! $receipt_details->shipping_address !!}
								
								@if(!empty($receipt_details->shipping_custom_field_1_label))
								<br><strong>{!!$receipt_details->shipping_custom_field_1_label!!}:</strong>
								{!!$receipt_details->shipping_custom_field_1_value ?? ''!!}
								@endif

								@if(!empty($receipt_details->shipping_custom_field_2_label))
								<br><strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong>
								{!!$receipt_details->shipping_custom_field_2_value ?? ''!!}
								@endif

								@if(!empty($receipt_details->shipping_custom_field_3_label))
								<br><strong>{!!$receipt_details->shipping_custom_field_3_label!!}:</strong>
								{!!$receipt_details->shipping_custom_field_3_value ?? ''!!}
								@endif

								@if(!empty($receipt_details->shipping_custom_field_4_label))
								<br><strong>{!!$receipt_details->shipping_custom_field_4_label!!}:</strong>
								{!!$receipt_details->shipping_custom_field_4_value ?? ''!!}
								@endif

								@if(!empty($receipt_details->shipping_custom_field_5_label))
								<br><strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong>
								{!!$receipt_details->shipping_custom_field_5_value ?? ''!!}
								@endif
							</div>
						</div>
					</div>
				</div>
 
				<div class=""> 
					<table class="mt-5 table" style="width:100%;border-top-style:solid;border-top-width:1pt;border-top-color:#113F67;border-left-style:solid;border-left-width:1pt;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:1pt;border-right-color:#113F67">
						<thead>
							<tr class="text-center" style="background-color:#E8F3FD!important;font-weight:600;">
								<td style="padding:3px 3px 3px 3px;background-color:#E8F3FD!important;width:5%!important;border-top-style:solid;border-top-width:1pt;border-top-color:#113F67;border-left-style:solid;border-left-width:1pt;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:1pt;border-right-color:#113F67">#</td>
								
								<td style="padding:3px 3px 3px 3px;background-color:#E8F3FD!important;width:65%!important;border-top-style:solid;border-top-width:1pt;border-top-color:#113F67;border-left-style:solid;border-left-width:1pt;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:1pt;border-right-color:#113F67">
									{{$receipt_details->table_product_label}}
								</td>
								
								<td style="padding:3px 3px 3px 3px;background-color:#E8F3FD!important;width:30%!important;border-top-style:solid;border-top-width:1pt;border-top-color:#113F67;border-left-style:solid;border-left-width:1pt;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:1pt;border-right-color:#113F67">
									{{$receipt_details->table_qty_label}}
								</td>

							</tr>
						</thead>
						<tbody>
							@foreach($receipt_details->lines as $line)
								<tr >
									<td class="text-center" style="padding:3px;border-top-style:solid;border-top-width:1pt;border-top-color:#113F67;border-left-style:solid;border-left-width:1pt;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:1pt;border-right-color:#113F67">
										{{$loop->iteration}}
									</td>
									<td style="padding:3px;word-break: break-all;border-top-style:solid;border-top-width:1pt;border-top-color:#113F67;border-left-style:solid;border-left-width:1pt;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:1pt;border-right-color:#113F67">
										{{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
										@if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif
										@if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
										@if(!empty($line['sell_line_note']))({!!$line['sell_line_note']!!}) @endif
										@if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif 
										@if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif 
									</td>
									<td class="text-right" style="padding:3px;border-top-style:solid;border-top-width:1pt;border-top-color:#113F67;border-left-style:solid;border-left-width:1pt;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:1pt;border-right-color:#113F67">
										{{$line['quantity']}} {{$line['units']}}
									</td>
								</tr>
								@if(!empty($line['modifiers']))
									@foreach($line['modifiers'] as $modifier)
										<tr>
											<td class="text-center" style="border-top-style:solid;border-top-width:1pt;border-top-color:#113F67;border-left-style:solid;border-left-width:1pt;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:1pt;border-right-color:#113F67">
												&nbsp;
											</td>
											<td style="border-top-style:solid;border-top-width:1pt;border-top-color:#113F67;border-left-style:solid;border-left-width:1pt;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:1pt;border-right-color:#113F67">
												{{$modifier['name']}} {{$modifier['variation']}} 
												@if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif 
												@if(!empty($modifier['sell_line_note']))({!!$modifier['sell_line_note']!!}) @endif 
											</td>
											<td class="text-right" style="border-top-style:solid;border-top-width:1pt;border-top-color:#113F67;border-left-style:solid;border-left-width:1pt;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:1pt;border-right-color:#113F67">
												{{$modifier['quantity']}} {{$modifier['units']}}
											</td>
										</tr>
									@endforeach
								@endif
							@endforeach

							@php
								$lines = count($receipt_details->lines);
							@endphp

							@for ($i = $lines; $i < 7; $i++)
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
							@endfor

						</tbody>
					</table>
				</div> 
 
				<div class="row invoice-info mb-5" style="page-break-inside: avoid !important">
					<div class="col-md-6 invoice-col width-100 mt-56" style="">
						<b class="pull-right">@lang('lang_v1.authorized_signatory')</b>
					</div>
				</div>

				{{-- Barcode --}}
				@if($receipt_details->show_barcode)
				<br>
				<div class="row mb-5">
					<div class="col-xs-12">
						<img class="center-block"
							src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
					</div>
				</div>
				@endif

				@if(!empty($receipt_details->footer_text))
				<div class="row ">
					<div class="col-xs-12">
						{!! $receipt_details->footer_text !!}
					</div>
				</div>
				@endif
 
			</td>
		</tr>
	</tbody>
</table>

<style>
	body{
		font-size: 9.5pt;
	}
.wrap {
	/* max-width:960px; */
	margin:auto;
	width:100%;
	display:table;
	/* font-size:100%; */
	border-collapse:collapse;
}
.wrap .td {
	display:table-cell;
	vertical-align:top;
	border:1px solid #113F67;
	padding:5px;
}
 
@media print { 
         body {
            padding: 0px;
            margin: 0;
            -webkit-print-color-adjust: exact;
         } 
 
      } 

</style>