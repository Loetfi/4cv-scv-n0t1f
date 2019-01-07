<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Helpers\Api;
use App\Mail\EmailSendgrid;
use App\Repositories\SendgridRepo;

class NotifController extends Controller
{
	/**
	* @param body,to
	* @param cc, subject attachment can be null
	* @return response json  
	*/
	public function sendEmail(Request $request)
	{
		$validation = $this->validate($request, [
	        'Subject'		=> 'required', 
	        'Body'       	=> 'required',
	        'To'  			=> 'required|email',
	        'Cc'  	 		=> 'email',
	    ]);

		try {
			$data = [
				'Subject' 		=> $request->subject,
				'Body' 			=> $request->body,
				'To' 			=> $request->to,
				'Cc'			=> $request->cc ? $request->cc : null,
				'Attachment' 	=> $request->attacment ? $request->attacment : null, // belom kelar
				'Campaign'		=> $request->campaign ? $request->campaign : null, 
				'IsUsed'		=> 0,
				'CreatedAt'    	=> \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
			];

			// send to email
        	Mail::to($request->to)->send(new EmailSendgrid($data));
        	// save to db
        	SendgridRepo::SaveNotif($data);
        	
        	$status   		= 1;
            $httpcode 		= 200;
            // $data 			= ['email' => SendgridRepo::SaveNotif($data)];
            $data 			= [];
            $errorMsg 		= 'Cek email anda untuk aktivasi akun';
		
		} catch (\Exception $e) {
        	
			$status   = 0;
            $httpcode = 500;
            $data     = [];
            $errorMsg = $e->getMessage();
		}

    	return response()->json(Api::format($status,$data, $errorMsg), $httpcode);	
	}
}