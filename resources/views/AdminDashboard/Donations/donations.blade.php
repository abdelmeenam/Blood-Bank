@extends('layouts.master')

@section('css')
    @toastr_css
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endsection

@section('title')
    {{ __('Donations') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ __('Donations') }}
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

                <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Patient Name') }}</th>
                                <th>{{ __('Patient Age') }}</th>
                                <th>{{ __('Bags Count') }}</th>
                                <th>{{ __('Patient Phone') }}</th>
                                <th>{{ __('Notes') }}</th>
                                <th>{{ __('Blood Type') }}</th>
                                <th>{{ __('Hospital Name') }}</th>
                                <th>{{ __('Hospital Address') }}</th>
                                <th>{{ __('Hospital city') }}</th>
                                <th>{{ __('Hospital governorate') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donations as $donation)
                                <tr>
                                    <td>{{ $donation->id }}</td>
                                    <td>{{ $donation->patient_name }}</td>
                                    <td>{{ $donation->patient_age }}</td>
                                    <td>{{ $donation->bags_count }}</td>
                                    <td>{{ $donation->patient_phone }}</td>
                                    <td>{{ Str::words($donation->notes, 5) }}</td>
                                    <td>{{ $donation->bloodType->name }}</td>
                                    <td>{{ $donation->hospital_name }}</td>
                                    <td>{{ $donation->hospital_address }}</td>
                                    <td>{{ $donation->city->name }}</td>
                                    <td>{{ $donation->city->governorate->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#previewDonation{{ $donation->id }}"
                                            title="{{ __('Preview Donation') }}">
                                            <i class="fa fa-eye"></i> {{ __('Preview') }}
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#deleteDonation{{ $donation->id }}"
                                            title="{{ __('Delete Donation') }}">
                                            <i class="fa fa-trash"></i> {{ __('Delete') }}
                                        </button>
                                    </td>
                                </tr>

                                <!-- Preview Modal -->
                                <div class="modal fade" id="previewDonation{{ $donation->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="previewDonationLabel{{ $donation->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="previewDonationLabel{{ $donation->id }}">
                                                    {{ __('Preview Donation Details') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $donation->patient_name }}</h5>
                                                        <p class="card-text">
                                                            <strong>Phone: </strong>{{ $donation->patient_phone }}
                                                        </p>
                                                        <p class="card-text">
                                                            <strong>Age: </strong>{{ $donation->patient_age }}
                                                        </p>
                                                        <p class="card-text">
                                                            <strong>Hospital Name:
                                                            </strong>{{ $donation->hospital_name }}
                                                        </p>
                                                        <p class="card-text">
                                                            <strong>Hospital Address:
                                                            </strong>{{ $donation->hospital_address }}
                                                        </p>
                                                        <p class="card-text">
                                                            <strong>City: </strong>{{ $donation->city->name }}
                                                        </p>
                                                        <p class="card-text">
                                                            <strong>Governorate:
                                                            </strong>{{ $donation->city->governorate->name }}
                                                        </p>
                                                        <p class="card-text">
                                                            <strong>Blood type:
                                                            </strong>{{ $donation->bloodType->name }}
                                                        </p>

                                                        <p class="card-text"> <strong>Notes:
                                                            </strong>{{ $donation->notes }}</p>
                                                        <p class="card-text">
                                                            <small class="text-muted">{{ __('donationed') }}
                                                                {{ $donation->created_at->diffForHumans() }}</small>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteDonation{{ $donation->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="deleteDonationLabel{{ $donation->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteDonationLabel{{ $donation->id }}">
                                                    {{ __('Delete Donation') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ __('Are you sure you want to delete this donation?') }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ __('Cancel') }}</button>
                                                <form action="{{ route('donations.destroy', $donation->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ __('Delete') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $donations->links() }}
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
