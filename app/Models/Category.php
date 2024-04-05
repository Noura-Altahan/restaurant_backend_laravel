<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'menu_id'
    ];
    public function menus()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
