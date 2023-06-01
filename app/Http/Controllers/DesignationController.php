<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Designation;
use App\DataTables\DesignationDataTable;
use App\Http\Requests\DesignationRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DesignationExport;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Response;



class DesignationController extends Controller
{

    public function index(DesignationDataTable $dataTable)
    {
        return $dataTable->render('designation.designationView');
    }

    public function create()
    {
        return view('designation.designationAdd');
    }

    public function store(DesignationRequest $request)
    {
        $roles = Designation::create([
            'designation' => $request->designation,
        ]);

        return redirect()->route('designation-details.index')
            ->with('success', "Successfully Added");
    }

    public function edit(Designation $designation)
    {
        return view('designation.designationEdit', compact('designation'));
    }

    public function update(DesignationRequest $request, Designation $designation)
    {
        $designation->update($request->all());

        return redirect()
            ->route('designation-details.index')
            ->with('message', "Successfully updated");
    }

    public function destroy(Designation $designation)
    {
        $designation->delete();

        return redirect()
            ->route('designation-details.index');
    }

    public function deleteSelected(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        Designation::whereIn('id', $selectedIds)->delete();

        return response()
            ->json(['success' => 'Designations deleted successfully.']);
    }

    public function exportDesignationsCSV()
    {
        return Excel::download(new DesignationExport, 'designations.csv');
    }
}
