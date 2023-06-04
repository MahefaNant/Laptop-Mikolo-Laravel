@php use App\function\Functions; @endphp
@extends('template.htmlTemplate')

@section('content')

    @include('template.navTop')

    <link href=" {{ asset("assets/css/list.css") }}" rel="stylesheet">

    <main id="main">
        <div class="card col-12">
            <div class="card-header">
                LISTE VENTE
                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Reference</label>
                        <input type="text" name="reference" placeholder="ref...">
                    </div>
                    <div class="col-md-2">
                        <label for="inputEmail4" class="form-label">Prix Min</label>
                        <input type="number" name="prixmin" step="0.1" placeholder="number">
                    </div>
                    <div class="col-md-2">
                        <label for="inputEmail4" class="form-label">Prix Max</label>
                        <input type="number" name="prixmax" step="0.1" placeholder="number">
                    </div>
                    <div class="col-md-2">
                        <label for="inputEmail4" class="form-label"><i class="bi bi-laptop"></i></label>
                        <input type="submit" value="FIND" class="btn btn-dark"/>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">marque</th>
                            <th scope="col">modele</th>
                            <th scope="col">prix de vente</th>
                            <th scope="col">Quantiter Laptop</th>
                            <th scope="col">Date vente</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ventesEffectuee as $res)
                            <tr class="bg-blue">
                                <td class="pt-2"><img
                                        src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                        class="rounded-circle" alt="">
                                    <div class="pl-lg-5 pl-md-3 pl-1 name">{{ $res->marque }}</div>
                                </td>
                                <td class="pt-3">{{ $res->modele }} </td>
                                <td class="pt-3">{{ $res->prix }} </td>
                                <td class="pt-3">{{ $res->quantiter }} </td>
                                <td class="pt-3">{{ Functions::formDate($res->datevente) }} </td>
                                <td class="pt-3">
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#renvoi{{ $res->id_vente }}"><i class="bi bi-pen-fill"></i>RENVOYER
                                    </button>
                                </td>
                                <td class="pt-3">
                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#vente{{ $res->id_vente }}"><i class="bi bi-pen-fill"></i>VENTE
                                    </button>
                                </td>
                                {{--<td class="pt-3"><a href="{{ route('removeRam', $res->id_ram) }}" class="btn btn-danger"><i class="bi bi-trash"></i>Remove</a></td>--}}
                            </tr>
                            <tr id="spacing-row">
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                        {{ $ventesEffectuee ? $ventesEffectuee->appends(compact('reference','prixmin','prixmax'))->links('pagination::bootstrap-4') : "" }}

                    </table>
                </div>
                {{--{{ $affectations ? $affectations->links('pagination::bootstrap-4') : "" }}--}}
            </div>
        </div>
    </main>

    @include('template.aside')

@endsection
