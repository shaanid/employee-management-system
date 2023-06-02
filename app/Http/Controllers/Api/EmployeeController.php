<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $employee = User::all();
        return EmployeeResource::collection($employee);
    }

    public function store(AdminRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));
        $employee = User::create($data);

        return response()->json([
            'message' => 'Employee Created successfully',
            'data' => new EmployeeResource($employee)
        ]);
    }

    public function update(AdminRequest $request, User $user): JsonResponse
    {
        $data = $request->all();
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }
        $user->fill($data);
        $user->save();

        return $this->success('Employee updated successfully', new EmployeeResource($user));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'Employee Deleted successfully',
            'data' => new EmployeeResource($user)
        ]);
    }
}
