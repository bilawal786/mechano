@extends('layouts.master')

@push('head-css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/all.css') }}">

    <style>
        .collapse.in{
            display: block;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #999;
        }
        .select2-dropdown .select2-search__field:focus, .select2-search--inline .select2-search__field:focus {
            border: 0px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            margin: 0 13px;
        }
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #cfd1da;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__clear {
            cursor: pointer;
            float: right;
            font-weight: bold;
            margin-top: 8px;
            margin-right: 15px;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button
        {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number]
        {
            -moz-appearance: textfield;
        }

    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Ajouter ma voiture</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('car.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nom de la voiture </label>
                                    <input type="text" class="form-control" name="name"   autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Type de voiture </label>
                                    <input type="text" class="form-control" name="type"   autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Marque de voiture </label>
                                    <input type="text" class="form-control" name="make"   autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Plaque d'immatriculation </label>
                                    <input type="text" class="form-control" name="license"   autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-light-round">
                                    <i class="fa fa-check"></i> Sauvegarder
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
