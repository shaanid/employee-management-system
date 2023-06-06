<?php

namespace App\Actions\Designation;

use Illuminate\Support\Collection;
use \App\Models\Designation;

class StoreDesignationAction
{
    public function execute(Collection $collection): bool
    {
        $designation = Designation::create($collection->toArray());
        
        return true;
    }
}
