<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_leads' => Lead::count(),
            'total_clients' => Client::count(),
            'total_invoices' => Invoice::count(),
            'total_revenue' => Invoice::where('status', 'paid')->sum('total'),
            'pending_invoices' => Invoice::where('status', 'sent')->count(),
            'overdue_invoices' => Invoice::where('status', 'overdue')->count(),
        ];

        $recent_leads = Lead::latest()->take(5)->get();
        $recent_invoices = Invoice::with('client')->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recent_leads', 'recent_invoices'));
    }
}
