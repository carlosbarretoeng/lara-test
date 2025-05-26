<?php

namespace App\Filament\Resources\FinancialCategoryResource\Pages;

use App\Filament\Resources\FinancialCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFinancialCategory extends CreateRecord
{
    protected static string $resource = FinancialCategoryResource::class;
}
