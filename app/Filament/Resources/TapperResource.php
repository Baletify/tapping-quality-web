<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use App\Models\Tapper;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TapperResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TapperResource\RelationManagers;
use Illuminate\Database\Eloquent\Model;

class TapperResource extends Resource
{
    protected static ?string $model = Tapper::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Data Master';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Tapper'),
                TextInput::make('nik')
                    ->required()
                    ->maxLength(255)
                    ->label('NIK'),
                Select::make('departemen')
                    ->options([
                        'Sub Div A' => 'Sub Div A',
                        'Sub Div B' => 'Sub Div B',
                        'Sub Div C' => 'Sub Div C',
                        'Sub Div D' => 'Sub Div D',
                        'Sub Div E' => 'Sub Div E',
                        'Sub Div F' => 'Sub Div F',
                    ])
                    ->required()
                    ->label('Departemen'),
                TextInput::make('jabatan')
                    ->maxLength(255)
                    ->label('Jabatan'),
                Select::make('status')
                    ->options([
                        'Reguler' => 'Reguler',
                        'Contract FL' => 'Contract FL',
                    ])
                    ->required()
                    ->label('Status'),
                TextInput::make('no_hp')
                    ->tel()
                    ->maxLength(15)
                    ->label('No. HP'),
                Select::make('user_id')
                    ->relationship('user', 'name', fn(Builder $query) => $query->where('role', 'Mandor'))
                    ->label('Kemandoran')
                    ->nullable()
                    ->searchable()
                    ->preload(),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->inline(false),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')
                    ->label('NIK'),
                TextColumn::make('name')
                    ->label('Nama Tapper')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jabatan')
                    ->label('Jabatan'),
                TextColumn::make('departemen')
                    ->label('Departemen'),
                TextColumn::make('status')
                    ->label('Status'),
                TextColumn::make('no_hp')
                    ->label('No. HP'),
                TextColumn::make('user.name')
                    ->label('Kemandoran')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Status Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->filters([
                SelectFilter::make('departemen')
                    ->options(Tapper::query()->distinct()->pluck('departemen', 'departemen'))
                    ->label('Departemen'),
                SelectFilter::make('status')
                    ->options([
                        'Reguler' => 'Reguler',
                        'Contract FL' => 'Contract FL',
                    ])
                    ->label('Status'),
                SelectFilter::make('user_id')
                    ->relationship('user', 'name', fn(Builder $query) => $query->where('role', 'Mandor'))
                    ->label('Kemandoran'),

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
            'index' => Pages\ListTappers::route('/'),
            'create' => Pages\CreateTapper::route('/create'),
            'edit' => Pages\EditTapper::route('/{record}/edit'),
        ];
    }
}
