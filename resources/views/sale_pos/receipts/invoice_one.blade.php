
<style type="text/css">
         /* @page {
            margin: 0
         }

         html {
            margin: 0
         } */
		
         body {
            padding: 1px;
            margin: 0;
            -webkit-print-color-adjust: exact;
         } 
 
      
 

        * {
            margin: 0;
            /* padding: 0; */
            text-indent: 0;
        } 
        .s1 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 15pt;
        }

        h1 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12.5pt;
        }

        .p, p, p small {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9.5pt;
            margin: 5px 0px 0px 0px !important;
            /* display: inline-block; */
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: normal;
            line-break: strict;
            hyphens: none;
            -webkit-hyphens: none;
            -moz-hyphens: none;
        }

        h2 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 9.5pt;
        }
 
        .s2 {
            color: #413BD4;
            font-family: Arial, sans-serif;
            font-style: italic;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        .s3 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 9pt;
        }

        .s4 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        .s5 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
            margin-bottom:0px;
        }

        .s6 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 10pt;
            margin-bottom:0px;
        }

        .s7 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 8pt;
        }

        .s8 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 8pt;
        }

        .s9 {
            color: #413BD4;
            font-family: Arial, sans-serif;
            font-style: italic;
            font-weight: normal;
            text-decoration: none;
            font-size: 8pt;
        }

        table,
        tbody {
            vertical-align: top;
            overflow: visible;
        }
        .clear_both{
            clear: both;
        }
    </style>

    <table class="table mb-0 clear_both" style="border-collapse:collapse;margin:0 auto;padding:0;" cellspacing="0">
		<tr style=" ">
            <!-- Logo -->
			@if(empty($receipt_details->letter_head))
            <td style="width:25%;padding:5px 5px 5px 5px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67;" colspan="4">  
				
					@if(!empty($receipt_details->logo))
						<img style="max-height: 120px; width: auto;" src="{{$receipt_details->logo}}" class="img img-responsive center-block">
					@endif

            </td>
            <td  class="width-50 word-wrap" style="padding:0px 5px 2px 5px;width:50%;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67;" colspan="6">
                 <h2 class="text-left">
					<!-- Shop & Location Name  -->
					@if(!empty($receipt_details->display_name))
						<!-- {{$receipt_details->display_name}} -->
						<b>{{$receipt_details->display_name}}</b>
					@endif
				</h2>

				<!-- Address -->
				<p>
				@if(!empty($receipt_details->address))
						<small class="text-left">
						{!! $receipt_details->address !!}
						</small>
				@endif
				@if(!empty($receipt_details->contact))
					<br/>{!! $receipt_details->contact !!}
				@endif	
				@if(!empty($receipt_details->contact) && !empty($receipt_details->website))
					, 
				@endif
				@if($receipt_details->show_website == 1)
    				@if(!empty($receipt_details->website))
    					{{ $receipt_details->website }}
    				@endif
    			@endif
				
				@if(!empty($receipt_details->location_custom_fields))
					<br>{{ $receipt_details->location_custom_fields }}
				@endif
				</p>
				<p>
				@if(!empty($receipt_details->sub_heading_line1))
					{{ $receipt_details->sub_heading_line1 }}
				@endif
				@if(!empty($receipt_details->sub_heading_line2))
					<br>{{ $receipt_details->sub_heading_line2 }}
				@endif
				@if(!empty($receipt_details->sub_heading_line3))
					<br>{{ $receipt_details->sub_heading_line3 }}
				@endif
				@if(!empty($receipt_details->sub_heading_line4))
					<br>{{ $receipt_details->sub_heading_line4 }}
				@endif		
				@if(!empty($receipt_details->sub_heading_line5))
					<br>{{ $receipt_details->sub_heading_line5 }}
				@endif
				</p>
				<p>
				@if(!empty($receipt_details->tax_info1))
					<b>{{ $receipt_details->tax_label1 }}</b> {{ $receipt_details->tax_info1 }}
				@endif

				@if(!empty($receipt_details->tax_info2))
					<b>{{ $receipt_details->tax_label2 }}</b> {{ $receipt_details->tax_info2 }}
				@endif
				</p>
			@endif
            </td>

            @if($receipt_details->show_barcode || $receipt_details->show_qr_code)
			<td class="@if(!empty($receipt_details->footer_text))  @else col-xs-12 @endif text-center" style="padding:5px 5px 5px 5px;width:25%;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67;" colspan="6">
                @if($receipt_details->show_barcode)
                    {{-- Barcode --}}
                    <img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
                @endif
                
                @if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
                    <img class="center-block" src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}">
                @endif 
            </td>
            @endif
        </tr>

        @if(!empty($receipt_details->letter_head))
        <tr>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <img style="width: 100%;margin-bottom: 10px;" src="{{$receipt_details->letter_head}}">
                </div>
            </div>            
        </tr>			
		@endif
        
        <!-- Header text -->
        @if(!empty($receipt_details->header_text))
        <tr>
			<td style="padding:0px 2px 0px 2px;width:25%;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67;"
			colspan="100%">                
                <div class="col-xs-12 text-center">
                    {!! $receipt_details->header_text !!}
                </div>                
            </td>
		</tr>
        @endif
        
        <!-- Title of receipt -->
        @if(!empty($receipt_details->invoice_heading))
		<tr>
			<td style="padding:0px 2px 0px 2px;width:25%;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67;"
			colspan="100%">                
                <h4 class="text-center">{!! $receipt_details->invoice_heading !!}</h4>                
            </td>
		</tr>
        @endif

	</table>
 
    <table class="table mb-0 clear_both" style="border-collapse:collapse;margin:0 auto;padding:0; " cellspacing="0">
        <tr style=" ">
				<td style="padding:2px 2px 5px 4px;vertical-align: top;width:50%;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67"
					colspan="4"> 
					<p class="s2" style="color:#0070C0!important;font-style:italic;text-align: left;">Bill To:</p>
					<p class="s3" style="text-align: left;">
                        <b>{{ $receipt_details->customer_label }}:</b>
						<span class="s4">
							@if(!empty($receipt_details->customer_info))
								{!! $receipt_details->customer_info !!} 
							@endif
						</span>  
					@if(!empty($receipt_details->client_id_label)) 
                     <br><b>{{ $receipt_details->client_id_label }}:</b> <span class="s5">{{ $receipt_details->client_id }}</span>
					@endif 
					@if(!empty($receipt_details->customer_tax_label)) 
                    <br><b>{{ $receipt_details->customer_tax_label }}:</b> <span class="s5">{{ $receipt_details->customer_tax_number }}</span>
					@endif 
					@if(!empty($receipt_details->customer_custom_fields))
                    <br>{!! $receipt_details->customer_custom_fields !!}
					@endif</p> 
				</td>

				<td style="padding:2px 2px 5px 4px;vertical-align: top;width:50%;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67;"
					colspan="6">
					<p class="s2" style="color:#0070C0!important;font-style:italic;text-align: left;">Invoice Details:</p> 
                
                    <p class="text-left" style="font-size:16px; font-weight:500;">
                        @if(!empty($receipt_details->invoice_no_prefix))
                            <span class="pull-left" >{!! $receipt_details->invoice_no_prefix !!}:&nbsp; </span>
                        @endif
                        <span style="font-size:16px; font-weight:700;">{{$receipt_details->invoice_no}}</span>
                    </p>

					<p class="s3" style="text-align: left;">
						<b>{{$receipt_details->date_label}}:</b>
						<span class="s5"> {{$receipt_details->invoice_date}}</span> 
						@if(!empty($receipt_details->due_date_label))
                        <br><b>{{$receipt_details->due_date_label}}:</b> <span class="s5">{{$receipt_details->due_date ?? ''}}</span>
						@endif 
						@if(!empty($receipt_details->sales_person_label)) 
                        <br><b>{{ $receipt_details->sales_person_label }}:</b> <span class="s5">{{ $receipt_details->sales_person }}</span>
						@endif 
						@if(!empty($receipt_details->commission_agent_label)) 
                        <br><strong>{{ $receipt_details->commission_agent_label }}:</strong> <span class="s5">{{ $receipt_details->commission_agent }}</span>
						@endif 
						@if(!empty($receipt_details->customer_rp_label)) 
                        <br><strong>{{ $receipt_details->customer_rp_label }}: </strong> <span class="s5">{{ $receipt_details->customer_total_rp }}</span> 
						@endif
					</p>   

				</td>
			</tr>

        <tr style="margin-bottom:10px">
            <td style="padding:2px 2px 5px 4px;vertical-align: top;width:50%;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67;" colspan="4">
                <p class="s2" style="color:#0070C0!important;font-style:italic;text-align: left;">Ship To:</p>
                <p class="word-wrap" style="text-align: left;"> 
                    {!! $receipt_details->shipping_address !!}
                    @if(!empty($receipt_details->shipping_custom_field_1_label))
                        <br><strong>{!!$receipt_details->shipping_custom_field_1_label!!}:</strong> {!!$receipt_details->shipping_custom_field_1_value ?? ''!!}
                    @endif

                    @if(!empty($receipt_details->shipping_custom_field_2_label))
                        <br><strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_2_value ?? ''!!}
                    @endif

                    @if(!empty($receipt_details->shipping_custom_field_3_label))
                        <br><strong>{!!$receipt_details->shipping_custom_field_3_label!!}:</strong> {!!$receipt_details->shipping_custom_field_3_value ?? ''!!}
                    @endif

                    @if(!empty($receipt_details->shipping_custom_field_4_label))
                        <br><strong>{!!$receipt_details->shipping_custom_field_4_label!!}:</strong> {!!$receipt_details->shipping_custom_field_4_value ?? ''!!}
                    @endif

                    @if(!empty($receipt_details->shipping_custom_field_5_label))
                        <br><strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_5_value ?? ''!!}
                    @endif
                </p>

            </td>
            <td style="padding:2px 2px 5px 4px;vertical-align: top;width:50%;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67;" colspan="6">
                <p class="s2" style="color:#0070C0!important;font-style:italic;text-align: left;">Bank Details:</p>
                <p class="s4" style="text-align: left;">
                    {!! $receipt_details->bank_details !!} 
                    <!--Name: NammaBilling Private Limited <br>-->
                    <!--Bank: Yes Bank<br>-->
                    <!--IFSC: YESB0000658<br>-->
                    <!--Branch: AVENUE ROAD<br>-->
                    <!--Account No: 065333300001234-->
                </p>
            </td>
        </tr>

	</table>
    
    <div class="row" style="color: #000000 !important;">
	<div class="col-xs-12">
		<!-- <br/> -->
		@php
			$p_width = 45;
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
		<table class="table" style="border-collapse:collapse;margin:0 auto;padding:0;" cellspacing="0">            
            <tr style="height:24px;" class="text-center">
                <td style="width:33%;background-color:#f3f3f3!important;padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="4">
                    <p style="text-align: center;">Original - Buyer</p>
                </td>
                <td style="background-color:#f3f3f3!important;padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="4">
                    <p style="text-align: center;">Duplicate -  Supplier</p>
                </td>
                <td style="background-color:#f3f3f3!important;padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="3">
                    <p style="text-align: center;">Trplicate - Transporter</p>
                </td>
            </tr> 
        </table>
            
        <table class="mb-5" style="border-collapse:collapse;margin:0 auto;padding:0;" cellspacing="0" width="100%">
			<thead>
				<tr style="background-color:#E8F3FD!important;">
                    <th class="text-left" width="4%" style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p class="s8" style="text-align: center;">#</p>
                    </th>

					<th width="{{$p_width}}%" style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p class="s8" style="text-align: center;">{{$receipt_details->table_product_label}}</p>
                    </th>
                    
                    @if($receipt_details->show_cat_code == 1)
					<th class="text-right" width="8%" style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p class="s8" style="text-align: center;">{{$receipt_details->cat_code_label}}</p>
                    </th>
                    @endif

                    <th class="text-right" width="8%" style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p class="s8" style="text-align: center;">{{$receipt_details->table_unit_price_label}}</p>
                    </th>

                    <th class="text-right" width="5%" style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p class="s8" style="text-align: center;">{{$receipt_details->table_qty_label}}</p>
                    </th>
                    @if($receipt_details->show_unit == 1)
                    <th class="text-right" width="5%" style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p class="s8" style="text-align: center;">Unit</p>
                    </th>
                    @endif
                    @if($receipt_details->show_tax == 1)
					<th class="text-right" width="8%" style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p class="s8" style="text-align: center;">Tax(%)</p>
                    </th>
                    @endif

					@if(!empty($receipt_details->discounted_unit_price_label))
						<th class="text-right" width="8%" style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                            <p class="s8" style="text-align: center;">{{$receipt_details->discounted_unit_price_label}}</p>
                        </th>
					@endif

					@if(!empty($receipt_details->item_discount_label))
						<th class="text-right" width="8%" style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                            <p class="s8" style="text-align: center;">{{$receipt_details->item_discount_label}}</p>
                        </th>
					@endif

					<th class="text-right" width="12%" style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p class="s8" style="text-align: center;">{{$receipt_details->table_subtotal_label}}</p>
                    </th>

				</tr>
			</thead>
			<tbody>
				@forelse($receipt_details->lines as $line)
					<tr style="height:24px;">
                        <td style="padding:0px 2px 0px 2px;-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                            <p class="s7" style="text-align: center;">{{$loop->iteration}}</p>
                        </td>
                        <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                            <p class="s7" style="text-align: left;">
                                @if(!empty($line['image']))
                                    <img src="{{$line['image']}}" alt="Image" width="50" style="float: left; margin-right: 8px;">
                                @endif

                                {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
                                @if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif 
                                @if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
                                @if(!empty($line['product_description']))
                                    <small>
                                        {!!$line['product_description']!!}
                                    </small>
                                @endif 

                                @if(!empty($line['sell_line_note']))
                                <br>
                                <small>
                                    {!!$line['sell_line_note']!!}
                                </small>
                                @endif 
                                
                                @if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif 
                                @if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif

                                @if(!empty($line['warranty_name'])) <br><small>{{$line['warranty_name']}} </small>@endif @if(!empty($line['warranty_exp_date'])) <small>- {{@format_date($line['warranty_exp_date'])}} </small>@endif
                                @if(!empty($line['warranty_description'])) <small> {{$line['warranty_description'] ?? ''}}</small>@endif

                                @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                                <br><small>
                                    1 {{$line['units']}} = {{$line['base_unit_multiplier']}} {{$line['base_unit_name']}} <br>
                                    {{$line['base_unit_price']}} x {{$line['orig_quantity']}} = {{$line['line_total']}}
                                </small>
                                @endif
                            </p>
                        </td>

                        @if($receipt_details->show_cat_code == 1)
                        <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                            <p class="s7" style="text-align: center;">
                                @if(!empty($line['cat_code']))
                                {{$line['cat_code']}}
                                @endif
                            </p>
                        </td>
                        @endif

                        <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                            <p class="s7" style="text-align: center;">{{$line['unit_price_inc_tax']}}</p>
                        </td>

                        <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                            <p class="s7" style="text-align: center;">
                            {{$line['quantity']}} 

                                @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                                <br><small>
                                    {{$line['quantity']}} x {{$line['base_unit_multiplier']}} = {{$line['orig_quantity']}} {{$line['base_unit_name']}}
                                </small>
                                @endif
                            </p>
                        </td>
                    @if($receipt_details->show_unit == 1)
                        <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                            <p class="s7" style="text-align: center;">{{$line['units']}} </p>
                        </td> 
                        @endif
                     @if($receipt_details->show_tax == 1)
                        <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                            <p class="s7" style="text-align: center;">
                                <!-- {{$line['tax']}}  -->
                                {{$line['tax_name']}}
                            </p>
                        </td>
                    @endif

                        @if(!empty($receipt_details->discounted_unit_price_label))
                        <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                            <p class="s7" style="text-align: right;">{{$line['unit_price_inc_tax']}} </p>
                        </td>
                        @endif 

                        @if(!empty($receipt_details->item_discount_label))
                        <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                            <p class="s7" style="text-align: right;">
                            {{$line['total_line_discount'] ?? '0.00'}}

                            @if(!empty($line['line_discount_percent']))
                                ({{$line['line_discount_percent']}}%)
                            @endif
                            </p>
                        </td>
                        @endif

                        <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                            <p class="s7" style="text-align: right;">{{$line['line_total']}}</p>
                        </td>
                    </tr>
                    
					@if(!empty($line['modifiers']))
						@foreach($line['modifiers'] as $modifier)
							<tr>
                                <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">&nbsp;</td>
								<td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                                <p class="s7" style=""> {{$modifier['name']}} {{$modifier['variation']}} 
		                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
		                            @if(!empty($modifier['sell_line_note']))({!!$modifier['sell_line_note']!!}) @endif </p>
		                        </td>
                                @if($receipt_details->show_cat_code == 1)
                                <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">&nbsp;</td>
                                 @endif
								
								<td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" class="text-right">
                                <p class="s7" style="text-align: center;">{{$modifier['unit_price_inc_tax']}}</p></td>
                                <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" class="text-right">
                                <p class="s7" style="text-align: center;">{{$modifier['quantity']}} {{$modifier['units']}}</p> </td>
                                <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">&nbsp;</td>
                                <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67"> &nbsp;</td>

								@if(!empty($receipt_details->discounted_unit_price_label))
									<td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" class="text-right">
                                    <p class="s7" style="text-align: right;">{{$modifier['unit_price_exc_tax']}}</p></td>
								@endif
								@if(!empty($receipt_details->item_discount_label))
									<td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" class="text-right">
                                    <p class="s7" style="text-align: right;">0.00</p></td>
								@endif
								<td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" class="text-right">
                                <p class="s7" style="text-align: right;">{{$modifier['line_total']}}</p></td>
							</tr>
						@endforeach
					@endif
				@empty
					<tr>
						<td colspan="4">&nbsp;</td>
						@if(!empty($receipt_details->discounted_unit_price_label))
    					<td></td>
    					@endif
    					@if(!empty($receipt_details->item_discount_label))
    					<td></td>
    					@endif
					</tr>
				@endforelse

                <tr style="height:24px;background-color:#E8F3FD!important;">
                    <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="2">
                        <p class="s8" style="text-align: right;">Total:</p>
                    </td> 
                    <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p style="text-align: left;"><br /></p>
                    </td>
                    @if($receipt_details->show_cat_code == 1)
                    <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p style="text-align: left;"><br /></p>
                    </td>
                    @endif 
                    <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p class="s8" style="text-align: center;">{{$receipt_details->total_quantity}}</p>
                    </td>
                    @if($receipt_details->show_unit == 1)
                    <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p style="text-align: left;"><br /></p>
                    </td>
                    @endif
                    @if($receipt_details->show_tax == 1)
					<td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p style="text-align: left;"><br /></p>
                    </td>
                    @endif 
                    @if(!empty($receipt_details->discounted_unit_price_label))
                    <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p class="s8" style="text-align: right;"></p>
                    </td>
                    @endif

					@if(!empty($receipt_details->item_discount_label))
                    <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p class="s8" style="text-align: right;">{{$receipt_details->total_line_discount}}</p>
                    </td>
                    @endif 
                    <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                        <p class="s8" style="text-align: right;">{{$receipt_details->subtotal}}</p>
                    </td>
                </tr>


                @php
                    $colspan = 2;
                @endphp
                @if($receipt_details->show_cat_code == 1)
                    @php
                        $colspan += 1;
                    @endphp
                @endif
                @if($receipt_details->show_unit == 1)
                    @php
                        $colspan += 1;
                    @endphp
                @endif
                @if($receipt_details->show_tax == 1)
                    @php
                        $colspan += 1;
                    @endphp
                @endif

                @if(!empty($receipt_details->discounted_unit_price_label))
                    @php
                        $colspan += 1;
                    @endphp
                @endif
                
                @if(!empty($receipt_details->item_discount_label))
                    @php
                        $colspan += 1;
                    @endphp
                @endif
                
		@if(!empty($receipt_details->total_exempt_uf))					
        <tr style="height:24px;">
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="{{$colspan}}">
                <p style="text-align: left;"><br /></p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="2">
                <p class="s7" style="text-align: right;">@lang('lang_v1.exempt')</p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                <p class="s7" style="text-align: right;">{{$receipt_details->total_exempt}}</p>
            </td>
        </tr>
		@endif

		<!-- Shipping Charges -->
		@if(!empty($receipt_details->shipping_charges)) 					
		<tr style="height:24px;">
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="{{$colspan}}">
                <p style="text-align: left;"><br /></p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="2">
                <p class="s7" style="text-align: right;">{!! $receipt_details->shipping_charges_label !!}: </p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                <p class="s7" style="text-align: right;">{{$receipt_details->shipping_charges}}</p>
            </td>
        </tr>
		@endif

		@if(!empty($receipt_details->packing_charge)) 
		<tr style="height:24px;">
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="{{$colspan}}">
                <p style="text-align: left;"><br /></p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="2">
                <p class="s7" style="text-align: right;">{!! $receipt_details->packing_charge_label !!}: </p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                <p class="s7" style="text-align: right;">{{$receipt_details->packing_charge}} </p>
            </td>
        </tr>
		@endif


		<!-- Discount -->
		@if( !empty($receipt_details->discount) ) 
		<tr style="height:24px;">
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="{{$colspan}}">
                <p style="text-align: left;"><br /></p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="2">
                <p class="s7" style="text-align: right;">{!! $receipt_details->discount_label !!} </p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                <p class="s7" style="text-align: right;">(-) {{$receipt_details->discount}} </p>
            </td>
        </tr>
		@endif

		@if( !empty($receipt_details->total_line_discount) ) 
		<tr style="height:24px;">
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="{{$colspan}}">
                <p style="text-align: left;"><br /></p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="2">
                <p class="s7" style="text-align: right;">{!! $receipt_details->line_discount_label !!}: </p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                <p class="s7" style="text-align: right;">(-) {{$receipt_details->total_line_discount}} </p>
            </td>
        </tr>
		@endif

		@if( !empty($receipt_details->additional_expenses) )
		@foreach($receipt_details->additional_expenses as $key => $val)
		<tr style="height:24px;">
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="{{$colspan}}">
                <p style="text-align: left;"><br /></p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="2">
                <p class="s7" style="text-align: right;">{{$key}}:
                </p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                <p class="s7" style="text-align: right;">(+) {{$val}}
                </p>
            </td>
		</tr> 
			@endforeach
		@endif


		@if( !empty($receipt_details->reward_point_label) ) 
        <tr style="height:24px;">
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="{{$colspan}}">
                <p style="text-align: left;"><br /></p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="2">
                <p class="s7" style="text-align: right;">{!! $receipt_details->reward_point_label !!}:</p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                <p class="s7" style="text-align: right;">(-) {{$receipt_details->reward_point_amount}}</p>
            </td>
        </tr>
		@endif

		<!-- Tax -->
		@if( !empty($receipt_details->tax) )
        <tr style="height:24px;">
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="{{$colspan}}">
                <p style="text-align: left;"><br /></p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="2">
                <p class="s7" style="text-align: right;">{!! $receipt_details->tax_label !!}</p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                <p class="s7" style="text-align: right;">(+) {{$receipt_details->tax}}</p>
            </td>
        </tr>
		@endif

		@if( $receipt_details->round_off_amount > 0)
        <tr >
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="{{$colspan}}">
                <p style="text-align: left;"><br /></p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="2">
                <p class="s7" style="text-align: right;">{!! $receipt_details->round_off_label !!}</p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67">
                <p class="s7" style="text-align: right;">{{$receipt_details->round_off}}</p>
            </td>
        </tr> 
		@endif 

        <tr style="height:24px;background-color:#E8F3FD!important;">
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="{{$colspan}}" bgcolor="#E1EDFF">
                <p class="s8" style="text-align: left;">
                    Amount in Words:
                    <span class="s7"> 
                            @if(!empty($receipt_details->total_in_words)) 
								{{$receipt_details->total_in_words}}
							@endif                            
                    </span>
                </p>
            </td>


            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="2" bgcolor="#E1EDFF">
                <p class="s8" style="text-align: right;">{!! $receipt_details->total_label !!}</p>
            </td>
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" bgcolor="#E1EDFF">
                <p class="s8" style="text-align: right;">{{$receipt_details->total}}</p>
            </td>
        </tr>

        <tr style="height:24px;">
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="10">
                <p class="s8" style="text-align: left;">
                    Note:<span class="s7">
                    @if(!empty($receipt_details->additional_notes)) 
                            <span>{!! nl2br($receipt_details->additional_notes) !!}</span>
                    @endif

                    </span>
                </p>
            </td>
        </tr>

        @if(empty($receipt_details->hide_price) && !empty($receipt_details->tax_summary_label) )
        <!-- tax -->
        @if(!empty($receipt_details->taxes))

        <tr style="height:24px;background-color:#E8F3FD!important;">
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="10">
                <p class="s8" style="text-align: center;"> {{$receipt_details->tax_summary_label}}</span>
                </p>
            </td>
        </tr>
       
        @foreach($receipt_details->taxes as $key => $val)

        <tr style="height:24px">
            <td style="padding:0px 2px 0px 2px;vertical-align: top;width:50%;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67;" colspan="{{$colspan}}"> 
                <p class="word-wrap" style="text-align: right;">{{$key}}</p>

            </td>
            <td style="padding:0px 2px 0px 2px;vertical-align: top;width:50%;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0pt;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67;" colspan="5"> 
                <p class="s4" style="text-align: right;">{{$val}}</p>
            </td>
        </tr> 
        @endforeach
                 
        @endif
        @endif 
        
        <tr style="height:90pt">
            
            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67" colspan="{{$colspan}}">
                <p class="s8" style="text-align: left;">
					@if(!empty($receipt_details->footer_text))					 
						<span  class="s7">{!! $receipt_details->footer_text !!} </span>
					@endif
				</p>
            </td>

            <td style="padding:0px 2px 0px 2px;border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67;position: relative;height:130px;min-width:200px;" colspan="3">
                <p class="s9" style="color:#413bd4 !important;font-style:italic;text-align: center;width: 100%;">For {{$receipt_details->display_name}}</p> 
                <div style="margin:0 auto;text-align: center;"> 

                        @if(!empty($receipt_details->signature_image))
						<img style="max-height: 100px; width: auto;" src="{{$receipt_details->signature_image}}" class="img img-responsive center-block">
				    	@endif
                    <!-- <img src="https://app.nammabilling.com/uploads/signature/marcos2.jpg" width="70%" height="auto" style="margin:0 auto;text-align: center;"> -->
                </div> 
                <p class="s9" style="position: absolute;bottom: 0%;left: 50%;transform: translate(-50%, -20%);text-align: center;width: 100%;">@lang('lang_v1.authorized_signatory')</p>
            </td>
        </tr>
        
        <!-- <tr style="height:13pt">
            <td style="border-top-style:solid;border-top-width:0.5px;border-top-color:#113F67;border-left-style:solid;border-left-width:0.5px;border-left-color:#113F67;border-bottom-style:solid;border-bottom-width:0.5px;border-bottom-color:#113F67;border-right-style:solid;border-right-width:0.5px;border-right-color:#113F67"
                colspan="10">
                <p class="s7"
                    style="padding-top: 1pt;padding-left: 2pt;padding-right: 3pt;text-align: center;">
                    @if(!empty($receipt_details->footer_text))					 
						{!! $receipt_details->footer_text !!} 
					@endif
                </p>
            </td>
        </tr> -->

			</tbody>
		</table>
	</div>
</div>


<style>
    ol, ul { 
    padding-left: 15px;
}
		* {
			/* font-size: 12px; */
			/* font-family: 'Times New Roman'; */ 
			/* word-break: break-all; */
            word-wrap: break-word;
		}
		.table>tbody>tr>td {
			border: 1px solid #d7d7d7;
			padding: .2rem;
			color: #222539;
			font-weight: 400;
		}

		.table>tbody>tr>td, .table>thead>tr>th {
			/* white-space: nowrap; */
			vertical-align: middle;
			font-size: 14px;
		}
		.table>thead>tr>th {
    font-weight: 600 !important;
    padding: .2rem;
    border: 1px solid #ccc !important;
    background: #ccc !important; 
    color: #000;
}
	
</style>