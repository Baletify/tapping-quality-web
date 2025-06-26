<?php

namespace App\Filament\Resources\AssessmentDetailResource\Pages;

use App\Filament\Resources\AssessmentDetailResource;
use App\Models\AssessmentDetail;
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
    public $tapperCreds;

    public $criteria;
    public $totalScore;

    public function mount($record): void
    {
        parent::mount($record);

        $this->criteria = DB::table('criteria')
            ->select('criteria.*')
            ->get();

        $this->customData = TreeAssessment::where('tree_assessments.assessment_code', $this->record->assessment_code)
            ->select('tree_assessments.criteria_id', DB::raw('SUM(criteria.score) as sum_score'))
            ->join('assessment_details', 'tree_assessments.assessment_code', '=', 'assessment_details.assessment_code')
            ->join('tappers', 'assessment_details.nik_penyadap', '=', 'tappers.nik')
            ->join('criteria', 'tree_assessments.criteria_id', '=', 'criteria.id')
            ->groupBy('tree_assessments.criteria_id')
            ->orderBy('criteria.id')
            ->get();

        // dd($this->customData);

        $this->tapperCreds = AssessmentDetail::where('assessment_code', $this->record->assessment_code)
            ->join('tappers', 'assessment_details.nik_penyadap', '=', 'tappers.nik')
            ->select('tappers.name as tapper_name', 'tappers.nik as tapper_nik', 'tappers.departemen as departemen', 'assessment_details.inspection_by as inspection_by', 'assessment_details.tanggal_inspeksi as tanggal_inspeksi', 'assessment_details.panel_sadap')
            ->first();
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
