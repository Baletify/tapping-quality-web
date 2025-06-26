<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Data Master';

    public static function canCreate(): bool
    {
        return Auth::user()->role === 'Admin';
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()->role === 'Admin';
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->role === 'Admin';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('nik')->required()->maxLength(255)->label('NIK'),
                Select::make('departemen')
                    ->options([
                        'QA/QM' => 'QA/QM',
                        'Sub Div A' => 'Sub Div A',
                        'Sub Div B' => 'Sub Div B',
                        'Sub Div C' => 'Sub Div C',
                        'Sub Div D' => 'Sub Div D',
                        'Sub Div E' => 'Sub Div E',
                        'Sub Div F' => 'Sub Div F',
                    ])
                    ->required()
                    ->label('Departemen'),
                TextInput::make('jabatan')->required()->maxLength(255),
                TextInput::make('no_hp')
                    ->tel()
                    ->required()
                    ->maxLength(15)
                    ->label('No. HP'),
                Select::make('status')
                    ->options([
                        'Monthly' => 'Monthly',
                        'Staff' => 'Staff',
                        'Contract-BSKP' => 'Contract-BSKP',
                    ])
                    ->required()
                    ->label('Status'),
                Select::make('role')->options([
                    'Instruktur' => 'Instruktur',
                    'Admin' => 'Admin',
                    'Mandor' => 'Mandor',
                ])->required(),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->inline(false)
                    ->columnSpanFull(),
                TextInput::make('email')
                    ->maxLength(255),
                TextInput::make('password')
                    ->password()
                    ->minLength(8)
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn($state) => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn($state) => filled($state))
                    ->label('Password')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jabatan')
                    ->label('Jabatan'),
                TextColumn::make('no_hp')
                    ->label('No. HP'),
                TextColumn::make('departemen')
                    ->label('Departemen')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email'),
                IconColumn::make('is_active')
                    ->label('Status Aktif')
                    ->alignCenter()
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')


            ])
            ->filters([
                SelectFilter::make('tapper.departemen')->options(
                    User::query()->distinct()->pluck('departemen', 'departemen')
                ),
                SelectFilter::make('is_active')
                    ->options([
                        true => 'Aktif',
                        false => 'Tidak Aktif',
                    ])
                    ->label('Status Aktif'),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
