@extends('admin.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3 mb-5">
                Форма добавления пользователя
            </p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label">Имя: </label>
                    <div class="col-md-9">
                        <input name="name" id="name" type="text" class="form-control" placeholder="Введите имя">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="patronymic" class="col-md-3 col-form-label">Отчество: </label>
                    <div class="col-md-9">
                        <input name="patronymic" id="patronymic" type="text" placeholder="Введите отчество" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-md-3 col-form-label">Фамилия: </label>
                    <div class="col-md-9">
                        <input name="surname" id="surname" type="text" class="form-control" placeholder="Введите фамилию">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label">Email: </label>
                    <div class="col-md-9">
                        <input name="email" id="email" type="text" class="form-control" placeholder="Введите email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role_id" class="col-md-3 col-form-label">Кафедра: </label>
                    <div class="col-md-9">
                        <select name="department_id" id="department_id" class="form-control">
                            <option hidden>Выберете кафедру</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-3 col-form-label">Пароль: </label>
                    <div class="col-md-9">
                        <input name="password" id="password" type="password" class="form-control">
                        <small id="passwordHelpInline" class="text-muted">
                            Должен содержать не менее 8 символов.
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-lg-3 col-md-3 col-form-label">Поддтверждение
                        пароля: </label>
                    <div class="col-lg-9 col-md-9">
                        <input name="password_confirmation" id="password_confirmation" type="password"
                               class="form-control">
                    </div>
                </div>
                <div class="text-center mt-5 mb-5">
                    <input type="submit" class="btn btn-success">
                </div>

            </form>

        </div>
    </div>
@endsection
