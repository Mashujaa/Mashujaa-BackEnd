<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class employee extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'first_name',
        'last_name',
        'national_id',
        'birth_date',
        'gender',
        'email_address',
        'street_address',
        'city',
        'state/province',
        'postal/zipcode',
        'telephone_number'
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class, );
    }
}
