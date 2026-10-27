<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        $query = Product::with('category');
    
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                ->orWhere('code', 'like', "%{$keyword}%");
            });
        }
    
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->query('stock_status') === 'menipis') {
            $query->where('stock', '>', 0)
                  ->where('stock', '<=', 5);
        } elseif ($request->query('stock_status') === 'habis') {
            $query->where('stock', '<=', 0);
        }

        $perPage = (int) $request->query('per_page', 10);

        if (!in_array($perPage, [10, 25, 50], true)) {
            $perPage = 10;
        }
    
        $products = $query->latest()
            ->paginate($perPage)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view(
            'master-data.product.index',
            compact('products', 'categories', 'perPage')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('master-data.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['transactionDetails.transaction']);
    
        $totalTerjual = $product->transactionDetails->sum('qty');
    
        $riwayat = $product->transactionDetails()
            ->with('transaction')
            ->latest()
            ->take(10)
            ->get();
    
        $peringkatHarian = $product->transactionDetails()
            ->join(
                'transactions',
                'transaction_details.transaction_id',
                '=',
                'transactions.id'
            )
            ->select(
                DB::raw('DATE(transactions.created_at) as tanggal'),
                DB::raw('SUM(transaction_details.qty) as total_qty')
            )
            ->groupBy(DB::raw('DATE(transactions.created_at)'))
            ->orderByDesc('total_qty')
            ->orderByDesc('tanggal')
            ->limit(5)
            ->get();

        return view('master-data.product.show', compact('product', 'totalTerjual', 'riwayat', 'peringkatHarian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('master-data.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {        
        $product->update($request->validated());
    
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {    
        $product->delete();
    
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
