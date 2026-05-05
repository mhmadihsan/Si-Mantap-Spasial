<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterOpd extends Model
{
    protected $table = 'master_of_opd';
    protected $fillable = [
        'name',
        'name_akronim',
        'name_of_head',
        'position_head',
        'number_phone',
        'address',
        'poscode',
        'mail_opd',
    ];
}
