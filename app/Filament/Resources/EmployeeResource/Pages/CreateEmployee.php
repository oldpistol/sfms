<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user']['password'] = bcrypt('password');

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $user = User::create($data['user']);
        $data['user_id'] = $user->id;
        unset($data['user']);

        return static::getModel()::create($data);
    }
}
