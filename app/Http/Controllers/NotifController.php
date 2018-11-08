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
				'Subject' 	=> 'ACV - Active Account',
				'To' 		=> $request->to,
				'Cc'		=> $request->Cc ? $request->Cc : null,
				// 'Attacment' => 
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