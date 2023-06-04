@extends('template.htmlTemplate')

@section('content')

    @include('template.adminTemplate.navTop')

    <link href=" {{ asset("assets/css/list.css") }}" rel="stylesheet">

    <main id="main">
        <div class="row">
            <div class="col-md-6">
                <div class="card col-12">
                    <div class="card-header">
                        <form method="get" action="{{ route('venteParMois') }}">
                            <select name="annee">
                                <option value="2023" >2023</option>
                                <option value="2022" >2022</option>
                                <option value="2021" >2021</option>
                                <option value="2020" >2020</option>
                            </select>
                            <input type="submit" class="btn btn-dark">
                        </form>
                        Stats vente par mois par point de vente
                        <a href="{{ route('ventesPDFStream') }}" class="btn btn-success"><i class="bi bi-hand-index"></i>VIEW PDF</a>
                        <a href="" class="btn btn-danger"><i class="bi bi-download"></i>DOWLOAD PDF</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Mois</th>
                                    <th scope="col">Point De vente</th>
                                    <th scope="col">tatal vente</th>
                                    <th scope="col">prix totale</th>
                                    <th scope="col">annee</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ventes[0] as $res)
                                    <tr class="bg-blue">
                                        <td class="pt-2"><img
                                                src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                class="rounded-circle" alt="">
                                            <div
                                                class="pl-lg-5 pl-md-3 pl-1 name">{{ $res->month }}</div>
                                        </td>
                                        <td class="pt-3">{{ $res->adresse }} </td>
                                        <td class="pt-3">{{ $res->total_quantiter }} </td>
                                        <td class="pt-3">{{ $res->total_value }} </td>
                                        <td class="pt-3">{{ $res->year }} </td>
                                        {{--<td class="pt-3"><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-pen-fill"></i>TRANSFERER</button></td>--}}
                                        {{--<td class="pt-3"><a href="{{ route('removeRam', $res->id_ram) }}" class="btn btn-danger"><i class="bi bi-trash"></i>Remove</a></td>--}}
                                    </tr>
                                    <tr id="spacing-row">
                                        <td></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                    <th scope="col">{{ $ventes[1] }}</th>
                                    <th scope="col">{{ $ventes[2] }}</th>
                                    <th scope="col"></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        {{--                {{ $materiels ? $materiels->appends(['cle' => $cle])->links('pagination::bootstrap-4') : "" }}--}}
                        {{--{{ $affectations ? $affectations->links('pagination::bootstrap-4') : "" }}--}}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card col-12">
                    <div class="card-header">
                        Stats vente global par mois
                        <a href="{{ route('ventesPDFGlobalStream') }}" class="btn btn-success"><i class="bi bi-hand-index"></i>VIEW PDF</a>
                        <a href="" class="btn btn-danger"><i class="bi bi-download"></i>DOWLOAD PDF</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Mois</th>
                                    <th scope="col">tatal vente</th>
                                    <th scope="col">prix totale</th>
                                    <th scope="col">annee</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ventesG[0] as $res)
                                    <tr class="bg-blue">
                                        <td class="pt-2"><img
                                                src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                class="rounded-circle" alt="">
                                            <div class="pl-lg-5 pl-md-3 pl-1 name">{{ $res->month }}</div>
                                        </td>
                                        <td class="pt-3">{{ $res->total_quantiter }} </td>
                                        <td class="pt-3">{{ $res->total_value }} </td>
                                        <td class="pt-3">{{ $res->year }} </td>
                                        {{--                                        <td class="pt-3"><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-pen-fill"></i>TRANSFERER</button></td>--}}
                                        {{--<td class="pt-3"><a href="{{ route('removeRam', $res->id_ram) }}" class="btn btn-danger"><i class="bi bi-trash"></i>Remove</a></td>--}}
                                    </tr>
                                    <tr id="spacing-row">
                                        <td></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th scope="col">Total</th>
                                    <th scope="col">{{ $ventesG[1] }}</th>
                                    <th scope="col">{{ $ventesG[2] }}</th>
                                    <th scope="col"></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        {{--                {{ $materiels ? $materiels->appends(['cle' => $cle])->links('pagination::bootstrap-4') : "" }}--}}
                        {{--{{ $affectations ? $affectations->links('pagination::bootstrap-4') : "" }}--}}
                    </div>
                </div>
            </div>
        </div>


    </main>

    @include('template.adminTemplate.aside')

@endsection
