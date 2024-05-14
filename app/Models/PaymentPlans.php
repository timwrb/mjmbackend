<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPlans extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration',
        'description',
        'features',
    ];
}
