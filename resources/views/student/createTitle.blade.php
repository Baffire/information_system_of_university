@extends('student.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-9">
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
                Форма создания темы ВКР
            </p>

            <form action="" method="POST" class="mt-3">
                @csrf
                <div class="form-group">
                    <label for="name">Наименование</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Информационная система управления процессом организации ИГА в вузе">
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                    <small id="descriptionHelp" class="form-text text-muted">Приведите краткое описание предметной области.</small>
                </div>
                <div class="form-group">
                    <label for="software">Программное обеспечение</label>
                    <textarea name="software" class="form-control" id="software" rows="3"></textarea>
                    <small id="softwareHelp" class="form-text text-muted">Перечислите программы, которые должен знать студент при проведении исследования по данной теме.</small>
                </div>
                <div class="text-center mt-5 mb-3">
                    <input type="submit" class="btn btn-success" value="Предложить тему">
                </div>
            </form>
        </div>
    </div>

@endsection
