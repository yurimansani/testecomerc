<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagination = Product::paginate(20);
        return Inertia::render('Products/Index', [
            'nextCursor' => $pagination->currentPage() + 1,
            'previousCursor' => ($pagination->currentPage() - 1) ? $pagination->currentPage() - 1 : 1,
            'nextPageUrl' => $pagination->nextPageUrl(),
            'currentPage' => $pagination->currentPage(),
            'hasPages' => $pagination->hasPages(),
            'lastPage' => $pagination->lastPage(),
            'previousPageUrl' => $pagination->previousPageUrl(),
            'products' => $pagination->items(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' =>           'required|string|max:100',
            'price' =>          'required|string|max:100',
        ]);
        $file = "data:image/png;base64," . base64_encode(file_get_contents($request->file('photo')));
        $validated['photo'] = $file;

        Product::create($validated);
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // dd($product);
        return Inertia::render('Products/Edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $validated = $request->validate([
            'name' =>           'required|string|max:100',
            'price' =>          'required|numeric',
        ]);
        if ($request->hasFile('photo')) {
            $file = "data:image/png;base64," . base64_encode(file_get_contents($request->file('photo')));
            $product->photo = $file;
        }
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->save();
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, Request $request)
    {
        $product->delete();
        return redirect(route('products.index'));
    }
}
