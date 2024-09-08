<?php

namespace App\Http\Controllers;

use App\Models\ServiceDetail;
use Illuminate\Http\Request;

class ServiceDetailApiController extends Controller
{
    public function index()
    {
        $serviceDetails = ServiceDetail::with('service')->get();

        if ($serviceDetails->isEmpty()) {
            return response()->json(['error' => 'No service details found'], 404);
        }

        return response()->json($serviceDetails, 200);
    }

   
    public function show($id)
    {
        $serviceDetail = ServiceDetail::with('service')->find($id);

        if (!$serviceDetail) {
            return response()->json(['error' => 'Service detail not found'], 404);
        }

        return response()->json($serviceDetail, 200);
    }
}
