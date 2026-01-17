<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'start_time', 'end_time', 'user_id','reminder_sent_at'];

    protected $casts = [
        'start_time' => 'datetime',
        'reminder_sent_at' => 'datetime',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attendees(): HasMany
    {
        return $this->hasMany(Attendee::class);
    }

    public function getStartTimeAttribute($value): Carbon
    {
        return Carbon::parse($value);
    }
}
