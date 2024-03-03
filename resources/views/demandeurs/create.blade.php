@extends('layout.default')
@section('title', 'ONFP - Demande de formation')
@section('content')
<div class="container">
    <!-- Standard buttons -->
    <div class="col-md-12 mt-10">
        <a class="btn btn-info btn-block" href="{{ route('individuelles.create') }}"><span data-feather="book-open"></span> Demande individuelle</a>
    </div>
    <br />
    <!-- Primary buttons -->
    <div class="col-md-12">
        <a class="btn btn-dark btn-block" href="{{ route('collectives.create') }}"><span data-feather="book-open"></span> Demande collective</a>
    </div>
    {{--  <br />
    <div class="col-md-12">
        <a class="btn btn-info btn-block" href="{{ route('internes.index') }}"><span data-feather="book-open"></span> Courriers internes</a>
    </div>
    <br />  --}}
    <!-- Primary buttons -->
    {{--  <div class="col-md-12">
        <a class="btn btn-dark btn-block" href="{{ route('demandeurs.index') }}"><span data-feather="book-open"></span>Courriers Demande</a>
    </div>  --}}
    <br />
</div>
@endsection