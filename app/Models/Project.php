<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $q){
            return $query->where('judul','like', '%' .$q. '%')
                        ->orWhere('deskripsi', 'like', '%' .$q. '%')
                        ->orWhere('link', 'like', '%' .$q. '%');
        });
    }
}
