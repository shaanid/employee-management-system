<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use \App\Models\designation;
use \App\Models\user;
use App\DataTables\UsersDataTable;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use Illuminate\Support\Facades\Hash;
use App\Actions\Employee\StoreEmployeeAction;
use App\Actions\Employee\UpdateEmployeeAction;


class EmployeeController extends Controller
{

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('employee.employeeView');
    }

    public function create()
    {
        $roles = Designation::get();

        return view('employee.employeeRegister', compact('roles'));
    }

    public function store(AdminRequest $request, StoreEmployeeAction $storeemployeeaction)
    {
        $storeemployeeaction->execute(collect($request->validated()));

        return redirect()
        ->route('employee-details.index')
        ->with('message', "Successfully Added");
    }

    public function edit(User $user)
    {
        $designations = Designation::get();
        return view('employee.employeeEdit', compact('user', 'designations'));
    }

    public function update(UpdateEmployeeRequest $request, User $user, UpdateEmployeeAction $UpdateEmployeeAction)
    {
        $collection = collect($request->validated());
        $UpdateEmployeeAction->execute($collection, $user);

        return redirect()->route('employee-details.index')
            ->with('success', "Successfully updated");
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('employee-details.index');
    }


    public function updateStatus(Request $request)
    {
        $user = User::find($request->input('userId'));
        $user->status = $request->input('status');
        $user->save();
    }


    public function dashboard()
    {
        $totalEmployees = User::count();
        $totaldesignation = Designation::count();
        $activeMembers = User::where('status', 'active')->get();
        $inactiveMembers = User::where('status', 'inactive')->get();

        return View(
            'admin.dashboard',
            [
                'totalEmployees' => $totalEmployees,
                'totaldesignation' => $totaldesignation,
                'activeMembers' => $activeMembers,
                'inactiveMembers' => $inactiveMembers,
            ]
        );
    }

    public function deleteSelected(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        User::whereIn('id', $selectedIds)->delete();

        return response()
            ->json(['success' => 'users deleted successfully.']);
    }

    public function exportUsersCSV()
    {
        return Excel::download(new UserExport, 'users.csv');
    }
}
