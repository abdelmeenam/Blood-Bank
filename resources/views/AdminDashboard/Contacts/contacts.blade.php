@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Contacts') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Contacts') }}
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

                <div class="row">
                    @foreach ($contacts as $contact)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $contact->subject }}</h5>
                                    <p class="card-text"><strong>Name:</strong> {{ $contact->name }}</p>
                                    <p class="card-text"><strong>Email:</strong> {{ $contact->email }}</p>
                                    <p class="card-text"><strong>Message:</strong> {{ $contact->message }}</p>
                                    <p class="card-text"><strong>Phone:</strong> {{ $contact->phone }}</p>
                                    <p class="card-text"><small class="text-muted">Contacted
                                            {{ $contact->created_at->diffForHumans() }}</small></p>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    {{-- ------------------------  & Delete Actions ------------------ --}}
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $contact->id }}" title="{{ __('Delete Contact') }}"><i
                                            class="fa fa-trash"></i> {{ __('Delete') }}</button>
                                    <button type="button" class="btn btn-info btn-sm mr-2" data-toggle="modal"
                                        data-target="#previewContact{{ $contact->id }}"
                                        title="{{ __('Preview Contact') }}">
                                        <i class="fa fa-eye"></i> Preview
                                    </button>

                                </div>
                            </div>
                        </div>

                        <!-- delete_modal_Grade -->
                        <div class="modal fade" id="delete{{ $contact->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                            id="exampleModalLabel">
                                            {{ __('Delete Contact') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="post">
                                            {{ method_field('Delete') }}
                                            @csrf
                                            {{ __('Do you want to delete') . ' ' . $contact->name . ' ' . __('?') }}

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ __('Cancel') }}</button>
                                                <button type="submit"
                                                    class="btn btn-danger">{{ __('Delete') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Contact -->
                        <!-- Preview Modal -->
                        <div class="modal fade" id="previewContact{{ $contact->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="previewContactLabel{{ $contact->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="previewContactLabel{{ $contact->id }}">Preview
                                            Contact
                                            Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $contact->subject }}</h5>
                                                <p class="card-text"><strong>Name:</strong> {{ $contact->name }}</p>
                                                <p class="card-text"><strong>Email:</strong> {{ $contact->email }}</p>
                                                </p>
                                                <p class="card-text"><strong>Message:</strong> {{ $contact->message }}
                                                </p>
                                                <p class="card-text"><strong>Phone:</strong> {{ $contact->phone }}</p>
                                                <p class="card-text"><small class="text-muted">Contacted
                                                        {{ $contact->created_at->diffForHumans() }}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>



                <div class="d-flex justify-content-center">
                    {{ $contacts->withQueryString()->links() }}
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
