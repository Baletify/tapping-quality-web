<?php

namespace App\Http\Controllers;

use App\Models\AssessmentDetail;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function store(Request $request)
    {
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
    }
}
