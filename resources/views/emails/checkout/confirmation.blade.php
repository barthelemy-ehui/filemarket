@extends('emails.layouts.default')

@section('content')
    <p>Thanks for downloading <strong>{{ $sale->file->title }}</strong> from filemarket.</p>

    <p><a href="">Download your file</a></p>

    <p>
        Or, copy and past this into your browser:<br/>
        http://someurl
    </p>
@endsection