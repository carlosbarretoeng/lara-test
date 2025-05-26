<?php

namespace App\Filament\Clusters\BackOffice\Financial\Pages;

use App\Filament\Clusters\BackOffice\Financial;
use Filament\Pages\Page;

class Home extends Page
{
    protected static ?string $cluster = Financial::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = -1;

    protected static string $view = 'filament.clusters.back-office.financial.pages.home';
}
