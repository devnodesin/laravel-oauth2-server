<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Passport\Client;

class ClientsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(): View
    {
        $clients = Client::where('user_id', Auth::user()->id)->get();

        return view('admin.clients.index', compact('clients'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'redirect' => ['required', 'url'],
        ]);

        // Create client first to get ID
        $client = new Client;
        $client->user_id = Auth::user()->id;
        $client->name = $validated['name'];
        $client->redirect = $validated['redirect'];
        $client->personal_access_client = false;
        $client->password_client = false;
        $client->revoked = false;

        // Generate and store secret before saving
        $client->secret = \Illuminate\Support\Str::random(40);
        $plainSecret = $client->secret; // Store plain secret before save/hash

        $client->save();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client created successfully!')
            ->with('client_id', $client->id)
            ->with('client_secret', $plainSecret);
    }

    public function destroy(Client $client): RedirectResponse
    {
        abort_if($client->user_id !== Auth::user()->id, 403);

        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client deleted successfully.');
    }
}
