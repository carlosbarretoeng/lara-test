<?php

namespace App\Filament\Resources; // Updated namespace

use App\Models\FinancialEntry;
use App\Models\FinancialCategory;
use App\Models\FinancialAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FinancialEntryResource extends Resource
{
    protected static ?string $model = FinancialEntry::class;
    protected static ?string $cluster = \App\Filament\Clusters\BackOffice\Financial::class;
    protected static ?string $label = 'Entries';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->step(0.01), // Allow decimal input
                Forms\Components\Select::make('type')
                    ->options([
                        'revenue' => 'Revenue',
                        'expense' => 'Expense',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\Select::make('financial_category_id')
                    ->relationship('financialCategory', 'name')
                    ->required(),
                Forms\Components\Select::make('account_id')
                    ->relationship('financialAccount', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                 Tables\Columns\TextColumn::make('amount')
                    ->getStateUsing(fn (FinancialEntry $record): string => $record->amount->format()), // Use Money Value Object for display
                Tables\Columns\TextColumn::make('type')
                     ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'revenue' => 'success',
                        'expense' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('financialCategory.name')
                    ->label('Category')
                    ->sortable(),
                Tables\Columns\TextColumn::make('financialAccount.name')
                    ->label('Account')
                    ->sortable(),
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
            'index' => \App\Filament\Resources\FinancialEntryResource\Pages\ListFinancialEntries::route('/'), // Updated page namespace
            'create' => \App\Filament\Resources\FinancialEntryResource\Pages\CreateFinancialEntry::route('/create'), // Updated page namespace
            'edit' => \App\Filament\Resources\FinancialEntryResource\Pages\EditFinancialEntry::route('/{record}/edit'), // Updated page namespace
        ];
    }
}
