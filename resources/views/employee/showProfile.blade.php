@extends('employee.layouts.app')

@section('content')

    @if ( $user->first_login === 1 )
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Системное оповещение</h5>
                    </div>
                    <div class="modal-body">
                        В целях безопасности ваших данных просьба сменить пароль учетной записи.
                    </div>

                    <div class="modal-footer">
                        <form action="employee/check" method="POST">
                            @csrf
                            <input name="notChangePassword" type="submit" class="btn btn-secondary" value="Закрыть">
                            <input name="changePassword" type="submit" class="btn btn-success" value="Сменить пароль">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h4 text-center mt-3">
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
                        <td>Факультет</td>
                        <td>{{ $user->employee->faculty->name }}</td>
                    </tr>
                    <tr>
                        <td>Кафедра</td>
                        <td>{{ $user->employee->department->name }}</td>
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
