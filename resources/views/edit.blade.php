@extends('layouts.main')


@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-plus-circle'></i> Редактировать
            </h1>
        </div>
        @if(Session::has('danger'))
            <div class="alert alert-danger">
                {{Session::get('danger')}}
            </div>
        @elseif(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        <form action="/edit/{{$user_id->id}}" method="POST">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Общая информация</h2>
                            </div>
                            <div class="panel-content">
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Имя</label>
                                    <input type="text" id="simpleinput" name="name" class="form-control" value="{{$user->name}}">
                                </div>
                                @if($errors->has('name'))
                                    <div class="alert alert-danger">
                                        {{$errors->first('name')}}
                                    </div>
                                @endif

                                <!-- title -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Место работы</label>
                                    <input type="text" id="simpleinput" name="job" class="form-control" value="{{$user->job}}">
                                </div>
                                @if($errors->has('job'))
                                        <div class="alert alert-danger">
                                            {{$errors->first('job')}}
                                        </div>
                                @endif

                            <!-- tel -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Номер телефона</label>
                                    <input type="text" id="simpleinput" name="phone" class="form-control" value="{{$user->phone}}">
                                </div>
                                @if($errors->has('phone'))
                                        <div class="alert alert-danger">
                                            {{$errors->first('phone')}}
                                        </div>
                                @endif

                            <!-- address -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Адрес</label>
                                    <input type="text" id="simpleinput" name="address" class="form-control" value="{{$user->address}}">
                                </div>
                                @if($errors->has('address'))
                                    <div class="alert alert-danger">
                                        {{$errors->first('address')}}
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Вконтакте</label>
                                    <input type="text" id="simpleinput" name="vk" class="form-control" value="{{$user->vk}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Инстаграм</label>
                                    <input type="text" id="simpleinput" name="inst" class="form-control" value="{{$user->inst}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Телеграм</label>
                                    <input type="text" id="simpleinput" name="tg" class="form-control" value="{{$user->tg}}">
                                </div>
                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning" type="submit">Редактировать</button>
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