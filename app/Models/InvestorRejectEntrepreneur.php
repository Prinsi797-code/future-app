<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorRejectEntrepreneur extends Model
{
    use HasFactory;
    protected $table = 'investor_reject_entrepreneur';
    protected $fillable = [
        'user_id',
        'entrepreneur_id',
        'reason',
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    public function entrepreneur()
    {
        return $this->belongsTo(Entrepreneur::class);
    }
}