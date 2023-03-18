<?php

namespace App\Http\Controllers;

use App\Models\CashLoanProduct;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ClientsController extends Controller
{
    /**
     * Show the clients screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.list', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required_without_all:phone|nullable|email',
            'phone' => 'required_without_all:email|nullable|string|max:50'
        ]);

        Client::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email ?? '',
            'phone' => $request->phone ?? '',
        ]);
        return Redirect::back()->with('message', 'Client saved.');
    }

    public function edit($id)
    {
        $client = Client::find($id);
        return view('clients.edit',  compact('client'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required_without_all:phone|nullable|email',
            'phone' => 'required_without_all:email|nullable|string|max:50'
        ]);

        Client::where('id', $id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email ?? '',
                'phone' => $request->phone ?? '',
            ]);

        if (!empty($request->loan_amount)) {
            CashLoanProduct::updateOrCreate(
                [
                    'client_id' => $request->client_id,
                    'adviser_id' => Auth::user()->id,
                ],
                [
                    'loan_amount' => $request->loan_amount
                ]
            );
        }

        return Redirect::to('/clients/' . $id . '/edit')->with('message', 'Client updated.');
    }

    public function delete($id)
    {
        Client::find($id)->delete();
        return Redirect::back()->with('message', 'Client deleted.');
    }
}
