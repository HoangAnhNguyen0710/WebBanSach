<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    protected $fillable = [
        'id',
        "created_at",
        "updated_at",
        "category_name",
    ];

    public function books(){
        return $this->hasMany(Book::class, 'category_id');
    }

    public $timestamps = true;
}
