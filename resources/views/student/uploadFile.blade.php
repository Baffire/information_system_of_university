@extends('student.layouts.app')

@section('content')
    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Форма загрузки файла
            </p>

            @if (!empty($message))
                <div class="alert alert-secondary" role="alert">
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

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mt-5 p-3">
                    <label for="file">my_document.doc, my_document.docx</label>
                    <input name="file" type="file" class="form-control-file mt-1" id="file">
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-success mt-5 mb-5" value="Загрузить">
                </div>
            </form>
        </div>
    </div>
@endsection
