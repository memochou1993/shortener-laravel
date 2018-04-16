<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkInfo extends Model
{
    protected $table = 'link_infos';

    protected $fillable = [
        'clicks',
    ];
}
