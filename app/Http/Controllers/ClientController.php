<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagination = Client::paginate(20);
        // dd([
        //     'nextPageUrl'=>$pagination->nextPageUrl(),
        //     'currentPage' => $pagination->currentPage(),
        //     'hasPages' => $pagination->hasPages(),
        //     'lastPage' => $pagination->lastPage(),
        //     'previousPageUrl' => $pagination->previousPageUrl(),
        //     'clients' => $pagination->items(),
        // ]);
        return Inertia::render('Clients/Index', [
            'nextCursor'=>$pagination->currentPage() + 1,
            'previousCursor'=>($pagination->currentPage() - 1)? $pagination->currentPage() - 1: 1,
            'nextPageUrl'=>$pagination->nextPageUrl(),
            'currentPage' => $pagination->currentPage(),
            'hasPages' => $pagination->hasPages(),
            'lastPage' => $pagination->lastPage(),
            'previousPageUrl' => $pagination->previousPageUrl(),
            'clients' => $pagination->items(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Clients/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' =>           'required|string|max:100',
            'email' =>          'required|string|max:100',
            'birthDate' =>      'required|string|max:100',
            'address' =>        'required|string|max:100',
            'complement' =>     'required|string|max:100',
            'neighborhood' =>   'required|string|max:100',
            'zipcode' =>        'required|string|max:10',
        ]);
        Client::create($validated);

        return redirect(route('clients.index'));
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return Inertia::render('Clients/Edit',['client' => $client]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' =>           'required|string|max:100',
            'email' =>          'required|string|max:100',
            'birthDate' =>      'required|string|max:100',
            'address' =>        'required|string|max:100',
            'complement' =>     'required|string|max:100',
            'neighborhood' =>   'required|string|max:100',
            'zipcode' =>        'required|string|max:10',
        ]);
        $client->update($validated);
        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect(route('clients.index'));
    }
}
