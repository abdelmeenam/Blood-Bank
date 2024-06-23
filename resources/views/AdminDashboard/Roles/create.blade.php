@extends('layouts.master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @toastr_css
@section('title')
    {{ trans('Add role') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Add Role') }}
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


                {{-- <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('Add Role') }}
                </button> --}}
                <br><br>


                <form action="{{ route('roles.store') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-10">
                            <label for="name">{{ __('Role Name') }}</label>
                            <input type="text" class="form-control" name="name"
                                placeholder="{{ __('Enter role name ....') }}">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary flex-left">{{ __('Add Role') }}</button>
                        </div>
                    </div>

                    {{-- simple table with check buttons to show permissions --}}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="15%">{{ __('Checked') }}</th>
                                <th>{{ __('Permission name') }}</th>
                                <th>{{ __('Guard name') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="permissions[{{ $permission->name }}]"
                                            value="{{ $permission->name }}">
                                    </td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->guard_name }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>

            </div>
        </div>
    </div>


    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ __('Add Role') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Email') }}</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Password') }}</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Confirm Password') }}</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('Add Role') }}</button>
                    </div>
                </form>

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
