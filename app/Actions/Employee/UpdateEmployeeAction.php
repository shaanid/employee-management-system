<?php

namespace App\Actions\Employee;


use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UpdateEmployeeAction
{
    public function execute(Collection $collection, User $user): bool
    {
        $user->update($collection->toArray());
    
        return true;
    }
    
    
    

}