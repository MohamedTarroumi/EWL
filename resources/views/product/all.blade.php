@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($filesNames as $file)
        
        <div class="col-lg-12">
            <a href="{{route('getfile', $file)}}"> {{$file}} </a>
        </div>
        @endforeach
    </div>
</div>
@endsection