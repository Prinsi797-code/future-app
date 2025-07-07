<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemarkEntrepreneur extends Model
{
    use HasFactory;
    protected $table = 'remark_entrepreneur';
    protected $fillable = [
        'investor_id',
        'entrepreneur_id',
        'remark_market_capital',
        'remark_your_stake',
        'remark_company_value',
        'remark_reason',
    ];
}