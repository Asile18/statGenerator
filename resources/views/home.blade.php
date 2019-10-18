
@extends('layouts.app')

@section('content')

<div class="container">
        
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('partials.form')
                    
                   <h2 style="text-align:center;">{{request('requestmodel') == 'udp' ? 'Udp Database' : 'Astuce Credit Database'}}</h2>
                   @include('partials.data')
                   <span>{{$statsView}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
