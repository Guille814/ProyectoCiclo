<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $report = Report::create([
            'user_id' => auth()->id(),
            'reportable_id' => $request->reportable_id,
            'reportable_type' => $request->reportable_type,
            'reason' => $request->reason,
            'description' => $request->description,
        ]);

        return response()->json(['success' => true]);
    }

    public function index()
    {
        $reports = Report::all();
        $reportCounts = Report::select('reportable_id', 'reportable_type', DB::raw('count(*) as total_reports'))
            ->groupBy('reportable_id', 'reportable_type')
            ->get()
            ->keyBy(function ($item) {
                return $item->reportable_type . '_' . $item->reportable_id;
            });

        return view('admin.reportes', compact('reports', 'reportCounts'));
    }

    public function destroy($reportableId)
    {
        Report::where('reportable_id', $reportableId)->delete();
        return redirect()->route('admin.reportes')->with('success', 'Reporte eliminado con éxito.');
    }

    public function show($reportableId, $reportableType)
    {
        $modelClass = 'App\\Models\\' . class_basename($reportableType);
        $query = $modelClass::query();

        if (method_exists($modelClass, 'comments')) {
            $query->with('comments');
        }
        if (method_exists($modelClass, 'user')) {
            $query->with('user');
        }
        if (method_exists($modelClass, 'posts')) {
            $query->with('posts.comments');
        }

        $reportable = $query->find($reportableId);

        if (!$reportable) {
            return redirect()->back()->with('error', 'El elemento reportado no existe.');
        }

        return view('admin.reports.show', compact('reportable', 'reportableType'));
    }
}
