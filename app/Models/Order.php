<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'subtotal',
        'shipping',
        'total',
        'payment_method',
        'status',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Order items relationship
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Calculate total
     */
    public function calculateTotal()
    {
        $subtotal = 0;
        foreach ($this->items as $item) {
            $subtotal += $item->price * $item->quantity;
        }
        $this->subtotal = $subtotal;
        $this->total = $subtotal + $this->shipping;
        return $this;
    }
}
