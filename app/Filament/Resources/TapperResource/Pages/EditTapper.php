<?php

namespace App\Filament\Resources\TapperResource\Pages;

use App\Models\User;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\TapperResource;

class EditTapper extends EditRecord
{
    protected static string $resource = TapperResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // If the user_id is set, fetch the user and set the kemandoran field
        if (isset($data['user_id'])) {
            $user = User::find($data['user_id']);
            $data['kemandoran'] = $user->name ?? 'Unknown';
        }
        return $data;
    }

    public static function canEdit(): bool
    {
        return Auth::user()->role === 'Admin';
    }

    public static function canDelete(): bool
    {
        return Auth::user()->role === 'Admin';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
