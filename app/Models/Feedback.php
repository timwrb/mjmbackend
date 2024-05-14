<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
 protected $fillable = [
     'first_name',
     'last_name',
        'email',
        'category',
        'title',
         'content',
            'browser',
            'device',
            'status',
 ];

    public function Company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

