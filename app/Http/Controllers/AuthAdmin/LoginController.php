<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers {
        logout as doLogout;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('authAdmin/login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
  
        $fieldType = filter_var($request->username, FILTER_VALIDATE_BOOLEAN) ? 'email' : 'UserID';
        if(Auth::guard('admin')->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
        {
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()
                ->with('error','These credentials do not match our records.');
        }
          
    }

    public function logout(Request $request)
    {
        $this->doLogout($request);

        return redirect('/dash');
    }
}
