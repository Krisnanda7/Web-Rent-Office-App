<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OfficeSpaceResource;
use App\Models\OfficeSpace;
use Illuminate\Http\Request;

class OfficeSpaceController extends Controller
{
    //
    public function index()
    {
        $officeSpace = OfficeSpace::with('city')->get();
        return OfficeSpaceResource::collection($officeSpace);
    }

    public function show(OfficeSpace $officeSpace) //model binding
    {
        $officeSpace->load(['city', 'photos', 'benefits']);
        return new OfficeSpaceResource($officeSpace);
    }


    
    public function showBySlug($slug)
    {
        $officeSpace = OfficeSpace::with(['city', 'photos', 'benefits'])
            ->where('slug', $slug)
            ->first();

        if (! $officeSpace) {
            return response()->json([
                'message' => 'Office not found'
            ], 404);
        }

        return new OfficeSpaceResource($officeSpace);
    }
}
