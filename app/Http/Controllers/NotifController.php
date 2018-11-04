<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Helpers\Api;
use App\Mail\EmailSendgrid;
use App\Repositories\SendgridRepo;

class NotifController extends Controller
{

	public function __construct()
	{

	}

	public function sendEmail()
	{
		try {

			$dataEmailSendgrid = [
				'Body' 		=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
				'Subject' 	=> 'Lorem Ipsum Dolor sit amet',
				'To' 		=> 'ahmaddjunaedi92@gmail.com',
				// 'Cc'		=> 'ahmaddjunaedi92@gmail.com',
				// 'Attacment' => 
			];

        	Mail::to('ahmaddjunaedi92@gmail.com')->send(new EmailSendgrid($dataEmailSendgrid));

        	$status   		= 1;
            $httpcode 		= 200;
            $data 			= ['email' => SendgridRepo::create($data)];
            $errorMsg 		= null;
		
		} catch (Exception $e) {
        	
			$status   = 0;
            $httpcode = 500;
            $data     = [];
            $errorMsg = $e->getMessage();
		}

    	return response()->json(Api::format($status,$data, $errorMsg), $httpcode);	
	}
}