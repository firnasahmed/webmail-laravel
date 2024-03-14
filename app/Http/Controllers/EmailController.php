<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Email;
use App\Mail\SendEmail;

use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    public function create(){
            return view('new-email');
        }

    public function dashboard(){
        $emails = Email::paginate(5);
        return view('dashboard', compact('emails'));
    }

    public function send(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'recipients' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

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

        // Redirect back with success message
        return redirect()->back()->with('success', 'Email(s) sent successfully.');
    }

}
