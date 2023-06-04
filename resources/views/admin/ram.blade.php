@extends('template.htmlTemplate')

@section('content')
    @include('template.adminTemplate.navTop')

    <link href=" {{ asset("assets/css/list.css") }}" rel="stylesheet">


    <main id="main">

        <div class="card">
            <div class="card-header">RAM</div>
            <div class="card-body">
                @if (isset($_GET['success']))
                    <div class="alert alert-success">
                        <p>- {{ $_GET['success'] }}</p>
                    </div>
                @endif

                <form action="{{ route('addRam') }}" method="POST" class="row g-3">
                    {{ csrf_field() }}
                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Description</label>
                        <input name="description" type="text"  id="inputEmail4" placeholder="..." autocomplete="on">
                    </div>
                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">ram (<span class="text-primary">peut être vide</span>)</label>
                        <input name="ram" type="number"  id="inputEmail4" placeholder="number" autocomplete="false">
                    </div>
                    <div class="col-md-4">
                        <div class="d-grid gap-2">
                            <label for="inputEmail4" class="form-label"><i class="bi bi-arrow-down-short"></i></label>
                            <button class="btn btn-danger" type="submit">VALIDER</button>
                        </div>
                    </div>
                </form>




            </div>
        </div>

        <div class="card col-12">
            <div class="card-header">Rams existant</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Description</th>
                            <th scope="col">Ram</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($rams as $res)
                                <tr class="bg-blue">
                                    <td class="pt-2"> <img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="rounded-circle" alt="">
                                        <div class="pl-lg-5 pl-md-3 pl-1 name">{{ $res->description }}</div>
                                    </td>
                                    <td class="pt-3">{{ $res->ram ? $res->ram:"" }} </td>
                                    <td class="pt-3"><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#{{ $res->id_ram }}"><i class="bi bi-pen-fill"></i>Edit</button></td>
                                    <td class="pt-3"><a href="{{ route('removeRam', $res->id_ram) }}" class="btn btn-danger"><i class="bi bi-trash"></i>Remove</a></td>
                                </tr>
                                <tr id="spacing-row">
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
{{--                {{ $materiels ? $materiels->appends(['cle' => $cle])->links('pagination::bootstrap-4') : "" }}--}}
                {{ $rams ? $rams->links('pagination::bootstrap-4') : "" }}
            </div>
        </div>
    </main>

    @include('template.adminTemplate.aside')
@endsection

@foreach($rams as $res)
    <div class="modal fade" id="{{ $res->id_ram }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Materiel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('editRam',$res->id_ram ) }}" method="POST" class=" g-3">
                    <div class="modal-body">

                            {{ csrf_field() }}
                            <div class="col-md-12">
                                <label for="inputEmail4" class="form-label">Description</label>
                                <input name="description" type="text"  id="inputEmail4" placeholder="..." autocomplete="on" value="{{ $res->description }}">
                            </div>
                            <div class="col-md-12">
                                <label for="inputEmail4" class="form-label">Ram (<span class="text-primary">peut être vide</span>)</label>
                                <input name="ram" type="number"  id="inputEmail4" placeholder="number" autocomplete="false" value="{{ $res->id_ram }}">
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
