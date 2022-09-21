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

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(2);
        return view('welcome', ['blogs' => $blogs]);
    }
}
