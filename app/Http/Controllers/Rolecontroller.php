<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;

class Rolecontroller extends Controller
{
    public function getRole()
{
    $users = User::whereHas('roles', function ($query) {
        $query->where('roles.id', 3);
    })->get();

    return view('role.role',compact('users'));
}
}
