@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Форма добавления преподавателя
            </p>

            @if (!empty($message))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-4">
                <form action="" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <label for="name">Имя: </label>
                            <input name="name" type="text" id="name" class="form-control" placeholder="Имя">
                        </div>
                        <div class="col">
                            <label for="patronymic">Отчество: </label>
                            <input name="patronymic" type="text" id="patronymic" class="form-control" placeholder="Отчество">
                        </div>
                        <div class="col">
                            <label for="surname">Фамилия: </label>
                            <input name="surname" type="text" id="surname" class="form-control" placeholder="Фамилия">
                        </div>
                    </div>


                    <div class="form-row mt-3">
                        <div class="form-group col-md-6">
                            <label for="academic_degree">Академическая степень: </label>
                            <select name="academic_degree" class="form-control" id="academic_degree">
                                <option hidden>Академическая степень:</option>
                                @foreach ( $academic_degrees as $academic_degree)
                                    <option value="{{ $academic_degree->id }}">{{ $academic_degree->name }}</option>
                                @endforeach
                                <option value="">Нет степени</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Звание: </label>
                            <select name="status" class="form-control" id="status">
                                <option hidden>Звание</option>
                                @foreach ( $statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                                <option value="">Нет звания</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="post">Должность: </label>
                            <select name="post" class="form-control" id="post">
                                <option hidden>Должность</option>
                                @foreach ( $posts as $post)
                                    <option value="{{ $post->id }}">{{ $post->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email адрес: </label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="name@yandex.ru">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Пароль: </label>
                            <input name="password" type="password" class="form-control" id="password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Подтвердите пароль: </label>
                            <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
                        </div>
                    </div>
                    <div class="text-center mt-5 mb-3">
                        <input type="submit" value="Создать" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
