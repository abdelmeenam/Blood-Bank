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

                <h5 class="card-title">Edit Settings</h5>
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    @method('PATCH') <!-- Add this line to override the method -->
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" aria-describedby="emailHelp"
                                value="{{ $setting->email }}" name="email">
                        </div>
                        <div class="col">
                            <label class="form-label" for="exampleInputPhone">Phone</label>
                            <input type="text" class="form-control" value="{{ $setting->phone }}" name="phone">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="exampleInputNotification">Notification setting</label>
                            <input type="text" class="form-control"
                                value="{{ $setting->notification_settings_text }}" name="">
                        </div>
                        <div class="col">
                            <label class="form-label" for="exampleInputPhone">About app</label>
                            <input type="text" class="form-control" placeholder="About Us"
                                value="{{ $setting->about_app }}" name="about_app">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="exampleInputNotification">Instgram Link</label>
                            <input type="text" class="form-control" value="{{ $setting->insta_link }}"
                                name="insta_link">
                        </div>
                        <div class="col">
                            <label class="form-label" for="exampleInputPhone">YouTube Link</label>
                            <input type="text" class="form-control" value="{{ $setting->youtube_link }}"
                                name="youtube_link">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="exampleInputNotification">WhatsApp Link</label>
                            <input type="text" class="form-control" value="{{ $setting->whatsapp_link }}"
                                name="whatsapp_link">
                        </div>
                        <div class="col">
                            <label class="form-label" for="exampleInputPhone">Goole Link</label>
                            <input type="text" class="form-control" value="{{ $setting->google_link }}"
                                name="google_link">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="exampleInputNotification">Fb Link</label>
                            <input type="text" class="form-control" value="{{ $setting->fb_link }}" name="fb_link">
                        </div>
                        <div class="col">
                            <label class="form-label" for="exampleInputPhone">Twitter Link</label>
                            <input type="text" class="form-control" value="{{ $setting->tw_link }}" name="tw_link">
                        </div>
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
