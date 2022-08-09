<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Notes</title>



    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('font-awesome/css/all.min.css') }}">

</head>

<body>

    <nav class="bg-light nav">
        <div class="flex container">
            <div>
                <a class="navbar-brand logo" href="{{ route('notes.index') }}"><i class="fa-solid fa-book"></i>{{ __('keepnote') }}</a>
            </div>
            <div>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" name="search" placeholder="{{ __('search') }}"
                        aria-label="Search" value="{{ request()->search }}">
                    <button class="btn btn-outline-success" type="submit">{{ __('here') }}</button>
                </form>
            </div>
            <div>
                {{-- <i class="fa-solid fa-arrow-rotate-right refresh"></i>
                <i class="fa-solid fa-bars-progress list"></i>
                <i class="fa-solid fa-gear setting"></i>
                <i class="fa-solid fa-table-cells menu"></i> --}}

                @if (App::isLocale('en'))
                    <a href="{{ route('notes.index') }}?lang=bn" class="btn btn-link ml-2 text-primary">
                       <img src="{{ asset('images/bn.png') }}" width="40" /> বাংলা
                    </a>
                    <a href="{{ route('notes.index') }}?lang=ara" class="btn btn-link ml-2 text-primary">
                         أرابيك
                     </a>
                @else
                    <a href="{{ route('notes.index') }}?lang=en" class="btn btn-link ml-2 text-primary">
                        <img src="{{ asset('images/en.png') }}" width="40" /> EN
                    </a>
                @endif
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="text-center text">
            {{ __('mynotes') }}
        </div>
        <div class="p-3 mb-5 bg-body rounded m-3 form-section">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <form action="{{ route('notes.store') }}" method="POST"
                        class="shadow p-3 bg-body rounded m-2 form-section">
                        @csrf
                        <input class="form-control col-12 title" type="text" name="title"
                            placeholder="{{ __('title') }}" value="{{ request()->title }}">
                        <textarea class="form-control col-12 detail" name="detail" placeholder="{{ __('description') }}"></textarea>

                        <button type="submit" class="submit btn btn-success">{{ __('save') }}</button>
                    </form>
                </div>
            </div>

            <div class="container">
                <div class="row mt-4">
                    @foreach ($notes as $note)
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="shadow p-3 mb-5 bg-body rounded">
                                <p>{{ $note->title }}</p>
                                <p>{{ $note->detail }}</p>
                                <a href="#editModal-{{ $note->id }}" data-bs-toggle="modal"
                                    class="btn btn-success">{{ __('edit') }}</a>

                                <a href="#deleteModal-{{ $note->id }}" data-bs-toggle="modal"
                                    class="btn btn-danger">{{ __('delete') }}</a>

                                <!-- Delete Modal -->



                                <div class="modal fade" id="deleteModal-{{ $note->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <mark>{{ $note->title }}</mark> will be deleted. Are you sure to
                                                delete
                                                ?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('notes.delete', $note->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-primary">Yes, Delete</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Edit Modal --}}

                                <div class="modal fade" id="editModal-{{ $note->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('notes.update', $note->id) }}" method="POST"
                                                    class="p-4 mx-4 p-3 mb-5 bg-body rounded">
                                                    @csrf
                                                    <input class="form-control col-12 title" type="text"
                                                        name="title" placeholder="Title"
                                                        value="{{ $note->title }}">
                                                    <br />
                                                    <textarea class="form-control col-12 detail" type="text" name="detail" placeholder="Note Detail"></textarea>
                                                    <br />

                                                    <button type="submit"
                                                        class="submit btn btn-success">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="mt-4 pagination">
                    {{ $notes->links() }}
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>

</html>
