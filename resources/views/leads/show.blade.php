@extends('layouts.app')

@section('title', 'Lead Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('leads.index') }}"
                   class="text-gray-600 hover:text-gray-800 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $lead->name }}</h1>
                    <p class="text-gray-600">Lead Details</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('leads.edit', $lead) }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span>Edit</span>
                </a>

                <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="inline"
                      onsubmit="return confirm('Are you sure you want to delete this lead?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        <span>Delete</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Lead Info Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Contact Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                        <p class="text-sm text-gray-900">{{ $lead->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                        <p class="text-sm text-gray-900">
                            <a href="mailto:{{ $lead->email }}" class="text-indigo-600 hover:text-indigo-800">
                                {{ $lead->email }}
                            </a>
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                        <p class="text-sm text-gray-900">
                            @if($lead->phone)
                                <a href="tel:{{ $lead->phone }}" class="text-indigo-600 hover:text-indigo-800">
                                    {{ $lead->phone }}
                                </a>
                            @else
                                <span class="text-gray-400">Not provided</span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Company</label>
                        <p class="text-sm text-gray-900">{{ $lead->company ?? 'Not provided' }}</p>
                    </div>
                </div>
            </div>

            <!-- Notes Section -->
            @if($lead->notes)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Notes
                </h3>
                <div class="prose prose-sm max-w-none">
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $lead->notes }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status & Source -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Lead Details</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full
                            @if($lead->status === 'new') bg-blue-100 text-blue-800
                            @elseif($lead->status === 'contacted') bg-yellow-100 text-yellow-800
                            @elseif($lead->status === 'qualified') bg-green-100 text-green-800
                            @elseif($lead->status === 'converted') bg-purple-100 text-purple-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($lead->status) }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Lead Source</label>
                        <p class="text-sm text-gray-900">
                            @if($lead->source)
                                <span class="inline-flex px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded">
                                    {{ ucfirst($lead->source) }}
                                </span>
                            @else
                                <span class="text-gray-400">Not specified</span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Created Date</label>
                        <p class="text-sm text-gray-900">{{ $lead->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                        <p class="text-sm text-gray-900">{{ $lead->updated_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>

                <div class="space-y-3">
                    <a href="mailto:{{ $lead->email }}"
                       class="w-full flex items-center justify-center px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Send Email
                    </a>

                    @if($lead->phone)
                    <a href="tel:{{ $lead->phone }}"
                       class="w-full flex items-center justify-center px-4 py-2 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Call Now
                    </a>
                    @endif

                    @if($lead->status !== 'converted')
                    <form action="{{ route('clients.store') }}" method="POST" class="w-full">
                        @csrf
                        <input type="hidden" name="name" value="{{ $lead->name }}">
                        <input type="hidden" name="email" value="{{ $lead->email }}">
                        <input type="hidden" name="phone" value="{{ $lead->phone }}">
                        <input type="hidden" name="company" value="{{ $lead->company }}">
                        <input type="hidden" name="status" value="active">

                        <button type="submit"
                                class="w-full flex items-center justify-center px-4 py-2 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a3 3 0 11-6 0 3 3 0 016 0zm-6.5-3a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            Convert to Client
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
