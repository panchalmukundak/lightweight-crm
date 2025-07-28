@extends('layouts.app')

@section('title', 'Edit Lead')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('leads.show', $lead) }}"
               class="text-gray-600 hover:text-gray-800 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Lead</h1>
                <p class="text-gray-600">Update {{ $lead->name }}'s information</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form action="{{ route('leads.update', $lead) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name & Email Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', $lead->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-300 @enderror"
                           placeholder="Enter full name"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email', $lead->email) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-300 @enderror"
                           placeholder="Enter email address"
                           required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Phone & Company Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="text"
                           id="phone"
                           name="phone"
                           value="{{ old('phone', $lead->phone) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('phone') border-red-300 @enderror"
                           placeholder="Enter phone number">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                    <input type="text"
                           id="company"
                           name="company"
                           value="{{ old('company', $lead->company) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('company') border-red-300 @enderror"
                           placeholder="Enter company name">
                    @error('company')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Source & Status Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="source" class="block text-sm font-medium text-gray-700 mb-2">Lead Source</label>
                    <select id="source"
                            name="source"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('source') border-red-300 @enderror">
                        <option value="">Select source</option>
                        <option value="website" {{ old('source', $lead->source) === 'website' ? 'selected' : '' }}>Website</option>
                        <option value="referral" {{ old('source', $lead->source) === 'referral' ? 'selected' : '' }}>Referral</option>
                        <option value="social" {{ old('source', $lead->source) === 'social' ? 'selected' : '' }}>Social Media</option>
                        <option value="email" {{ old('source', $lead->source) === 'email' ? 'selected' : '' }}>Email Campaign</option>
                        <option value="phone" {{ old('source', $lead->source) === 'phone' ? 'selected' : '' }}>Phone Call</option>
                        <option value="event" {{ old('source', $lead->source) === 'event' ? 'selected' : '' }}>Event</option>
                        <option value="other" {{ old('source', $lead->source) === 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('source')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status"
                            name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('status') border-red-300 @enderror"
                            required>
                        <option value="new" {{ old('status', $lead->status) === 'new' ? 'selected' : '' }}>New</option>
                        <option value="contacted" {{ old('status', $lead->status) === 'contacted' ? 'selected' : '' }}>Contacted</option>
                        <option value="qualified" {{ old('status', $lead->status) === 'qualified' ? 'selected' : '' }}>Qualified</option>
                        <option value="converted" {{ old('status', $lead->status) === 'converted' ? 'selected' : '' }}>Converted</option>
                        <option value="lost" {{ old('status', $lead->status) === 'lost' ? 'selected' : '' }}>Lost</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                <textarea id="notes"
                          name="notes"
                          rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('notes') border-red-300 @enderror"
                          placeholder="Add any additional notes about this lead...">{{ old('notes', $lead->notes) }}</textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('leads.show', $lead) }}"
                   class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors duration-200 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Update Lead</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
