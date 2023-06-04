@extends('template.htmlTemplate')

@section('content')

    @include('template.adminTemplate.navTop')

    <link href=" {{ asset("assets/css/list.css") }}" rel="stylesheet">

    <main id="main">

    </main>

    @include('template.adminTemplate.aside')

@endsection
