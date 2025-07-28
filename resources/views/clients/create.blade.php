@extends('layouts.app')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full max-w-4xl mt-6">
  <div class="flex flex-wrap mb-12">
    <div class="w-full px-4">
      <div class="relative flex flex-col min-w-0 break-words bg-white rounded shadow-lg p-6">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">Add New Client</h3>

        @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="{{ route('clients.store') }}" method="POST" class="space-y-6">
          @csrf
          <div>
            <label for="name" class="block text-gray-700 font-semibold mb-2">Name <span class="text-red-500">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
              class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required autofocus>
          </div>

          <div>
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email <span class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
              class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
          </div>

          <div>
            <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
              class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          </div>

          <div>
            <label for="company" class="block text-gray-700 font-semibold mb-2">Company</label>
            <input type="text" id="company" name="company" value="{{ old('company') }}"
              class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          </div>

          <div>
            <label for="address" class="block text-gray-700 font-semibold mb-2">Address</label>
            <textarea id="address" name="address" rows="3"
              class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('address') }}</textarea>
          </div>

          <div>
            <label for="status" class="block text-gray-700 font-semibold mb-2">Status</label>
            <select id="status" name="status"
              class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
              <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
          </div>

          <div class="flex space-x-4 mt-6">
            <button type="submit"
              class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow">
              Create Client
            </button>
            <a href="{{ route('clients.index') }}"
              class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded shadow">
              Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
