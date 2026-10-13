<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaPage extends Model
{
    protected $fillable = [
        'page_title',
        'page_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'shortcut_icon',
        'status',
    ];
}
