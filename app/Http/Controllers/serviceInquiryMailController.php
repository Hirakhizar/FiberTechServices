<?php


namespace App\Http\Controllers;

use App\Mail\QuoteRequestedMail;
use App\Mail\ServiceInquiryMail;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class serviceInquiryMailController extends Controller
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
    
        Mail::to('ashabbar439@gmail.com')->send(new ServiceInquiryMail($data));
    
 
    return response()->json([
        'message' => 'Email sent successfully  '
    ], 200);
}
public function getQuote(Request $request){
    {
        // Validate request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'service_id' => 'required|exists:services,id',
        ]);

        // Fetch service name
        $service = Blog::find($validated['service_id']);
        $serviceName = $service->description;

        // Prepare email data
        $emailData = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'service_name' => $serviceName,
        ];

        // Send email to admin
        Mail::to('hirakhizarkhizarhayat@gmail.com')->send(new QuoteRequestedMail($emailData));

        return response()->json(['message' => 'Quote request sent successfully.'], 200);
    }

}

}
