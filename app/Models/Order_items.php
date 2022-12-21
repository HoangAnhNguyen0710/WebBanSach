<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{
    use HasFactory;
    /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'orders_items';
  protected $fillable = [
      "order_id",
      "book_id",
      "quantity"
  ];

  public function order(){
    return $this->belongsTo(Order::class, 'order_id');
  }

  public function voucher(){
    return $this->belongsTo(Book::class, 'book_id');
  }

  public $timestamps = true;
}
