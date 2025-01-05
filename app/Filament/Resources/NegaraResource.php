<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Negara;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\NegaraResource\Pages;
use App\Filament\Resources\NegaraResource\RelationManagers\ProvinsiRelationManager;
use App\Filament\Resources\NegaraResource\RelationManagers\InstansiLainRelationManager;

class NegaraResource extends Resource
{
    protected static ?string $model = Negara::class;
    protected static ?string $label = 'Negara';
    protected static ?string $navigationGroup = 'Wilayah';
    protected static ?int $sort = 0;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Negara')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Negara')
                            ->required(),
                        Forms\Components\TextInput::make('kode')
                            ->label('Kode Negara')
                            ->required(),
                        Forms\Components\FileUpload::make('logo')
                            ->label('Bendera Negara')
                            ->image()
                            ->directory('bendera')
                            ->fetchFileInformation(false)
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '1:1' => '1:1',
                                '3:4' => '3:4',
                                '4:3' => '4:3',
                                '16:9' => '16:9',
                                '9:16' => '9:16',
                            ])
                            // ->minSize('10')
                            ->maxSize('2048'),
                    ])
                    ->columns([
                        'sm' => 2,
                        'xl' => 3,
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Bendera')
                    ->width('60px'),
                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode Negara'),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Negara')
                    ->searchable()
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
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProvinsiRelationManager::class,
            InstansiLainRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNegaras::route('/'),
            'create' => Pages\CreateNegara::route('/create'),
            'edit' => Pages\EditNegara::route('/{record}/edit'),
        ];
    }
}
