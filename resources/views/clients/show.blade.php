@extends('layouts.app')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full max-w-7xl mt-6">

  <!-- Page Header -->
  <div class="flex items-center justify-between mb-8">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">{{ $client->company ?? '---' }}</h1>
      <p class="text-gray-600 mt-1">Manage - {{ $client->name }} | <span class="capitalize text-green-600">{{ $client->status }}</span>
      </p>
    </div>
    <div class="flex space-x-4 my-14">
      <a href="{{ route('clients.edit', $client) }}"
         class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
        Edit Client
      </a>
      <a href="{{ route('clients.index') }}"
         class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded shadow">
        Back to Clients
      </a>
    </div>
  </div>
  <br class="clearfix">
  <!-- Client Info Card -->
  <div class="bg-white rounded shadow p-6 space-y-6">

    <p><strong>Phone:</strong> {{ $client->phone ?? 'N/A' }}</p>

    <p><strong>Email:</strong> {{ $client->email }}</p>

    <p><strong>Address:</strong> <span class="whitespace-pre-line">{{ $client->address ?? 'N/A' }}</span></p>

  </div>
</div>
@endsection
