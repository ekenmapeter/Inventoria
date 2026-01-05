<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use PDF;
use Mail;
use DB;
use Exception;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'supplier_id' => 'required|exists:suppliers,id',
                'expected_date' => 'required|date',
                'billing_address' => 'required|string',
                'issue_date' => 'required|date',
                'location_id' => 'required|exists:locations,id',
                'shipping_address' => 'required|string',
                'tracking_ref' => 'nullable|string',
                'ship_by' => 'nullable|string',
                'order_note' => 'nullable|string',
                'internal_note' => 'nullable|string',
                'items' => 'required|array|min:1',
                'items.*.item_id' => 'required|exists:items,id',
                'items.*.quantity' => 'required|numeric|min:1',
                'items.*.unit_value' => 'required|numeric|min:0',
                'items.*.line_total' => 'required|numeric|min:0',
                'items.*.measure' => 'required|string',
            ]);

            // Calculate totals
            $subtotal = collect($request->items)->sum('line_total');
            $total = $subtotal; // Add tax calculation here if needed

            // Create order
            $order = Order::create([
                'supplier_id' => $request->supplier_id,
                'expected_date' => $request->expected_date,
                'billing_address' => $request->billing_address,
                'issue_date' => $request->issue_date,
                'location_id' => $request->location_id,
                'shipping_address' => $request->shipping_address,
                'tracking_ref' => $request->tracking_ref,
                'ship_by' => $request->ship_by,
                'order_note' => $request->order_note,
                'internal_note' => $request->internal_note,
                'subtotal' => $subtotal,
                'total' => $total,
                'status' => 'pending'
            ]);

            // Create order items
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $item['item_id'],
                    'quantity' => $item['quantity'],
                    'description' => $item['description'],
                    'unit_value' => $item['unit_value'],
                    'line_total' => $item['line_total'],
                    'measure' => $item['measure']
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Order created successfully',
                'id' => $order->id
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function print($id)
    {
        try {
            $order = Order::with(['supplier', 'location', 'items.item'])->findOrFail($id);

            $pdf = PDF::loadView('pdf.purchase-order', [
                'order' => $order
            ]);

            return $pdf->stream("purchase-order-{$id}.pdf");

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to generate PDF',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function email($id)
    {
        try {
            $order = Order::with(['supplier', 'location', 'items.item'])->findOrFail($id);

            // Generate PDF
            $pdf = PDF::loadView('pdf.purchase-order', [
                'order' => $order
            ]);

            // Send email
            Mail::send('emails.purchase-order', ['order' => $order], function($message) use ($order, $pdf) {
                $message->to($order->supplier->email)
                        ->subject("Purchase Order #{$order->id}")
                        ->attachData($pdf->output(), "purchase-order-{$order->id}.pdf");
            });

            return response()->json([
                'message' => 'Order email sent successfully'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to send email',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $order = Order::with(['supplier', 'location', 'items.item'])->findOrFail($id);
            return response()->json($order);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Order not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function index()
    {
        try {
            $orders = Order::with(['supplier', 'location'])
                          ->orderBy('created_at', 'desc')
                          ->get();
            return response()->json($orders);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}