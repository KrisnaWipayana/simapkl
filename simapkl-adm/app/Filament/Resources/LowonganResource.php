<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Lowongan;
use Filament\Forms\Form;
use App\Models\Perusahaan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LowonganResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LowonganResource\RelationManagers;

class LowonganResource extends Resource
{
    protected static ?string $model = Lowongan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Data Lowongan';

    // Updated form untuk LowonganResource
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section untuk informasi dasar lowongan
                Forms\Components\Section::make('Informasi Lowongan')
                    ->schema([
                        Forms\Components\Select::make('perusahaan_id')
                            ->label('Perusahaan')
                            ->options(function (): array {
                                return Perusahaan::all()
                                    ->pluck('nama', 'id')
                                    ->filter()
                                    ->toArray();
                            })
                            ->required()
                            ->searchable()
                            ->preload(),
                            
                        Forms\Components\TextInput::make('judul')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\Textarea::make('deskripsi')
                            ->rows(4)
                            ->columnSpanFull(),
                            
                        Forms\Components\DatePicker::make('tanggal_mulai')
                            ->label('Tanggal Mulai')
                            ->native(false),
                            
                        Forms\Components\DatePicker::make('tanggal_selesai')
                            ->label('Tanggal Selesai')
                            ->native(false)
                            ->after('tanggal_mulai'),

                        Forms\Components\DatePicker::make('expired')
                            ->label('Expired')
                            ->native(false),

                        Forms\Components\TextInput::make('kuota')
                            ->required()
                            ->maxLength(2),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Skills yang Dibutuhkan')
                    ->schema([
                        Forms\Components\Select::make('skills')
                            ->label('Skills')
                            ->relationship('skills', 'nama')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->placeholder('Pilih skills yang dibutuhkan')
                            ->maxItems(10),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    // Update tabel untuk menampilkan skills
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('perusahaan.nama')
                    ->label('Perusahaan')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('kuota')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('expired')
                    ->date()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('perusahaan_id')
                    ->label('Perusahaan')
                    ->relationship('perusahaan', 'nama')
                    ->searchable()
                    ->preload(),
                    
                Tables\Filters\SelectFilter::make('skills')
                    ->label('Skills')
                    ->relationship('skills', 'nama')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                    
                Tables\Filters\Filter::make('tanggal_aktif')
                    ->label('Masih Aktif')
                    ->query(fn (Builder $query): Builder => $query->where('tanggal_selesai', '>=', now())),
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
            'index' => Pages\ListLowongans::route('/'),
            'create' => Pages\CreateLowongan::route('/create'),
            'edit' => Pages\EditLowongan::route('/{record}/edit'),
        ];
    }
}
