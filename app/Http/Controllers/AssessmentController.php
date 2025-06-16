<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssessmentDetail;
use App\Models\TreeAssessment;
use App\Models\UploadLog;
use Illuminate\Support\Facades\Log;

class AssessmentController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        Log::info('Assessment Detail Request Data: ', $request->all());

        try {
            $create = AssessmentDetail::create([
                'assessment_code' => $request->assessment_code,
                'nik_penyadap' => $request->nik_penyadap,
                'blok' => $request->blok,
                'task' => $request->task,
                'kemandoran' => $request->kemandoran,
                'no_hancak' => $request->no_hancak,
                'tahun_tanam' => $request->tahun_tanam,
                'clone' => $request->clone,
                'sistem_sadap' => $request->sistem_sadap,
                'panel_sadap' => $request->panel_sadap,
                'jenis_kulit_pohon' => $request->jenis_kulit_pohon,
                'tanggal_inspeksi' => $request->tanggal_inspeksi,
                'inspection_by' => $request->inspection_by,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Assessment detail created successfully',
                'data' => $create
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create assessment detail',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function storeTree(Request $request)
    {
        try {
            $create = TreeAssessment::create([
                'assessment_code' => $request->assessment_code,
                'tree_id' => $request->tree_id,
                'criteria_id' => $request->criteria_id,
            ]);

            $createUploadedAt = UploadLog::create([
                'upload_at' => now()->toDateTimeString(),
                'assessment_code' => $request->assessment_code,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tree assessment created successfully',
                'data' => $create
            ], 201);
        } catch (\Exception $e) {
            Log::error('Tree Assessment Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create tree assessment',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
