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
use App\Actions\Designation\StoreDesignationAction;
use App\Actions\Designation\UpdateDesignationAction;
use App\Actions\Designation\DestroyDesignationAction;

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

    public function store(DesignationRequest $request, StoreDesignationAction $StoreDesignationAction)
    {
        $StoreDesignationAction->execute(collect($request->validated()));

        return redirect()->route('designation-details.index')
            ->with('success', "Successfully Added");
    }

    public function edit(Designation $designation)
    {
        return view('designation.designationEdit', compact('designation'));
    }

    public function update(DesignationRequest $request, Designation $designation, UpdateDesignationAction $updateDesignationAction)
    {
        $collection = collect($request->validated());
        $updateDesignationAction->execute($collection, $designation);

        return redirect()
            ->route('designation-details.index')
            ->with('message', 'Successfully updated');
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
