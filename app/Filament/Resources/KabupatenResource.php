<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Kabupaten;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\KabupatenResource\Pages;
use App\Filament\Resources\KabupatenResource\RelationManagers\KecamatansRelationManager;
use App\Filament\Resources\KabupatenResource\RelationManagers\InstansiLainRelationManager;

class KabupatenResource extends Resource
{
    protected static ?string $model = Kabupaten::class;
    protected static ?string $label = 'Kabupaten';
    protected static ?string $navigationGroup = 'Wilayah';
    protected static ?int $sort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Kabupaten/Kota')
                    ->required(),
                Forms\Components\Select::make('provinsi_id')
                    ->relationship('provinsi', 'nama')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Kabupaten/Kota')
                    ->searchable(),
                Tables\Columns\TextColumn::make('provinsi.nama')
                    ->label('Nama Provinsi')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
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
            KecamatansRelationManager::class,
            InstansiLainRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKabupatens::route('/'),
            'create' => Pages\CreateKabupaten::route('/create'),
            'edit' => Pages\EditKabupaten::route('/{record}/edit'),
        ];
    }
}
