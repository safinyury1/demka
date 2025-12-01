<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort');
        if ($sort != 'asc' && $sort != 'desc') {
            $sort = 'desc';
        }

        $status = $request->input('status');
        $validate = $request->validate([
            'status' => "exists:statuses,id"
        ]);
        
        if ($validate && $status) {
            $reports = Report::where('status_id', $status)
                ->where('user_id', Auth::user()->id)
                ->orderBy('created_at', $sort)
                ->paginate(5);
        } else {
            $reports = Report::where('user_id', Auth::user()->id)
                ->orderBy('created_at', $sort)
                ->paginate(5);
        }

        $statuses = Status::all();
        return view('Reports.index', compact('reports', 'statuses', 'sort', 'status'));
    }

    public function destroy(Report $report)
    {
        if (Auth::user()->id === $report->user_id) {
            $report->delete();
            return redirect()->route('reports.index'); 
        } else {
            abort(403, 'У вас нет прав на удаление этой записи.');
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => 'required|string',
            'description' => 'required|string',
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['status_id'] = 1;

        Report::create($data); 
        return redirect()->route('reports.index'); 
    }

    public function edit(Report $report)
    {
        if (Auth::user()->id === $report->user_id) {
            return view('reports.edit', compact('report'));
        } else {
            abort(403, 'У вас нет прав на редактирование этой записи.');
        }
    }

    public function update(Request $request, Report $report)
    {
        if (Auth::user()->id === $report->user_id) {
            $data = $request->validate([
                'number' => 'required|string',
                'description' => 'required|string',
            ]);

            $report->update($data);
            return redirect()->route('reports.index'); 
        } else {
            abort(403, 'У вас нет прав на редактирование этой записи.');
        }
    }

    public function show(Report $report)
    {
        if (Auth::user()->id === $report->user_id) {
            return view('reports.show', compact('report'));
        } else {
            abort(403, 'У вас нет прав на просмотр этой записи.');
        }
    }
}