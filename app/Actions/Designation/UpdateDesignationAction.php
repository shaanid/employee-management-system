<?php

namespace App\Actions\Designation;

use Illuminate\Support\Collection;
use \App\Models\Designation;

class UpdateDesignationAction
{
    public function execute(Collection $collection, Designation $designation): bool
    {
        $designation->update($collection->toArray());

        return true;
    }
}
