<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class StudentUser extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'nick_name',
        'phone',
        'registration_number',
        'password',
        'personal_mobile',
        'gender',
        'religion',
        'blood_group',
        'date_of_birth',
        'father_name',
        'mother_name',
        'father_mobile',
        'mother_mobile',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'is_verified' => 'boolean',
        ];
    }

    public static function generateRegistrationNumber(): string
    {
        $lastStudent = self::orderBy('registration_number', 'desc')->first();
        $nextNumber = $lastStudent ? (intval($lastStudent->registration_number) + 1) : 1;

        return str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

    public static function generatePassword(int $length = 8): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        return Str::random($length);
    }
}
