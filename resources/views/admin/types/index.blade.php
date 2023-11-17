@extends('layouts.admin')

@section('content')
    @include('partials.message')

    <div class=" text-white mt-4">
        <div class="d-flex justify-content-between my-4">
            <h1>type</h1>
            <a class="btn m-2 btn_custom_create" href="{{ route('admin.types.create') }}">
                <i class="fa-solid fa-pencil" style="color: #ffffff;"></i> new type
            </a>
        </div>

        <table class="table bg_custom_table table-hover align-middle">
            <thead>
                <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($types as $type)
                    <tr class="text-center">
                        <td>{{ $type->id }}</td>

                        <td>{{ $type->name }}</td>

                        <td>{{ $type->slug }}</td>

                        <td>
                            <a class="btn btn-warning" href="{{ route('admin.types.edit', $type->slug) }}">
                                <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                            </a>


                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalId-{{ $type->id }}">
                                <i class="fa-solid fa-trash-can" style="color: #000000;"></i>
                            </button>

                            <div class="modal fade text-white" id="modalId-{{ $type->id }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modalTitle-{{ $type->id }}" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                    role="document">

                                    <div class="modal-content">

                                        <div class="modal-header bg-dark">
                                            <h5 class="modal-title" id="modalTitle-{{ $type->id }}">Modal id:
                                                {{ $type->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body bg-dark">
                                            sei sicuro di voler eliminare questo type?
                                        </div>

                                        <div class="modal-footer bg-dark">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>


                                            <form class=" d-inline-block bg-dark"
                                                action="{{ route('admin.types.destroy', $type->slug) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center table-dark">
                        <td colspan="5"> no types avalible</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {!! $types->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
@endsection
