@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Settings') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Settings') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h5 class="card-title">Update Password </h5>
                <form action="{{ route('admin.password.update') }}" method="POST">
                    @csrf
                    @method('put') <!-- Add this line to override the method -->
                    <div class="col">
                        <label class="form-label" for="">Current Password</label>
                        <input type="password" class="form-control" name="current_password"
                            autocomplete="current-password">
                    </div>
                    <div class="col">
                        <label class="form-label" for="">New Password</label>
                        <input type="password" class="form-control" name="password" autocomplete="new-password">
                    </div>

                    <div class="col">
                        <label class="form-label" for="">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
    </div>
</div>



</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
