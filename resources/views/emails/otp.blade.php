@extends("emails.base")

@section('header')
    <div class="header">
        <h1>{!! $header !!}</h1>
    </div>
@endsection

@section('content')
    <div class="content">
        {!! $content !!}
    </div>
@endsection

@section('footer')
    <div class="footer">
        &copy; {{ date('Y') }} {!! $footer !!}
    </div>
@endsection
