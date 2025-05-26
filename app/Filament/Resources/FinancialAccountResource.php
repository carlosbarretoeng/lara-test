<?php

namespace App\Filament\Resources; // Updated namespace

use App\Models\FinancialAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FinancialAccountResource extends Resource
{
    protected static ?string $cluster = \App\Filament\Clusters\BackOffice\Financial::class;

    protected static ?string $model = FinancialAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';
    protected static ?int $navigationSort = 1;

    protected static ?string $label = 'Accounts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description'),
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
            'index' => \App\Filament\Resources\FinancialAccountResource\Pages\ListFinancialAccounts::route('/'), // Updated page namespace
            'create' => \App\Filament\Resources\FinancialAccountResource\Pages\CreateFinancialAccount::route('/create'), // Updated page namespace
            'edit' => \App\Filament\Resources\FinancialAccountResource\Pages\EditFinancialAccount::route('/{record}/edit'), // Updated page namespace
        ];
    }
}
