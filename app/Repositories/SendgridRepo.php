<?php

namespace App\Repositories;

use Illuminate\Database\QueryException;
use App\Models\Email as EmailDB; 

class SendgridRepo
{
	
	public static function SaveNotif($data)
	{
		try {
			return EmailDB::create($data);
		} catch (Exception $e) {
			throw new \Exception($e->getMessage(), 500);
		}
	}
}
