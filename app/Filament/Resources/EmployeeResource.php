<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use App\Models\State;
use App\Models\User;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user.name')
                    ->label('Name')
                    ->required(),
                TextInput::make('user.email')
                    ->email()
                    ->required(),
                TextInput::make('id_no')->required(),
                Textarea::make('address')->required(),
                Select::make('state_id')
                    ->relationship('state', 'name')
                    ->required(),
                TextInput::make('postcode')
                    ->type('number')
                    ->integer()
                    ->required(),
                TextInput::make('phone_number')
                    ->prefix('+60')
                    ->required(),
                DatePicker::make('hire_date')->required(),
                TextInput::make('salary')
                    ->type('number')
                    ->numeric()
                    ->prefix('RM')
                    ->required(),
                Select::make('manager_id')
                    ->relationship('manager.user', 'name')
                    ->placeholder('Select a manager'),
                Forms\Components\Hidden::make('user_id'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('user.name'),
                TextColumn::make('user.email'),
                TextColumn::make('id_no')->label('IC No'),
                TextColumn::make('hire_date'),
                TextColumn::make('resignation_date'),
                TextColumn::make('salary'),
                TextColumn::make('manager.user.name')->label('Manager'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        dd($data, 'sini');
        $user = User::create($data['user']);
        $data['user_id'] = $user->id;
        unset($data['user']);

        return static::getModel()::create($data);
    }
}
