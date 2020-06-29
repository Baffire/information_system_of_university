@extends('admin.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3 mb-5">
                Форма редактирования пользователя
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
                        <input name="name" id="name" type="text" class="form-control" value="{{ $user->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="patronymic" class="col-md-3 col-form-label">Отчество: </label>
                    <div class="col-md-9">
                        <input name="patronymic" id="patronymic" type="text" value="{{ $user->patronymic }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-md-3 col-form-label">Фамилия: </label>
                    <div class="col-md-9">
                        <input name="surname" id="surname" type="text" class="form-control" value="{{ $user->surname }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label">Почта: </label>
                    <div class="col-md-9">
                        <input name="email" id="email" type="email" class="form-control" value="{{ $user->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role_id" class="col-md-3 col-form-label">Роль: </label>
                    <div class="col-md-9">
                        <select name="role_id" id="role_id" class="form-control">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="text-center mt-5 mb-5">
                    <input type="submit" class="btn btn-success">
                </div>

            </form>

        </div>
    </div>
@endsection
