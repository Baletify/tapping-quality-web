<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AssessmentDetail extends Model
{
    /** @use HasFactory<\Database\Factories\AssessmentDetailFactory> */
    use HasFactory;

    protected $primaryKey = 'assessment_code';
    public $incrementing = false;
    protected $keyType = 'string';

    public function tapper()
    {
        return $this->belongsTo(Tapper::class, 'nik_penyadap', 'nik');
    }

    public function treeAssessments()
    {
        return $this->hasMany(TreeAssessment::class, 'assessment_code', 'assessment_code');
    }



    public function getRouteKey()
    {
        return (string) $this->getAttribute($this->getRouteKeyName());
    }
}
