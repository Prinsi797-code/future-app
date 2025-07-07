<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;
    protected $fillable = ['entrepreneur_id', 'investor_id', 'market_capital', 'your_stake', 'company_value', 'reason', 'is_counter_offer'];

    public function entrepreneur()
    {
        return $this->belongsTo(Entrepreneur::class);
    }

    public function investor()
    {
        return $this->belongsTo(User::class, 'investor_id');
    }
}