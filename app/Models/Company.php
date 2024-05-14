<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{


    protected $fillable = [
        'name',
        'desc',
        'legal_form',
        'tax_id',
        'logo',
        'industry',
        'contact_email',
        'contat_phone',
        'company_state',
        'company_zip',
        'company_city',
        'company_street',
        'company_house_nr',
        'company_address_addition'
    ];

    public function address(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function jobposts(): HasMany
    {
        return $this->hasMany(Jobpost::class);
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function contactrequests(): HasMany
    {
        return $this->hasMany(ContactRequest::class);
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }


}
