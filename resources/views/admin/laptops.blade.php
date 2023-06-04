@extends('template.htmlTemplate')

@section('content')
    @include('template.adminTemplate.navTop')

    <link href=" {{ asset("assets/css/list.css") }}" rel="stylesheet">


    <main id="main">

        <div class="card col-12">
            <div class="card-header">Laptop existant</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Marque</th>
                            <th scope="col">Modele</th>
                            <th scope="col">Processeur</th>
                            <th scope="col">Processeur(desc)</th>
                            <th scope="col">Dur</th>
                            <th scope="col">Dur(desc)</th>
                            <th scope="col">Pouce</th>
                            <th scope="col">ecran(desc)</th>
                            <th scope="col">Ram</th>
                            <th scope="col">ram(desc)</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($laptops as $res)
                                <tr class="bg-blue">
                                    <td class="pt-2"> <img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="rounded-circle" alt="">
                                        <div class="pl-lg-5 pl-md-3 pl-1 name">{{ $res->marque }}</div>
                                    </td>
                                    <td class="pt-3">{{ $res->modele }} </td>
                                    <td class="pt-3">{{ $res->processeur }} </td>
                                    <td class="pt-3">{{ $res->proc_desc }} </td>
                                    <td class="pt-3">{{ $res->dur }} </td>
                                    <td class="pt-3">{{ $res->dur_desc }} </td>
                                    <td class="pt-3">{{ $res->pouce }} </td>
                                    <td class="pt-3">{{ $res->ecran_desc }} </td>
                                    <td class="pt-3">{{ $res->ram }} </td>
                                    <td class="pt-3">{{ $res->ram_desc }} </td>
                                    <td class="pt-3"><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-pen-fill"></i>Edit</button></td>
                                    <td class="pt-3"><a href="" class="btn btn-danger"><i class="bi bi-trash"></i>Remove</a></td>
                                </tr>
                                <tr id="spacing-row">
                                    <td></td>
                                </tr>

                                {{----------------MODAL---------------------}}
                                <!-- Modal -->

                                {{------------------------------------------}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
{{--                {{ $materiels ? $materiels->appends(['cle' => $cle])->links('pagination::bootstrap-4') : "" }}--}}
                {{ $laptops ? $laptops->links('pagination::bootstrap-4') : "" }}
            </div>
        </div>
    </main>

    @include('template.adminTemplate.aside')
@endsection

{{--@foreach($durs as $res)
    <div class="modal fade" id="{{ $res->id_dur }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Materiel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('editDur',$res->id_dur ) }}" method="POST" class=" g-3">
                    <div class="modal-body">

                            {{ csrf_field() }}
                            <div class="col-md-12">
                                <label for="inputEmail4" class="form-label">Description</label>
                                <input name="description" type="text"  id="inputEmail4" placeholder="..." autocomplete="on" value="{{ $res->description }}">
                            </div>
                            <div class="col-md-12">
                                <label for="inputEmail4" class="form-label">Dur (<span class="text-primary">peut être vide</span>)</label>
                                <input name="dur" type="text"  id="inputEmail4" placeholder="number" autocomplete="false" value="{{ $res->dur }}">
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
@endforeach--}}
