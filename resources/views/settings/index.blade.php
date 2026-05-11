@extends('templates.dashboard')
@section('isi')
    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-0 d-flex mt-2">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/settings/store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="name" class="float-left">Company Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus value="{{ old('name', $data->name) }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="float-left">Address</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" autofocus value="{{ old('alamat', $data->alamat) }}">
                            @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="float-left">Phone Number</label>
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" autofocus value="{{ old('phone', $data->phone) }}">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="wa_api_url" class="float-left">Whatsapp Api URL</label>
                            <input type="text" class="form-control @error('wa_api_url') is-invalid @enderror" id="wa_api_url" name="wa_api_url" autofocus value="{{ old('wa_api_url', $data->wa_api_url) }}">
                            @error('wa_api_url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="wa_session" class="float-left">Whatsapp Session</label>
                            <input type="text" class="form-control @error('wa_session') is-invalid @enderror" id="wa_session" name="wa_session" autofocus value="{{ old('wa_session', $data->wa_session) }}">
                            @error('wa_session')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="email" class="float-left">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" autofocus value="{{ old('email', $data->email) }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="logo" class="form-label">Logo</label>
                            <img src="{{ asset('/storage/'.$data->logo) }}" alt="" style="width: 20px">
                            <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="logo">
                            @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
