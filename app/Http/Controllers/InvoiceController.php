<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('client')->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();
        return view('invoices.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'invoice_number' => 'required|unique:invoices,invoice_number',
            'due_date' => 'required|date',
            'status' => 'required|in:draft,sent,paid,overdue',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.rate' => 'required|numeric|min:0',
            'items.*.tax' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $amount = 0;
            $totalTax = 0;

            foreach ($validated['items'] as $item) {
                $lineTotal = $item['quantity'] * $item['rate'];
                $amount += $lineTotal;
                $itemTax = isset($item['tax']) ? (float)$item['tax'] : 0;
                $totalTax += $itemTax;
            }

            $total = $amount + $totalTax;

            $invoice = Invoice::create([
                'client_id' => $validated['client_id'],
                'invoice_number' => $validated['invoice_number'],
                'amount' => $amount,
                'tax' => $totalTax,
                'total' => $total,
                'due_date' => $validated['due_date'],
                'status' => $validated['status'],
            ]);

            foreach ($validated['items'] as $item) {
                $invoice->items()->create([
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'rate' => $item['rate'],
                    'amount' => $item['quantity'] * $item['rate'],
                    'tax' => $item['tax'] ?? 0,
                ]);
            }

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Error creating invoice: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('client', 'items');
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $clients = Client::orderBy('name')->get();

        // Prepare items array for Alpine.js
        $initialItems = $invoice->items->map(function ($item) {
            return [
                'description' => $item->description,
                'quantity' => $item->quantity,
                'rate' => $item->rate,
                'tax' => $item->tax,
            ];
        })->toArray();

        return view('invoices.edit', compact('invoice', 'clients', 'initialItems'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'invoice_number' => "required|unique:invoices,invoice_number,{$invoice->id}",
            'due_date' => 'required|date',
            'status' => 'required|in:draft,sent,paid,overdue',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.rate' => 'required|numeric|min:0',
            'items.*.tax' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $amount = 0;
            $totalTax = 0;

            foreach ($validated['items'] as $item) {
                $lineTotal = $item['quantity'] * $item['rate'];
                $amount += $lineTotal;
                $itemTax = isset($item['tax']) ? (float)$item['tax'] : 0;
                $totalTax += $itemTax;
            }

            $total = $amount + $totalTax;

            $invoice->update([
                'client_id' => $validated['client_id'],
                'invoice_number' => $validated['invoice_number'],
                'amount' => $amount,
                'tax' => $totalTax,
                'total' => $total,
                'due_date' => $validated['due_date'],
                'status' => $validated['status'],
            ]);

            // Delete old items and recreate to simplify
            $invoice->items()->delete();

            foreach ($validated['items'] as $item) {
                $invoice->items()->create([
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'rate' => $item['rate'],
                    'amount' => $item['quantity'] * $item['rate'],
                    'tax' => $item['tax'] ?? 0,
                ]);
            }

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Error updating invoice: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
