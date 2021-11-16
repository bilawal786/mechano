@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">@lang('app.edit') @lang('app.customer')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{route('customer.save')}}"  method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>@lang('app.name')<sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control form-control-lg" name="name" required>
                                </div>

                                <!-- text input -->
                                <div class="form-group">
                                    <label>@lang('app.email')<sup class="text-danger">*</sup></label>
                                    <input type="email" class="form-control form-control-lg" name="email" required>
                                </div>

                                <!-- text input -->
                                <div class="form-group">
                                    <label>@lang('app.password')</label>
                                    <input type="password" class="form-control form-control-lg" name="password" required>
                                </div>

                                <!-- text input -->
                                <div class="form-group">
                                    <label>@lang('app.mobile')</label>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <input type="text"  class="form-control form-control-lg" name="mobile" required>
                                        </div>
                                        <div class="col-md-1 text-center d-flex justify-content-center align-items-center">

                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-light-round"><i
                                            class="fa fa-check"></i> @lang('app.save')</button>
                                </div>

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
