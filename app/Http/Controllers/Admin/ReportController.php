<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $userQuery = User::query();

        if ($request->from && $request->to) {
            $userQuery->whereBetween('created_at', [
                $request->from . ' 00:00:00',
                $request->to . ' 23:59:59'
            ]);
        }

        $users = $userQuery->latest()->get();

        // QUERY BARU KHUSUS GRAFIK
        $chartQuery = User::query();

        if ($request->from && $request->to) {
            $chartQuery->whereBetween('created_at', [
                $request->from . ' 00:00:00',
                $request->to . ' 23:59:59'
            ]);
        }

        $monthly = $chartQuery
            ->select(
                DB::raw("COUNT(*) as total"),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        return view('admin.reports.index', compact('users', 'monthly'));
    }

    public function exportPdf(Request $request)
    {
        $query = User::query();

        if ($request->from && $request->to) {
            $query->whereBetween('created_at', [
                $request->from,
                $request->to
            ]);
        }

        $users = $query->latest()->get();

        $pdf = Pdf::loadView('admin.reports.pdf', [
            'users' => $users,
            'from' => $request->from,
            'to' => $request->to
        ]);

        return $pdf->download('user-report.pdf');
    }
}
