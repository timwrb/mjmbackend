<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'type',
        'category',
    ];

    public function jobposts(): BelongsToMany
    {
        return $this->belongsToMany(jobpost::class);
    }

    public function company(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }
}
