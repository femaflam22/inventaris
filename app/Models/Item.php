<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Lending;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'repair_total',
        'total',
        'available_total',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function lendings() {
        return $this->hasMany(Lending::class);
    }
}
