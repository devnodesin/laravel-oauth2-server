@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">OAuth Clients</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-warning">
                                <h5>Client Created Successfully!</h5>
                                <div class="mt-3">
                                    <p><strong>Client ID:</strong>
                                        <code class="ms-2">{{ session('client_id') }}</code>
                                    </p>
                                    <p><strong>Client Secret:</strong>
                                        <code class="ms-2">{{ session('client_secret') }}</code>
                                    </p>
                                    <small class="text-danger">Save these credentials! The secret will not be shown
                                        again.</small>
                                </div>
                            </div>
                        @endif

                        @if (session('client_secret'))
                            <div class="alert alert-warning">
                                <strong>New Client Secret (copy this now, it won't be shown again):</strong>
                                <code class="d-block mt-2 p-2 bg-light">{{ session('client_secret') }}</code>
                            </div>
                        @endif

                        <!-- Create Client Form -->
                        <form method="POST" action="{{ route('admin.clients.store') }}" class="mb-4">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <input type="text" name="name" class="form-control" placeholder="Client Name"
                                        required>
                                </div>
                                <div class="col-md-5">
                                    <input type="url" name="redirect" class="form-control" placeholder="Redirect URL"
                                        required>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Create</button>
                                </div>
                            </div>
                        </form>

                        <!-- Clients List -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Client ID</th>
                                    <th>Redirect</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($clients as $index => $client)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $client->name }}</td>
                                        <td><code>{{ $client->id }}</code></td>
                                        <td class="text-truncate" style="max-width: 200px;">{{ $client->redirect }}</td>
                                        <td>
                                            <form action="{{ route('admin.clients.destroy', $client) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No clients found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
