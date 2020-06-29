@extends('teacher.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-8 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h4 text-center mt-3 mb-5">
                Шаблоны документов .xls
            </p>

            <div class="table-responsive">
                <table class="table table-borderless mt-3 bg-white">
                    <tbody>
                    <tr class="border-bottom">
                        <td class="align-middle pl-5">Шаблон файла со списком тем ВКР</td>
                        <td>
                            <div class="documentTemplate">
                                <a href="/teacher/templates/titles">
                                    <img src="/images/template.png" width="50px" height="50px" alt="Here must be documents pin" >
                                    Скачать
                                </a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
