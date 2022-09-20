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
use Illuminate\Support\File;

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
    public function dashboard(Request $request)
    {
        if (Auth::check()) {
            //return view('dashboard');
            $user = auth()->user();
            if ($request->ajax()) {
                if ($user->hasRole('Admin')) {
                    $blogs = Blog::where('blog_name', 'like', '%' . $request->search . '%')->orWhere('description', 'like', '%' . $request->search . '%')->paginate(5);
                } else {
                    $blogs = Blog::where('user_id', $user->id)->paginate(5);
                }
                return view('blog_table', compact('blogs'))->render();
            } else {
                if ($user->hasRole('Admin')) {
                    $blogs = Blog::paginate(5);
                } else {
                    $blogs = Blog::where('user_id', $user->id)->paginate(5);
                }
                return view('dashboard', ['blogs' => $blogs]);
            }
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
        $link->blog_date = $request->blog_date;
        $link->save();
        $link['can_edit'] = $user->can('blog-edit');
        $link['can_delete'] = $user->can('blog-delete');
        return response()->json($link);
    }

    public function blogcreate(Request $request)
    {

        $user = auth()->user();
        $data = $request->all();
        $path = $request->file('image');
        $image_name = time() . '.' . $path->getClientOriginalExtension();
        $path->move(public_path('images'), $image_name);
        $data['image'] = asset('images/' . $image_name);
        $link = Blog::create($data);
        $link['can_edit'] = $user->can('blog-edit');
        $link['can_delete'] = $user->can('blog-delete');
        return response()->json($link);
    }
}
