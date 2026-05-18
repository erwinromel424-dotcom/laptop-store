<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'subtotal',
        'shipping_cost',
        'grand_total',
        'shipping_address',
        'shipping_method',
        'tracking_number',
        'notes'
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'integer',
            'shipping_cost' => 'integer',
            'grand_total' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function canBeCancelled()
    {
        // Hanya bisa cancel jika status masih 'pending'
        if ($this->status !== 'pending') {
            return false;
        }

        // Cek apakah sudah lewat 10 menit dari waktu pesan
        return $this->created_at->diffInMinutes(now()) <= 10;
    }
}
