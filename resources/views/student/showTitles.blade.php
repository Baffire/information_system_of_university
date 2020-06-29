@extends('student.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 shadow">
            <p class="h5 text-center mt-3">
                Список тем ВКР
            </p>

            @if($titles && count($titles) != 0)
                @if (!empty($message))
                    <div class="alert alert-{{ $status }}" role="alert">
                        {{ $message }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table bg-white mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Наименование</th>
                                <th>Предложил</th>
                                <th>Студент</th>
                                <th>Описание</th>
                                <th>Программное обеспечение</th>
                                <th>Выбрать</th>
                                <th class="text-center">Подать заявку</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($titles as $title)
                            @if( empty($title->title_confirm->confirmation) )
                                <tr>
                                    <td>@php echo $i; @endphp</td>
                                    <td>{{ $title->name }}</td>
                                    <td>
                                        {{ $title->teacher->user->name }}
                                        {{ $title->teacher->user->patronymic }}
                                        {{ $title->teacher->user->surname }}
                                    </td>
                                    <td>
                                        @if( isset($title->title_confirm->student) && $title->title_confirm->confirmation == 1 )
                                            {{ $title->title_confirm->student->user->name }}
                                            {{ $title->title_confirm->student->user->patronymic }}
                                            {{ $title->title_confirm->student->user->surname }}
                                        @else
                                            <div class="alert alert-success p-2 text-center" role="alert">
                                                Тема доступна для выбора
                                            </div>
                                        @endif
                                    </td>
                                    <td> {{ $title->description }}</td>
                                    <td class="text-center"> {{ $title->software }}</td>

                                    @if( empty($title->title_confirm->confirmation) )
                                        <form action="" method="POST">
                                            @csrf
                                            <td class="text-center">
                                                <input name="choose" type="checkbox" value="{{ $title->id }}">
                                            </td>
                                            <td>
                                                <input type="submit" class="btn btn-success">
                                            </td>
                                        </form>
                                    @else
                                        <td colspan="2">
                                            <div class="alert alert-secondary p-2 text-center" role="alert">
                                                Тема закреплена
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                                @php $i++; @endphp
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $titles->links() }}
                </div>

            @else
                <div class="alert alert-success mt-5 mb-5" role="alert">
                    Нет тем для выпускных квалификационных работ.
                </div>
            @endif
        </div>
    </div>
@endsection
