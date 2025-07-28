@extends('layouts.app')

@section('title', 'Invoice Details')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full max-w-4xl mt-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-0">Invoice #{{ $invoice->invoice_number }}</h1>
            <p class="text-gray-600 mb-0">For client: <span class="font-semibold text-gray-900">{{ $invoice->client->name ?? 'N/A' }}</span></p>
        </div>
        <a href="{{ route('invoices.index') }}"
           class="bg-white hover:bg-white text-gray-800 font-semibold py-2 px-6 rounded shadow">
            Back to Invoices
        </a>
    </div>

    <div class="bg-white rounded shadow p-6 space-y-5">
        <div class="flex flex-col sm:flex-row sm:space-x-10 space-y-3 sm:space-y-0">
            <div><strong>Status:</strong>
                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                @if($invoice->status == 'paid') bg-green-100 text-green-800
                @elseif($invoice->status == 'overdue') bg-red-100 text-red-800
                @elseif($invoice->status == 'sent') bg-yellow-100 text-yellow-800
                @else bg-gray-100 text-gray-800 @endif"
                >{{ ucfirst($invoice->status) }}</span>
            </div>
            <div><strong>Due Date:</strong> {{ $invoice->due_date?->format('M d, Y') }}</div>
            <div><strong>Total:</strong> ${{ number_format($invoice->total, 2) }}</div>
        </div>

        <div>
            <h2 class="font-semibold text-lg text-gray-700 mt-6 mb-2">Invoice Items</h2>
            <table class="min-w-full text-sm text-left border rounded overflow-hidden">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Qty</th>
                        <th class="px-4 py-2">Rate</th>
                        <th class="px-4 py-2">Tax</th>
                        <th class="px-4 py-2">Amount</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($invoice->items as $item)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $item->description }}</td>
                        <td class="px-4 py-2">{{ $item->quantity }}</td>
                        <td class="px-4 py-2">${{ number_format($item->rate, 2) }}</td>
                        <td class="px-4 py-2">{{ $item->tax ?? '-' }}</td> {{-- Display tax, show "-" if empty --}}
                        <td class="px-4 py-2">${{ number_format($item->amount, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end mt-8 space-x-3">
            <a href="{{ route('invoices.edit', $invoice) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow">
                Edit Invoice
            </a>
            <a href="{{ route('invoices.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded shadow">
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection
