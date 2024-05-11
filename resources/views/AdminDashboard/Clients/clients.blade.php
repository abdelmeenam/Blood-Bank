@extends('layouts.master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @toastr_css
@section('title')
    {{ trans('Clients') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Clients') }}
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
                    {{ trans('Add Client') }}
                </button>
                <br><br>

                <form action="{{ route('clients.index') }}" method="get" style="display: inline">
                    <select class="selectpicker" data-style="btn-info" name="status" required
                        onchange="this.form.submit()">
                        <option value="" selected disabled>{{ __('Filter Clients') }}</option>
                        </option>
                        <option value="1">Active Clients</option>
                        <option value="0">In Active Clients</option>
                    </select>
                </form>

                <form action="{{ route('search-clients') }}" method="get" style="display: inline">
                    <input type="text" name="search" placeholder="Search...">
                    <button type="submit">Search</button>
                </form>



                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('date of birth') }}</th>
                                <th>{{ __('last donation date') }}</th>
                                <th>{{ __('blood type') }}</th>
                                <th>{{ __('city') }}</th>
                                <th>{{ __('Governorate') }}</th>
                                <th>{{ __('Is Acive') }}</th>

                                <th>{{ __('Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->date_of_birth }}</td>
                                    <td>{{ $client->last_donation_date }}</td>
                                    <td>{{ $client->bloodType->name }}</td>
                                    <td>{{ $client->city->name }}</td>
                                    <td>{{ $client->governorate->name }}</td>
                                    <td>

                                        {{-- <span class="badge badge-{{ $client->is_active ? 'success' : 'danger' }}">
                                            {{ $client->is_active ? 'Active' : 'In Active' }}
                                        </span> --}}
                                        <div class="form-group form-switch ">
                                            <div class="checkbox checbox-switch switch-success">
                                                <label>
                                                    <input class="form-check-input mx-2" type="checkbox"
                                                        style="transform: scale(.1);"
                                                        data-client-id="{{ $client->id }}" name="switch8"
                                                        {{ $client->is_active ? 'checked' : '' }}>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#show{{ $client->id }}" title="{{ __('show client') }}"><i
                                                class="fa fa-eye"></i></button>

                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $client->id }}" title="{{ __('Edit client') }}"><i
                                                class="fa fa-edit"></i></button>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $client->id }}"
                                            title="{{ __('Delete client') }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- edit_modal -->
                                <div class="modal fade" id="edit{{ $client->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ __('Edit client') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('clients.update', $client->id) }}"
                                                    method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="name" class="mr-sm-2">{{ __('Name') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $client->name }}" name="name" required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="Email" class="mr-sm-2">{{ __('Email') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $client->email }}" name="email" required>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="row">


                                                        <div class="col">
                                                            <label for="last_donation_date"
                                                                class="mr-sm-2">{{ __('last donation date') }}
                                                                :</label>
                                                            <input type="date" class="form-control"
                                                                value="{{ $client->last_donation_date }}"
                                                                name="last_donation_date" required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="date_of_birth"
                                                                class="mr-sm-2">{{ __('date of birth') }}
                                                                :</label>
                                                            <input type="date" class="form-control"
                                                                value="{{ $client->date_of_birth }}"
                                                                name="date_of_birth" required>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="blood_type_id"
                                                                class="mr-sm-2">{{ __('blood type') }}
                                                                :</label>
                                                            <select name="blood_type_id" class="form-control"
                                                                required>
                                                                @foreach ($bloodTypes as $bloodType)
                                                                    <option value="{{ $bloodType->id }}"
                                                                        {{ $client->blood_type_id == $bloodType->id ? 'selected' : '' }}>
                                                                        {{ $bloodType->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>


                                                        <div class="col">
                                                            <label for="is_active"
                                                                class="mr-sm-2">{{ __('Is Acive') }}
                                                                :</label>
                                                            <select name="is_active" class="form-control" required>
                                                                <option value="1"
                                                                    {{ $client->is_active == 1 ? 'selected' : '' }}>
                                                                    {{ __('Active') }}
                                                                </option>
                                                                <option value="0"
                                                                    {{ $client->is_active == 0 ? 'selected' : '' }}>
                                                                    {{ __('In Active') }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="governorate_id"
                                                                class="mr-sm-2">{{ __('Governorate') }}
                                                                :</label>
                                                            <select name="governorate_id" class="form-control"
                                                                required>
                                                                @foreach ($governorates as $governorate)
                                                                    <option value="{{ $governorate->id }}"
                                                                        {{ $client->governorate_id == $governorate->id ? 'selected' : '' }}>
                                                                        {{ $governorate->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col">
                                                            <label for="city_id" class="mr-sm-2">{{ __('city') }}
                                                                :</label>
                                                            <select name="city_id" class="form-control" required>
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->id }}"
                                                                        {{ $client->city_id == $city->id ? 'selected' : '' }}>
                                                                        {{ $city->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="phone" class="mr-sm-2">{{ __('phone') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $client->phone }}" name="phone" required>
                                                        </div>
                                                    </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ __('Cancel') }}</button>
                                                <button type="submit"
                                                    class="btn btn-success">{{ __('Update client') }}</button>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                </div>


                <!-- delete_modal -->
                <div class="modal fade" id="delete{{ $client->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    {{ __('Delete client') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('clients.destroy', $client->id) }}" method="post">
                                    {{ method_field('Delete') }}
                                    @csrf
                                    {{ __('Do you wanna delete') . ' ' . $client->name . ' ' . __('?') }}

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
                {{ $clients->links() }}
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
                    {{ __('Add client') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('clients.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ __('Name') }} :</label>
                            <input id="name" type="text" name="name" class="form-control">
                        </div>

                        <div class="col">
                            <label for="phone" class="mr-sm-2">{{ __('phone') }} :</label>
                            <input id="phone" type="text" name="phone" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="Email" class="mr-sm-2">{{ __('Email') }} :</label>
                            <input id="Email" type="text" name="email" class="form-control">
                        </div>
                        <div class="col">
                            <label for="password" class="mr-sm-2">{{ __('password') }} :</label>
                            <input id="password" type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="blood_type_id" class="mr-sm-2">{{ __('blood type') }} :</label>
                            <select name="blood_type_id" class="form-control">
                                @foreach ($bloodTypes as $bloodType)
                                    <option value="{{ $bloodType->id }}">{{ $bloodType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="is_active" class="mr-sm-2">{{ __('Is Acive') }} :</label>
                            <select name="is_active" class="form-control">
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('In Active') }}</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="governorate_id" class="mr-sm-2">{{ __('Governorate') }} :</label>
                            <select name="governorate_id" class="form-control" id="governorate_id">
                                <option value="" selected disabled>{{ __('Select Governorate') }}</option>
                                @foreach ($governorates as $governorate)
                                    <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="city_id" class="mr-sm-2">{{ __('city') }} :</label>
                            <select name="city_id" class="form-control" id="city_id">
                                <option value="" selected disabled>{{ __('Select city') }}</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="last_donation_date" class="mr-sm-2">{{ __('last donation date') }} :</label>
                            <input id="last_donation_date" type="date" name="last_donation_date"
                                class="form-control">
                        </div>
                        <div class="col">
                            <label for="date_of_birth" class="mr-sm-2">{{ __('date of birth') }} :</label>
                            <input id="date_of_birth" type="date" name="date_of_birth" class="form-control">
                        </div>
                    </div>

                    <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="submit" class="btn btn-success">{{ __('Add client') }}</button>
            </div>
            </form>

        </div>
    </div>
</div>
</div>

<!-- row closed -->
@endsection
@section('js')

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Get cities based on selected governorate
        $('#governorate_id').change(function() {
            var selectedGovernorateId = $(this).val();
            if (selectedGovernorateId) {
                $.ajax({
                    url: '/get-cities/' + selectedGovernorateId,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 200) {
                            // Cities retrieved successfully
                            var cities = response.data;
                            if (cities.length > 0) {
                                var options = '<option value="">Select City</option>';
                                $.each(cities, function(index, city) {
                                    options += '<option value="' + city.id + '">' +
                                        city.name + '</option>';
                                });
                                $('#city_id').html(options);
                            }
                        } else {
                            // Handle other status codes (if needed)
                            $('#city_id').html(
                                '<option value="">No cities available</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        })

        // Activate toggle switch
        $('.checkbox input[type="checkbox"]').change(function() {
            var userId = $(this).data('client-id');
            var isActive = $(this).prop('checked') ? 1 : 0; // Convert boolean to integer
            // Send AJAX request to update user status
            $.ajax({
                url: '/update-user-status/' + userId,
                type: 'POST',
                data: {
                    is_active: isActive
                },
                success: function(response) {
                    // Show success toast
                    toastr.success(response.message);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });


    });
</script>

{{-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> --}}

@toastr_js
@toastr_render
@endsection
