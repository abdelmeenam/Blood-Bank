@extends('layouts.master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @toastr_css
@section('title')
    {{ trans('users') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('users') }}
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


                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('Add user') }}
                </button>
                <br><br>



                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>

                                <th>{{ __('Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#show{{ $user->id }}" title="{{ __('show user') }}"><i
                                                class="fa fa-eye"></i></button>

                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $user->id }}" title="{{ __('Edit user') }}"><i
                                                class="fa fa-edit"></i></button>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $user->id }}"
                                            title="{{ __('Delete user') }}"><i class="fa fa-trash"></i></button>
                                    </td>

                                </tr>

                </div>
            </div>


            <!-- delete_modal -->
            <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                {{ __('Delete user') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                {{ method_field('Delete') }}
                                @csrf
                                {{ __('Do you wanna delete') . ' ' . $user->name . ' ' . __('?') }}

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ __('Cancel') }}</button>
                                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            </table>

        </div>
        <div class="d-flex justify-content-center">
            {{-- {{ $users->links() }} --}}
        </div>
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
                    {{ __('Add user') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="submit" class="btn btn-success">{{ __('Add Admin') }}</button>
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
