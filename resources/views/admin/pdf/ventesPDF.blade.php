@php use App\function\Functions;use App\Models\PointDeVente; @endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<style>
    .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }

    .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }
</style>

<div style="width: 95%; margin: 0 auto;">
    <div style="width: 50%; float: left">
        <h1>Statistic de vente par mois par Point de vente</h1>
    </div>
</div>
<table border="1px" class="styled-table" style="position: relative; top: 100px">
    <thead>
    <tr>
        <th>Mois</th>
        <th>Point De vente</th>
        <th>tatal vente</th>
        <th>prix totale</th>
        <th>annee</th>
    </tr>
    </thead>

    @foreach($ventes[0] as $res)
        <tr>
        <tr class="bg-blue">
            <th>{{ $res->month }}</th>
            <th>{{ $res->adresse }} </th>
            <th>{{ $res->total_quantiter }} </th>
            <th>{{ $res->total_value }} </th>
            <th>{{ $res->year }} </th>
        </tr>
    @endforeach
    <tr>
        <th>Total</th>
        <th></th>
        <th>{{ $ventes[1] }}</th>
        <th>{{ $ventes[2] }}</th>
        <th></th>
    </tr>
</table>
</body>
</html>
