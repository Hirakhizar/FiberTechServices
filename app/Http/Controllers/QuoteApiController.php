<?php

namespace App\Http\Controllers;

use App\Mail\QuoteRequestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuoteApiController extends Controller
{


    public function sendEmail(Request $request)
    {
        $data = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message'),
        ];
    
        Mail::to('hirakhizarkhizarhayat@gmail.com')->send(new QuoteRequestEmail($data));
    
 
    return response()->json([
        'message' => 'Email sent successfully to ' . $data['email']
    ], 200);
}

}
        

