<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_Invoice extends Model
{
    use HasFactory;
    protected $table = "supplier__invoices";
    protected $fillable = [
        'project_id',
        'supplier_id',
        'path',
        'number',
        'total_payment',
        'advanced_payment'
    ];
}
