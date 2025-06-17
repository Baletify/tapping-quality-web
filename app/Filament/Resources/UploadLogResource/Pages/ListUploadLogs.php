<?php

namespace App\Filament\Resources\UploadLogResource\Pages;

use App\Filament\Resources\UploadLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUploadLogs extends ListRecords
{
    protected static string $resource = UploadLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
