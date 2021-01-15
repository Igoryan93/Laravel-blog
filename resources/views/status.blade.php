@extends('layouts.main')

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-sun'></i> Установить статус
            </h1>

        </div>
        <form action="/status/{{$user->user_id}}" method="POST">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Установка текущего статуса</h2>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- status -->
                                        <div class="form-group">
                                            <label class="form-label" for="example-select">Выберите статус</label>
                                            <select class="form-control" id="example-select" name="status">
                                                @if($user->status == 1)
                                                    <option value="1" selected >Онлайн</option>
                                                    <option value="2" >Отошел</option>
                                                    <option value="0" >Не беспокоить</option>
                                                @elseif($user->status == 2) {
                                                    <option value="1">Онлайн</option>
                                                    <option value="2" selected>Отошел</option>
                                                    <option value="0" >Не беспокоить</option>
                                                @else
                                                    <option value="1">Онлайн</option>
                                                    <option value="2" selected>Отошел</option>
                                                    <option value="0" selected>Не беспокоить</option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                        <button class="btn btn-warning" type="submit">Отправить</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @csrf
        </form>
    </main>
@endsection