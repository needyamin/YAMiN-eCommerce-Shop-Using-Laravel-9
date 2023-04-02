<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class theme_settings extends Model
{
    protected $table='themesettings';
    protected $fillable=[
        'website_title',
        'website_description',
        'header_meta_code',
        'logo',
        'footer_text',
        'social_links',
        'theme_color',
    ];
}
