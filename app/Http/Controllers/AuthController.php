<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Blog;

class AuthController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:blog-delete', ['only' => ['destroy']]);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }

        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        $check->assignRole('User');

        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if (Auth::check()) {
            //return view('dashboard');
            $user = auth()->user();
            if ($user->hasRole('Admin')) {
                $blogs = Blog::all();
            } else {
                $blogs = Blog::where('user_id', $user->id)->get();
            }

            return view('dashboard')->with('blogs', $blogs);
        }



        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    public function blogDelete($id)
    {
        $blog = Blog::destroy($id);
        return response()->json($blog);
    }

    public function blogEdit($id)
    {
        $link = Blog::find($id);
        return response()->json($link);
    }

    public function blogUpdate(Request $request, $id)
    {
        $user = auth()->user();
        $link = Blog::find($id);
        $link->blog_name = $request->blog_name;
        $link->description = $request->description;
        $link->save();
        $link['can_edit'] = $user->can('blog-edit');
        $link['can_delete'] = $user->can('blog-delete');
        return response()->json($link);
    }

    public function blogcreate(Request $request)
    {
        $user = auth()->user();
        $link = Blog::create($request->all());
        $link['can_edit'] = $user->can('blog-edit');
        $link['can_delete'] = $user->can('blog-delete');
        return response()->json($link);
    }
}
