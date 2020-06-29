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
                        <input name="name" id="name" type="text" class="form-control" value="{{ $teacher->user->name ?? '' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="patronymic" class="col-md-3 col-form-label">Отчество: </label>
                    <div class="col-md-9">
                        <input name="patronymic" id="patronymic" type="text" value="{{ $teacher->user->patronymic ?? ''}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-md-3 col-form-label">Фамилия: </label>
                    <div class="col-md-9">
                        <input name="surname" id="surname" type="text" class="form-control" value="{{ $teacher->user->surname ?? ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label">Email: </label>
                    <div class="col-md-9">
                        <input name="email" id="email" type="text" class="form-control" value="{{ $teacher->user->email ?? ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="academic_degree" class="col-md-3 col-form-label">Академическая степень: </label>
                    <div class="col-md-9">
                        <select name="academic_degree" id="academic_degree" class="form-control">
                            <option value="{{ $teacher->academic_degree_id }}" selected hidden>{{ $teacher->academic_degree->name }}</option>
                            @foreach($academic_degrees as $academic_degree)
                                <option value="{{ $academic_degree->id }}">{{ $academic_degree->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-md-3 col-form-label">Звание: </label>
                    <div class="col-md-9">
                        <select name="status" id="status" class="form-control">
                            <option value="{{ $teacher->status_id }}" selected hidden>{{ $teacher->status->name }}</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="post" class="col-md-3 col-form-label">Должность: </label>
                    <div class="col-md-9">
                        <select name="post" id="post" class="form-control">
                            <option value="{{ $teacher->post_id }}" selected hidden>{{ $teacher->post->name }}</option>
                            @foreach($posts as $post)
                                <option value="{{ $post->id }}">{{ $post->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="department_id" class="col-md-3 col-form-label">Кафедра: </label>
                    <div class="col-md-9">
                        <select name="department_id" id="department_id" class="form-control">
                            <option value="{{ $teacher->department_id }}" selected hidden>{{ $teacher->department->name }}</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
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
