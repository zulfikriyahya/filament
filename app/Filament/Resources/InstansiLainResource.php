<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Provinsi;
use Filament\Forms\Form;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Filament\Tables\Table;
use App\Models\InstansiLain;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Section;
use App\Filament\Resources\InstansiLainResource\Pages;

class InstansiLainResource extends Resource
{
    protected static ?string $model = InstansiLain::class;
    protected static ?string $navigationLabel = 'Instansi Lain';
    protected static ?string $navigationGroup = 'Instansi';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Instansi')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Instansi')
                            ->required(),
                        Forms\Components\TextInput::make('nama_pimpinan')
                            ->label('Nama Pimpinan'),
                        Forms\Components\TextInput::make('nip_pimpinan')
                            ->label('NIP Pimpinan'),
                        Forms\Components\TextInput::make('nss')
                            ->label('NSS'),
                        Forms\Components\TextInput::make('npsn')
                            ->label('NPSN'),
                        Forms\Components\TextInput::make('no_sk_pendirian')
                            ->label('No SK Pendirian'),
                        Forms\Components\DatePicker::make('tanggal_pendirian')
                            ->label('Tanggal SK Pendirian')
                            ->maxDate(now()),
                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->directory('logo')
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
                            ->maxSize('2048')
                            ->columnSpan([
                                'sm' => 1,
                                'xl' => 2,
                            ]),
                    ])->columns([
                        'sm' => 2,
                        'xl' => 3,
                    ]),


















                Section::make('Alamat Instansi')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('alamat')
                            ->label('Alamat'),
                        Forms\Components\Select::make('negara_id')
                            ->label('Negara')
                            ->relationship('negara', 'nama')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('provinsi_id', null);
                                $set('kabupaten_id', null);
                                $set('kecamatan_id', null);
                                $set('kelurahan_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('provinsi_id')
                            ->label('Provinsi')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->options(
                                fn(Get $get): Collection => Provinsi::query()
                                    ->where('negara_id', $get('negara_id'))
                                    ->pluck('nama', 'id')
                            )
                            ->afterStateUpdated(function (Set $set) {
                                $set('kabupaten_id', null);
                                $set('kecamatan_id', null);
                                $set('kelurahan_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('kabupaten_id')
                            ->label('Kabupaten')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->options(
                                fn(Get $get): Collection => Kabupaten::query()
                                    ->where('provinsi_id', $get('provinsi_id'))
                                    ->pluck('nama', 'id')
                            )
                            ->afterStateUpdated(function (Set $set) {
                                $set('kecamatan_id', null);
                                $set('kelurahan_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('kecamatan_id')
                            ->label('Kecamatan')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->options(
                                fn(Get $get): Collection => Kecamatan::query()
                                    ->where('kabupaten_id', $get('kabupaten_id'))
                                    ->pluck('nama', 'id')
                            )
                            ->afterStateUpdated(function (Set $set) {
                                $set('kelurahan_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('kelurahan_id')
                            ->label('Kelurahan')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->options(
                                fn(Get $get): Collection => Kelurahan::query()
                                    ->where('kecamatan_id', $get('kecamatan_id'))
                                    ->pluck('nama', 'id')
                            )
                            ->required(),
                    ])->columns([
                        'sm' => 2,
                        'xl' => 3,
                    ]),
                Section::make('Kontak Instansi')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('telepon')
                            ->label('Telepon')
                            ->tel(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email(),
                        Forms\Components\TextInput::make('website')
                            ->label('Website')
                            ->url(),
                    ])->columns([
                        'sm' => 2,
                        'xl' => 3,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('logo')
                    ->label('Logo'),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Instansi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_pimpinan')
                    ->label('Nama Pimpinan'),
                Tables\Columns\TextColumn::make('nss')
                    ->label('NSS'),
                Tables\Columns\TextColumn::make('npsn')
                    ->label('NPSN'),
                Tables\Columns\TextColumn::make('telepon')
                    ->label('Telepon')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('website')
                    ->label('Website')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('no_sk_pendirian')
                    ->label('No SK Pendirian')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tanggal_pendirian')
                    ->label('Tanggal SK Pendirian')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date(),
                Tables\Columns\TextColumn::make('nip_pimpinan')
                    ->label('NIP Pimpinan')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('negara.nama')
                    ->label('Negara')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('provinsi.nama')
                    ->label('Provinsi')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kabupaten.nama')
                    ->label('Kabupaten')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kecamatan.nama')
                    ->label('Kecamatan')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kelurahan.nama')
                    ->label('Kelurahan')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tables\Filters\Filter::make([
                //     //
                // ])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInstansiLains::route('/'),
            'create' => Pages\CreateInstansiLain::route('/create'),
            'edit' => Pages\EditInstansiLain::route('/{record}/edit'),
        ];
    }
}
