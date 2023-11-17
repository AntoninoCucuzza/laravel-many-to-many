@extends('layouts.admin')

@section('content')
    <div class="container text-white">
        <h1 class="fw-bold text-center mt-3">Project Number: # {{ $project->id }}</h1>
        @include('partials.message')


        <div class="d-flex align-items-center justify-content-between">
            <h4>slug: {{ $project->slug }}</h4>
            <div>
                <a class="btn btn-warning btn-lg me-2 border-dark" href="{{ route('admin.projects.edit', $project->slug) }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>

                <button type="button" class="btn btn-danger  btn-lg me-2 border-dark" data-bs-toggle="modal"
                    data-bs-target="#modalId-{{ $project->id }}">
                    <i class="fa-solid fa-trash-can" style="color: #000000;"></i>
                </button>

                <div class="modal fade text-white" id="modalId-{{ $project->id }}" tabindex="-1" data-bs-backdrop="static"
                    data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $project->id }}"
                    aria-hidden="true">

                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">

                        <div class="modal-content">

                            <div class="modal-header bg-dark">
                                <h5 class="modal-title" id="modalTitle-{{ $project->id }}">Modal id:
                                    {{ $project->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body bg-dark">
                                Sei sicuro di voler eliminare questo projetto?
                            </div>

                            <div class="modal-footer bg-dark">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>


                                <form class=" d-inline-block bg-dark"
                                    action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h4>Online link: <a href="{{ $project->project_link }}">{{ $project->project_link }}</a></h4>
        <h4>Github link: <a href="{{ $project->github_link }}">{{ $project->github_link }}</a></h4>



        <div class="row mt-4">

            <div class="col-6">
                <img class="img-fluid" src="{{ $project->thumb }}" alt="">
            </div>

            <div class="col-6">
                <h1 class="">Titolo: {{ $project->title }}</h1>
                <p class="mt-3">Descrizione: {{ $project->description }}</p>


                <h4>Type:
                    @if ($project->type)
                        <span class="badge bg-dark">
                            {{ $project->type->name ? $project->type->name : 'Uncategorized' }}
                        </span>
                    @else
                        Uncategorized
                    @endif
                </h4>

                <div class="d-flex gap-2">
                    <span>Technologies: </span>
                    <ul class="d-flex gap-1 list-unstyled">
                        @forelse ($project->technologies as $technology)
                            <li class="badge bg-dark p-2">
                                <i class="fas fa-tag fa-xs fa-fw"></i>
                                {{ $technology->name }}
                            </li>
                        @empty
                            <li class="badge bg-dark">Untagged</li>
                        @endforelse
                    </ul>
                </div>

            </div>

        </div>

    </div>
@endsection
