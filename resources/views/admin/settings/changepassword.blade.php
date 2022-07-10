@extends("layouts.admin")
@section('content')
<div class="container">
    {{-- @include('settings.navbar') --}}
    <div class="row justify-content-center mt-3">
        <h5>Schimba parola</h5>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('change-password') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="old-password" class="col-sm-4 col-form-label text-sm-right">{{ __('Parola veche') }}</label>

                            <div class="col-sm-6">
                                <input id="old-password" type="password" class="form-control @error('old-password') is-invalid @enderror" name="old-password" required autocomplete="old-password">
                                @error('old-password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label text-sm-right">{{ __('Parola noua') }}</label>

                            <div class="col-sm-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-4 col-form-label text-sm-right">{{ __('Confirma parola') }}</label>

                            <div class="col-sm-6">
                                <input id="password_confirmation" type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" name=" password_confirmation" required autocomplete="password">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row justify-content-end align-items-center mb-0">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Salveaza') }}
                                </button>
                            </div>
                            <div class="col-6">
                                <span>
                                    (Va trebui sa intri din nou in cont)
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')
