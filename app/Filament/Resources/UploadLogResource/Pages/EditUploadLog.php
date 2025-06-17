<?php

namespace App\Filament\Resources\UploadLogResource\Pages;

use App\Filament\Resources\UploadLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUploadLog extends EditRecord
{
    protected static string $resource = UploadLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
