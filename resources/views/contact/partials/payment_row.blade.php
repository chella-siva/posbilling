<tr>
    @if(empty($payment->parent_id))
    <td @if($count_child_payments > 0) rowspan="{{$count_child_payments + 1}}" style="vertical-align:middle;" @endif>
        {{@format_datetime($payment->paid_on)}}
    </td>
    @endif
    <td @if($count_child_payments > 0) class="bg-gray" @endif>
        {{$payment->payment_ref_no}}
        @if(!empty($parent_payment_ref_no))
            <br>@lang('lang_v1.parent_payment'): {{$parent_payment_ref_no}}
        @endif
    </td>
    <td @if($count_child_payments > 0) class="bg-gray" @endif>
        <span class="display_currency paid-amount" data-orig-value=" {{$payment->amount}}" data-currency_symbol ="true">{{$payment->amount}}</span>
    </td>
    <td @if($count_child_payments > 0) class="bg-gray" @endif>
        @php
            $method = !empty($payment_types[$payment->method]) ? $payment_types[$payment->method] : '';
            if ($payment->method == 'cheque') {
                $method .= '<br>(' . __('lang_v1.cheque_no') . ': ' . $payment->cheque_number . ')';
            } elseif ($payment->method == 'card') {
                $method .= '<br>(' . __('lang_v1.card_transaction_no') . ': ' . $payment->card_transaction_number . ')';
            } elseif ($payment->method == 'bank_transfer') {
                $method .= '<br>(' . __('lang_v1.bank_account_no') . ': ' . $payment->bank_account_number . ')';
            } elseif ($payment->method == 'custom_pay_1') {
                $method .= '<br>(' . __('lang_v1.transaction_no') . ': ' . $payment->transaction_no . ')';
            } elseif ($payment->method == 'custom_pay_2') {
                $method .= '<br>(' . __('lang_v1.transaction_no') . ': ' . $payment->transaction_no . ')';
            } elseif ($payment->method == 'custom_pay_3') {
                $method .= '<br>(' . __('lang_v1.transaction_no') . ': ' . $payment->transaction_no . ')';
            }
            if ($payment->is_return == 1) {
                $method .= '<br><small>(' . __('lang_v1.change_return') . ')</small>';
            }
        @endphp
        {!! $method ?? '' !!}
    </td>
    <td @if($count_child_payments > 0) class="bg-gray" @endif>
        @php
            $transaction_type = $payment->transaction->type ?? $payment->transaction_type;
            $transaction_id = $payment->transaction->id ?? $payment->transaction_id;
            $invoice_no = $payment->transaction->invoice_no ?? $payment->invoice_no;
            $return_parent_id = $payment->transaction->return_parent_id ?? $payment->return_parent_id;
            $ref_no = $payment->transaction->ref_no ?? $payment->ref_no;
        @endphp
        @if($transaction_type == 'sell')
            <a data-href="{{action([\App\Http\Controllers\SellController::class, 'show'], [$transaction_id])}}" href="#" data-container=".view_modal" class="btn-modal">{{$invoice_no}}</a> <br> <small>({{__('sale.sale')}}) </small>

        @elseif($transaction_type == 'sell_return')
            <a data-href="{{action([\App\Http\Controllers\SellReturnController::class, 'show'], [$return_parent_id])}}" href="#" data-container=".view_modal" class="btn-modal">{{$invoice_no }}</a> <br> <small>({{__('lang_v1.sell_return')}}) </small>
        @elseif($transaction_type == 'purchase_return')
            <a data-href="{{action([\App\Http\Controllers\PurchaseReturnController::class, 'show'], [$return_parent_id])}}" href="#" data-container=".view_modal" class="btn-modal">{{$ref_no}}</a> <br> <small>({{__('lang_v1.purchase_return')}}) </small>
        @elseif ($transaction_type == 'purchase')
            <a data-href="{{action([\App\Http\Controllers\PurchaseController::class, 'show'], [$transaction_id])}}" href="#" data-container=".view_modal" class="btn-modal">{{$ref_no}}</a> <br> <small>({{__('lang_v1.purchase')}}) </small>
        @else 
            @if(!empty($transaction_id))
                {{$ref_no}} <br> <small>({{__('lang_v1.' . $transaction_type)}}) </small>
            @endif
        @endif
    </td>
    <td @if($count_child_payments > 0) class="bg-gray" @endif>
        <button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline  tw-dw-btn-primary btn-modal" data-href="{{action([\App\Http\Controllers\TransactionPaymentController::class, 'viewPayment'], [$payment->id])}}" data-container=".view_modal"><i class="fas fa-eye"></i>{{__('messages.view')}}</button>

        @if($transaction_type == 'sell')
            <a href="#" class="print-invoice tw-dw-btn tw-dw-btn-primary tw-text-white" data-href="{{route('sell.printposbillInvoice', [$transaction_id,$payment->id])}}"><i class="fa fa-print" aria-hidden="true"></i> @lang("messages.print")</a>
        @elseif($transaction_type == 'sell_return')
            <a href="#" class="print-invoice tw-dw-btn tw-dw-btn-primary tw-text-white" data-href="{{route('sell.printposbillInvoice', [$return_parent_id,$payment->id])}}"><i class="fa fa-print" aria-hidden="true"></i> @lang("messages.print")</a>
        @elseif($transaction_type == 'purchase_return')
            <a href="#" class="print-invoice tw-dw-btn tw-dw-btn-primary tw-text-white" data-href="{{route('sell.printposbillInvoice', [$return_parent_id,$payment->id])}}"><i class="fa fa-print" aria-hidden="true"></i> @lang("messages.print")</a>
        @elseif ($transaction_type == 'purchase')
            <a href="#" class="print-invoice tw-dw-btn tw-dw-btn-primary tw-text-white" data-href="{{route('sell.printposbillInvoice', [$transaction_id,$payment->id])}}"><i class="fa fa-print" aria-hidden="true"></i> @lang("messages.print")</a>
        @endif
        
        @if(!empty($transaction_id))
            @if(( in_array($transaction_type, ['purchase', 'purchase_return']) && auth()->user()->can('edit_purchase_payment')) || (in_array($transaction_type, ['sell', 'sell_return']) && auth()->user()->can('edit_sell_payment')) )
                <button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline  tw-dw-btn-info btn-modal" data-href="{{action([\App\Http\Controllers\TransactionPaymentController::class, 'edit'], [$payment->id])}}" data-container=".view_modal"><i class="fas fa-edit"></i> {{__('messages.edit')}}</button>
             @endif
        @endif

        @if((in_array($transaction_type, ['purchase', 'purchase_return']) && auth()->user()->can('delete_purchase_payment')) || (in_array($transaction_type, ['sell', 'sell_return']) && auth()->user()->can('delete_sell_payment')) || ((empty($transaction_type)|| $transaction_type=='opening_balance') && (auth()->user()->can('customer.create') || auth()->user()->can('customer.update') || auth()->user()->can('supplier.create') || auth()->user()->can('supplier.update') ) ))
            <button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline  tw-dw-btn-error delete_payment" data-href="{{action([\App\Http\Controllers\TransactionPaymentController::class, 'destroy'], [$payment->id])}}" > <i class="fas fa-trash"></i>{{__('messages.delete')}}</button>
        @endif
    </td>
</tr>