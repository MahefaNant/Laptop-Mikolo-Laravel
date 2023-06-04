@php use App\function\Functions; @endphp
@extends('template.htmlTemplate')

@section('content')
    @include('template.adminTemplate.navTop')

    <link href=" {{ asset("assets/css/list.css") }}" rel="stylesheet">


    <main id="main">
        <div class="card col-12">
            <div class="card-header">LISTS</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">month</th>
                            <th scope="col">total_value</th>
                            <th scope="col">Commission</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comms as $res)
                            <tr class="bg-blue">
                                <td class="pt-2"><img
                                        src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                        class="rounded-circle" alt="">
                                    <div class="pl-lg-5 pl-md-3 pl-1 name">
                                        {{ $res->month ? Functions::getMois($res->month) :"" }}
                                    </div>
                                </td>
                                <td class="pt-3">{{ $res->total_value ? $res->total_value:"" }} </td>
                                <td class="pt-3">{{ $res->val_com ? $res->val_com:"" }} </td>
                                {{--                                <td class="pt-3"><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#{{ $res->id_pointdevente }}"><i class="bi bi-pen-fill"></i>Edit</button></td>--}}
                                {{--<td class="pt-3"><a href="{{ route('removePV', $res->id_pointdevente) }}" class="btn btn-danger"><i class="bi bi-trash"></i>Remove</a></td>
                                <td class="pt-3"><a href="{{ route('commissionPointDeVente', $res->id_pointdevente) }}" class="btn btn-danger"><i class="bi bi-trash"></i>Commission Vente</a></td>--}}
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
                {{--{{ $pointdeventes ? $pointdeventes->links('pagination::bootstrap-4') : "" }}--}}
            </div>
        </div>
    </main>

    @include('template.adminTemplate.aside')
@endsection
