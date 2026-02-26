<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Students';

    protected static ?string $pluralModelLabel = 'Students';

    protected static ?string $modelLabel = 'Student';

    // Who can see this resource in the sidebar / access the list page
    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole([
            'Division Admin',
            'SMM&E Monitor',
            'School Head',
        ]) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Personal Information')
            ->schema([
                Forms\Components\TextInput::make('lrn')
                ->label('Learner Reference Number (LRN)')
                ->required()
                ->maxLength(12)
                ->unique(ignoreRecord: true),

                     Forms\Components\TextInput::make('first_name')
                     ->required()
                     ->maxLength(255),

                     Forms\Components\TextInput::make('middle_name')
                     ->maxLength(255),

                     Forms\Components\TextInput::make('last_name')
                     ->required()
                     ->maxLength(255),

                     Forms\Components\Select::make('sex')
                     ->options([
                         'Male' => 'Male',
                         'Female' => 'Female',
                     ])
                     ->required(),

                     Forms\Components\DatePicker::make('birthdate')
                     ->required()
                     ->maxDate(now()),
            ])
            ->columns(2),

                 Forms\Components\Section::make('Enrollment Information')
                 ->schema([
                     Forms\Components\Select::make('section_id')
                     ->relationship('section', 'name')
                     ->required()
                     ->searchable()
                     ->preload(),
                 ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->recordTitleAttribute('lrn')
        ->columns([
            Tables\Columns\TextColumn::make('lrn')
            ->label('LRN')
            ->searchable()
            ->sortable(),

                  Tables\Columns\TextColumn::make('full_name')
                  ->label('Name')
                  ->getStateUsing(fn ($record) => $record->first_name . ' ' . ($record->middle_name ? $record->middle_name . ' ' : '') . $record->last_name)
                  ->searchable(['first_name', 'last_name', 'middle_name'])
                  ->sortable(),

                  Tables\Columns\TextColumn::make('sex')
                  ->sortable(),

                  Tables\Columns\TextColumn::make('birthdate')
                  ->date()
                  ->sortable(),

                  Tables\Columns\TextColumn::make('section.name')
                  ->label('Section')
                  ->sortable()
                  ->searchable(),

                  Tables\Columns\TextColumn::make('section.school.name')
                  ->label('School')
                  ->sortable()
                  ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            // You can add filters later, e.g. SelectFilter for section/school
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
                  Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ])
        ->modifyQueryUsing(function (Builder $query): Builder {
            $user = auth()->user();

            if (!$user) {
                return $query->where('id', 0); // nobody sees anything if not logged in
            }

            if ($user->hasRole('School Head')) {
                return $query->whereHas('section', function ($q) use ($user) {
                    $q->where('school_id', $user->school_id);
                });
            }

            // Division Admin & SMM&E Monitor see everything
            return $query;
        });
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagers\EnrollmentsRelationManager::class,
            // etc.
        ];
    }

    public static function getPages(): array
    {
        return [
        //    'index'  => Pages\ListStudents::route('/'),
          //  'create' => Pages\CreateStudent::route('/create'),
          //  'view'   => Pages\ViewStudent::route('/{record}'),
           // 'edit'   => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
