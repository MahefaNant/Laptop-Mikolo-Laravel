@extends('template.htmlTemplate')

@section('content')
    @include('template.adminTemplate.navTop')

    <main id="main">
        <div class="card">
            <div class="card-header">LAPTOP</div>
            <div class="card-body">
                @if (isset($_GET['success']))
                    <div class="alert alert-success">
                        <p>- {{ $_GET['success'] }}</p>
                    </div>
                @endif
                <form action="{{ route('addLaptop') }}" method="POST" class="row g-3">
                    {{ csrf_field() }}

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Marque</label>
                        <select id="inputEmail4" class="form-select" name="id_marque">
                            @foreach($marques as $mar)
                                <option value="{{ $mar->id_marque }}">{{ $mar->marque }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">MODELE</label>
                        <input name="modele" type="text"  id="inputEmail4" placeholder="ref" autocomplete="false">
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Dur</label>
                        <select id="inputEmail4" class="form-select" name="id_dur">
                            @foreach($durs as $res)
                                <option value="{{ $res->id_dur }}">{{ $res->description }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Ecran</label>
                        <select id="inputEmail4" class="form-select" name="id_ecran">
                            @foreach($ecrans as $res)
                                <option value="{{ $res->id_ecran }}">{{ $res->description }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Processeur</label>
                        <select id="inputEmail4" class="form-select" name="id_processeur">
                            @foreach($processeurs as $res)
                                <option value="{{ $res->id_processeur }}">{{ $res->description }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Ram</label>
                        <select id="inputEmail4" class="form-select" name="id_ram">
                            @foreach($rams as $res)
                                <option value="{{ $res->id_ram }}">{{ $res->description }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4"></div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">PRIX</label>
                        <input name="prix" type="number" step="0.1"  id="inputEmail4" placeholder="prix" autocomplete="false">
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
