@extends('layouts.app')
@section('content')

<div class="container">
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="flex-center position-ref full-height">

    <h2>Article owner <strong>{{$article->user->name}}</strong></h2>
    <div class="col-md-6 col-lg-9">
            <textarea class="form-control" id="article_text" name="brigade_members" rows="5"> {{$article->body}} </textarea>
            <span class="text-muted"><i>(bla bla bla)</i></span>
        </div>

       <form class="GridWithSearch">
           @csrf
            <table class="table table-fixed table-striped" id="dict-table">
              <thead>
                <tr>

                </tr>
              </thead>
              <tbody>

            </tbody>
         </table>
   </form>

@endsection
