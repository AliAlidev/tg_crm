<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignServices extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'stage_a',
        'stage_b',
        'stage_c',
        'stage_d',
        'Subtotal',
        'vat',
        'grand_total',
        'is_paid'
    ];
}
