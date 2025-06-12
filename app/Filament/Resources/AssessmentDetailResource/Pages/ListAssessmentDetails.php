<?php

namespace App\Filament\Resources\AssessmentDetailResource\Pages;

use App\Filament\Resources\AssessmentDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssessmentDetails extends ListRecords
{
    protected static string $resource = AssessmentDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
