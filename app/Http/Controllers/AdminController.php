<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        // Загружаем все заявки с отношениями user и status
        // Используем with для безопасной загрузки отношений
        $reports = Report::with(['user', 'status'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Получаем все статусы
        $statuses = Status::all();
        
        return view('admin.index', compact('reports', 'statuses'));
    }
}