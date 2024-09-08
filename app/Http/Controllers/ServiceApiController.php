<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceApiController extends Controller
{
    public function index()
    {
        $services = Service::with(['keyPoints', 'details'])->get();
        
        if ($services->isEmpty()) {
            return response()->json(['error' => 'No services found'], 404);
        }

        return response()->json($services, 200);
    }
    
public function show($id)
{
    $service = Service::with(['keyPoints', 'details'])->find($id);
    if (!$service) {
        return response()->json(['error' => 'Service not found'], 404);
    }
    return response()->json($service, 200);
}
}
