<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected ?string $heading = 'All Students';           // optional custom title

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Student')                     // optional
                ->icon('heroicon-o-user-plus'),
        ];
    }

    // Optional: add table filters, bulk actions, etc.
    // protected function getTableFilters(): array { ... }
}