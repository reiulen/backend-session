<?php

namespace App\Models;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $q){
            return $query->where('judul', 'like', '%' .$q. '%')
            ->orWhere('isi', 'like', '%' .$q. '%')
            ->orWhere('tag', 'like', '%' .$q. '%');
        });
        
    }

    public function Kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
