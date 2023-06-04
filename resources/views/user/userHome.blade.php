@extends('template.htmlTemplate')

@section('content')

    @include('template.navTop')

    <main id="main">
        <p>Hello {{ $user->mail }}</p>
        <a class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top" href="#"><i class="bi bi-arrow-up"></i></a>
    </main>

    @include('template.aside')

@endsection
