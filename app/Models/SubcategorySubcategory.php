<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcategorySubcategory extends Model
{
    protected $table = 'subcategory_subcategory';

    protected $fillable = [
        'parent_subcategory_id',
        'child_subcategory_id',
    ];
}
