<?php

namespace App\Filament\Resources; // Updated namespace

use App\Filament\Clusters\BackOffice;
use App\Models\FinancialCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FinancialCategoryResource extends Resource
{
    protected static ?string $model = FinancialCategory::class;
    protected static ?string $cluster = \App\Filament\Clusters\BackOffice\Financial::class;
    protected static ?string $label = 'Categories';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options([
                        'revenue' => 'Revenue',
                        'expense' => 'expense',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                     ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'revenue' => 'success',
                        'expense' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\FinancialCategoryResource\Pages\ListFinancialCategories::route('/'), // Updated page namespace
            'create' => \App\Filament\Resources\FinancialCategoryResource\Pages\CreateFinancialCategory::route('/create'), // Updated page namespace
            'edit' => \App\Filament\Resources\FinancialCategoryResource\Pages\EditFinancialCategory::route('/{record}/edit'), // Updated page namespace
        ];
    }
}
