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
                Форма добавления комментария
            </p>

            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="comment">Комментарий</label>
                    <textarea name="comment" id="comment" class="form-control" rows="5">Введите текст комментария</textarea>
                    <small>Текст комментария должен содержать замечания к теме ВКР. Данный комментарий увидит преподаватель.</small>
                </div>
                <div class="text-center mt-5 mb-3">
                    <input type="submit" class="btn btn-success" value="Сохранить">
                </div>
            </form>
        </div>
    </div>

@endsection
