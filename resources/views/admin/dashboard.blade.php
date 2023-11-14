@extends('layouts.admin')

@section('content')
    <div class="container text-white">
        <h2 class="fs-4 my-4">
            <i class="bi bi-body-text"></i> {{ __('Welcome') }} {{ Auth::user()->name }}!
        </h2>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif



        <div class="row justify-content-center">
            <div class="col">
                <div class="card bg_custom_card text-white">
                    <div class="card-body">
                        <h4 class="text-uppercase">
                            <i class="fa-solid fa-bars-progress"></i> projects
                        </h4>
                        <strong class="fs-2">{{ $total_Projects }}</strong>
                    </div>
                    <div class="card-footer text-end d-flex align-items-center justify-content-between">

                        <div>
                            <span> With image: {{ $total_Projects_with_images }} </span>
                            <span> Without image: {{ $total_Projects_without_images }}</span>

                        </div>

                        <a href="{{ route('admin.projects.index') }}" class="btn text-white">Go
                            <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{--   @if (Auth::user()->isSuperAdmin())
                <div class="col">
                    <div class="card bg_custom_card text-white">
                        <div class="card-body">
                            <h4 class="text-uppercase">
                                <i class="fa-solid fa-users"></i> Users
                            </h4>
                            <strong class="fs-2">{{ $total_users }}</strong>

                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.projects.index') }}" class="btn text-white">Go
                                <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif --}}

            <div class="col">
                <div class="card bg_custom_card text-white">
                    <div class="card-body">
                        <h4 class="text-uppercase">
                            <i class="fa-solid fa-list"></i> Categories
                        </h4>
                        <strong class="fs-2">{{ $total_categories }}</strong>

                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.projects.index') }}" class="btn text-white">Go
                            <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
