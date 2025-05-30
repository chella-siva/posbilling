<?php

namespace Modules\Woocommerce\Http\Controllers;

use App\Utils\ModuleUtil;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Menu;

class DataController extends Controller
{
    public function dummy_data()
    {
        Artisan::call('db:seed', ['--class' => 'Modules\Woocommerce\Database\Seeders\AddDummySyncLogTableSeeder']);
    }

    public function superadmin_package()
    {
        return [
            [
                'name' => 'woocommerce_module',
                'label' => __('woocommerce::lang.woocommerce_module'),
                'default' => false,
            ],
        ];
    }

    /**
     * Defines user permissions for the module.
     *
     * @return array
     */
    public function user_permissions()
    {
        return [
            [
                'value' => 'woocommerce.syc_categories',
                'label' => __('woocommerce::lang.sync_product_categories'),
                'default' => false,
            ],
            [
                'value' => 'woocommerce.sync_products',
                'label' => __('woocommerce::lang.sync_products'),
                'default' => false,
            ],
            [
                'value' => 'woocommerce.sync_orders',
                'label' => __('woocommerce::lang.sync_orders'),
                'default' => false,
            ],
            [
                'value' => 'woocommerce.map_tax_rates',
                'label' => __('woocommerce::lang.map_tax_rates'),
                'default' => false,
            ],
            [
                'value' => 'woocommerce.access_woocommerce_api_settings',
                'label' => __('woocommerce::lang.access_woocommerce_api_settings'),
                'default' => false,
            ],

        ];
    }

    /**
     * Parses notification message from database.
     *
     * @return array
     */
    public function parse_notification($notification)
    {
        $notification_data = [];
        if ($notification->type ==
            'Modules\Woocommerce\Notifications\SyncOrdersNotification') {
            $msg = __('woocommerce::lang.orders_sync_notification');

            $notification_data = [
                'msg' => $msg,
                'icon_class' => 'fas fa-sync bg-light-blue',
                'link' => action([\App\Http\Controllers\SellController::class, 'index']),
                'read_at' => $notification->read_at,
                'created_at' => $notification->created_at->diffForHumans(),
            ];
        }

        return $notification_data;
    }

    /**
     * Returns product form part path with required extra data.
     *
     * @return array
     */
    public function product_form_part()
    {
        $path = 'woocommerce::woocommerce.partials.product_form_part';

        $business_id = request()->session()->get('user.business_id');

        $module_util = new ModuleUtil();
        $is_woo_enabled = (bool) $module_util->hasThePermissionInSubscription($business_id, 'woocommerce_module', 'superadmin_package');
        if ($is_woo_enabled) {
            return  [
                'template_path' => $path,
                'template_data' => [],
            ];
        } else {
            return [];
        }
    }

    /**
     * Returns products table extra columns for this module
     *
     * @return array
     */
    public function product_form_fields()
    {
        return ['woocommerce_disable_sync'];
    }

    /**
     * Adds Woocommerce menus
     *
     * @return null
     */
    public function modifyAdminMenu()
    {
        $module_util = new ModuleUtil();

        $business_id = session()->get('user.business_id');
        $is_woo_enabled = (bool) $module_util->hasThePermissionInSubscription($business_id, 'woocommerce_module', 'superadmin_package');

        if ($is_woo_enabled && (auth()->user()->can('woocommerce.syc_categories') || auth()->user()->can('woocommerce.sync_products') || auth()->user()->can('woocommerce.sync_orders') || auth()->user()->can('woocommerce.map_tax_rates') || auth()->user()->can('woocommerce.access_woocommerce_api_settings'))) {
            Menu::modify('admin-sidebar-menu', function ($menu) {
                $menu->url(
                    action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'index']),
                    __('woocommerce::lang.woocommerce'),
                    ['icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-wordpress"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.5 9h3" /><path d="M4 9h2.5" /><path d="M11 9l3 11l4 -9" /><path d="M5.5 9l3.5 11l3 -7" /><path d="M18 11c.177 -.528 1 -1.364 1 -2.5c0 -1.78 -.776 -2.5 -1.875 -2.5c-.898 0 -1.125 .812 -1.125 1.429c0 1.83 2 2.058 2 3.571z" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /></svg>', 'style' => config('app.env') == 'demo' ? 'background-color: #9E458B !important;color:white' : '', 'active' => request()->segment(1) == 'woocommerce']
                )->order(88);
            });
        }
    }
}
