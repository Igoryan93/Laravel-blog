@extends('layouts.main')

@section('content')

    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-users'></i> Список пользователей
            </h1>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @elseif(Session::has('danger'))
            <div class="alert alert-danger">
                {{Session::get('danger')}}
            </div>
        @endif
        <div class="row">
            <div class="col-xl-12">
                @if(Auth::check() && Auth::user()->is_admin)
                    <a class="btn btn-success" href="/admin/create">Добавить</a>
                @endif
                <div class="border-faded bg-faded p-3 mb-g d-flex mt-3">
                    <input type="text" id="js-filter-contacts" name="filter-contacts" class="form-control shadow-inset-2 form-control-lg" placeholder="Найти пользователя">
                    <div class="btn-group btn-group-lg btn-group-toggle hidden-lg-down ml-3" data-toggle="buttons">
                        <label class="btn btn-default active">
                            <input type="radio" name="contactview" id="grid" checked="" value="grid"><i class="fas fa-table"></i>
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="contactview" id="table" value="table"><i class="fas fa-th-list"></i>
                        </label>
                    </div>
                </div>
            </div>
        </div>


        <div class="row" id="js-contacts">
            @foreach($users as $user)
                <div class="col-xl-4">
                    <div id="c_8" class="card border shadow-0 mb-g shadow-sm-hover" data-filter-tags="arica grace">
                        <div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
                            <div class="d-flex flex-row align-items-center">
                                @if($user->find($user->id)->info)
                                    @if($user->find($user->id)->info->status == 1)
                                        <span class="status status-success mr-3">
                                     @elseif($user->find($user->id)->info->status == 2)
                                        <span class="status status-warning mr-3">
                                     @else
                                        <span class="status status-danger mr-3">
                                     @endif
                                @endif
                                @if(!$user->find($user->id)->info || empty($user->find($user->id)->info->image))
                                    <span class="rounded-circle profile-image d-block " style="background-image:url('img/No-Image.png'); background-size: cover;"></span>
                                @else
                                    <span class="rounded-circle profile-image d-block " style="background-image:url('{{$user->find($user->id)->info->image}}'); background-size: cover;"></span>
                                @endif
                                </span>
                                <div class="info-card-text flex-1">
                                    <a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">
                                        {{$user->find($user->id)->info ? $user->find($user->id)->info->name : '' }}
                                        @if(Auth::check())
                                            @if(Auth::id() === $user->id ||  Auth::user()->is_admin)
                                                <i class="fal fas fa-cog fa-fw d-inline-block ml-1 fs-md"></i>
                                                <i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
                                            @endif
                                        @endif
                                    </a>
                                    @if(Auth::check())
                                        @if(Auth::id() == $user->id || Auth::user()->is_admin)
                                            <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/edit/{{$user->id}}">
                                                <i class="fa fa-edit"></i>
                                                Редактировать</a>
                                            <a class="dropdown-item" href="/security/{{$user->id}}">
                                                <i class="fa fa-lock"></i>
                                                Безопасность</a>
                                            <a class="dropdown-item" href="/status/{{$user->id}}">
                                                <i class="fa fa-sun"></i>
                                                Установить статус</a>
                                            <a class="dropdown-item" href="/media/{{$user->id}}">
                                                <i class="fa fa-camera"></i>
                                                Загрузить аватар
                                            </a>
                                            <a href="/delete/{{$user->id}}" class="dropdown-item" onclick="return confirm('are you sure?');">
                                                <i class="fa fa-window-close"></i>
                                                Удалить
                                            </a>
                                        </div>
                                        @endif
                                    @endif
                                    @if($user->find($user->id)->info)
                                        <span class="text-truncate text-truncate-xl">{{$user->find($user->id)->info->job}}</span>
                                    @endif
                                </div>
                                <button class="js-expand-btn btn btn-sm btn-default d-none" data-toggle="collapse" data-target="#c_8 > .card-body + .card-body" aria-expanded="false">
                                    <span class="collapsed-hidden">+</span>
                                    <span class="collapsed-reveal">-</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0 collapse show">
                            <div class="p-3">
                                @if($user->find($user->id)->info)
                                    <a href="tel:{{$user->find($user->id)->info->phone}}" class="mt-1 d-block fs-sm fw-400 text-dark">
                                        <i class="fas fa-mobile-alt text-muted mr-2"></i> {{$user->find($user->id)->info->phone}}</a>
                                @endif

                                <a href="mailto:{{$user->email}}" class="mt-1 d-block fs-sm fw-400 text-dark">
                                    <i class="fas fa-mouse-pointer text-muted mr-2"></i> {{$user->email}}</a>
                                @if($user->find($user->id)->info)
                                    <address class="fs-sm fw-400 mt-4 text-muted">
                                        <i class="fas fa-map-pin mr-2"></i> {{$user->find($user->id)->info->address}}</address>
                                @endif
                                <div class="d-flex flex-row">
                                    @if(!empty($user->find($user->id)->info->inst))
                                        <a href="{{$user->find($user->id)->info->inst}}" class="mr-2 fs-xxl" style="color:#C13584">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    @endif
                                    @if(!empty($user->find($user->id)->info->tg))
                                        <a href="{{$user->find($user->id)->info->tg}}" class="mr-2 fs-xxl" style="color:#0088cc">
                                            <i class="fab fa-telegram"></i>
                                        </a>
                                    @endif
                                    @if(!empty($user->find($user->id)->info->vk))
                                        <a href="{{$user->find($user->id)->info->vk}}" class="mr-2 fs-xxl" style="color:#4680C2">
                                            <i class="fab fa-vk"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        {{ $users->links() }}

    </main>


@endsection