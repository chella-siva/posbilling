@extends('layouts.guest')
@section('title', 'Checkout')

@section('content')
<section class="content-header text-center">
    <h2>Checkout</h2>
    <p>Please enter your details to proceed with the purchase.</p>
</section>

<section class="content pt-0">
    <div class="container">
{!! Form::open(['url' => action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'store']), 'method' => 'post', 'id' => 'add_pos_layout_form', 'files' => true]) !!}
        @csrf

        <div class="checkout-form">
            <!-- Mobile Number Field with Autocomplete -->
            <div class="form-group">
                <label for="mobile_no">Mobile Number:</label>
                <input type="text" class="form-control" id="mobile_no" name="mobile_no" required placeholder="Enter your mobile number">
                <div id="customer_suggestions" class="list-group mt-2"></div>
            </div>

            <!-- Customer Name -->
            <div class="form-group">
                <label for="customer_name">Customer Name:</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" required placeholder="Enter your full name">
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email address">
            </div>

            <!-- Address Field -->
            <div class="form-group">
                <label for="address_line_1">Address:</label>
                <input type="text" class="form-control" id="address_line_1" name="address_line_1" required placeholder="Enter your address">
            </div>

            <!-- Cart Details Section -->
            <div class="cart-details">
                <h3>Cart Details</h3>
                <div id="cart-items-list" style="display: block;">
                    <!-- Cart Items will be populated here dynamically -->
                </div>

                <button type="button" class="btn btn-info" id="toggleCartDetails">Hide Cart</button>
            </div>

            <!-- Hidden fields for business_id, location_id, and cart -->
            <input type="hidden" id="business_id" name="business_id">
            <input type="hidden" id="location_id" name="location_id">
            <input type="hidden" id="cart" name="cart">
            <!-- Total Amount Field -->
            <div class="form-group">
                <label for="total_amount">Total Amount:</label>
                <input type="text" class="form-control" id="total_amount" name="total_amount" readonly placeholder="Total Amount" value="0">
            </div>


            <!-- Submit Button -->
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success btn-lg">Proceed to Payment</button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Retrieve data from localStorage
        const checkoutData = JSON.parse(localStorage.getItem('checkout_data'));

        if (checkoutData) {
            document.getElementById('business_id').value = checkoutData.business_id || '';
            document.getElementById('location_id').value = checkoutData.location_id || '';
            document.getElementById('cart').value = JSON.stringify(checkoutData.cart) || '';

            // Display cart details
            displayCartItems(checkoutData.cart);
            updateTotalAmount(checkoutData.cart);

        } else {
            console.error('No checkout data found in localStorage.');
        }

        // Handle autocomplete for mobile number
        const mobileInput = document.getElementById('mobile_no');
        const suggestionsBox = document.getElementById('customer_suggestions');

        mobileInput.addEventListener('input', function () {
            let mobile = this.value;
            let businessId = document.getElementById('business_id').value;
            let locationId = document.getElementById('location_id').value;

            if (mobile.length >= 3) {
                fetch(`/search-customers?mobile=${mobile}&business_id=${businessId}&location_id=${locationId}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsBox.innerHTML = "";
                    if (data.length > 0) {
                        data.forEach(contact => {
                            let item = document.createElement('a');
                            item.href = "#";
                            item.classList.add('list-group-item', 'list-group-item-action');
                            item.textContent = `${contact.name} (${contact.mobile})`;
                            item.onclick = function () {
                                document.getElementById('customer_name').value = contact.name;
                                document.getElementById('email').value = contact.email;
                                document.getElementById('mobile_no').value = contact.mobile;
                                document.getElementById('address_line_1').value = contact.address_line_1 || '';
                                suggestionsBox.innerHTML = ""; // Clear suggestions
                            };
                            suggestionsBox.appendChild(item);
                        });
                    }
                })
                .catch(error => console.error('Error fetching customers:', error));
            } else {
                suggestionsBox.innerHTML = "";
            }
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function (event) {
            if (!mobileInput.contains(event.target) && !suggestionsBox.contains(event.target)) {
                suggestionsBox.innerHTML = "";
            }
        });

        // Show or Hide Cart Details
        const toggleCartDetailsBtn = document.getElementById('toggleCartDetails');
        const cartItemsList = document.getElementById('cart-items-list');

        toggleCartDetailsBtn.addEventListener('click', function () {
            if (cartItemsList.style.display === 'none' || cartItemsList.style.display === '') {
                cartItemsList.style.display = 'block';
                toggleCartDetailsBtn.textContent = 'Hide Cart';
            } else {
                cartItemsList.style.display = 'none';
                toggleCartDetailsBtn.textContent = 'Show Cart';
            }
        });

        // Display Cart Items
        function displayCartItems(cart) {
            const cartItemsList = document.getElementById('cart-items-list');
            cartItemsList.innerHTML = ''; // Clear the list before rendering new items

            cart.forEach(item => {
                let cartItemElement = document.createElement('div');
                cartItemElement.classList.add('cart-item');
                cartItemElement.innerHTML = `
                    <p><strong>${item.name}</strong></p>
                    <p>Price: <span class="display_currency" data-currency_symbol="true">${item.price}</span></p>
                    <p>Quantity: 
                        <button class="btn btn-sm btn-light" onclick="updateQuantity(${item.product_id}, -1)">-</button>
                        <span id="quantity-${item.product_id}">${item.quantity}</span>
                        <button class="btn btn-sm btn-light" onclick="updateQuantity(${item.product_id}, 1)">+</button>
                        <button class="btn btn-danger btn-sm remove-item" onclick="removeCartItem(${item.product_id})">Remove</button>
                    </p>
                `;
                cartItemsList.appendChild(cartItemElement);
            });
        }

        // Update Cart Quantity
        window.updateQuantity = function(productId, change) {
        // Get the cart data from localStorage
        let cart = JSON.parse(localStorage.getItem('checkout_data')).cart;

        // Find the item in the cart
        let item = cart.find(item => item.product_id == productId);
        
        if (item) {
            // Update the quantity (ensure it's not less than 1)
            item.quantity += change;
            if (item.quantity <= 0) {
                item.quantity = 1; // Prevent negative or zero quantity
            }

            // Update the cart in localStorage
            localStorage.setItem('checkout_data', JSON.stringify({ ...checkoutData, cart: cart }));
            updateTotalAmount(cart);
            // Update the displayed quantity for that item on the UI
            document.getElementById(`quantity-${productId}`).textContent = item.quantity;
        } else {
            console.error(`Item with ID ${productId} not found in cart.`);
        }
    }


    function updateTotalAmount(cart) {
        let totalAmount = 0;

        // Calculate total amount
        cart.forEach(item => {
            totalAmount += item.price * item.quantity;
        });

        // Display the total amount in the total_amount input
        document.getElementById('total_amount').value = totalAmount.toFixed(2);
    }

        // Remove Cart Item (Directly from UI and localStorage)
        window.removeCartItem = function(productId) {
            let cart = JSON.parse(localStorage.getItem('checkout_data')).cart;
            console.log(cart);
            cart = cart.filter(item => item.product_id != productId);

            localStorage.setItem('checkout_data', JSON.stringify({ ...checkoutData, cart: cart }));
            // Remove the item directly from the DOM
            const itemElement = document.querySelector(`#cart-items-list .cart-item[data-id="${productId}"]`);
            if (itemElement) {
                itemElement.remove();
            }
            updateTotalAmount(cart);

            location.reload();
        }
    });
</script>

<style>
    .checkout-form {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .checkout-form label {
        font-size: 1.1rem;
        font-weight: bold;
    }

    .checkout-form input[type="text"],
    .checkout-form input[type="email"] {
        border-radius: 5px;
        padding: 10px;
    }

    .btn-info {
        margin-top: 10px;
    }

    .cart-details {
        margin-top: 20px;
    }

    .cart-item {
        margin-bottom: 15px;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }

    .remove-item {
        margin-top: 5px;
    }
</style>

@endsection