<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'orders';
  protected $fillable = [
      'id',
      "created_at",
      "updated_at",
      "status",
      "price",
      "price_discount",
      "applied_voucher",
      "customer_name",
      "customer_address",
      "customer_contact",
      "customer_id"
  ];

  protected $casts = [
      'price' => 'long',
      'price_discount' => 'long',
  ];


  public function customer(){
    return $this->belongsTo(User::class, 'customer_id');
  }

  public function voucher(){
    return $this->belongsTo(Voucher::class, 'applied_voucher');
  }

  public $timestamps = true;
}
