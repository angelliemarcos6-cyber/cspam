<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use App\Filament\Widgets\{
    EnrollmentTrendChart,
    DropoutAlertWidget,
    SchoolComplianceStatsWidget,
    OwnSchoolSummaryWidget  // ← You'll create this later for School Heads
};

class MonitorDashboard extends Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Monitor Dashboard';

    // Custom heading based on role
    public function getHeading(): string
    {
        return Auth::user()?->hasRole('SMM&E Monitor')
            ? 'Division-Wide Monitoring Dashboard'
            : 'School Performance Dashboard';
    }

    // Use header widgets for main stats/charts/alerts
    protected function getHeaderWidgets(): array
    {
        if (! Auth::check()) {
            return [];
        }

        if (Auth::user()->hasRole('SMM&E Monitor')) {
            // Full division access: show comprehensive widgets
            return [
                EnrollmentTrendChart::class,
                DropoutAlertWidget::class,
                SchoolComplianceStatsWidget::class,
                // Add more: e.g., NetEnrollmentRateWidget::class, etc.
            ];
        }

        // School Head: limited own-school view
        return [
            OwnSchoolSummaryWidget::class,
            // You can add a simple EnrollmentWidget for their school only
        ];
    }

    // Optional: Hide navigation if you make this the default dashboard
    // protected static bool $shouldRegisterNavigation = true;

    // Optional: Custom view path if you want Blade overrides
    // protected static string $view = 'filament.pages.monitor-dashboard';
}
