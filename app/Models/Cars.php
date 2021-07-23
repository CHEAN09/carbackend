<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'brand',
        'acquired_on',
        'status',
        'user_id'
    ];
    public function container() {
        return $this->belongsTo('App\Models\Cars', 'contained_in', 'id');
    }
}
