@extends('layouts.app')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full max-w-4xl mt-6">
  <!-- Header -->
  <div class="flex items-center justify-between mb-8">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Clients</h1>
      <p class="text-gray-600 mt-1">
        Manage - {{ $client->name }} | <span class="text-green-600 capitalize">{{ $client->status }}</span>
      </p>
    </div>
    <div>
      <a href="{{ route('clients.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded shadow">Back to Clients</a>
    </div>
  </div>
  <br class="clearfix">

  <div class="flex flex-wrap mb-12">
    <div class="w-full px-4">
      <div class="relative flex flex-col min-w-0 break-words bg-white rounded shadow-lg p-6">

        @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="{{ route('clients.update', $client) }}" method="POST" class="space-y-6">
          @csrf
          @method('PUT')

          {{-- Name and Company side by side --}}
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="name" class="block text-gray-700 font-semibold mb-2">
                Name <span class="text-red-500">*</span>
              </label>
              <input type="text" id="name" name="name" value="{{ old('name', $client->name) }}" required autofocus
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
              <label for="company" class="block text-gray-700 font-semibold mb-2">Company</label>
              <input type="text" id="company" name="company" value="{{ old('company', $client->company) }}"
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
          </div>

          {{-- Email and Phone side by side --}}
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="email" class="block text-gray-700 font-semibold mb-2">
                Email <span class="text-red-500">*</span>
              </label>
              <input type="email" id="email" name="email" value="{{ old('email', $client->email) }}" required
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
              <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone</label>
              <input type="text" id="phone" name="phone" value="{{ old('phone', $client->phone) }}"
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
          </div>

          {{-- Address --}}
          <div>
            <label for="address" class="block text-gray-700 font-semibold mb-2">Address</label>
            <textarea id="address" name="address" rows="3"
              class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('address', $client->address) }}</textarea>
          </div>

          {{-- Status radio buttons --}}
          <div>
            <span class="block text-gray-700 font-semibold mb-2">Status</span>
            <div class="flex items-center space-x-6">
              <label class="inline-flex items-center cursor-pointer">
                <input type="radio" name="status" value="active"
                  {{ old('status', $client->status) === 'active' ? 'checked' : '' }}
                  class="form-radio text-indigo-600 focus:ring-indigo-500">
                <span class="ml-2 text-gray-700">Active</span>
              </label>

              <label class="inline-flex items-center cursor-pointer mx-5">
                <input type="radio" name="status" value="inactive"
                  {{ old('status', $client->status) === 'inactive' ? 'checked' : '' }}
                  class="form-radio text-indigo-600 focus:ring-indigo-500">
                <span class="ml-2 text-gray-700">Inactive</span>
              </label>
            </div>
          </div>

          {{-- Buttons --}}
          <div class="flex space-x-4 mt-6">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow">Update Client</button>
            <a href="{{ route('clients.show', $client) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded shadow">
              Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</br>
@endsection
