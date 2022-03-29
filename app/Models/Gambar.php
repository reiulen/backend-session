<?php

namespace App\Models;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gambar extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
