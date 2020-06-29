@extends('admin.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Данные профиля
            </p>

            <div class="table-responsive">
                <table class="table table-borderless mt-3 bg-white">
                    <tbody>
                    <tr>
                        <td>Имя</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Отчество</td>
                        <td>{{ $user->patronymic }}</td>
                    </tr>
                    <tr>
                        <td>Фамилия</td>
                        <td>{{ $user->surname }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Статус</td>
                        <td>{{ $user->role->name }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
