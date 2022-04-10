@extends('layouts.app')
@section('title')
    <title>Phone Numbers</title>
@endsection
@section('content')
        <div class="container-fluid">
            <h1>Phone Numbers</h1>

            @include('countryPhones.filterForm')

        </div>
        <div class="row" style="justify-content: center">
             {!! $data['customers']->appends(\Illuminate\Support\Facades\Request::except('page'))->render()  !!}

        </div>

@endsection
