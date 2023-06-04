@extends('template.htmlTemplate')

@section('content')

    @include('template.navTop')
    <link href=" {{ asset("assets/css/list.css") }}" rel="stylesheet">

    <main id="main">
        <div class="card col-6">
            <div class="card-header">LISTE laptop transferer</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">marque</th>
                            <th scope="col">modele</th>
                            <th scope="col">Quantiter</th>
                            <th scope="col">Prix laptop(1)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transferts as $res)
                            <tr class="bg-blue">
                                <td class="pt-2"> <img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="rounded-circle" alt="">
                                    <div class="pl-lg-5 pl-md-3 pl-1 name">{{ $res->marque }}</div>
                                </td>
                                <td class="pt-3">{{ $res->modele }} </td>
                                <td class="pt-3">{{ $res->quantiter }} </td>
                                <td class="pt-3">{{ $res->prix }} </td>
                                <td class="pt-3"><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#{{ $res->id_transfert_to_pv }}"><i class="bi bi-pen-fill"></i>RECEVOIR</button></td>
                                {{--<td class="pt-3"><a href="{{ route('removeRam', $res->id_ram) }}" class="btn btn-danger"><i class="bi bi-trash"></i>Remove</a></td>--}}
                            </tr>
                            <tr id="spacing-row">
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{--                {{ $materiels ? $materiels->appends(['cle' => $cle])->links('pagination::bootstrap-4') : "" }}--}}
                {{--{{ $affectations ? $affectations->links('pagination::bootstrap-4') : "" }}--}}
            </div>
        </div>
    </main>

    @include('template.aside')

@endsection

@foreach($transferts as $res)
    <div class="modal fade" id="{{ $res->id_transfert_to_pv }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">ENVOYER {{ $res->marque }} ({{ $res->modele }})</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('saveReception',['id_laptop'=>$res->id_laptop, 'id_pointdevente'=>$res->id_pointdevente,'id_transfert_to_pv'=>$res->id_transfert_to_pv]) }}" method="POST" class=" g-3">
                    <div class="modal-body">
                        <input type="hidden" name="quantiterDeb" value="{{ $res->quantiter }}">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Quantiter </label>
                            <input name="quantiter" type="number"  id="inputEmail4" placeholder="number" autocomplete="false" value="">
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Date Reception</label>
                            <input name="datereception" type="datetime-local"  id="inputEmail4" placeholder="number" autocomplete="false" value="">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
