@extends('layouts.guest')
@section('title', $business->name)


<style>
    /* Style for quantity input, cart icon, etc. */
    .quantity-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 120px;
    }

    .quantity-input {
        text-align: center;
        width: 40px;
        border: 1px solid #ccc;
        padding: 5px;
        margin: 0 5px;
    }
    #cart-details 
    {
    max-height: 300px; /* Adjust height as needed */
    overflow-y: auto; /* Enables vertical scrollbar */
    border: 1px solid #ccc; /* Optional: To make the cart visible */
    padding: 10px; /* Optional: For better spacing */
    }
    .btn-outline-secondary {
        width: 30px;
        height: 30px;
        padding: 0;
        font-size: 18px;
        line-height: 0;
    }

    .cart-icon {
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #ff9800;
        padding: 15px;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        z-index: 1000;
    }

    .cart-icon:hover {
        background-color: #ff5722;
    }

    .cart-count {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 5px 10px;
        font-size: 14px;
    }

    #cart-details {
        position: fixed;
        top: 60px;
        right: 20px;
        background-color: white;
        border: 1px solid #ccc;
        padding: 15px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        display: none;
        z-index: 1000;
    }

    #cart-details ul {
        list-style-type: none;
        padding: 0;
    }

    #cart-details li {
        padding: 5px 0;
    }

    #cart-details .total-price {
        font-weight: bold;
    }

    /* Style for the buttons */
    .cart-buttons {
        display: flex;
        gap: 10px; /* Space between buttons */
        margin-top: 10px;
    }

    .quantity-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 120px;
    }

    .quantity-input {
        text-align: center;
        width: 40px;
        border: 1px solid #ccc;
        padding: 5px;
        margin: 0 5px;
    }

    .btn-outline-secondary {
        width: 30px;
        height: 30px;
        padding: 0;
        font-size: 18px;
        line-height: 0;
        cursor: pointer;
    }

    #clrbtn, #checkout {
        cursor: pointer;
        padding: 10px;
        color: white;
        border: none;
        border-radius: 5px;
        width: 48%; /* Adjust the width if needed */
    }

    #clrbtn {
        background-color: #ff5722;
    }

    #clrbtn:hover {
        background-color: #e64a19;
    }

    #checkout {
        background-color: #4caf50;
    }

    #checkout:hover {
        background-color: #388e3c;
    }

</style>
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header text-center" id="top">
    <h2 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black" >{{$business->name}}</h2>
    <h4 class="mb-0 tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">{{$business_location->name}}</h4>
    <p>{!! $business_location->location_address !!}</p>
</section>
<section class="no-print">
    <div class="container">
        <!-- Static navbar -->
        <nav class="navbar-default tw-transition-all tw-duration-5000 tw-shrink-0 tw-rounded-2xl tw-m-[16px] tw-border-2 !tw-bg-white">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" style="margin-top: 3px; margin-right: 3px;">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand menu" href="#top">
                        @if(!empty($business->logo))
                            <img src="{{asset( 'uploads/business_logos/' . $business->logo)}}" alt="Logo" width="30">
                        @else
                            <i class="fas fa-boxes"></i>
                        @endif
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                    @foreach($categories as $key => $value)
                        <li><a href="#category{{$key}}" class="menu">{{$value}}</a></li>
                    @endforeach 
                        <li><a href="#category0" class="menu">Uncategorized</a></li>           
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>
    </div> <!-- /container -->
</section>
<!-- Main content -->
<section class="content pt-0">
    <div class="container">
        @foreach($products as $product_category)
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-header" id="category{{$product_category->first()->category->id ?? 0}}">{{$product_category->first()->category->name ?? 'Uncategorized'}}</h2>
                </div>
            </div>
            <div class="row eq-height-row">
            @foreach($product_category as $product)
            @php
                if($product->enable_stock == 1)
                {
                    $location_id = $business_location->id;
                    $stock = $product->variations->flatMap->variation_location_details
                    ->where('location_id', $location_id)
                    ->sum('qty_available');
                } else {
                    $stock = 100000;   
                }
            @endphp
                <div class="col-md-3 eq-height-col col-xs-12">
                    <div class="box box-solid product-box">
                        <div class="box-body">
                            <a href="#" class="show-product-details" data-href="{{action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'show'],  [$business->id, $product->id])}}?location_id={{$business_location->id}}">
                            <img src="{{$product->image_url}}" class="img-responsive catalogue"></a>

                            @php
                                $discount = $discounts->firstWhere('brand_id', $product->brand_id);
                                if(empty($discount)){
                                    $discount = $discounts->firstWhere('category_id', $product->category_id);
                                }
                            @endphp

                            @if(!empty($discount))
                                <span class="label label-warning discount-badge">- {{($discount->discount_amount)}}%</span>
                            @endif

                            @php
                                $max_price = $product->variations->max('sell_price_inc_tax');
                                $min_price = $product->variations->min('sell_price_inc_tax');
                            @endphp
                            <h2 class="catalogue-title">
                                <a href="#" class="show-product-details" data-href="{{action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'show'],  [$business->id, $product->id])}}?location_id={{$business_location->id}}">
                                    {{$product->name}}
                                </a>
                            </h2>
                            <table class="table no-border product-info-table">
                                <tr>
                                    <th class="pb-0"> @lang('lang_v1.price'):</th>
                                    <td class="pb-0">
                                        <span class="display_currency" data-currency_symbol="true">{{($max_price)}}</span> @if($max_price != $min_price) - <span class="display_currency" data-currency_symbol="true">{{($min_price)}}</span> @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="pb-0"> @lang('product.sku'):</th>
                                    <td class="pb-0">{{$product->sku}}</td>
                                </tr>
                            @if($product->type == 'variable')
                                @php
                                    $variations = $product->variations->groupBy('product_variation_id');
                                @endphp
                                @foreach($variations as $product_variation)
                                    <tr>
                                        <th>{{$product_variation->first()->product_variation->name}}:</th>
                                        <td>
                                            <select class="form-control input-sm variant-selector" data-product-id="{{$product->id}}" 
                                                onchange="updateVariationId(this)">
                                                @foreach($product_variation as $variation)
                                                    <option value="{{$variation->id}}" 
                                                        data-price="{{($variation->sell_price_inc_tax)}}"
                                                        data-name="{{$variation->name}}"
                                                        data-sku="{{$variation->sub_sku}}">
                                                        {{$variation->name}} ({{$variation->sub_sku}}) - {{($variation->sell_price_inc_tax)}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                           
                                @if (($product->stock < 0 || empty($product->stock)) && $product->enable_stock)
                                    <tr>
                                        <td colspan="2">
                                            <small class="text-muted">@lang('productcatalogue::lang.out_of_stock')</small>
                                        </td>
                                    </tr>
                                @endif

                                @if($stock > 0)
                                <tr>
                                    <th class="pb-0"> Quantity:</th>
                                    <td class="pb-0">
                                    <div class="quantity-container">
                                        <button type="button" class="btn btn-outline-secondary" data-action="decrease">-</button>
                                        <input type="text" name="quantity" class="quantity-input" value="1" readonly />
                                        <button type="button" class="btn btn-outline-secondary" data-action="increase">+</button>
                                    </div>
                                    </td>
                                </tr>
                                @endif

                                <input type="hidden" name="product_sku" value="{{$product->sku}}" />
                                <input type="hidden" name="variation_id" 
                                value="{{ $product->type == 'variable' ? '' : ($product->variations->isNotEmpty() ? $product->variations->first()->id : '') }}"
                                class="selected-variation-id"/>
                                
                            </table>

                            @if($stock > 0)
                                <button type="button" class="btn btn-primary add-to-cart-btn"
                                data-product-id="{{$product->id}}"  
                                data-product-type="{{$product->type}}"
                                data-product-name="{{$product->name}}"
                                data-product-price="{{($max_price)}}"
                                data-stock-available="{{ $stock }}">Add to cart</button>
                            @endif
                          
                        </div>
                    </div>
                </div>
            @if($loop->iteration%4 == 0)
                <div class="clearfix"></div>
            @endif
            @endforeach
            </div>
        @endforeach
    </div>
    <div class='scrolltop no-print'>
        <div class='scroll icon'><i class="fas fa-angle-up"></i></div>
    </div>

    <!-- Cart Icon -->
    <div class="cart-icon">
        <i class="fas fa-shopping-cart"></i>
        <span id="cart-count" class="cart-count">0</span>
    </div>

    <!-- Cart Details -->
    <div id="cart-details" class="cart-details">
        <!-- Cart details will be dynamically filled here -->
        <button id="clrbtn" class="btn btn-danger btn-sm">Clear Cart</button>
    </div>
</section>
<!-- /.content -->
<!-- Add currency related field-->
<input type="hidden" id="__code" value="{{$business->currency->code}}">
<input type="hidden" id="__symbol" value="{{$business->currency->symbol}}">
<input type="hidden" id="__thousand" value="{{$business->currency->thousand_separator}}">
<input type="hidden" id="__decimal" value="{{$business->currency->decimal_separator}}">
<input type="hidden" id="__symbol_placement" value="{{$business->currency->currency_symbol_placement}}">
<input type="hidden" id="__precision" value="{{$business->currency_precision}}">
<input type="hidden" id="__quantity_precision" value="{{$business->quantity_precision}}">
<div class="modal fade product_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
@stop
@section('javascript')
<script type="text/javascript">


document.addEventListener('DOMContentLoaded', function () {
        var cartDetails = document.getElementById('cart-details');
        var clearCartBtn = document.getElementById('clrbtn');
        
        // Get business_id and location_id from the URL
        const pathSegments = window.location.pathname.split('/');
        const business_id = pathSegments[2];
        const location_id = pathSegments[3];

        // Retrieve the cart data based on business_id and location_id
        var cart = JSON.parse(localStorage.getItem(`cart_${business_id}_${location_id}`)) || [];

        function adjustQuantity(button, action) {
            const quantityInput = button.closest('.quantity-container').querySelector('.quantity-input');
            let quantity = parseInt(quantityInput.value);

            if (action === 'increase') {
                quantity++;
            } else if (action === 'decrease' && quantity > 1) {
                quantity--;
            }

            quantityInput.value = quantity;
        }

        // Attach event listeners to the quantity adjustment buttons
        const decreaseButtons = document.querySelectorAll('.quantity-container .btn-outline-secondary[data-action="decrease"]');
        const increaseButtons = document.querySelectorAll('.quantity-container .btn-outline-secondary[data-action="increase"]');

        decreaseButtons.forEach(button => {
            button.addEventListener('click', function () {
                adjustQuantity(button, 'decrease');
            });
        });

        increaseButtons.forEach(button => {
            button.addEventListener('click', function () {
                adjustQuantity(button, 'increase');
            });
        });

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('increase-quantity')) {
                var index = event.target.dataset.index;
                if (cart[index]) {
                    cart[index].quantity++; // Increase quantity
                    updateCart();
                }
            }

            if (event.target.classList.contains('decrease-quantity')) {
                var index = event.target.dataset.index;
                if (cart[index] && cart[index].quantity > 1) {
                    cart[index].quantity--; // Decrease quantity
                    updateCart();
                }
            }
        });

        // Update cart and store it in localStorage under business_id and location_id
        function updateCart() {
            localStorage.setItem(`cart_${business_id}_${location_id}`, JSON.stringify(cart)); // Store cart per business-location
            updateCartIcon();
            showCartDetails();
        }

        // Update cart icon count
        function updateCartIcon() {
            var cartCount = cart.length;
            document.getElementById('cart-count').textContent = cartCount;
        }

        // Show cart details
        function showCartDetails() {
            cartDetails.innerHTML = ''; // Clear existing cart details

            if (cart.length > 0) {
                let cartList = '<ul>';
                let total = 0;

                cart.forEach((item, index) => {
                    const price = parseFloat(item.price) || 0;
                    cartList += 
                        `<li>${item.name} x ${item.quantity} - ${price * item.quantity}
                            <button class="btn btn-sm btn-danger remove-item-btn" data-index="${index}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </li>`;
                    total += price * item.quantity;
                });

                const formattedTotal = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'INR'
                }).format(total);

                cartList += `<li class="total-price">Total: ${formattedTotal}</li>`;
                cartList += '</ul>';

                cartList += 
                    `<div class="cart-buttons">
                        <button id="clrbtn" class="btn-clear-cart">Clear Cart</button>
                        <button id="checkout" class="btn-checkout">Proceed to Checkout</button>
                    </div>`;

                cartDetails.innerHTML = cartList;
                cartDetails.style.display = 'block';

                // Add remove functionality
                document.querySelectorAll('.remove-item-btn').forEach(button => {
                    button.addEventListener('click', function () {
                        const itemIndex = button.dataset.index;
                        cart.splice(itemIndex, 1); // Remove item from the cart
                        updateCart(); // Refresh cart after removal
                    });
                });
            } else {
                cartDetails.innerHTML = '<p>No items in the cart</p>';
                cartDetails.style.display = 'block';
            }

            // Clear cart functionality
            $('#clrbtn').on('click', function () {
                localStorage.removeItem(`cart_${business_id}_${location_id}`);
                cart = [];
                updateCartIcon();
                showCartDetails();
            });

            // Checkout functionality
            document.getElementById('checkout').addEventListener('click', function () {
                const checkoutData = {
                    business_id: business_id,
                    location_id: location_id,
                    cart: cart,
                };

                localStorage.setItem('checkout_data', JSON.stringify(checkoutData));

                window.location.href = `/checkout?business_id=${business_id}&location_id=${location_id}`;
            });
        }

        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const productCard = this.closest('.box-body');
            const productId = this.dataset.productId;
            const productType = this.dataset.productType;
            const stockAvailable = parseInt(this.dataset.stockAvailable); // Get the stock available
            // Get the existing quantity of the product in the cart
            const existingProductIndex = cart.findIndex(item => item.product_id === productId);
            const existingProductQuantity = existingProductIndex >= 0 ? cart[existingProductIndex].quantity : 0;

            // Get the quantity the user wants to add
            let quantityInput = productCard.querySelector('.quantity-input');
            let quantity = parseInt(quantityInput.value) || 1;

            // Check if the user is trying to add more than the available stock
            if (quantity + existingProductQuantity > stockAvailable) {
                alert(`You can only add ${stockAvailable - existingProductQuantity} more of this product to your cart.`);
                return; // Don't add to the cart if the quantity exceeds available stock
            }

            // Proceed with product details based on product type
            let variantId, selectedVariantName, selectedVariantPrice;
            
            if (productType === 'single') {
                variantId = productCard.querySelector('.selected-variation-id').value;
                selectedVariantName = this.dataset.productName;
                selectedVariantPrice = parseFloat(this.dataset.productPrice);
            } else {
                const variantSelector = productCard.querySelector('.variant-selector');
                const selectedOption = variantSelector.options[variantSelector.selectedIndex];
                variantId = selectedOption.value;
                selectedVariantName = selectedOption.textContent.trim();
                selectedVariantPrice = parseFloat(selectedOption.dataset.price);
            }

            const totalPrice = selectedVariantPrice * quantity;
            const existingVarIndex = cart.findIndex(item => item.variant_id === variantId);

            // Check if product already exists in the cart
            if (existingVarIndex >= 0) {
                // Update the existing product quantity
                cart[existingVarIndex].quantity += quantity;
                cart[existingProductIndex].total = cart[existingVarIndex].quantity * selectedVariantPrice;
            } else {
                // Add new product to the cart
                const product = {
                    product_id: productId,
                    variant_id: variantId,
                    name: selectedVariantName,
                    price: selectedVariantPrice,
                    quantity: quantity,
                    total: totalPrice
                };
                cart.push(product);
            }

            // Save the updated cart to localStorage and refresh the cart display
            updateCart();
        });
    });
        updateCartIcon();
        showCartDetails();
    });

    (function($) {
    $(document).ready( function() {
        //Set global currency to be used in the application
        __currency_symbol = $('input#__symbol').val();
        __currency_thousand_separator = $('input#__thousand').val();
        __currency_decimal_separator = $('input#__decimal').val();
        __currency_symbol_placement = $('input#__symbol_placement').val();
        if ($('input#__precision').length > 0) {
            __currency_precision = $('input#__precision').val();
        } else {
            __currency_precision = 2;
        }

        if ($('input#__quantity_precision').length > 0) {
            __quantity_precision = $('input#__quantity_precision').val();
        } else {
            __quantity_precision = 2;
        }

        //Set page level currency to be used for some pages. (Purchase page)
        if ($('input#p_symbol').length > 0) {
            __p_currency_symbol = $('input#p_symbol').val();
            __p_currency_thousand_separator = $('input#p_thousand').val();
            __p_currency_decimal_separator = $('input#p_decimal').val();
        }

        __currency_convert_recursively($('.content'));
    });

    $(document).on('click', '.show-product-details', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).data('href'),
            dataType: 'html',
            success: function(result) {
                $('.product_modal')
                    .html(result)
                    .modal('show');
                __currency_convert_recursively($('.product_modal'));
            },
        });
    });

    $(document).on('click', '.menu', function(e){
        e.preventDefault();
        $('.navbar-toggle').addClass('collapsed');
        $('.navbar-collapse').removeClass('in');

        var cat_id = $(this).attr('href');
        if ($(cat_id).length) {
            $('html, body').animate({
                scrollTop: $(cat_id).offset().top
            }, 1000);
        }
    });

    })(jQuery);

    $(window).scroll(function() {
        var height = $(window).scrollTop();

        if(height  > 180) {
            $('nav').addClass('navbar-fixed-top');
            $('.scrolltop:hidden').stop(true, true).fadeIn();
        } else {
            $('nav').removeClass('navbar-fixed-top');
            $('.scrolltop').stop(true, true).fadeOut();
        }
    });

    $(document).on('click', '.scroll', function(e){
        $("html,body").animate({scrollTop:$("#top").offset().top},"1000");
        return false;
    });
</script>
@endsection
