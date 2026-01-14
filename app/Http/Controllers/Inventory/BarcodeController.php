<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarcodeController extends Controller
{
    public function index()
    {
        return view('barcodes.index');
    }

    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'copies' => 'nullable|integer|min:1|max:10',
            'barcode_type' => 'nullable|in:code128,code39,ean13',
            'paper_size' => 'nullable|in:a4,letter,label',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $products = Product::whereIn('id', $request->product_ids)->get();
            $copies = $request->copies ?? 1;

            // Generate barcode data
            $barcodeData = [];
            foreach ($products as $product) {
                for ($i = 0; $i < $copies; $i++) {
                    $barcodeData[] = [
                        'item_code' => $product->item_code,
                        'description' => $product->description,
                        'price' => $product->sales_price,
                        'barcode_value' => $product->item_code,
                    ];
                }
            }

            return response()->json([
                'message' => 'Barcode data generated successfully',
                'data' => $barcodeData,
                'print_url' => route('barcodes.print', [
                    'ids' => implode(',', $request->product_ids),
                    'copies' => $copies,
                    'type' => $request->barcode_type ?? 'code128',
                    'size' => $request->paper_size ?? 'a4'
                ])
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to generate barcodes: ' . $e->getMessage()
            ], 500);
        }
    }

    public function print(Request $request)
    {
        $productIds = explode(',', $request->get('ids', ''));
        $copies = (int) $request->get('copies', 1);
        $barcodeType = $request->get('type', 'code128');
        $paperSize = $request->get('size', 'a4');

        $products = Product::whereIn('id', $productIds)->get();

        return view('barcodes.print', compact('products', 'copies', 'barcodeType', 'paperSize'));
    }
}
