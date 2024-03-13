<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{
    public function create(){
            return view('new-email');
        }

    public function dashboard(){
        $emails = Email::paginate(5);
        return view('dashboard', compact('emails'));
    }

}
