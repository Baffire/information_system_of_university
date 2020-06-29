@extends('head.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <p class="h5 text-center mt-3">
                Форма редактирования темы ВКР
            </p>

            <form action="" method="POST" class="mt-3">
                @csrf
                <div class="form-group">
                    <label for="name">Наименование</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ $title->title->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="description" class="form-control" id="description" rows="3" readonly>{{  $title->title->description }}</textarea>
                    <small id="descriptionHelp" class="form-text text-muted">Приведите краткое описание предметной области.</small>
                </div>
                <div class="form-group">
                    <label for="software">Программное обеспечение</label>
                    <textarea name="software" class="form-control" id="software" rows="3" readonly>{{ $title->title->software }}</textarea>
                    <small id="softwareHelp" class="form-text text-muted">Перечислите программы, которые должен знать студент при проведении исследования по данной теме.</small>
                </div>
                <div class="form-group mt-3">
                    <label for="add_teacher">Дополнительный руководитель</label>
                    <select name="add_teacher" id="add_teacher" class="form-control form-control-md">
                    <option value="@if (!empty($title->add_teacher)) {{ $title->add_teacher->teacher->id }} @endif" selected hidden > @if (!empty($title->add_teacher)) {{ $title->add_teacher->teacher->user->surname }}{{ $title->add_teacher->teacher->user->name }}{{ $title->add_teacher->teacher->user->patronymic }} @endif </option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" >{{ $teacher->user->surname }} {{ $teacher->user->name }} {{ $teacher->user->patronymic }} {{ $teacher->post->name }} </option>
                        @endforeach
                    <option value="0"> Нет дополнительного руководителя</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="confirm">Утвердить</label>
                    <select name="confirm" id="confirm" class="form-control form-control-md">
                        <option value="{{ $title->confirmation }}" selected hidden>{{ $title->confirmation == 1 ? 'Утверждено': 'Не утверждено' }}</option>
                        <option value="1">Да</option>
                        <option value="null">Нет</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="negative">Отклонить</label>
                    <select name="negative" id="negative" class="form-control form-control-md">
                        <option value="{{ $title->negative }}" selected hidden>{{ $title->negative == 1 ? 'Отклонено': 'Не отклонено' }}</option>
                        <option value="1">Да</option>
                        <option value="null">Нет</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="order">Приказ о закреплении</label>
                    <input name="order" type="text" class="form-control" id="order" placeholder="Не закреплено" value="{{ $title->order }}">
                </div>
                <div class="text-center mt-5 mb-3">
                    <input type="submit" class="btn btn-success" value="Сохранить">
                </div>
            </form>
        </div>
    </div>

@endsection
