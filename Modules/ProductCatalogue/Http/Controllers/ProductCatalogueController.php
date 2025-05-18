<?php

namespace Modules\ProductCatalogue\Http\Controllers;

use App\Business;
use App\BusinessLocation;
use App\Category;
use App\Discount;
use App\Product;
use App\SellingPriceGroup;
use App\Utils\ModuleUtil;
use App\Utils\ProductUtil;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
 use App\Contact;
 use App\Transaction;
 use Modules\Superadmin\Entities\SuperadminCommunicatorLog;
 use Modules\Superadmin\Notifications\SuperadminCommunicator;
 use App\TransactionSellLine;
 use App\Utils\ContactUtil;
 use App\Utils\NotificationUtil;
 use App\Utils\TransactionUtil;
 use App\Utils\Util;
 use Illuminate\Support\Facades\Log;



class ProductCatalogueController extends Controller
{

    /**
     * Constructor
     *
     * @param  ProductUtils  $product
     * @return void
     */
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

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

     public function checkout()
     {
         return view('productcatalogue::catalogue.checkout');
     }
     
      public function searchContacts(Request $request)
      {
          // Validate request parameters
          $request->validate([
              'mobile' => 'required|string',
              'business_id' => 'required|integer',
              'location_id' => 'required|integer',
          ]);
  
          // Fetch contacts based on search input
          $contacts = Contact::where('mobile', 'LIKE', '%' . $request->mobile . '%')
              ->where('business_id', $request->business_id)
              ->limit(5)
              ->get(['id', 'name', 'email', 'mobile','address_line_1']); // Fetch only necessary fields
  
          return response()->json($contacts);
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
                 $contact = Contact::where('business_id', $request->input('business_id'))->where('mobile', $validatedData['mobile_no'])->first();
         
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
                     'final_total' => $request->input('total_amount', 0.0), // Final total
                     'created_by' => auth()->id() ?? 1, // Default current user or admin (1)
                     'created_at' => now(),
                     'updated_at' => now(),
                 ]);
         
                 // Log transaction creation
                 Log::debug('Transaction created:', ['transaction' => $transaction]);
                 $business_id =  $request->input('business_id');
                 
                 $input = $request->all();
                 $input['subject'] = $input['subject'] ?? 'Quotation Created';
                 $input['message'] = $input['message'] ?? 'New Quotation created sucessfully - '.$invoice_no;
                 $busid = is_array($business_id) ? $business_id : [$business_id];
 
 
 
                 //Get business owners
                 $business_owners = User::join('business as B', 'users.id', '=', 'B.owner_id')
                                 ->whereIn('B.id', $busid)
                                 ->select('users.*')
                                 ->groupBy('users.id')
                                 ->get();
         
                 //Send notifications
                 \Notification::send($business_owners, new SuperadminCommunicator($input));
         
                 //Create Log
                 SuperadminCommunicatorLog::create([
                     'business_ids' => $busid,
                     'subject' => $input['subject'],
                     'message' => $input['message'],
                 ]);
                 
                 // $whatsapp_link = $this->notificationUtil->autoSendNotification($business_id, 'new_sale', $transaction, $transaction->contact);
                 // print_R($whatsapp_link);die;
                 
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
                // return response()->json([
                //      'contact_id' => $contact->id,
                //      'transaction_id' => $transaction->id,
                //  ], 201);
         
                // return redirect()->route('catalogue.qr', ['transaction_id' => $transaction->id]);
                // return redirect()->route('catalogue.qr', [
                //     'business_id' => $request->input('business_id'),
                //     'location_id' => $request->input('location_id'),
                // ]);
                
                return view('clear-storage-redirect', [
                    'business_id' => $request->input('business_id'),
                    'location_id' => $request->input('location_id'),
                ]);




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
    public function index($business_id, $location_id)
    {
        $business = Business::with(['currency'])->findOrFail($business_id);

        $settings = json_decode($business->productcatalogue_settings, true);

        $is_show = $settings['is_show'] ?? 1;

        $products = Product::where('business_id', $business_id)
                ->whereHas('product_locations', function ($q) use ($location_id) {
                    $q->where('product_locations.location_id', $location_id);
                })
                ->ProductForSales()
                ->with(['variations', 'variations.product_variation', 'category']);
                if($is_show == 0){
                    $products = $products->havingRaw('
                    (SELECT CASE WHEN enable_stock = 0 THEN 1 
                        ELSE SUM(variation_location_details.qty_available) END
                        FROM variation_location_details 
                        WHERE variation_location_details.product_id = products.id) > 0');
                }

        $products = $products->select('products.*', DB::raw('(SELECT SUM(variation_location_details.qty_available) FROM variation_location_details WHERE variation_location_details.product_id = products.id) as stock'))
                            ->get()
                            ->groupBy('category_id');

        $business = Business::with(['currency'])->findOrFail($business_id);
        $business_location = BusinessLocation::where('business_id', $business_id)->findOrFail($location_id);

        $now = \Carbon::now()->toDateTimeString();
        $discounts = Discount::where('business_id', $business_id)
                                ->where('location_id', $location_id)
                                ->where('is_active', 1)
                                ->where('starts_at', '<=', $now)
                                ->where('ends_at', '>=', $now)
                                ->orderBy('priority', 'desc')
                                ->get();
        foreach ($discounts as $key => $value) {
            $discounts[$key]->discount_amount = $this->productUtil->num_f($value->discount_amount, false, $business);
        }

        $categories = Category::forDropdown($business_id, 'product');

        return view('productcatalogue::catalogue.index')->with(compact('products', 'business', 'discounts', 'business_location', 'categories'));
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($business_id, $id)
    {
        $product = Product::with(['brand', 'unit', 'category', 'sub_category', 'product_tax', 'variations', 'variations.product_variation', 'variations.group_prices', 'variations.media', 'product_locations', 'warranty', 'variations.variation_location_details'])->where('business_id', $business_id)
                    ->select('products.*', DB::raw('(SELECT SUM(variation_location_details.qty_available) FROM variation_location_details WHERE variation_location_details.product_id = products.id) as stock'))
                    ->findOrFail($id);
        

        $price_groups = SellingPriceGroup::where('business_id', $product->business_id)->active()->pluck('name', 'id');

        $allowed_group_prices = [];
        foreach ($price_groups as $key => $value) {
            $allowed_group_prices[$key] = $value;
        }

        $group_price_details = [];
        $discounts = [];
        foreach ($product->variations as $variation) {
            foreach ($variation->group_prices as $group_price) {
                $group_price_details[$variation->id][$group_price->price_group_id] = $group_price->price_inc_tax;
            }

            $discounts[$variation->id] = $this->productUtil->getProductDiscount($product, $product->business_id, request()->input('location_id'), false, null, $variation->id);
        }

        $combo_variations = [];
        if ($product->type == 'combo') {
            $combo_variations = $this->productUtil->__getComboProductDetails($product['variations'][0]->combo_variations, $product->business_id);
        }

        $business = Business::findOrFail($business_id);

        return view('productcatalogue::catalogue.show')->with(compact(
            'product',
            'allowed_group_prices',
            'group_price_details',
            'combo_variations',
            'discounts',
            'business'
        ));
    }

    public function generateQr()
    {
        $business_id = request()->session()->get('user.business_id');
        if (! (auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'productcatalogue_module'))) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');
        $business_locations = BusinessLocation::forDropdown($business_id);
        $business = Business::findOrFail($business_id);

        return view('productcatalogue::catalogue.generate_qr')
                    ->with(compact('business_locations', 'business'));
    }
    
/**
 * update product Catalogue Setting
 * @param Request $request
 */

    public function productCatalogueSetting(Request $request){

        $business_id = request()->session()->get('user.business_id');
        
        if (! (auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'productcatalogue_module'))) {
            abort(403, 'Unauthorized action.');
        }
        
        try {
            $is_show = $request->post('is_show');
    
            $busines = Business::findOrFail($business_id);

            $settings = json_decode($busines->productcatalogue_settings, true);

            $settings['is_show'] = $is_show;

            $busines->productcatalogue_settings = json_encode($settings);
  
            $busines->update();
    
            $output = [
                'success' => 1,
                'msg' => __('lang_v1.success'),
            ];
    
            return redirect()
                ->action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'generateQr'])
                ->with('status', $output);
                
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];

            return back()->with('status', $output)->withInput();
        }
    }
}
