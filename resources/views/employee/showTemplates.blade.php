@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h4 text-center mt-3 mb-5">
                Шаблоны документов .xls
            </p>

            <div class="table-responsive  pl-5 pr-5">
                <table class="table table-borderless mt-3 bg-white">
                    <tbody>
                    <tr>
                        <td class="align-middle">Шаблон файла с дорожной картой</td>
                        <td>
                            <div class="documentTemplate">
                                <a href="/employee/templates/roadmap">
                                    <img src="/images/template.png" width="50px" height="50px" alt="Here must be documents pin">
                                    Скачать
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Шаблон файла со списком студентов</td>
                        <td>
                            <div class="documentTemplate">
                                <a href="/employee/templates/students">
                                    <img src="/images/template.png" width="50px" height="50px" alt="Here must be documents pin">
                                    Скачать
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Шаблон файла со списком преподавателей</td>
                        <td>
                            <div class="documentTemplate">
                                <a href="/employee/templates/teachers">
                                    <img src="/images/template.png" width="50px" height="50px" alt="Here must be documents pin">
                                    Скачать
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Шаблон файла со списком тем ВКР</td>
                        <td>
                            <div class="documentTemplate">
                                <a href="/employee/templates/titles">
                                    <img src="/images/template.png" width="50px" height="50px" alt="Here must be documents pin">
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
