<?php

namespace App\Filament\Resources;

use App\Models\TimeSchedule;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\TimeScheduleResource\Pages;

class TimeScheduleResource extends Resource
{
    protected static ?string $model = TimeSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('student_id')
                    ->label('Student')
                    ->relationship('student', 'name')
                    ->required(),
                    
                Select::make('platform_id')
                    ->label('Platform')
                    ->relationship('platform', 'name')
                    ->required(),

                Select::make('day')
                    ->label('Day of the Week')
                    ->options([
                        'monday' => 'Monday',
                        'tuesday' => 'Tuesday',
                        'wednesday' => 'Wednesday',
                        'thursday' => 'Thursday',
                        'friday' => 'Friday',
                        'saturday' => 'Saturday',
                        'sunday' => 'Sunday',
                    ])
                    ->required(),

                TimePicker::make('start_time')
                    ->label('Start Time')
                    ->required(),

                TimePicker::make('end_time')
                    ->label('End Time')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')
                    ->label('Student')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('platform.name')
                    ->label('Platform')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('day')
                    ->label('Day'),

                TextColumn::make('start_time')
                    ->label('Start Time'),

                TextColumn::make('end_time')
                    ->label('End Time'),

                TextColumn::make('duration')
                    ->label('Duration (hours)'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTimeSchedules::route('/'),
            'create' => Pages\CreateTimeSchedule::route('/create'),
            'edit' => Pages\EditTimeSchedule::route('/{record}/edit'),
        ];
    }
}
