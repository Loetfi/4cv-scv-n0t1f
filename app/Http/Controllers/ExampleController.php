<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSendgrid;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function sendEmail()
    {
        $data = ['message' => '<b><i>This is a test!</i></b>'];
        // print_r($data);die();

        Mail::to('lutfi.f.hidayat@gmail.com')->send(new EmailSendgrid($data));
    }
}
