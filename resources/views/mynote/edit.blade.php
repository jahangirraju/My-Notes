<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Notes</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container">
        <div class="text-center text">
            My Notes
        </div>
        <div class="border border-success form-section">
            <form action="{{ route('notes.update', $note->id) }}" method="POST"
                class="p-4 mx-4 border border-success form-section">
                @csrf
                <input class="form-controle col-12 title" type="text" name="title" placeholder="Title" value="">
                <br />
                <input class="form-controle col-12 detail" type="text" name="detail" placeholder="Note Detail" value="">
                <br />

                <button type="submit" class="submit btn btn-success">Save</button>
            </form>
        </div>

    </div>
</body>

</html>
