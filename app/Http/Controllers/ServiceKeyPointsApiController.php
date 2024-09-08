<?php

namespace App\Http\Controllers;

use App\Models\ServiceKeyPoint;
use Illuminate\Http\Request;

class ServiceKeyPointsApiController extends Controller
{
    public function index()
    {
        $serviceKeyPoints = ServiceKeyPoint::with('service')->get();

        if ($serviceKeyPoints->isEmpty()) {
            return response()->json(['error' => 'No service key points found'], 404);
        }

        return response()->json($serviceKeyPoints, 200);
    }


    public function show($id)
    {
        $serviceKeyPoint = ServiceKeyPoint::with('service')->find($id);

        if (!$serviceKeyPoint) {
            return response()->json(['error' => 'Service key point not found'], 404);
        }

        return response()->json($serviceKeyPoint, 200);
    }
}
