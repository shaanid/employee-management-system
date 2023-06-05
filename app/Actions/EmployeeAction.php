<?php

namespace App\Actions;

use App\Http\Requests\AdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeeAction
{
    public function execute(AdminRequest  $request)
    {
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'position_id' => $request->position_id,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
        ];

        if (request()->hasFile('image')) {
            $input['image'] = 'profile_photo' . time() . '.' . request('image')->extension();
            request('image')->storeAs('public/images', $input['image']);
        }

        $datas = User::create($input);

        return redirect()
            ->route('employee-details.index')
            ->with('message', "Successfully Added");
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('employee-details.index')
            ->with('success', "Successfully updated");
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('employee-details.index');
    }
}