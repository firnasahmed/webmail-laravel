<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Email;
use App\Mail\SendEmail;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function create(){
        return view('new-email');
    }

    public function dashboard(){
        $emails = Email::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard', compact('emails'));
    }
    
    public function send(Request $request)
    {
        // Validate the form inputs
        $validator = Validator::make($request->all(), [
            'recipients' => ['required', function ($attribute, $value, $fail) {
                $emails = explode(',', $value);
                foreach ($emails as $email) {
                    if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                        $fail('One or more email addresses are invalid.');
                    }
                }
            }],
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Split the recipient emails by comma
        $recipients = explode(',', $request->input('recipients'));

        // Loop through each recipient and send the email
        foreach ($recipients as $recipient) {
            try {
                // Send email with message content
                Mail::to(trim($recipient))->send(new SendEmail($request->input('subject'), $request->input('message')));

                // Store data in the database
                Email::create([
                    'recipient' => trim($recipient),
                    'subject' => $request->input('subject'),
                    'message' => $request->input('message'),
                    'status' => 'sent', 
                ]);
            } catch (\Exception $e) {
                // Handle any exceptions and update status as error
                Log::error('Error sending email: ' . $e->getMessage());
                
                Email::create([
                    'recipient' => trim($recipient),
                    'subject' => $request->input('subject'),
                    'message' => $request->input('message'),
                    'status' => 'error',
                ]);
            }
        }

        // Redirect to dashboard upon successful email sending
        return redirect()->route('dashboard')->with('success', 'Email(s) sent successfully.');
    }
}
