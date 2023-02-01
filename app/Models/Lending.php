<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\User;

class Lending extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'user_id',
        'date',
        'return_date',
        'ket',
        'total_item',
        'name',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
