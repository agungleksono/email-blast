<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSchedule extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'company_name',
        'pic',
        'email',
        'website',
        'company_address',
        'email_schedule',
        'subject',
        'section',
        'product',
        'email_intro',
        'form_1',
        'form_3',
        'email_type',
    ];
}
