<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;
    protected $fillable = [
        'installation_fees',
        'material_and_furniture_proposals_id',
        'grand_total',
        'vat_fee',
        'total_amount',
        'design_fee',
        'furniture_total'
    ];
}
