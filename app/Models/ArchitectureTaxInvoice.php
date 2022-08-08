<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchitectureTaxInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
    'material_and_furniture_proposals_id',
    'code',
    'date',
    'terms_and_conditions'
    ];
}
