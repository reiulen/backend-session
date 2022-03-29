<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['q'] ?? false, function($query, $q){
            return $query->where('kategori', 'like', '%' .$q. '%');
        });
    }

}
