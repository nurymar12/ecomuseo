<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'author_id', 'status'];


    public function components()
{
    return $this->belongsToMany(Components::class, 'blog_component', 'blog_id', 'component_id');
}


    // Relación con el autor/usuario
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

}
