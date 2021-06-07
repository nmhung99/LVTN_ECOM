<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class GroupProduct extends Model
{
    protected $fillable = [
            'brand_id', 'group_name'
        ];
}
