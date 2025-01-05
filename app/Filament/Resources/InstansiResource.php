<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Instansi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\InstansiResource\Pages;

class InstansiResource extends Resource
{
    protected static ?string $model = Instansi::class;
    protected static ?string $label = 'Instansi';
    protected static ?string $navigationGroup = 'Instansi';
    protected static ?int $sort = 1;
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
                        Forms\Components\Select::make('pimpinan_id')
                            ->label('Nama Pimpinan')
                            ->relationship('pimpinan', 'nama')
                            ->required(),
                        Forms\Components\TextInput::make('nss')
                            ->label('NSS'),
                        Forms\Components\TextInput::make('npsn')
                            ->label('NPSN'),
                        Forms\Components\TextInput::make('no_sk_pendirian')
                            ->label('Nomor SK Pendirian'),
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
                            ->columnSpanFull(),
                    ])->columns([
                        'sm' => 2,
                        'xl' => 3,
                    ]),
                Section::make('Alamat Instansi')
                    ->schema([
                        Forms\Components\TextInput::make('alamat')
                            ->label('Alamat'),
                        Forms\Components\Select::make('negara_id')
                            ->label('Negara')
                            ->relationship('negara', 'nama')
                            ->required(),
                        Forms\Components\Select::make('provinsi_id')
                            ->label('Provinsi')
                            ->relationship('provinsi', 'nama')
                            ->required(),
                        Forms\Components\Select::make('kabupaten_id')
                            ->label('Kabupaten')
                            ->relationship('kabupaten', 'nama')
                            ->required(),
                        Forms\Components\Select::make('kecamatan_id')
                            ->label('Kecamatan')
                            ->relationship('kecamatan', 'nama')
                            ->required(),
                        Forms\Components\Select::make('kelurahan_id')
                            ->label('Kelurahan')
                            ->relationship('kelurahan', 'nama')
                            ->required(),
                    ])->columns([
                        'sm' => 2,
                        'xl' => 3,
                    ]),
                Section::make('Kontak Instansi')
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
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo'),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Instansi'),
                Tables\Columns\TextColumn::make('pimpinan.nama')
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
                    ->label('Tanggal Pendirian')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('pimpinan.foto')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Foto Pimpinan'),
                Tables\Columns\TextColumn::make('pimpinan.nip')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('NIP Pimpinan'),
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
                    //     Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListInstansis::route('/'),
            // 'create' => Pages\CreateInstansi::route('/create'),
            // 'edit' => Pages\EditInstansi::route('/{record}/edit'),
        ];
    }
}
