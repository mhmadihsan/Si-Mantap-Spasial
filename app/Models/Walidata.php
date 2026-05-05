<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Walidata extends Model
{
    protected $table = 'walidata_profile';

    protected $fillable = [
        'is_active',
        'name',
        'position',
        'agency',
        'number_phone',
        'fax_mail',
        'address',
        'name_of_district',
        'pos_code',
        'province_name',
        'mail_agency',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
