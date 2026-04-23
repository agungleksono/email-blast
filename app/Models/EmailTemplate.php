<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'subject',
        'sender_mail',
        'sender_name',
        'recipient_mail_test',
        'signature_name',
        'upper_body',
        'lower_body',
        'body_img',
        'signature_img',
    ];
}
