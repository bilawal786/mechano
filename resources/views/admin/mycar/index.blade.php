@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center justify-content-md-end mb-3">
                        <a href="{{ route('mycar.add') }}" class="btn btn-rounded btn-primary mb-1"><i class="fa fa-plus"></i>Ajouter un nouveau</a>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table w-100">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom de la voiture</th>
                                <th>Type de voiture</th>
                                <th>Marque de voiture</th>
                                <th>Plaque d'immatriculation</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cars as $car)
                                <tr>
                                    <td>{{$car->id}}</td>
                                    <td>{{$car->name}}</td>
                                    <td>{{$car->type}}</td>
                                    <td>{{$car->make}}</td>
                                    <td>{{$car->license}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
