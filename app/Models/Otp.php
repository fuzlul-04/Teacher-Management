<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [
        'phone',
        'otp_code',
        'expires_at',
        'is_used',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'is_used' => 'boolean',
        ];
    }

    public function isExpired(): bool
    {
        return now()->greaterThan($this->expires_at);
    }

    public function scopeValid($query)
    {
        return $query->where('is_used', false)
            ->where('expires_at', '>', now());
    }

    public static function generate(int $length = 4): string
    {
        return str_pad(random_int(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    }

    public static function createFor(string $phone, int $validityMinutes = 5): self
    {
        self::where('phone', $phone)->where('is_used', false)->update(['is_used' => true]);

        return self::create([
            'phone' => $phone,
            'otp_code' => self::generate(),
            'expires_at' => now()->addMinutes($validityMinutes),
            'is_used' => false,
        ]);
    }
}
