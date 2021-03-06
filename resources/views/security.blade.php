@extends('layouts.main')

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-lock'></i> Безопасность
            </h1>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        </div>
        <form action="/security/{{$user->id}}" method="POST">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Обновление эл. адреса и пароля</h2>
                            </div>
                            <div class="panel-content">
                                <!-- email -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Email</label>
                                    <input type="text" id="simpleinput" class="form-control" name="email" value="{{$user->email}}" disabled>
                                </div>
                                @if($errors->has('email'))
                                    <div class="alert alert-danger">
                                        {{$errors->first('email')}}
                                    </div>
                                @endif
                                <!-- password -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Пароль</label>
                                    <input type="password" id="simpleinput" name="password" class="form-control">
                                </div>
                                @if($errors->has('password'))
                                    <div class="alert alert-danger">
                                        {{$errors->first('password')}}
                                    </div>
                                @endif

                                <!-- password confirmation-->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Подтверждение пароля</label>
                                    <input type="password" id="simpleinput" name="password_again" class="form-control">
                                </div>
                                @if($errors->has('password_again'))
                                    <div class="alert alert-danger">
                                        {{$errors->first('password_again')}}
                                    </div>
                                @endif


                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning" type="submit">Изменить</button>
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