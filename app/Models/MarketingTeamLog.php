<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class MarketingTeamLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='MarketingTeamLog';
    protected $fillable = [
        'product_id', 'product_name', 'slug', 'update_price', 'old_price', 'username','ip'
    ];
}