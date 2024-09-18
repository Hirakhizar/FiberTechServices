<?php

namespace App\Http\Controllers;

use App\Mail\ServiceQuoteMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function serviceQuoteMail(Request $request){
        // return response()->json($request, 200);
        $data=$request;
        Mail::to('ashabbar411@gmail.com')->send(new ServiceQuoteMail($data));
        return response()->json('mail sended success fully', 200);
    }
}
