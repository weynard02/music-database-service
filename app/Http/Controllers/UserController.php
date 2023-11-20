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

    public function show($id) {
        $user = User::findorfail($id);
        return view('admin.showUser', compact('user'));
    }

    public function destroy($id) {
        $user = User::findorfail($id);
        $user->delete();
        return redirect('/admin/users')->with('success', 'Delete successfully!');
    }
}
