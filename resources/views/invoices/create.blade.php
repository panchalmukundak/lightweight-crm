@extends('layouts.app')

@section('title', 'Create Invoice')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full max-w-4xl mt-6" x-data="invoiceForm()">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-0">Create Invoice</h1>
            <p class="text-gray-600 mb-0">Generate a new invoice and add line items</p>
        </div>
        <a href="{{ route('invoices.index') }}"
           class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded shadow">
            Back to Invoices
        </a>
    </div>

    <div class="bg-white rounded shadow p-6 space-y-6">
        @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="client_id" class="block text-gray-700 font-semibold mb-2">Client</label>
                    <select name="client_id" id="client_id" required class="w-full rounded border border-gray-300 px-3 py-2">
                        <option value="">Select Client</option>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="invoice_number" class="block text-gray-700 font-semibold mb-2">Invoice #</label>
                    <input type="text" name="invoice_number" id="invoice_number" value="{{ old('invoice_number') }}" required
                           class="w-full rounded border border-gray-300 px-3 py-2" />
                </div>
                <div>
                    <label for="due_date" class="block text-gray-700 font-semibold mb-2">Due Date</label>
                    <input type="date" name="due_date" id="due_date" value="{{ old('due_date', now()->format('Y-m-d')) }}" required
                           class="w-full rounded border border-gray-300 px-3 py-2" />
                </div>
                <div>
                    <label for="status" class="block text-gray-700 font-semibold mb-2">Status</label>
                    <select name="status" id="status" required class="w-full rounded border border-gray-300 px-3 py-2">
                        <option value="">Select status</option>
                        <option value="draft"   {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="sent"    {{ old('status') == 'sent' ? 'selected' : '' }}>Sent</option>
                        <option value="paid"    {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="overdue" {{ old('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                    </select>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="font-semibold text-lg mb-3 text-gray-700">Invoice Items</h2>
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b border-gray-300 text-gray-700">
                            <th class="py-2 px-3">Description</th>
                            <th class="py-2 px-3 w-24">Qty</th>
                            <th class="py-2 px-3 w-24">Rate</th>
                            <th class="py-2 px-3 w-24">Tax</th> {{-- Added Tax Header --}}
                            <th class="py-2 px-3 w-24">Total</th>
                            <th class="py-2 px-3 w-16"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(item, index) in items" :key="index">
                            <tr>
                                <td class="py-2 px-3">
                                    <input type="text" :name="`items[${index}][description]`" placeholder="Description"
                                           x-model="item.description" required
                                           class="w-full border border-gray-300 rounded px-2 py-1" />
                                </td>
                                <td class="py-2 px-3">
                                    <input type="number" min="1" :name="`items[${index}][quantity]`" x-model="item.quantity" required
                                           class="w-full border border-gray-300 rounded px-2 py-1" />
                                </td>
                                <td class="py-2 px-3">
                                    <input type="number" min="0" step="0.01" :name="`items[${index}][rate]`" x-model="item.rate" required
                                           class="w-full border border-gray-300 rounded px-2 py-1" />
                                </td>
                                <td class="py-2 px-3">
                                    <input type="text" :name="`items[${index}][tax]`" x-model="item.tax" placeholder="Tax" autocomplete="off" class="w-full border border-gray-300 rounded px-2 py-1" />
                                </td>
                                <td class="py-2 px-3">
                                    <input type="text" :value="( (item.quantity || 0) * (item.rate || 0) ).toFixed(2)" disabled class="w-full border border-gray-200 bg-gray-100 rounded px-2 py-1 text-gray-500" />
                                </td>
                                <td class="py-2 px-3 text-center">
                                    <button type="button" @click="removeItem(index)" class="text-red-600 hover:text-red-800 font-bold rounded-full px-3" title="Remove Item">×</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <div class="mt-3">
                    <button type="button" @click="addItem()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-1 rounded shadow text-xs font-semibold">+ Add Item</button>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow">Create Invoice</button>
            </div>
        </form>
    </div>
</div>

{{-- Alpine.js for Invoice Items --}}
<script>
    function invoiceForm() {
        return {
            items: [{ description: '', quantity: 1, rate: 0, tax: '' }],
            addItem() {
                this.items.push({ description: '', quantity: 1, rate: 0, tax: '' });
            },
            removeItem(index) {
                this.items.splice(index, 1);
            },
        }
    }
</script>
@endsection
