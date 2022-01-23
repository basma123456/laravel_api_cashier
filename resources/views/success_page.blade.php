@extends('layouts.app')

@section('content')

<h2>this is the success page</h2>
@if(isset($my_status))
<?php

dd($my_status);
?>
@endif
@endsection