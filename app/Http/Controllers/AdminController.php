<?php

namespace App\Http\Controllers;
use App\Models\Report;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request){

        $reports = Report::with(['user', 'status'])
        ->paginate(10);

        $statuses = Status::all();

        return view ('admin.index', compact('reports', 'statuses'));
    }
}