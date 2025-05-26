<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Casts\MoneyCast;

class FinancialEntry extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'description',
        'amount',
        'type',
        'date',
        'financial_category_id',
        'financial_account_id',
    ];

    protected $casts = [
        'amount' => MoneyCast::class,
        'date' => 'date',
    ];

    public function financialCategory(): BelongsTo
    {
        return $this->belongsTo(FinancialCategory::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(FinancialAccount::class);
    }
}
