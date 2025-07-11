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
use App\Models\Assessment;

class AssessmentDetailResource extends Resource
{
    protected static ?string $model = Assessment::class;
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
                TextColumn::make('tgl_inspeksi')
                    ->date('d M Y')
                    ->sortable()
                    ->label('Tanggal Inspeksi'),
                TextColumn::make('nama_inspektur')
                    ->label('Nama Inspektur'),
                TextColumn::make('nik_penyadap')
                    ->label('NIK Tapper'),
                TextColumn::make('nama_penyadap')
                    ->label('Nama Tapper')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status'),
                TextColumn::make('kemandoran')
                    ->label('Kemandoran')
                    ->searchable(),
                TextColumn::make('dept')
                    ->label('Departemen'),
                TextColumn::make('blok')
                    ->label('Blok'),
                TextColumn::make('no_hancak')
                    ->label('No Hancak'),
                TextColumn::make('tahun_tanam')
                    ->label('Tahun Tanam'),
                TextColumn::make('clone')
                    ->label('Clone'),
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
                SelectFilter::make('kemandoran')
                    ->options(
                        Assessment::pluck('kemandoran', 'kemandoran')
                            ->unique()
                    )
                    ->label('Kemandoran'),
                SelectFilter::make('panel_sadap')
                    ->options(
                        Assessment::pluck('panel_sadap', 'panel_sadap')
                    )
                    ->label('Panel Sadap'),
                SelectFilter::make('blok')
                    ->options(
                        Assessment::pluck('blok', 'blok')
                    )
                    ->label('Blok'),
                SelectFilter::make('task')
                    ->options(
                        [
                            'A' => 'A',
                            'B' => 'B',
                            'C' => 'C',
                            'D' => 'D',
                        ]
                    )
                    ->label('Task'),
                DateRangeFilter::make('tgl_inspeksi')
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
            ->defaultSort('tgl_inspeksi', 'desc');
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
