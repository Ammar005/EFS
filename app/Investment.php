<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    //
    protected $fillable=[
    	'customer_id',
    	'category',
    	'description',
        'acquired_value',
        'Acquired_Date',
        'Recent_Value',
        'Recent_Date',

    ];

     public function customer() {
        return $this->belongsTo('App\Customer');
    }
}
