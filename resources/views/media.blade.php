@extends('layouts.main')

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-image'></i> Загрузить аватар
            </h1>
            @if(Session::has('danger'))
                <div class="alert alert-danger">
                    {{Session::get('danger')}}
                </div>
            @elseif(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    {{$errors->first('image')}}
                </div>
            @endif
        </div>
        <form action="/media/{{$user->user_id}}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Текущий аватар</h2>
                            </div>
                            <div class="panel-content">
                                <div class="form-group">
                                    @if(empty($user->image))
                                        <img src="/img/No-Image.png" alt="" class="img-responsive" width="200">
                                    @else
                                        <img src="/{{$user->image}}" alt="" class="img-responsive" width="200">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="example-fileinput">Выберите аватар</label>
                                    <input type="file" id="example-fileinput" name="image" class="form-control-file">
                                </div>


                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning" type="submit">Загрузить</button>
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