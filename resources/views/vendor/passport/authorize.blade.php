@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <div class="row justify-content-center text-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Authorize Login
                    </div>

                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            Login <strong>{{ $client->name }}</strong>
                        </h5>

                        <!-- Scope List -->
                        @if (count($scopes) > 0)
                            <div class="mb-4">
                                <p class="text-muted">This application will be able to:</p>
                                <ul class="list-group">
                                    @foreach ($scopes as $scope)
                                        <li class="list-group-item">{{ $scope->description }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="d-flex flex-column align-items-center mx-auto" style="width: 200px;">

                            <!-- Authorize Button -->
                            <form method="post" action="{{ route('passport.authorizations.approve') }}" class="w-100 mb-2">
                                @csrf
                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->getKey() }}">
                                <input type="hidden" name="auth_token" value="{{ $authToken }}">
                                <button type="submit" class="btn btn-primary btn-sm w-100">Authorize</button>
                            </form>

                            <!-- Cancel Button -->
                            <form method="post" action="{{ route('passport.authorizations.deny') }}" class="w-100">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->getKey() }}">
                                <input type="hidden" name="auth_token" value="{{ $authToken }}">
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
