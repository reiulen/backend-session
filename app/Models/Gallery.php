<?php

namespace App\Models;

use App\Models\Gambar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
    
    public function gambar()
    {
        return $this->hasMany(Gambar::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $q){
            return $query->where('judul', 'like', '%' .$q.'%');
        });
    }

}
