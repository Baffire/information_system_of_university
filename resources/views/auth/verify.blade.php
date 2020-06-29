@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-9 col-lg-10">
            <div class="verify border shadow">
                <div class="verify-header">{{ __('Подтвердите ваш E-Mail адрес') }}</div>

                <div class="verify-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Ссылка была отправлена на ващ email адрес.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
