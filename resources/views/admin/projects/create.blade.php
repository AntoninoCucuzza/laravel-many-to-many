@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-white mt-3 mb-0">New project</h1>


        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-3 row">
                <div class="col-12 mt-4">
                    <label for="title" class="form-label text-white ">Title</label>
                    <input class="form-control @error('title') is-invalid @enderror" name="title" type="text"
                        placeholder="inserisci il nome del progetto">

                    @if ($errors->get('title'))
                        <label for="title" class="form-label">
                            @foreach ($errors->get('title') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        </label>
                    @endif

                </div>

                <div class="col-6 mt-4">
                    <label for="project_link" class="form-label text-white ">Project_link</label>
                    <input class="form-control @error('project_link') is-invalid @enderror" name="project_link"
                        type="text" placeholder="inserisci il link del progetto">

                    @if ($errors->get('project_link'))
                        <label for="project_link" class="form-label">
                            @foreach ($errors->get('project_link') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        </label>
                    @endif
                </div>

                <div class="col-6 mt-4">
                    <label for="github_link" class="form-label text-white ">Github_link</label>
                    <input class="form-control @error('github_link') is-invalid @enderror" name="github_link" type="text"
                        placeholder="inserisci il link di github">

                    @if ($errors->get('github_link'))
                        <label for="github_link" class="form-label">
                            @foreach ($errors->get('github_link') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        </label>
                    @endif
                </div>


                <div class="col-6 mt-4">
                    <label for="type_id" class="form-label text-white">Categories</label>
                    <select class="form-select @error('type_id') is-invalid  @enderror" name="type_id" id="type_id">
                        <option selected disabled>Select a category</option>
                        <option value="">Uncategorized</option>

                        @forelse ($types as $type)
                            <option value="{{ $type->id }}" {{ $type->id == old($type->id) ? selected : '' }}
                                class="form-select @error('type_id') is-invalid @enderror">
                                {{ $type->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>


                {{--                 <div class="col-6 mt-4">
                    <label for="technologies" class="form-label text-white">Technologies</label>
                    <select multiple class="form-select @error('technologies') is-invalid @enderror" name="technologies[]"
                        id="technologies">

                        <option disabled>Select technologies</option>
                        <option value="">No technologies has bes used</option>

                        @forelse($technologies as $technology)
                            <option value=" {{ $technology->id }} "
                                {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>
                                
                            </option>

                        @empty
                        @endforelse
                    </select>

                    @if ($errors->get('technologies'))
                        <label for="technologies" class="form-label">
                            @foreach ($errors->get('technologies') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        </label>
                    @endif

                </div> --}}
                <div class="col-6 mt-4">
                    <div style="height:100px" class="row overflow-y-auto h">
                        @forelse($technologies as $technology)
                            @if ($technology->id % 2 == 0)
                                <div class="col-6">
                                    <input class="form-check-input @error('technologies') is-invalid @enderror"
                                        type="checkbox" id="technologies{{ $technology->id }}" name="technologies[]"
                                        aria-describedby="helpTechnology" value="{{ $technology->id }}"
                                        {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label text-white"
                                        for="technologies{{ $technology->id }}">{{ $technology->name }}</label>
                                </div>
                            @else
                                <div class="col-6">
                                    <input class="form-check-input @error('technologies') is-invalid @enderror"
                                        type="checkbox" id="technologies{{ $technology->id }}" name="technologies[]"
                                        aria-describedby="helpTechnology" value="{{ $technology->id }}"
                                        {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>

                                    <label class="form-check-label text-white"
                                        for="technologies{{ $technology->id }}">{{ $technology->name }}</label>
                                </div>
                            @endif

                        @empty
                            no technologies available
                        @endforelse
                    </div>

                    @if ($errors->get('technologies'))
                        <label for="technologies" class="form-label">
                            @foreach ($errors->get('technologies') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        </label>
                    @endif
                </div>

                <div class="col-12 mt-4">
                    <label for="thumb" class="form-label text-white ">Thumb</label>
                    <input class="form-control @error('thumb') is-invalid @enderror" name="thumb" type="file">

                    @if ($errors->get('thumb'))
                        <label for="thumb" class="form-label">
                            @foreach ($errors->get('thumb') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        </label>
                    @endif
                </div>

                <div class="col-12 mt-4">
                    <label for="description" class="form-label text-white ">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" name="descrizione"
                        id="descrizione" cols="30" rows="10"></textarea>


                    @if ($errors->get('description'))
                        <label for="description" class="form-label">
                            @foreach ($errors->get('description') as $error)
                                <small class="text-danger">{{ $error }}</small>
                            @endforeach
                        </label>
                    @endif
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>

            </div>


        </form>
    </div>
@endsection
