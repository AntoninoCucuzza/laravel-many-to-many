@extends('layouts.admin')

@section('content')
    <div class="container text-white ">
        <h1 class="text-center">edit type</h1>
        <form action="{{ route('admin.types.update', $Type) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div>
                    <label for="name" class="form-label text-white ">name</label>
                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"
                        placeholder="inserisci il nome">

                    @if ($errors->get('name'))
                        <label for="name" class="form-label">
                            @foreach ($errors->get('name') as $error)
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
