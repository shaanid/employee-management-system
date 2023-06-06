<?php

namespace App\Actions\Employee;


use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StoreEmployeeAction
{
    public function execute(Collection $collection): bool
{
    $input = $collection->all();
    $input['password'] = Hash::make($input['password']);

    if (request()->hasFile('image')) {
        $input['image'] = 'profile_photo' . time() . '.' . request('image')->extension();
        request('image')->storeAs('public/images', $input['image']);
    }

    $user = User::create($input);

    return true;
}
}