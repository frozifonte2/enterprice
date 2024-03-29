<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';
    protected $guarded = false;
    protected $fillable = [
        'article', 'name', 'status', 'data'
    ];
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')->orderBy('id', 'desc');
    }

}
