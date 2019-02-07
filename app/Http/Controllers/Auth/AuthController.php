<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use Log;

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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
        Log::useFiles(storage_path().'/logs/audits.log');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'last_name'   => 'required|min:2|max:255',
            'first_name'  => 'required|min:2|max:255',
            'username'    => 'required|max:255|min:3|unique:users',
            'email'       => 'required|email|max:255|unique:users',
            'password'    => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      // $finitial = substr($data['first_name'],0,1);
      // $username = strtolower($data['last_name'] . $finitial);

      return User::create([
          'last_name'       => $data['last_name'],
          'first_name'      => $data['first_name'],
          'username'        => $data['username'],
          //'username'        => $username,
          'email'           => $data['email'],
          'password'        => bcrypt($data['password']),
          'selfRegistered'  => $data['selfRegistered'],
      ]);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    // This section of code allows users to log in to the site using either their username or email address //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return 'login';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
      $login = $request->get('login');
      $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

      return [
          $field => $login,
          'password'  => $request->get('password'),
          'active'    => 1,
      ];

    }


    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    // This overrides the default authenticated function to allow for the login_count to be updated when a  //
    // user logs in to the system                                                                           //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function authenticated(Request $request, User $user){
      //put your thing in here
      $id = request()->user()->id;
      $user = User::find($id);
      //$user->last_login = Carbon::now();
      $user->login_count = $user->login_count+1;
      $user->save();

      if (Session::has('oldUrl')) {
        $oldUrl = Session::get('oldUrl');
        Session::forget('oldUrl');
        return redirect()->to($oldUrl);
      } else {

        if ($user->landingPage) {
            if ($user->landingPage == 'home') {
                return redirect()->intended('/');
            }
            if ($user->landingPage == 'dashboard') {
                return redirect()->intended('dashboard');
            }
            if ($user->landingPage == 'profile') {
                return redirect()->intended('profile/'.$user->id.'/show');
            }
            if ($user->landingPage == 'blog') {
                return redirect()->intended('blog');
            }
        }
      }

      return redirect()->intended($this->redirectPath());
    }

    // Overwrite default register function
    // Validate user input and redirect to page
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
              $request, $validator
            );
        }

        //create the account and login the user 
        //$this->auth->login($this->registrar->create($request->all()));

        // create the user
        // $user->selfRegistered == $this->['selfRegistered'];
        $user = $this->create($request->all());

        return redirect()->route('new_reg');
        //return redirect()->route('login');
    }



// // https://gist.github.com/AlexanderPoellmann/61feafa59963854009b7
//     public function postLogin(Request $request)
//     {
//         // get our login input
//         $login = $request->input('login');
//         // check login field
//         $login_type = filter_var( $login, FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';
//         // merge our login field into the request with either email or username as key
//         $request->merge([ $login_type => $login ]);
//         // let's validate and set our credentials
//         if ( $login_type == 'email' ) {
//             $this->validate($request, [
//                 'email'    => 'required|email',
//                 'password' => 'required',
//             ]);
//             $credentials = $request->only( 'email', 'password' );
//         } else {
//             $this->validate($request, [
//                 'username' => 'required',
//                 'password' => 'required',
//             ]);
//             $credentials = $request->only( 'username', 'password' );
//         }
//         //if ($this->auth->attempt($credentials, $request->has('remember')))
//         if (Auth::attempt($credentials, $request->has('remember')))
//         {
//             if (Session::has('oldURL')) {
//               $oldURL = Session::get('oldURL');
//               Session::forget('oldURL');
//               return redirect()->to($oldURL);
//             }
            
//             return redirect()->intended($this->redirectPath());
//         }
//         return redirect($this->loginPath())
//             ->withInput($request->only('login', 'remember'))
//             ->withErrors([
//                 'login' => $this->getFailedLoginMessage(),
//             ]);
//     }


}