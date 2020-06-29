@extends('admin.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10 ">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Список заведующих кафедрами
            </p>

            @if(count($heads) != 0)
                <div class="text-center mt-4 mb-2">
                    <form action="" method="POST">
                        @csrf
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="department_id" name="sort" class="custom-control-input" value="department_id">
                            <label class="custom-control-label" for="department_id">Кафедра</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="created_at" name="sort" class="custom-control-input" value="created_at">
                            <label class="custom-control-label" for="created_at">Дата добавления</label>
                        </div>
                        <div class="text-center mt-3">
                            <input type="submit" class="btn btn-secondary" value="Сортировать">
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>ФИО</th>
                                <th>Email</th>
                                <th>Кафедра</th>
                                <th>Редактировать</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($heads as $head)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $head->user->name }}
                                    {{ $head->user->patronymic }}
                                    {{ $head->user->surname }}
                                </td>
                                <td>{{ $head->user->email }}</td>
                                <td>{{ $head->department->name }}</td>
                                <td>
                                    <a class="btn btn-success" href="/admin/heads/edit/{{ $head->id }}">Редактировать</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-5">
                    {{ $heads->links() }}
                </div>

            @else
                <div class="alert alert-success mt-5 mb-5" role="alert">
                    Нет пользователей.
                </div>
            @endif

            <div class="text-center mb-5">
                <a class="btn btn-success" href="/admin/heads/create">Создать</a>
            </div>
        </div>
    </div>

@endsection

