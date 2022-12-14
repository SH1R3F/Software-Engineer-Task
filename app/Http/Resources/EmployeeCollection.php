<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollection extends ResourceCollection
{


    public static $wrap = 'employees';


    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
