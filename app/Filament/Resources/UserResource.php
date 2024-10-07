<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Spatie\Permission\Models\Role;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Name'),

                TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique(User::class, 'email', ignoreRecord: true)
                    ->label('Email'),

                TextInput::make('password')
                    ->password()
                    ->required(fn ($record) => !$record) // Only required when creating
                    ->label('Password')
                    ->minLength(8),

                Select::make('roles')
                    ->label('Roles')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->options(Role::all()->pluck('name', 'id')->toArray()) // Fetch available roles
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('roles.name')->label('Roles')->sortable(), // Show roles
            ])
            ->filters([
                // Add any filters if necessary
            ])
            ->actions([
                EditAction::make(),  // Correct action namespace
            ])
            ->bulkActions([
                DeleteBulkAction::make(),  // Correct bulk action namespace
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add any relationships if necessary
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
