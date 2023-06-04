@extends('template.htmlTemplate')

@section('content')
    @include('template.adminTemplate.navTop')

    <main id="main">
        <div class="card">
            <div class="card-header">ACHAT</div>
            <div class="card-body">
                @if (isset($_GET['success']))
                    <div class="alert alert-success">
                        <p>- {{ $_GET['success'] }}</p>
                    </div>
                @endif
                <form action="{{ route('achat') }}" method="POST" class="row g-3">
                    {{ csrf_field() }}

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Laptop</label>
                        <select id="inputEmail4" class="form-select" name="id_laptop">
                            @foreach($laptops as $res)
                                <option value="{{ $res->id_laptop }}">{{ $res->marque." ".$res->modele }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Quantiter</label>
                        <input type="number" name="quantiter" placeholder="number">
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Prix D`achat</label>
                        <input type="number" name="prix" step="0.1" placeholder="number">
                    </div>

                    <div class="d-grid gap-2">
                        <label for="inputEmail4" class="form-label"><i class="bi bi-arrow-down-short"></i></label>
                        <button class="btn btn-danger" type="submit">VALIDER</button>
                    </div>
                </form>

            </div>
        </div>
    </main>

    @include('template.adminTemplate.aside')
@endsection
