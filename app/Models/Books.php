<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';
    protected $fillable = [
        'id',
        "created_at",
        "updated_at",
        "type",
        "category_id",
        "publisher_id",
        "name",
        "author_name",
        "pages",
        "in_stock",
        "sold",
        "number_of_copies",
        "language",
        "description",
        "display",
        "price",
        "discount_price"
    ];

    protected $casts = [
        'price' => 'long',
        'discount_price' => 'long',
        'display' => 'boolean',
        'sold' => 'integer',
        'number_of_copies' => 'integer',
        'pages' => 'integer',
        'in_stock' => 'integer'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function publisher(){
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }
    public $timestamps = true;
}
