@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    


                   <table class="table table-bordered">
  <thead class="thead-dark">  
    <tr>
      <th scope="col">#</th>
      <th scope="col">Invoice one</th>
      <th scope="col">Invoice two</th>
      <th scope="col">Invoice three</th>
      <th scope="col">Invoice four</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><a href="{{url('/pay?payment_value=')}}{{(int)100}}">100 LE</a></td>
      <td><a href="{{url('/pay?payment_value=')}}{{(int)500}}">500 LE</a></td>
      <td><a href="{{url('/pay?payment_value=')}}{{(int)800}}">800 LE</a></td>
      <td><a href="{{url('/pay?payment_value=')}}{{(int)1000}}">1000 LE</a></td>

      
    </tr>
  </tbody>
</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
