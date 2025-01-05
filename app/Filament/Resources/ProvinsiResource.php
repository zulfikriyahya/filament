<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Provinsi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProvinsiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProvinsiResource\RelationManagers;
use App\Filament\Resources\ProvinsiResource\RelationManagers\KabupatensRelationManager;
use App\Filament\Resources\ProvinsiResource\RelationManagers\InstansiLainRelationManager;

class ProvinsiResource extends Resource
{
    protected static ?string $model = Provinsi::class;
    protected static ?string $label = 'Provinsi';
    protected static ?string $navigationGroup = 'Wilayah';
    protected static ?int $sort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Provinsi')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Provinsi')
                            ->required(),
                        Forms\Components\Select::make('negara_id')
                            ->label('Nama Negara')
                            ->relationship('negara', 'nama')
                            ->required()
                            ->preload(10)
                            ->searchable(),
                    ])
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('negara.nama')
                    ->numeric()
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            KabupatensRelationManager::class,
            InstansiLainRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProvinsis::route('/'),
            'create' => Pages\CreateProvinsi::route('/create'),
            'edit' => Pages\EditProvinsi::route('/{record}/edit'),
        ];
    }
}
