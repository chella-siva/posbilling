<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Transaction;
use App\TransactionSellLine; // Add this import for the TransactionSellLine model
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Utils\ContactUtil;
use App\Utils\ModuleUtil;
use App\Utils\NotificationUtil;
use App\Utils\TransactionUtil;
use App\Utils\Util;

class CatalogueController extends Controller
{
    protected $commonUtil;

    protected $contactUtil;

    protected $transactionUtil;

    protected $moduleUtil;

    protected $notificationUtil;

    public function __construct(
        Util $commonUtil,
        ModuleUtil $moduleUtil,
        TransactionUtil $transactionUtil,
        NotificationUtil $notificationUtil,
        ContactUtil $contactUtil
    ) {
        $this->commonUtil = $commonUtil;
        $this->contactUtil = $contactUtil;
        $this->moduleUtil = $moduleUtil;
        $this->transactionUtil = $transactionUtil;
        $this->notificationUtil = $notificationUtil;
    }
    public function store(Request $request)
    {
        // Log the incoming request data
            try {
                // Validate the form inputs
                $validatedData = $request->validate([
                    'customer_name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'mobile_no' => 'required|string|max:15',
                    'cart' => 'required',
                    'address_line_1' => 'required'
                ]);
        
                // Log validated data
                Log::debug('Validated data:', ['validatedData' => $validatedData]);
        
                // Check if the contact already exists by mobile number
                $contact = Contact::where('mobile', $validatedData['mobile_no'])->first();
        
                if (!$contact) {
                    // Create a new contact record if no existing contact is found
                    $contact = new Contact();
                    $contact->business_id = $request->input('business_id'); // Default business_id
                    $contact->type = 'customer'; // Type
                    $ref_count = $this->commonUtil->setAndGetReferenceCount('contacts', $request->input('business_id'));

                    $contact->contact_id = $this->commonUtil->generateReferenceNumber('contacts', $ref_count, $request->input('business_id'));
                    $contact->contact_type = 'individual'; // Contact type
                    $contact->name = $validatedData['customer_name']; // Customer name
                    $contact->first_name = $validatedData['customer_name']; // First name
                    $contact->email = $validatedData['email']; // Email
                    $contact->mobile = $validatedData['mobile_no']; // Mobile number
                    $contact->address_line_1 = $validatedData['address_line_1'];  // Save address
        
                    // Save the contact record
                    $contact->save();
        
                    // Log contact creation
                    Log::debug('Contact saved:', ['contact' => $contact]);
                } else {
                    // If contact exists, log it
                    Log::debug('Existing contact found:', ['contact' => $contact]);
                }

                $invoice_no = $this->transactionUtil->getInvoiceNumber($request->input('business_id'), 'draft',
                $request->input('location_id'));
        
                // Create the transaction record
                $transaction = Transaction::create([
                    'business_id' => $request->input('business_id'), // Default business ID
                    'location_id' => $request->input('location_id'),
                    'is_kitchen_order' => false, // Default false
                    'res_table_id' => null,
                    'res_waiter_id' => null,
                    'res_order_status' => null,
                    'type' => 'sell', // Default type
                    'sub_type' => null,
                    'status' => 'draft', // Default status
                    'sub_status' => 'quotation', // Default sub_status
                    'is_quotation' => 1, // Default true
                    'payment_status' => null,
                    'adjustment_type' => null,
                    'contact_id' => $contact->id, // Contact ID (existing or newly created)
                    'customer_group_id' => null,
                    'invoice_no' => $invoice_no, // Default invoice_no
                    'ref_no' => null,
                    'source' => null,
                    'subscription_no' => null,
                    'subscription_repeat_on' => null,
                    'transaction_date' => now(), // Default current date
                    'total_before_tax' => $request->input('total_before_tax', 0.0), // Total before tax
                    'tax_id' => null,
                    'tax_amount' => 0.0, // Default value
                    'discount_type' => 'percentage', // Default type
                    'discount_amount' => 0.0, // Default value
                    'rp_redeemed' => 0, // Default value
                    'rp_redeemed_amount' => 0.0, // Default value
                    'shipping_details' => null,
                    'shipping_address' => null,
                    'delivery_date' => null,
                    'shipping_status' => null,
                    'delivered_to' => null,
                    'delivery_person' => null,
                    'shipping_charges' => 0.0, // Default value
                    'final_total' => $request->input('final_total', 0.0), // Final total
                    'created_by' => auth()->id() ?? 1, // Default current user or admin (1)
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        
                // Log transaction creation
                Log::debug('Transaction created:', ['transaction' => $transaction]);
                $cartData = json_decode($validatedData['cart'], true); // true returns as array, not object
        
                // Iterate over the cart and save each item as a transaction sell line
                foreach ($cartData as $cartItem) {
                    Log::debug('Adding cart item to TransactionSellLine:', ['cartItem' => $cartItem]);
        
                    TransactionSellLine::create([
                        'transaction_id' => $transaction->id, // Link to the transaction
                        'product_id' => $cartItem['product_id'], // Product ID
                        'variation_id' => $cartItem['variant_id'], // You can add variation if required
                        'quantity' => $cartItem['quantity'], // Quantity
                        'unit_price_before_discount' => $cartItem['price'], // Unit price before discount
                        'unit_price' => $cartItem['price'], // Unit price
                        'line_discount_type' => 'fixed', // Example value, update as needed
                        'line_discount_amount' => 0.0, // Example value
                        'unit_price_inc_tax' => $cartItem['price'], // Include tax if applicable
                        'sell_price_excluding_tax' => $cartItem['total'], // Total price excluding tax
                        'sell_price_including_tax' => $cartItem['total'], // Total price including tax
                        'item_tax' => 0.0, // Calculate tax if needed
                        'tax_id' => null, // Add tax ID if needed
                        'discount_id' => null, // Add discount ID if needed
                        'so_line_id' => null, // Add SO line ID if needed
                        'so_quantity_invoiced' => 0, // Set quantity invoiced if needed
                        'res_service_staff_id' => null, // Optional: Staff ID
                        'res_line_order_status' => 'pending', // Set order status as needed
                        'parent_sell_line_id' => null, // Optional: Parent line if there is one
                        'children_type' => null, // Optional: Type of children
                        'sub_unit_id' => null, // Optional: Sub unit ID
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
        
                // Log completion
                Log::debug('All cart items saved to TransactionSellLine.');
        
                // Return the inserted contact ID and transaction ID
                return response()->json([
                    'contact_id' => $contact->id,
                    'transaction_id' => $transaction->id,
                ], 201);
        
            } catch (\Exception $e) {
                // Log the exception error
                Log::error('Error processing transaction', [
                    'error_message' => $e->getMessage(),
                    'stack_trace' => $e->getTraceAsString(),
                ]);
        
                // Return a response with the error message
                return response()->json([
                    'error' => 'Something went wrong.',
                    'message' => $e->getMessage()
                ], 500);
            }
    
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     // Catch validation exception, log the error details, and display errors (if any)
        //     Log::error('Validation errors:', ['errors' => $e->errors()]);
        //     dd($e->errors());  // Dump validation errors to see them
        // }
    }
    
}
