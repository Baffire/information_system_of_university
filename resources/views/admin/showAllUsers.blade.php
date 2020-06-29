@extends('admin.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Список пользователей сайта
            </p>

            @if(count($users) != 0)
                <div class="text-center mt-4 mb-2">
                    <form action="" method="POST">
                        @csrf
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="surname" name="sort" class="custom-control-input" value="surname">
                            <label class="custom-control-label" for="surname">Фамилия</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="email" name="sort" class="custom-control-input" value="email">
                            <label class="custom-control-label" for="email">Email</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="role_id" name="sort" class="custom-control-input" value="role_id">
                            <label class="custom-control-label" for="role_id">Роль</label>
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
                            <th>Имя</th>
                            <th>Отчество</th>
                            <th>Фамилия</th>
                            <th>E-mail</th>
                            <th>Роль</th>
                            <th>Редактировать</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->patronymic }}</td>
                                <td>{{ $user->surname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if( isset($user->role->name) )
                                        {{ $user->role->name }}
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success" href="/admin/users/edit/{{ $user->id }}">Редактировать</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-5">
                    {{ $users->links() }}
                </div>
            @else
                <div class="alert alert-success mt-5" role="alert">
                    Нет пользователей.
                </div>
            @endif
        </div>
    </div>

@endsection

