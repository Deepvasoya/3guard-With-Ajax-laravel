<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:student')->except('logout');
        $this->middleware('guest:teacher')->except('logout');
    }
    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function showStudentLoginForm()
    {
        return view('auth.login', ['url' => 'student']);
    }

    public function studentLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/student');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function showTeacherLoginForm()
    {
        return view('auth.login', ['url' => 'teacher']);
    }

    public function teacherLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/teacher');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        // $guards = array_keys(config('auth.guards'));
        // dd($guards);
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect()->intended('login/admin');
        } elseif (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
            return redirect()->intended('login/student');
        } else {
            Auth::guard('teacher')->logout();
            return redirect()->intended('login/teacher');
        }
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }
}
