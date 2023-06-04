@extends('template.htmlTemplate')

@section('content')
    @include('template.adminTemplate.navTop')
    <link href=" {{ asset("assets/css/list.css") }}" rel="stylesheet">

    @php
        $mois = $beneficesToArray[0];
        $prix = $beneficesToArray[1];
    @endphp

    <?php


    ?>

    <main id="main">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bar CHart</h5>

                    <!-- Bar Chart -->
                    <canvas id="barChart" style="max-height: 400px;"></canvas>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const data = @json($prix);
                            const labels =  @json($mois);

                            const backgroundColors = data.map(value => {
                                if (value <= 2000000) {
                                    return 'rgba(255,0,0,0.2)';
                                } else if (value <= 10000000) {
                                    return 'rgba(255,249,0,0.2)';
                                } else {
                                    return 'rgba(49,255,0,0.2)';
                                }
                            });

                            const borderColors = data.map(value => {
                                if (value >= 80) {
                                    return 'rgb(75, 192, 192)';
                                } else if (value >= 60) {
                                    return 'rgb(255, 159, 64)';
                                } else {
                                    return 'rgb(255, 99, 132)';
                                }
                            });
                            new Chart(document.querySelector('#barChart'), {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'BENEFICE',
                                        data: data,
                                        backgroundColor: backgroundColors,
                                        borderColor: borderColors,
                                        /*backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(255, 205, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(201, 203, 207, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(255, 159, 64)',
                                            'rgb(255, 205, 86)',
                                            'rgb(75, 192, 192)',
                                            'rgb(54, 162, 235)',
                                            'rgb(153, 102, 255)',
                                            'rgb(201, 203, 207)'
                                        ],*/
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                    <!-- End Bar CHart -->

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card col-12">
                    <div class="card-header">
                        Stats Benefice par mois par ans
                        <a href="{{ route('beneficePDF') }}" class="btn btn-success"><i class="bi bi-hand-index"></i>VIEW PDF</a>
                        <form method="get" action="{{ route('adminHome') }}">
                            <select name="annee">
                                <option value="2023" >2023</option>
                                <option value="2022" >2022</option>
                                <option value="2021" >2021</option>
                                <option value="2020" >2020</option>
                            </select>
                            <input type="submit" class="btn btn-dark">
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Mois</th>
                                    <th scope="col">Benefice</th>
                                    <th scope="col">Commission</th>
                                    <th scope="col">annee</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($benefices[0] as $res)
                                    <tr class="bg-blue">
                                        <td class="pt-2"><img
                                                src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                class="rounded-circle" alt="">
                                            <div
                                                class="pl-lg-5 pl-md-3 pl-1 name">{{ $res->month }}</div>
                                        </td>
                                        <td class="pt-3">{{ $res->diff_total_value }} </td>
                                        <td class="pt-3">{{ $res->val_com }} </td>
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
                                    <th scope="col">{{ $benefices[2] }}</th>
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
