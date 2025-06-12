<?php

namespace App\Filament\Resources\TapperResource\Pages;

use App\Filament\Resources\TapperResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTappers extends ListRecords
{
    protected static string $resource = TapperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
