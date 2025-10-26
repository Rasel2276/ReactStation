<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    public function index()
    {
        
        $employees = Employee::with(['users', 'clients'])->get();

        return view('employees.index', compact('employees'));
    }

   
    public function showClients($id)
    {
        $employee = Employee::with('clients')->findOrFail($id);
        return view('employees.clients', compact('employee'));
    }
}

