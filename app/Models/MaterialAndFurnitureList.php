<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialAndFurnitureList extends Model
{
    use HasFactory;
    protected $fillable = [
        'material_and_furniture_proposals_id',
        'title',
        'note',
        'total'
    ];
    public function MaterialAndFurnitureListrow(){
        return $this->hasMany(MaterialAndFurnitureListRows::class,'material_and_furniture_list_row_id');
    }

}
