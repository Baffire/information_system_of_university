@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-4">
                Форма редактирования
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

            <div class="table-responsive p-5">
                <table class="table table-borderless mt-3 bg-white">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Наименование: </label>
                            <input name="name" type="text" class="form-control" id="name" value="{{ $roadmap_item->name }}">
                        </div>
                        <div class="form-group">
                            <label for="start_date">Дата начала: </label>
                            <input name="start_date" type="datetime-local" class="form-control" id="start_date" value="{{ date('Y-m-d', strtotime($roadmap_item->start_date)) }}T{{ date('H:i', strtotime($roadmap_item->start_date)) }}" >
                        </div>
                        <div class="form-group">
                            <label for="finish_date">Дата окончания: </label>
                            <input name="finish_date" type="datetime-local" class="form-control" id="finish_date" value="{{ date('Y-m-d', strtotime($roadmap_item->finish_date)) }}T{{ date('H:i', strtotime($roadmap_item->finish_date)) }}" >
                        </div>
                        <div class="text-center mt-5">
                            <input type="submit" class="btn btn-success" value="Сохранить">
                        </div>
                    </form>
                </table>
            </div>
        </div>
    </div>

@endsection
