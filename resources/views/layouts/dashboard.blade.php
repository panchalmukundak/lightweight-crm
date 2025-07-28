@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Message -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg p-6 text-white">
        <h1 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
        <p class="text-indigo-100">Here's what's happening with your CRM today.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Leads -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Leads</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_leads'] }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <span class="text-green-500 text-sm font-medium">+12%</span>
                <span class="text-gray-500 text-sm ml-2">from last month</span>
            </div>
        </div>

        <!-- Total Clients -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Clients</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_clients'] }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a3 3 0 11-6 0 3 3 0 016 0zm-6.5-3a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <span class="text-green-500 text-sm font-medium">+8%</span>
                <span class="text-gray-500 text-sm ml-2">from last month</span>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                    <p class="text-3xl font-bold text-gray-900">${{ number_format($stats['total_revenue'], 2) }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <span class="text-green-500 text-sm font-medium">+23%</span>
                <span class="text-gray-500 text-sm ml-2">from last month</span>
            </div>
        </div>

        <!-- Pending Invoices -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending Invoices</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_invoices'] }}</p>
                </div>
                <div class="bg-red-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <span class="text-red-500 text-sm font-medium">{{ $stats['overdue_invoices'] }}</span>
                <span class="text-gray-500 text-sm ml-2">overdue</span>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Leads -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Recent Leads</h3>
                    <a href="{{ route('leads.index') }}" class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">View All</a>
                </div>
            </div>

            <div class="p-6">
                @forelse($recent_leads as $lead)
                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-100 rounded-full p-2">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $lead->name }}</p>
                            <p class="text-xs text-gray-500">{{ $lead->email }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                            @if($lead->status === 'new') bg-blue-100 text-blue-800
                            @elseif($lead->status === 'contacted') bg-yellow-100 text-yellow-800
                            @elseif($lead->status === 'qualified') bg-green-100 text-green-800
                            @elseif($lead->status === 'converted') bg-purple-100 text-purple-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($lead->status) }}
                        </span>
                        <p class="text-xs text-gray-500 mt-1">{{ $lead->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <p class="text-gray-500">No leads yet</p>
                    <a href="{{ route('leads.create') }}" class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">Add your first lead</a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Invoices -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Recent Invoices</h3>
                    <a href="{{ route('invoices.index') }}" class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">View All</a>
                </div>
            </div>

            <div class="p-6">
                @forelse($recent_invoices as $invoice)
                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                    <div class="flex items-center space-x-3">
                        <div class="bg-green-100 rounded-full p-2">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $invoice->invoice_number }}</p>
                            <p class="text-xs text-gray-500">{{ $invoice->client->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">${{ number_format($invoice->total, 2) }}</p>
                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                            @if($invoice->status === 'draft') bg-gray-100 text-gray-800
                            @elseif($invoice->status === 'sent') bg-blue-100 text-blue-800
                            @elseif($invoice->status === 'paid') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-500">No invoices yet</p>
                    <a href="{{ route('invoices.create') }}" class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">Create your first invoice</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('leads.create') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                <div class="bg-blue-100 rounded-full p-2 mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-900">Add New Lead</p>
                    <p class="text-sm text-gray-600">Capture a new potential client</p>
                </div>
            </a>

            <a href="{{ route('clients.create') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors duration-200">
                <div class="bg-green-100 rounded-full p-2 mr-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-900">Add New Client</p>
                    <p class="text-sm text-gray-600">Register a new client</p>
                </div>
            </a>

            <a href="{{ route('invoices.create') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors duration-200">
                <div class="bg-purple-100 rounded-full p-2 mr-3">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-900">Create Invoice</p>
                    <p class="text-sm text-gray-600">Generate a new invoice</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
