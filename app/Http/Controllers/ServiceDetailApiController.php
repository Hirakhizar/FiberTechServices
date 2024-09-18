<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceDetail;
use Exception;
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
        try {
            $serviceDetails=Service::where('id',$id)->with(['details','keyPoints'])->get();
            return response($serviceDetails,200);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
           return response()->json([
            'error' => 'An error occurred while retrieving the services.',
            'message' => $e->getMessage()
        ], 500);

        return response()->json($serviceDetail, 200);
    }
}

    public function services(){

    try {
        $services=Service::get();
        return response($services,200);
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
       return response()->json([
        'error' => 'An error occurred while retrieving the services.',
        'message' => $e->getMessage()
    ], 500);
}

}
}
