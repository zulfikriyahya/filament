<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pimpinan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PimpinanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PimpinanResource\RelationManagers;

class PimpinanResource extends Resource
{
    protected static ?string $model = Pimpinan::class;
    protected static ?string $navigationLabel = 'Pimpinan';
    protected static ?string $navigationGroup = 'Instansi';
    protected static ?int $navigationSort = 0;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Pimpinan')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Pimpinan')
                            ->required(),
                        Forms\Components\TextInput::make('nip')
                            ->label('NIP'),
                        Forms\Components\DatePicker::make('periode_awal')
                            ->label('Periode Awal')
                            ->maxDate(now())
                            ->required(),
                        Forms\Components\DatePicker::make('periode_akhir')
                            ->label('Periode Akhir')
                            ->minDate(now())
                            ->required(),
                        Forms\Components\FileUpload::make('ttd')
                            ->label('TTE')
                            ->image()
                            ->directory('piminan/tte')
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
                            ->minSize('10')
                            ->maxSize('2048'),
                        Forms\Components\FileUpload::make('foto')
                            ->image()
                            ->fetchFileInformation(false)
                            ->directory('pimpinan/foto')
                            ->required()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '1:1' => '1:1',
                                '3:4' => '3:4',
                                '4:3' => '4:3',
                                '16:9' => '16:9',
                                '9:16' => '9:16',
                            ])
                            ->minSize('10')
                            ->maxSize('2048'),
                        Forms\Components\Toggle::make('status')
                            ->label('Aktifkan')
                            ->required(),
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
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Pimpinan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('periode_awal')
                    ->label('Periode Awal')
                    ->date('d-M-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('periode_akhir')
                    ->label('Periode Akhir')
                    ->date('d-M-Y')
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Status Jabatan')
                    ->boolean(),
                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('ttd')
                    ->label('TTE')
                    ->searchable(),
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
                    // Tables\Actions\DeleteAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPimpinans::route('/'),
            'create' => Pages\CreatePimpinan::route('/create'),
            'edit' => Pages\EditPimpinan::route('/{record}/edit'),
        ];
    }
}
