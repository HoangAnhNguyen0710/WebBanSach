<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'publishers';
    protected $fillable = [
        'id',
        "created_at",
        "updated_at",
        "publisher_name",
        "establishment_day",
        "website"
    ];

    protected $casts = [
        'establishment_day' => 'datetime',
    ];


    public function books(){
        return $this->hasMany(Book::class, 'publisher_id');
    }

    public $timestamps = true;
}
