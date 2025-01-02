<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Rules\ReCaptcha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;



class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * All Utils instance.
     */
    protected $businessUtil;

    protected $moduleUtil;

    /**
     * Create a new controller instance.
     *
     * @param BusinessUtil $businessUtil
     * @param ModuleUtil $moduleUtil
     */
    public function __construct(BusinessUtil $businessUtil, ModuleUtil $moduleUtil)
    {
        $this->middleware('guest')->except('logout');
        $this->businessUtil = $businessUtil;
        $this->moduleUtil = $moduleUtil;
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Change authentication from email to username.
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Handle user logout.
     */
    public function logout()
    {
        $this->businessUtil->activityLog(auth()->user(), 'logout');

        request()->session()->flush();
        \Auth::logout();

        return redirect('/login');
    }

    /**
     * Validate login request.
     */
    public function validateLogin(Request $request)
    {
        $rules = [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ];

        if (config('constants.enable_recaptcha')) {
            $rules['g-recaptcha-response'] = ['required', new ReCaptcha];
        }

        $this->validate($request, $rules);
    }

    /**
     * Attempt to log the user into the application with "Remember Me".
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $remember = $request->has('remember'); // Check if "Remember Me" is checked
         if($request->has('remember'))
        {
            cookie::queue('adminuser',$request->username,1440);
            cookie::queue('adminpwd',$request->password,1440);
        } else {
        // Clear the cookies if remember me is not checked
            Cookie::queue(Cookie::forget('adminuser'));  // Delete the cookie
            Cookie::queue(Cookie::forget('adminpwd'));   // Delete the cookie
        }

        return \Auth::attempt($credentials, $remember);
    }

    /**
     * The user has been authenticated.
     * Check if the business is active or not.
     */
    protected function authenticated(Request $request, $user)
    {
        
        if ($request->has('remember')) {
            Log::info('Remember Me token: ' . $user->remember_token);
        }
    
        $this->businessUtil->activityLog($user, 'login', null, [], false, $user->business_id);

        if (!$user->business->is_active) {
            \Auth::logout();
            return redirect('/login')->with('status', [
                'success' => 0,
                'msg' => __('lang_v1.business_inactive'),
            ]);
        } elseif ($user->status != 'active') {
            \Auth::logout();
            return redirect('/login')->with('status', [
                'success' => 0,
                'msg' => __('lang_v1.user_inactive'),
            ]);
        } elseif (!$user->allow_login) {
            \Auth::logout();
            return redirect('/login')->with('status', [
                'success' => 0,
                'msg' => __('lang_v1.login_not_allowed'),
            ]);
        } elseif (
            ($user->user_type == 'user_customer') &&
            !$this->moduleUtil->hasThePermissionInSubscription($user->business_id, 'crm_module')
        ) {
            \Auth::logout();
            return redirect('/login')->with('status', [
                'success' => 0,
                'msg' => __('lang_v1.business_dont_have_crm_subscription'),
            ]);
        }
    }

    /**
     * Redirect the user after login.
     */
    protected function redirectTo()
    {
        $user = \Auth::user();

        if (!$user->can('dashboard.data') && $user->can('sell.create')) {
            return '/pos/create';
        }

        if ($user->user_type == 'user_customer') {
            return 'contact/contact-dashboard';
        }

        return '/home';
    }
}
