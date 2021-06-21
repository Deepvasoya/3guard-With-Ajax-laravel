<?php

namespace App\Http\Controllers\Auth;

use App\Models\Subject;
use App\Models\Standard;
use App\Models\Student;
use App\Models\Teacher;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:student');
        $this->middleware('guest:teacher');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showStudentRegisterForm()
    {
        $standard = Standard::all();
        $url = 'student';
        return view('Student.register', compact('standard', 'url'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTeacherRegisterForm()
    {
        $subject = Subject::all();
        $url = 'teacher';
        return view('Teacher.register', compact('subject', 'url'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function createStudent(Request $request)
    {
        $this->validator($request->all())->validate();
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'enrollno' => $request->enrollno,
            'standard' => $request->standard,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->intended('login/student');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function createTeacher(Request $request)
    {
        $this->validator($request->all())->validate();
        Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->intended('login/teacher');
    }
}
