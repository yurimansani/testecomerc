<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Hamcrest\Arrays\IsArray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pagination = Order::with('client')->with('product')->with('product.product')->paginate(20);
        // dd(Order::with('client')->with('product.product')->get());
        // dd(Order::with('client')->with('product.product')->get());
        // $pagination = Order::paginate(20);
        return Inertia::render('Orders/Index', [
            'nextCursor' => $pagination->currentPage() + 1,
            'previousCursor' => ($pagination->currentPage() - 1) ? $pagination->currentPage() - 1 : 1,
            'nextPageUrl' => $pagination->nextPageUrl(),
            'currentPage' => $pagination->currentPage(),
            'hasPages' => $pagination->hasPages(),
            'lastPage' => $pagination->lastPage(),
            'previousPageUrl' => $pagination->previousPageUrl(),
            'orders' => $pagination->items(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Orders/Create', [
            'products' => Product::all(),
            'clients' => Client::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'amount' =>         'required|numeric',
            'status' =>         'required|string',
            'client' =>         'required',
            'products' =>         'required',
        ]);
        $products = $request->input('products');

        // dd($validated['client']['id']);
        $orderId = Order::insertGetId([
            'amount' => $validated['amount'],
            'status' => $validated['status'],
            'client_id' => $validated['client']['id'],
        ]);
        foreach ($products as $product) {

            // dd($product['id'], $orderId);
            OrderProduct::insertGetId([
                'order_id' => $orderId,
                'product_id' => $product['id']
            ]);
        }
        return redirect(route('orders.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return Inertia::render('Orders/Edit', [
            'orderData' => $order->with('client')->with('product')->with('product.product')->first(),


            'allProducts' => Product::all(),
            'allClients' => Client::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {

        $validated = $request->validate([
            'amount' =>         'required|numeric',
            'status' =>         'required|string',
            'client' =>         'required',
            'products' =>         'required',
        ]);

        OrderProduct::where('order_id', $order->id)->delete();
        $products = $request->input('products');

        $order->amount = $validated['amount'];
        $order->status = $validated['status'];
        $order->client_id = $validated['client']['id'];

        $order->save();

        foreach ($products as $product) {

            // dd($product['id'], $orderId);
            OrderProduct::insertGetId([
                'order_id' => $order->id,
                'product_id' => $product['id']
            ]);
        }
        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {

        OrderProduct::where('order_id', $order->id)->delete();

        $order->delete();
        return redirect(route('orders.index'));
    }
}
