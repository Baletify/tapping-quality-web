<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UploadLogResource\Pages;
use App\Filament\Resources\UploadLogResource\RelationManagers;
use App\Models\UploadLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UploadLogResource extends Resource
{
    protected static ?string $model = UploadLog::class;

    protected static ?string $navigationIcon = 'heroicon-s-wallet';
    protected static ?string $navigationGroup = 'Data Assessment';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('assessment_code')
                    ->label(('Kode Assessment')),
                TextColumn::make('upload_at')
                    ->date('d M Y')
                    ->label('Waktu Upload'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListUploadLogs::route('/'),
            'create' => Pages\CreateUploadLog::route('/create'),
            'edit' => Pages\EditUploadLog::route('/{record}/edit'),
        ];
    }
}
