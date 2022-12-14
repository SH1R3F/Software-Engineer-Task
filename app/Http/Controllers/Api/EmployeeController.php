<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeCollection;

class EmployeeController extends Controller
{
    public function __invoke(Request $request)
    {

        // Probably would've added some validation and filtering. But for simplicity I'll keep it as it is.

        $employees = User::query()
            ->where('role_id', 2)
            ->paginate(20);

        return EmployeeCollection::make($employees);
    }
}
