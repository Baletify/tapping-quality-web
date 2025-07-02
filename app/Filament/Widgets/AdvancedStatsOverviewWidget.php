<?php

namespace App\Filament\Widgets;

use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget as BaseWidget;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Stat;

class AdvancedStatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Assessments', fn() => \App\Models\AssessmentDetail::where('created_at', '>=', now()->startOfWeek())->count())
                ->icon('heroicon-o-document-text')
                ->iconPosition('start')
                ->description('Total assessments this week')
                ->iconColor('primary'),
            Stat::make('Tappers', fn() => \App\Models\Tapper::all()->count())->icon('heroicon-o-user-group')
                ->iconPosition('start')
                ->description('Total Penyadap')
                ->iconColor('success'),
            Stat::make('Users', fn() => \App\Models\User::all()->count())->icon('heroicon-o-users')
                ->iconPosition('start')
                ->description('Total Users')
                ->iconColor('warning'),
        ];
    }
}
