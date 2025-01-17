<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Kelurahan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KelurahanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KelurahanResource\RelationManagers;
use App\Filament\Resources\KelurahanResource\RelationManagers\InstansiLainRelationManager;

class KelurahanResource extends Resource
{
    protected static ?string $model = Kelurahan::class;
    protected static ?string $navigationLabel = 'Kelurahan';
    protected static ?string $navigationGroup = 'Wilayah';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Kecamatan')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Kelurahan')
                            ->required(),
                        Forms\Components\Select::make('kecamatan_id')
                            ->label('Nama Kecamatan')
                            ->relationship('kecamatan', 'nama')
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
                Tables\Columns\TextColumn::make('kecamatan.nama')
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
            InstansiLainRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKelurahans::route('/'),
            'create' => Pages\CreateKelurahan::route('/create'),
            'edit' => Pages\EditKelurahan::route('/{record}/edit'),
        ];
    }
}
