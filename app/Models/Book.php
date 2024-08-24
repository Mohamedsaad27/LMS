<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = ['subject_id', 'title', 'author', 'publication_year','cover_image','description'];
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
