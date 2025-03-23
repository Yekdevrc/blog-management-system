<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'author_id',
        'published_at',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
