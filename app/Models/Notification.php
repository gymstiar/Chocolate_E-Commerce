<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'link',
        'data',
        'read_at',
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    /**
     * Get the user that owns the notification.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for unread notifications.
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    /**
     * Scope for notifications of a specific user.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead()
    {
        if (!$this->read_at) {
            $this->update(['read_at' => now()]);
        }
    }

    /**
     * Check if notification is read.
     */
    public function isRead()
    {
        return $this->read_at !== null;
    }

    /**
     * Get time ago string.
     */
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Get icon based on notification type.
     */
    public function getIconAttribute()
    {
        return match($this->type) {
            'new_order' => 'bi-bag-check-fill text-success',
            'payment_uploaded' => 'bi-credit-card-fill text-warning',
            'payment_verified' => 'bi-check-circle-fill text-success',
            'payment_rejected' => 'bi-x-circle-fill text-danger',
            'order_status' => 'bi-truck text-info',
            'order_shipped' => 'bi-truck text-primary',
            'order_delivered' => 'bi-house-check text-success',
            'order_completed' => 'bi-star-fill text-warning',
            'order_cancelled' => 'bi-x-octagon-fill text-danger',
            default => 'bi-bell-fill text-secondary',
        };
    }
}
