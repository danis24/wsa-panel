<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'user_id', 'settings_name', 'config_data',
    ];
}
