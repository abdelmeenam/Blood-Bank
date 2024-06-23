@extends('layouts.master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @toastr_css
@section('title')
    {{ trans('Roles') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Roles') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
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
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    <a href="{{ route('roles.create') }}">
                        {{ trans('Add Role') }}
                    </a>
                </button>
                <br><br>

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col" width="15%">Name</th>
                                <th> Guard Name</th>
                                <th>{{ __('Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->guard_name }}</td>
                                    <td>
                                        <form action="{{ route('roles.edit', $role->id) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $role->id }}"> {{ __('Edit') }}</button>
                                        </form>

                                        {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $role->id }}"> {{ __('Delete') }}</button> --}}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
