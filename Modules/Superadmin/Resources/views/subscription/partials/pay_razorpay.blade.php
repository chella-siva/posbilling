<div class="col-md-12">

	<form action="{{action([\Modules\Superadmin\Http\Controllers\SubscriptionController::class, 'confirm'], [$package->id])}}" method="POST">
		<!-- Note that the amount is in paise -->
		@php 
		 	$baseAmount = $package->price;
			$gstRate = 18; 
			$gstAmount = $baseAmount * ($gstRate / 100);
			$payableamnt = ($baseAmount + $gstAmount);
		 @endphp
		<script
		    src="https://checkout.razorpay.com/v1/checkout.js"
		    data-key="{{env('RAZORPAY_KEY_ID')}}"
		    data-amount="{{$payableamnt*100}}"
		    data-buttontext="Pay with Razorpay"
		    data-name="{{env('APP_NAME')}}"
		    data-description="{{$package->name}}"
		    data-theme.color="#3c8dbc"
		></script>
		{{ csrf_field() }}
		<input type="hidden" name="gateway" value="{{$k}}">
		<input type="hidden" name="price" value="{{$payableamnt}}">
		<input type="hidden" name="coupon_code" value="{{request()->get('code') ?? null}}">
	</form>
</div>