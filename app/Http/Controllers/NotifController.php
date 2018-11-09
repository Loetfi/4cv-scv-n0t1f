<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Helpers\Api;
use App\Mail\EmailSendgrid;
use App\Repositories\SendgridRepo;

class NotifController extends Controller
{

	public function __construct()
	{

	}

	public function sendEmail(Request $request)
	{
		try {
			// print_r($request->all());
			$data = [
				'Body' 		=> $request->body,
				'Subject' 	=> $request->subject ? $request->subject : null,
				'To' 		=> $request->to,
				'Cc'		=> $request->cc ? $request->cc : null,
				'Attachment' => $request->attacment ? $request->attacment : null,
			];

        	Mail::to($request->to)->send(new EmailSendgrid($data));

        	$status   		= 1;
            $httpcode 		= 200;
            $data 			= ['email' => SendgridRepo::SaveNotif($data)];
            $errorMsg 		= 'Please check your email to active account';
		
		} catch (Exception $e) {
        	
			$status   = 0;
            $httpcode = 500;
            $data     = [];
            $errorMsg = $e->getMessage();
		}

    	return response()->json(Api::format($status,$data, $errorMsg), $httpcode);	
	}
}