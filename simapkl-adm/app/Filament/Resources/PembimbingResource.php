<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Dospem;
use Filament\Forms\Form;
use App\Models\Mahasiswa;
use App\Models\Pembimbing;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PembimbingResource\Pages;
use App\Filament\Resources\PembimbingResource\RelationManagers;

class PembimbingResource extends Resource
{
    protected static ?string $model = Pembimbing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Data Pembimbing';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('dospem_id')
                    ->options(function (): array {
                        return Dospem::all()
                            ->pluck('nama', 'id')
                            ->filter()
                            ->toArray();
                    })
                    ->required(),
                Forms\Components\Select::make('mahasiswa_id')
                    ->options(function (): array {
                        return Mahasiswa::all()
                            ->pluck('nama', 'id')
                            ->filter()
                            ->toArray();
                    })
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dospem.nama')
                    ->label('Dospem')
                    ->sortable(),
                Tables\Columns\TextColumn::make('mahasiswa.nama')
                    ->label('Mahasiswa')
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([ // Tambahkan aksi di header tabel
                Tables\Actions\Action::make('acakDospem')
                    ->label('Acak Dosen Pembimbing')
                    ->icon('heroicon-o-arrows-pointing-in')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Pengacakan Dosen Pembimbing')
                    ->modalDescription('Apakah Anda yakin ingin mengacak dosen pembimbing untuk semua mahasiswa? Tindakan ini akan menghapus semua penugasan dosen pembimbing yang sudah ada dan menggantinya dengan yang baru.')
                    ->action(function () {
                        // Logika pengacakan
                        try {
                        DB::beginTransaction();

                        // Validasi dospem tersedia
                        $dospem = Dospem::all()->shuffle();
                        $dospemCount = $dospem->count();
                        if ($dospemCount === 0) {
                            DB::rollBack();
                            Notification::make()
                                ->title('Gagal Mengacak')
                                ->body('Tidak ada dosen pembimbing yang tersedia.')
                                ->danger()
                                ->send();
                            return;
                        }

                        DB::table('pembimbings')->truncate();
                        $mahasiswa = Mahasiswa::all()->shuffle();

                        $i = 0;
                        foreach ($mahasiswa as $mhs) {
                            $selectedDospem = $dospem->get($i % $dospemCount);
                            $mhs->dospem()->attach($selectedDospem->id);
                            $i++;
                        }

                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        Notification::make()
                            ->title('Berhasil!')
                            ->body('Dosen pembimbing berhasil diacak dan ditugaskan.')
                            ->success()
                            ->send();
                        return;
                    }

                    // Letakkan notifikasi sukses di luar blok try-catch
                    Notification::make()
                        ->title('Berhasil!')
                        ->body('Dosen pembimbing berhasil diacak dan ditugaskan.')
                        ->success()
                        ->send();
                    })
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
            'index' => Pages\ListPembimbings::route('/'),
            'create' => Pages\CreatePembimbing::route('/create'),
            'edit' => Pages\EditPembimbing::route('/{record}/edit'),
        ];
    }
}
