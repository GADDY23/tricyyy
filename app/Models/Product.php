<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'condition',
        'fitment',
        'price',
        'stock',
        'details',
        'icon',
        'is_available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    /**
     * Check if product is available for purchase
     */
    public function isAvailable(): bool
    {
        return $this->is_available && $this->stock > 0;
    }

    /**
     * Get availability status message
     */
    public function getAvailabilityMessage(): string
    {
        if (!$this->is_available) {
            return 'Item Unavailable';
        }
        if ($this->stock <= 0) {
            return 'Out of Stock';
        }
        if ($this->stock < 5) {
            return 'Low Stock (' . $this->stock . ' left)';
        }
        return 'In Stock';
    }

    /**
     * Orders relationship
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
