<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class LogActivity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='log_activity';
    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'user_id'
    ];
}