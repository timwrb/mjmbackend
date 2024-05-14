<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class jobpost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'visible',
        'active',
        'job_state',
        'job_zip',
        'job_city',
        'job_street',
        'job_house_nr',
        'job_address_addition',
        'company_id',
        'type',
    ];


    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(tag::class, 'job_post_tag');
    }

    public function address(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(address::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }



}
