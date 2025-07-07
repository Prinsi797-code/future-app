<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrepreneurCompany extends Model
{
    use HasFactory;
    protected $table = "entrepreneurs_companies";
    protected $fillable = [
        'entrepreneurs_id',
        'company_name',
        'more_market_capital',
        'more_your_stake',
        'more_stake_funding',
        'created_at',
        'updated_at'
    ];

    public function entrepreneur()
    {
        return $this->belongsTo(Entrepreneur::class);
    }
}