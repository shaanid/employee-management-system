<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;

class Rolecontroller extends Controller
{
    public function getRole()
{
    $users = User::UserRole(3)->get();

    return view('role.role',compact('users'));
}
}
