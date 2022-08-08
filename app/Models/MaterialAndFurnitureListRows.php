<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialAndFurnitureListRows extends Model
{
    use HasFactory;
    protected $fillable = [
        'material_and_furniture_list_row_id' ,
        "s_no" ,
        "item_category" ,
        "size" ,
        "material_description" ,
        "photo",
        "unit" ,
        "qty" ,
        "currency" ,
        "unit_price" ,
        "brands",
        "website_links" ,
        'total_price'
    ];
}
