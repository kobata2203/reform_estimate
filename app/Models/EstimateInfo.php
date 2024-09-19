<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Htpp\Controllers\EstimateController;

class EstimateInfo extends Model
{
    protected $table = 'estimate_info'; // Ensure this matches your table name
    protected $fillable = [
        'customer_name', 'creation_date', 'construction_name', 'charger_name', 'department_name', 'expiration_date'
    ]; // Add all relevant columns here
}
