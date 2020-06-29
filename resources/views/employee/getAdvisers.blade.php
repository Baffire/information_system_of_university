@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Выгрузить данные в Excel
            </p>

            @if (!empty($message))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif

            <form action="" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead>
                        <tr class="border-bottom">
                            <th>№</th>
                            <th>Напрвление подготовки</th>
                            <th>Выбрать</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $training_programs as $training_program )
                            <tr class="border-bottom">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $training_program->name }}</td>
                                <td>
                                    <input name="training_programs[]" type="checkbox" value="{{ $training_program->id }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="form-group col-sm-12 col-md-10 col-lg-5 mt-3">
                    <label for="year_of_admissions">Выберите год набора: </label>
                    <select name="year_of_admissions[]" multiple class="form-control" id="year_of_admissions">
                        <option>2020</option>
                        <option>2019</option>
                        <option>2018</option>
                        <option>2017</option>
                        <option>2016</option>
                        <option>2015</option>
                    </select>
                </div>

                <div class="mt-5 text-center ">
                    <input type="submit" value="Выгрузить" class="btn btn-success">
                </div>
            </form>
        </div>

    </div>

@endsection
