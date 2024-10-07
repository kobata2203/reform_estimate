<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateInfo extends Model
{
    use HasFactory;

    protected $table = 'estimate_info'; // Your table name
    protected $fillable = [
        'customer_name',
         'creation_date',
         'subject_name',
         'delivery_place',
         'construction_period',
         'payment_type',
         'expiration_date',
         'remarks',
         'charger_name',
         'department_name',
         'construction_name',
     ];

    // Define relationship
    public function breakdowns()
    {
        return $this->hasMany(Breakdown::class, 'estimate_id'); // Adjust foreign key if necessary
    }
}
