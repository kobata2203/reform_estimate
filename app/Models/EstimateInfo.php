<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Htpp\Controllers\EstimateController;

class EstimateInfo extends Model
{
    protected $table = 'estimate_info'; // Ensure this matches your table name
    protected $fillable = [
<<<<<<< HEAD
        'customer_name', 'creation_date', 'construction_name', 'charger_name', 'department_name', 'expiration_date'
    ]; // Add all relevant columns here
=======
        'creation_date',
        'customer_name',
        //'construction_name',
        'charger_name',
        'department_name',
        'subject_name',
        'delivery_place',
        'construction_period',
        'payment_type',
        'expiration_date',
        'remarks',
        //'construction_item',
        //'specification',
        //'quantity',
        //'unit',
        //'unit_price',
        //'amount',
        //'remarks2',
    ];

    public function construction_name()
    {
    return $this->belongsTo('App\Models\ConstructionName');
    }

    public function breakdown()
    {
    return $this->hasMany('App\Models\Breakdown');
    }

>>>>>>> 77cf654eba123dafc4e50cdcfded18a332b3b0f6
}
