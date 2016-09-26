<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Book extends Model
{
    protected $table = "books";
    protected $fillable = ['isbn10', 'isbn13', 'name', 'athor', 'description'];
}
