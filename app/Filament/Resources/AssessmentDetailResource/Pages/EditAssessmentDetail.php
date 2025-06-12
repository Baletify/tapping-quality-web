<?php

namespace App\Filament\Resources\AssessmentDetailResource\Pages;

use App\Filament\Resources\AssessmentDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssessmentDetail extends EditRecord
{
    protected static string $resource = AssessmentDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
