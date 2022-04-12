@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            Book title:
            <br />
            <input type="text" name="title" />
            <br /><br />
            Logo:
            <br />
            <input type="file" name="file" />
            <br /><br />
            <input type="submit" value=" Save " />
        </form>
    </div>
</div>
@endsection