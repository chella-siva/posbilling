<?php

namespace Modules\Superadmin\Http\Controllers;

use App\Utils\ModuleUtil;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Superadmin\Entities\Package;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * All Utils instance.
     */
    protected $moduleUtil;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct(ModuleUtil $moduleUtil)
    {
        $this->moduleUtil = $moduleUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $packages = Package::listPackages(true);

        //Get all module permissions and convert them into name => label
        $permissions = $this->moduleUtil->getModuleData('superadmin_package');
        $permission_formatted = [];
        foreach ($permissions as $permission) {
            foreach ($permission as $details) {
                $permission_formatted[$details['name']] = $details['label'];
            }
        }

        return view('superadmin::pricing.index')
            ->with(compact('packages', 'permission_formatted'));
    }

    public function package_duration_update(Request $request)
    {
        $interval = $request->input('interval');

        $packages = Package::listPackages(true, $interval);

        //Get all module permissions and convert them into name => label
        $permissions = $this->moduleUtil->getModuleData('superadmin_package');
        $permission_formatted = [];
        foreach ($permissions as $permission) {
            foreach ($permission as $details) {
                $permission_formatted[$details['name']] = $details['label'];
            }
        }

        $action_type = 'register';

        return view('superadmin::subscription.partials.packages')
        ->with(compact('packages', 'permission_formatted', 'action_type'));

        
    }
}
