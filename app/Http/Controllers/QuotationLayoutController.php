<?php
namespace App\Http\Controllers;
use App\QuotationLayout;
use App\Utils\Util;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\File; // <-- Import the File facade
class QuotationLayoutController extends Controller
{
    protected $commonUtil;
    public function __construct(Util $commonUtil)
    {
        $this->commonUtil = $commonUtil;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! auth()->user()->can('invoice_settings.access')) {
            abort(403, 'Unauthorized action.');
        }
        $designs = $this->getDesigns();
        $common_settings = session()->get('business.common_settings');
        $is_warranty_enabled = ! empty($common_settings['enable_product_warranty']) ? true : false;
        return view('quotation_layout.create')->with(compact('designs', 'is_warranty_enabled'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('invoice_settings.access')) {
            abort(403, 'Unauthorized action.');
        }
        try {
            $validator = Validator::make($request->all(), [
                'logo' => 'mimes:jpeg,gif,png|1000',
            ]);
            $input = $request->only(['name', 'header_text',
                'invoice_no_prefix', 'invoice_heading', 'sub_total_label', 'discount_label', 'tax_label', 'total_label', 'highlight_color', 'footer_text','bank_details', 'invoice_heading_not_paid', 'invoice_heading_paid', 'total_due_label', 'customer_label', 'paid_label', 'sub_heading_line1', 'sub_heading_line2',
                'sub_heading_line3', 'sub_heading_line4', 'sub_heading_line5','show_signature','signature_image',
                'table_product_label', 'table_qty_label', 'table_unit_price_label','show_savedvalue','savedvalue_lable',
                'table_subtotal_label', 'client_id_label', 'date_label', 'quotation_heading', 'quotation_no_prefix', 'design', 'client_tax_label', 'cat_code_label', 'cn_heading', 'cn_no_label', 'cn_amount_label', 'sales_person_label', 'prev_bal_label', 'opening_bal_label', 'show_opening_bal','show_mrp','show_tax','show_unit','show_website','date_time_format', 'common_settings', 'change_return_label', 'round_off_label', 'qr_code_fields', 'commission_agent_label', ]);
            $business_id = $request->session()->get('user.business_id');
            $input['business_id'] = $business_id;
            //Set value for checkboxes
            $checkboxes = ['show_business_name', 'show_location_name', 'show_landmark', 'show_city', 'show_state','show_savedvalue','show_country', 'show_zip_code', 'show_mobile_number', 'show_alternate_number', 'show_email', 'show_tax_1', 'show_tax_2', 'show_logo', 'show_barcode', 'show_payments', 'show_customer', 'show_client_id',
                'show_brand', 'show_sku', 'show_cat_code', 'show_sale_description', 'show_sales_person', 'show_expiry',
                'show_lot', 'show_previous_bal', 'show_image', 'show_reward_point', 'show_qr_code','show_signature',
                'show_commission_agent', 'show_letter_head', ];
            foreach ($checkboxes as $name) {
                $input[$name] = ! empty($request->input($name)) ? 1 : 0;
            }
            //Upload Logo
            $logo_name = $this->commonUtil->uploadFile($request, 'logo', 'invoice_logos', 'image');
            if (! empty($logo_name)) {
                $input['logo'] = $logo_name;
            }
            $letter_head = $this->commonUtil->uploadFile($request, 'letter_head', 'invoice_logos', 'image');
            if (! empty($letter_head)) {
                $input['letter_head'] = $letter_head;
            }
            
              $signature_image = $this->commonUtil->uploadFile($request, 'signature_image', 'signature_image', 'image');
            if (! empty($signature_image)) {
                $input['signature_image'] = $signature_image;
            }


            if (! empty($request->input('is_default'))) {
                //get_default
                $default = QuotationLayout::where('business_id', $business_id)
                                ->where('is_default', 1)
                                ->update(['is_default' => 0]);
                $input['is_default'] = 1;
            }
            //Module info
            if ($request->has('module_info')) {
                $input['module_info'] = json_encode($request->input('module_info'));
            }
            if (! empty($request->input('table_tax_headings'))) {
                $input['table_tax_headings'] = json_encode($request->input('table_tax_headings'));
            }
            $input['product_custom_fields'] = ! empty($request->input('product_custom_fields')) ? $request->input('product_custom_fields') : null;
            $input['contact_custom_fields'] = ! empty($request->input('contact_custom_fields')) ? $request->input('contact_custom_fields') : null;
            $input['location_custom_fields'] = ! empty($request->input('location_custom_fields')) ? $request->input('location_custom_fields') : null;
            QuotationLayout::create($input);
            $output = ['success' => 1,
                'msg' => __('invoice.layout_added_success'),
            ];
        } catch (\Exception $e) {
            \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());
            $output = ['success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }
        return redirect('invoice-schemes')->with('status', $output);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\QuotationLayout  $QuotationLayout
     * @return \Illuminate\Http\Response
     */
    public function show(QuotationLayout $QuotationLayout)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuotationLayout  $QuotationLayout
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//         $user = auth()->user()->username;
// dd($user);
        if (! auth()->user()->can('invoice_settings.access')) {
            abort(403, 'Unauthorized action.');
        }
        $quotation_layout = QuotationLayout::findOrFail($id);
        //Module info
        $quotation_layout->module_info = json_decode($quotation_layout->module_info, true);
        $quotation_layout->table_tax_headings = ! empty($quotation_layout->table_tax_headings) ? json_decode($quotation_layout->table_tax_headings) : ['', '', '', ''];
        $designs = $this->getDesigns();
        return view('quotation_layout.edit')
                ->with(compact('quotation_layout', 'designs'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuotationLayout  $QuotationLayout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! auth()->user()->can('invoice_settings.access')) {
            abort(403, 'Unauthorized action.');
        }
        try {
            $validator = Validator::make($request->all(), [
                'logo' => 'mimes:jpeg,gif,png|1000',
            ]);
            $input = $request->only(['name', 'header_text',
                'invoice_no_prefix', 'invoice_heading', 'sub_total_label', 'discount_label', 'tax_label', 'total_label', 'highlight_color', 'footer_text','bank_details', 'invoice_heading_not_paid', 'invoice_heading_paid', 'total_due_label', 'customer_label', 'paid_label', 'sub_heading_line1', 'sub_heading_line2',
                'sub_heading_line3', 'sub_heading_line4', 'sub_heading_line5',
                'table_product_label', 'table_qty_label', 'table_unit_price_label','show_signature','signature_image',
                'table_subtotal_label', 'client_id_label', 'date_label', 'quotation_heading', 'quotation_no_prefix', 'design',
                'client_tax_label', 'cat_code_label', 'cn_heading', 'cn_no_label', 'cn_amount_label',
                'sales_person_label', 'prev_bal_label', 'opening_bal_label', 'show_opening_bal','show_mrp','show_tax','show_unit','show_website','date_time_format', 'change_return_label', 'round_off_label', 'commission_agent_label', ]);
            $business_id = $request->session()->get('user.business_id');
            $checkboxes = ['show_business_name', 'show_location_name', 'show_landmark', 'show_city', 'show_state', 'show_country', 'show_zip_code', 'show_mobile_number', 'show_alternate_number', 'show_email', 'show_tax_1', 'show_tax_2', 'show_logo', 'show_barcode', 'show_payments', 'show_customer', 'show_client_id',
                'show_brand', 'show_sku', 'show_cat_code', 'show_sale_description', 'show_sales_person','show_signature',
                'show_expiry', 'show_lot', 'show_previous_bal', 'show_image', 'show_reward_point','show_opening_bal','show_mrp','show_tax','show_unit','show_website',
                'show_qr_code', 'show_commission_agent', 'show_letter_head', ];
            foreach ($checkboxes as $name) {
                $input[$name] = ! empty($request->input($name)) ? 1 : 0;
            }
            
            //Upload Logo
            $logo_name = $this->commonUtil->uploadFile($request, 'logo', 'invoice_logos', 'image');
            if (! empty($logo_name)) {
                $input['logo'] = $logo_name;
            }
            //Upload letter head
            $letter_head = $this->commonUtil->uploadFile($request, 'letter_head', 'invoice_logos', 'image');
            if (! empty($letter_head)) {
                $input['letter_head'] = $letter_head;
            }
               $signature_image = $this->commonUtil->uploadFile($request, 'signature_image', 'signature_image', 'image');
            if (! empty($signature_image)) {
                $input['signature_image'] = $signature_image;
            }
            
            if (! empty($request->input('is_default'))) {
                //get_default
                $default = QuotationLayout::where('business_id', $business_id)
                                ->where('is_default', 1)
                                ->update(['is_default' => 0]);
                $input['is_default'] = 1;
            }
            //Module info
            if ($request->has('module_info')) {
                $input['module_info'] = json_encode($request->input('module_info'));
            }
            if (! empty($request->input('table_tax_headings'))) {
                $input['table_tax_headings'] = json_encode($request->input('table_tax_headings'));
            }
            $input['product_custom_fields'] = ! empty($request->input('product_custom_fields')) ? json_encode($request->input('product_custom_fields')) : null;
            $input['contact_custom_fields'] = ! empty($request->input('contact_custom_fields')) ? json_encode($request->input('contact_custom_fields')) : null;
            $input['location_custom_fields'] = ! empty($request->input('location_custom_fields')) ? json_encode($request->input('location_custom_fields')) : null;
            $input['common_settings'] = ! empty($request->input('common_settings')) ? json_encode($request->input('common_settings')) : null;
            $input['qr_code_fields'] = ! empty($request->input('qr_code_fields')) ? json_encode($request->input('qr_code_fields')) : null;
            QuotationLayout::where('id', $id)
                        ->where('business_id', $business_id)
                        ->update($input);
            $output = ['success' => 1,
                'msg' => __('invoice.layout_updated_success'),
            ];
        } catch (\Exception $e) {
            \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());
            $output = ['success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }
        return redirect('invoice-schemes')->with('status', $output);
    }
    
     public function removeletterheadImage(Request $request, $invlayid)
    {
        try {
            $product = QuotationLayout::find($invlayid);
    
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Layout not found.']);
            }
    
            // Check if the product has an image and the image file exists
            if ($product->letter_head && file_exists(public_path('uploads/invoice_logos/' . $product->letter_head))) {
                // Delete the image file from the server
                File::delete(public_path('uploads/img/' . $product->letter_head));
                
                // Remove the image record in the database
                $product->letter_head = null;
                $product->save();
    
                return response()->json(['success' => true, 'message' => 'Image removed successfully.']);
            }
    
            return response()->json(['success' => false, 'message' => 'Image not found.']);
        } catch (\Exception $e) {
            Log::error('Error removing image: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Server Error.']);
        }
    }
   public function removelogoImage(Request $request, $invlayid)
    {
        try {
            $product = QuotationLayout::find($invlayid);
    
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Layout not found.']);
            }
    
            // Check if the product has an image and the image file exists
            if ($product->letter_head && file_exists(public_path('uploads/invoice_logos/' . $product->logo))) {
                // Delete the image file from the server
                File::delete(public_path('uploads/img/' . $product->logo));
                
                // Remove the image record in the database
                $product->logo = null;
                $product->save();
    
                return response()->json(['success' => true, 'message' => 'Image removed successfully.']);
            }
    
            return response()->json(['success' => false, 'message' => 'Image not found.']);
        } catch (\Exception $e) {
            Log::error('Error removing image: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Server Error.']);
        }
    }
    private function getDesigns()
    {
        return ['classic' => __('lang_v1.classic').' ('.__('lang_v1.for_normal_printer').')',
            'elegant' => __('lang_v1.elegant').' ('.__('lang_v1.for_normal_printer').')',
            // 'thirutest' => __('lang_v1.thirutest').' ('.__('lang_v1.for_normal_printer').')',
            'invoice_one' => __('lang_v1.invoice_one').' ('.__('lang_v1.for_normal_printer').')',
            'invoice_two' => __('lang_v1.invoice_two').' ('.__('lang_v1.for_normal_printer').')',
            'invoice_three' => __('lang_v1.invoice_three').' ('.__('lang_v1.for_normal_printer').')',
            'invoice_four' => __('lang_v1.invoice_four').' ('.__('lang_v1.for_normal_printer').')',
            // 'invoice_five' => __('lang_v1.invoice_five').' ('.__('lang_v1.for_normal_printer').')',
            // 'quotation' => __('lang_v1.quotation_inv').' ('.__('lang_v1.for_normal_printer').')',
            'detailed' => __('lang_v1.detailed').' ('.__('lang_v1.for_normal_printer').')',
            'columnize-taxes' => __('lang_v1.columnize_taxes').' ('.__('lang_v1.for_normal_printer').')',
            'slim' => __('lang_v1.slim').' ('.__('lang_v1.recomended_for_80mm').')',
            'slim2' => __('lang_v1.slim').' 2 ('.__('lang_v1.recomended_for_58mm').')',
            'slim_mrp' => __('lang_v1.slim_mrp').' ('.__('lang_v1.recomended_for_108mm').')',
        ];
    }
}