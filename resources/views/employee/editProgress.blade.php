@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-4">
                Форма редактирования отчестности студентов по контролю: <br>
                {{ $roadmap_item->name }}
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

            <div class="m-5">
                <form action="" method="POST">
                    @csrf

                    <table class="table editProgress">

                        @foreach( $degree_of_preparation as $degree)
                            <tr>
                                <td>
                                    <b>Студент:  </b>
                                    {{ $degree->student->user->surname }}{{ $degree->student->user->name }}{{ $degree->student->user->patronymic }}
                                </td>
                                <td>
                                    <div class="form-check form-check-inline mr-5">
                                        <input class="form-check-input" type="radio" name="{{ $degree->student->id }}" id="{{ $degree->student->id }}.1" value="1" @if($degree->employee_confirm == 1) checked @endif>
                                        <label class="form-check-label" for="{{ $degree->student->id }}.1">Сдал</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-5">
                                        <input class="form-check-input" type="radio" name="{{ $degree->student->id }}" id="{{ $degree->student->id }}.0" value="0" @if($degree->employee_negative == 1) checked @endif>
                                        <label class="form-check-label" for="{{ $degree->student->id }}.0">Не сдал</label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </table>

                    <div class="text-center mt-5 mb-5">
                        <input name="submit" type="submit" class="btn btn-success" value="Сохранить">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
