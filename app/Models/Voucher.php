<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vouchers';
    protected $fillable = [
        'id',
        "created_at",
        "updated_at",
        "voucher_name",
        "voucher_description",
        "discount_value",
        "condition",
        "expired_at",
        "valid_at"
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'valid_at' => 'datetime',
        'condition' => 'integer',
    ];


    public function orders(){
        return $this->hasMany(Order::class, 'applied_voucher');
    }

    public $timestamps = true;
}
