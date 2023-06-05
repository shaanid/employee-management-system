<?php

namespace App\Actions;

use App\Http\Requests\DesignationRequest;
use App\Models\Designation;

class DesignationAction
{
    public function execute(DesignationRequest $request)
    {
        $designation = Designation::create($request->all());
        
        return redirect()->route('designation-details.index')
            ->with('success', "Successfully Added");
    }

    public function update(DesignationRequest $request, Designation $designation)
    {
        $designation->update($request->all());

        return redirect()->route('designation-details.index')
            ->with('message', 'Successfully updated');
    }

    public function destroy(Designation $designation)
    {
        $designation->delete();

        return redirect()
            ->route('designation-details.index');
    }
}
