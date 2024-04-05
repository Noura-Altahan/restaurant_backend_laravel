<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'name',
        'description',
        'image',
        'subcategory_id',
        'price',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,'subcategory_id','id');
    }
}
