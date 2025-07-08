<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Tapper;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AssessmentDetail;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AssessmentDetailResource\Pages;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use App\Filament\Resources\AssessmentDetailResource\RelationManagers;



class AssessmentDetailResource extends Resource
{
    protected static ?string $model = AssessmentDetail::class;
    protected static ?string $navigationGroup = 'Data Assessment';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canCreate(): bool
    {
        return false; // Allow all users to create assessment details
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
                TextColumn::make('tanggal_inspeksi')
                    ->date('d M Y')
                    ->sortable()
                    ->label('Tanggal Inspeksi'),
                TextColumn::make('inspection_by')
                    ->label('Inspeksi Oleh'),
                TextColumn::make('nik_penyadap')
                    ->label('NIK Tapper'),
                TextColumn::make('tapper.name')
                    ->label('Nama Tapper')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tapper.status')
                    ->label('Status'),
                TextColumn::make('kemandoran')
                    ->label('Kemandoran')
                    ->searchable(),
                TextColumn::make('tapper.departemen')
                    ->label('Departemen'),
                TextColumn::make('task')
                    ->label('Task'),
                TextColumn::make('panel_sadap')
                    ->label('Panel Sadap'),
                TextColumn::make('jenis_kulit_pohon')
                    ->label('Status Kulit'),

            ])->striped(true)
            ->filters([
                SelectFilter::make('tapper_departemen')
                    ->options(Tapper::pluck('departemen', 'departemen')->unique())
                    ->label('Departemen')
                    ->modifyQueryUsing(function (Builder $query, array $data) {
                        $value = $data['value'] ?? null;
                        if (blank($value)) {
                            return;
                        }
                        $query->whereHas('tapper', function ($q) use ($value) {
                            $q->where('departemen', $value);
                        });
                    }),
                // SelectFilter::make('kemandoran')
                //     ->options(
                //         AssessmentDetail::pluck('kemandoran', 'kemandoran')
                //             ->unique()
                //     )
                //     ->label('Kemandoran'),
                DateRangeFilter::make('tanggal_inspeksi')
                    ->label('Tanggal Inspeksi')
                    ->ranges([
                        'Today' => [now()->startOfDay(), now()->endOfDay()],
                        'This Week' => [now()->startOfWeek(), now()->endOfWeek()],
                        'This Month' => [now()->startOfMonth(), now()->endOfMonth()],
                    ])
                    ->placeholder('Pilih Tanggal'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('tanggal_inspeksi', 'desc');
        // ->bulkActions([
        //         Tables\Actions\BulkActionGroup::make([
        //             Tables\Actions\DeleteBulkAction::make(),
        //         ]),
        //     ])
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
            'view' => Pages\ViewAssessmentDetail::route('/{record}'),
            'index' => Pages\ListAssessmentDetails::route('/'),
            'create' => Pages\CreateAssessmentDetail::route('/create'),
            // 'edit' => Pages\EditAssessmentDetail::route('/{record}/edit'),
        ];
    }

    public function getRouteKeyName()
    {
        return 'assessment_code';
    }
}
