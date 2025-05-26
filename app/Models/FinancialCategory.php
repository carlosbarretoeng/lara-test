<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FinancialCategory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'type',
    ];

    public function financialEntries(): HasMany
    {
        return $this->hasMany(FinancialEntry::class);
    }
}