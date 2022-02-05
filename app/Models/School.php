<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

    protected $fillable = [
        'name',
        'status',
    ];

    public function students(): BelongsTo
    {
        return $this->hasMany(User::class);
    }
}
