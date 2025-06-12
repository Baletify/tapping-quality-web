<?php

namespace App\Filament\Resources\TapperResource\Pages;

use App\Filament\Resources\TapperResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTapper extends CreateRecord
{
    protected static string $resource = TapperResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['user_id'])) {
            $user = User::find($data['user_id']);
            $data['kemandoran'] = $user->name ?? 'Unknown';
        }
        return $data;
    }



}
