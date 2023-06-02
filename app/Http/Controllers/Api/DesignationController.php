<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Http\Resources\DesignationResource;
use App\Http\Requests\DesignationRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $designations = Designation::all();
        return DesignationResource::collection($designations);
    }

    public function store(DesignationRequest $request)
    {
        $designation = Designation::create($request->all());

        return response()->json([
            'message' => 'Designation Created successfully',
            'data' => new DesignationResource($designation)
        ]);
    }

    public function update(DesignationRequest $request, Designation $designation): JsonResponse
    {
       
        $designation->fill($request->all());
        $designation->save();

        return $this->success('Designation updated successfully', new DesignationResource($designation));
    }

    public function destroy(Designation $designation)
    {
        $designation->delete();

        return response()->json([
            'message' => 'Designation Deleted successfully',
            'data' => new DesignationResource($designation)
        ]);
    }
}
