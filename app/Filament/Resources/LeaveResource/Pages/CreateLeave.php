<?php

namespace App\Filament\Resources\LeaveResource\Pages;

use App\Filament\Resources\LeaveResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateLeave extends CreateRecord
{
    protected static string $resource = LeaveResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['leave_type'] = 'al';
        $user = User::find($data['employee_id']);
        $data['employee_id'] = $user->employee->id;

        return $data;
    }

//    protected function handleRecordCreation(array $data): Model
//    {
//        $data['user_id'] = $user->id;
//        unset($data['user']);
//
//        return static::getModel()::create($data);
//    }
}
