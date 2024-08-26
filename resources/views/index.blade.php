<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TestTask</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container text-center mt-5">
    <h1>Create Entity</h1>

    <div class="dropdown mb-4">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="entityDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            Select Entity Type
        </button>
        <ul class="dropdown-menu" aria-labelledby="entityDropdown">
            @foreach($availableEntities as $entity)
                <li><a class="dropdown-item" data-entity="{{ strtolower($entity->name) }}">{{ $entity->name }}</a></li>
            @endforeach
        </ul>
    </div>

    <form action="{{ route('entity.create') }}" method="post" id="entityForm">
        @csrf
        <div id="formFields">

        </div>
        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{ asset('js/forms.js') }}"></script>
</body>
</html>
