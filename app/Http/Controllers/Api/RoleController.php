<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RoleController extends Controller
{
    public function getRole()
    {
        $users = User::UserRole(3)->get();

        return response()->json($users);
}
}
