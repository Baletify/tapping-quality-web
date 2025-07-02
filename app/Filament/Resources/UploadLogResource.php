<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\UploadLog;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UploadLogResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UploadLogResource\RelationManagers;

class UploadLogResource extends Resource
{
    protected static ?string $model = UploadLog::class;

    protected static ?string $navigationIcon = 'heroicon-s-wallet';
    protected static ?string $navigationGroup = 'Data Assessment';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $model): bool
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
                TextColumn::make('assessment_details.inspection_by')
                    ->label('Uploaded By'),
                TextColumn::make('assessment_details.tanggal_inspeksi')
                    ->date('d M Y')
                    ->label('Tanggal Inspeksi'),
                TextColumn::make('assessment_details.created_at')
                    ->label('Upload At')
                    ->date('d M Y'),
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
