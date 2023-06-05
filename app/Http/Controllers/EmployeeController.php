<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use \App\Models\designation;
use \App\Models\user;
use App\DataTables\UsersDataTable;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use Illuminate\Support\Facades\Hash;
use App\Actions\EmployeeAction;


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

    public function store(AdminRequest $request, EmployeeAction $employeeAction)
    {
        return $employeeAction->execute($request);
    }

    public function edit(User $user)
    {
        $designations = Designation::get();
        return view('employee.employeeEdit', compact('user', 'designations'));
    }

    public function update(Request $request, User $user, EmployeeAction $employeeAction)
    {
        return $employeeAction->update($request, $user);
    }

    public function destroy(User $user, EmployeeAction $employeeAction)
    {
      return $employeeAction->destroy($user);
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
