<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSpasial extends Model
{
    protected $table = 'general_spasial';

    protected $fillable = [
        'name_of_region',
        'name_of_province',
        'url_domain',
    ];
}
