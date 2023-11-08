<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all()->sortBy('name');
        return view('admin.users', compact('users'));
    }
}
