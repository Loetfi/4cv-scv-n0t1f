<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
	protected $table = 'email';

	protected $primaryKey = 'EmailId';

    protected $fillable = [
        'Subject', 'To','Body','Cc','Attacment','Campaign','IsUsed'
    ];

    protected $dates = [
        'CreatedAt',
        'UpdatedAt'
    ];
}