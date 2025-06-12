<?php

namespace App\Filament\Resources\AssessmentDetailResource\Pages;

use App\Filament\Resources\AssessmentDetailResource;
use App\Models\TreeAssessment;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class ViewAssessmentDetail extends ViewRecord
{
    protected static string $resource = AssessmentDetailResource::class;
    protected static string $view = 'filament.resources.assessment-detail-resource.pages.view-assessment-detail';
    protected static ?string $title = 'Detail Penilaian';

    public $customData;

    public function mount($record): void
    {
        parent::mount($record);
        $this->customData = TreeAssessment::where('tree_assessments.assessment_code', $this->record->assessment_code)
            ->select('criteria.name as nama_kriteria', DB::raw('AVG(criteria.score) as avg_score'))
            ->join('assessment_details', 'tree_assessments.assessment_code', '=', 'assessment_details.assessment_code')
            ->join('tappers', 'assessment_details.nik_penyadap', '=', 'tappers.nik')
            ->join('criteria', 'tree_assessments.criteria_id', '=', 'criteria.id')
            ->groupBy('criteria.name')
            ->orderBy('criteria.id')
            ->get();
    }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             TextColumn::make('criteria.name')
    //                 ->label('Kriteria'),
    //         ])
    //         ->filters([
    //             // Define any filters you want to apply to the table
    //             // Example:
    //             // SelectFilter::make('filter_name')->options([...]),
    //         ]);
    // }
    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\EditAction::make(),
    //     ];
    // }
}
