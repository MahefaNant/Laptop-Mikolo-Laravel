@extends('template.htmlTemplate')

@section('content')
    @include('template.adminTemplate.navTop')

    <link href=" {{ asset("assets/css/list.css") }}" rel="stylesheet">


    <main id="main">
        <div class="card">
            <div class="card-header">LAPTOP</div>
            <div class="card-body">
                @if (isset($_GET['success']))
                    <div class="alert alert-success">
                        <p>- {{ $_GET['success'] }}</p>
                    </div>
                @endif
                <form action="{{ route('affecter') }}" method="POST" class="row g-3">
                    {{ csrf_field() }}

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">UTILISATEUR</label>
                        <select id="inputEmail4" class="form-select" name="id_utilisateur">
                            @foreach($utilisateurLibres as $res)
                                <option value="{{ $res->id_utilisateur }}">{{ $res->mail }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">POINT DE VENTE</label>
                        <select id="inputEmail4" class="form-select" name="id_pointdevente">
                            @foreach($pointdeventes as $res)
                                <option value="{{ $res->id_pointdevente }}">{{ $res->adresse }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <label for="inputEmail4" class="form-label"><i class="bi bi-arrow-down-short"></i></label>
                        <button class="btn btn-danger" type="submit">VALIDER</button>
                    </div>
                </form>

            </div>
        </div>

        <div class="card col-6">
            <div class="card-header">LISTE utilisateur affecter</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Point de vente</th>
                            <th scope="col">Date affectation</th>
                            <th scope="col">Mail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($affectations as $res)
                            <tr class="bg-blue">
                                <td class="pt-2"> <img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="rounded-circle" alt="">
                                    <div class="pl-lg-5 pl-md-3 pl-1 name">{{ $res->adresse }}</div>
                                </td>
                                <td class="pt-3">{{ $res->dateaffectation }} </td>
                                <td class="pt-3">{{ $res->mail }} </td>
                                {{--<td class="pt-3"><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#{{ $res->id_ram }}"><i class="bi bi-pen-fill"></i>Edit</button></td>
                                <td class="pt-3"><a href="{{ route('removeRam', $res->id_ram) }}" class="btn btn-danger"><i class="bi bi-trash"></i>Remove</a></td>--}}
                            </tr>
                            <tr id="spacing-row">
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{--                {{ $materiels ? $materiels->appends(['cle' => $cle])->links('pagination::bootstrap-4') : "" }}--}}
                {{ $affectations ? $affectations->links('pagination::bootstrap-4') : "" }}
            </div>
        </div>
    </main>

    @include('template.adminTemplate.aside')
@endsection
