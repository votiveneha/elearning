<?php

namespace App\Http\Controllers\AdminAuth;

use App\Admin;

use App\Http\Controllers\Controller;

use DB;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use PHPMailer\PHPMailer;

use Redirect;

use Session;

use Validator;

use Mail;



class AuthController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | Registration & Login Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles the registration of new users, as well as the

    | authentication of existing users. By default, this controller uses

    | a simple trait to add these behaviors. Why don't you explore it?

    |

    */



 

    /**

     * Where to redirect users after login / registration.

     *

     * @var string

     */





    protected $redirectTo = '/admin/dashboard';

    protected $redirectAfterLogout = '/admin/login';

    protected $guard = 'admin';





    /**

     * Create a new authentication controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);

    }




    public function login(Request $request)
    {
        $request->validate([

            "email" => "required",

            "password" => "required"

        ]);
        $remember = $request->remember;

        if (Auth::guard("admin")->attempt(["email" => $request->email,"password" => $request->password])) {
            

            if (Auth::guard("admin")->user()->status==0) {

                Auth::guard("admin")->logout();

                return redirect()->back()->with("warning","Your account is not activated by administrator.");   

            }
            if($remember){
                setcookie("email", $request->email, time() + 3600); 

                setcookie("password", $request->password, time() + 3600);

                setcookie("remember", 1, time() + 3600);
            }else{

         setcookie ("email", "", time() - 3600);
         setcookie ("password", "", time() - 3600);
         setcookie ("remember", "", time() - 3600);

         }    

            return redirect()->route("admin.dashboard");

        }else{

             Session::flash('message', "Credentails do not matches our record");

            return redirect()->back()->withErros(["email" => "Credentails do not matches our record."]);

        }

    }





























}

