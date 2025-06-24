<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\AssessmentDetail;
use Illuminate\Support\Facades\DB;

class SummaryAssessment extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.summary-assessment';

    protected static ?string $navigationGroup = 'Data Assessment';
    protected static ?string $title = 'Summary Assessment';

    // public $assessmentDetails;
    // public $treeAssessments;

    // public function mount(): void
    // {
    //     DB::table('assessment_details')
    //         ->select('assessment_details.*', 'tappers.name as tapper_name', 'tappers.nik as tapper_nik', 'users.name as user_name', 'tappers.departemen as departemen', 'tappers.status as status')
    //         ->join('tappers', 'assessment_details.nik_penyadap', '=', 'tappers.nik')
    //         ->join('users', 'tappers.user_id', '=', 'users.id')
    //         ->orderBy('assessment_details.tanggal_inspeksi', 'desc')
    //         ->get();

    //     DB::table('tree_assessments')
    //         ->join('assessment_details', 'tree_assessments.assessment_code', '=', 'assessment_details.assessment_code')
    //         ->join('criteria', 'tree_assessments.criteria_id', '=', 'criteria.id')
    //         ->select('tree_assessments.criteria_id', 'tree_assessments.assessment_code', DB::raw('SUM(criteria.score) as sum_score'))
    //         ->groupBy('tree_assessments.criteria_id', 'tree_assessments.assessment_code')
    //         ->get();
    //     // dd($this->treeAssessments);
    // }

    public function getAssessmentDetailsProperty()
    {
        $query = DB::table('assessment_details')
            ->select('assessment_details.*', 'tappers.name as tapper_name', 'tappers.nik as tapper_nik', 'users.name as user_name', 'tappers.departemen as departemen', 'tappers.status as status')
            ->join('tappers', 'assessment_details.nik_penyadap', '=', 'tappers.nik')
            ->join('users', 'tappers.user_id', '=', 'users.id')
            ->orderBy('assessment_details.tanggal_inspeksi', 'desc');

        if (request('search')) {
            $query->where('tappers.name', 'like', '%' . request('search') . '%');
        }

        if (request('departemen')) {
            $query->where('tappers.departemen', request('departemen'));
        }

        return $query->paginate(1);
    }

    public function getTreeAssessmentsProperty()
    {
        return DB::table('tree_assessments')
            ->join('assessment_details', 'tree_assessments.assessment_code', '=', 'assessment_details.assessment_code')
            ->join('criteria', 'tree_assessments.criteria_id', '=', 'criteria.id')
            ->select('tree_assessments.criteria_id', 'tree_assessments.assessment_code', DB::raw('SUM(criteria.score) as sum_score'))
            ->groupBy('tree_assessments.criteria_id', 'tree_assessments.assessment_code')
            ->get();
    }

    public function getDepartemenOptionsProperty()
    {
        return DB::table('tappers')->distinct()->pluck('departemen');
    }
}
