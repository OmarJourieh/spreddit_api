<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import Export Excel & CSV to Database in Laravel 7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5 text-center">
    <h2 class="mb-4">
        Laravel 7 Import and Export CSV & Excel to Database Example
    </h2>

    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="custom-file">
            <input type="file" name="attachment" class="custom-file-input" id="validatedCustomFile" >
            <label class="custom-file-label" for="validatedCustomFile">Choose Excelfile</label>
          @error('attachment')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="pt-4">
        <button type="submit" class="btn btn-sm btn-primary">Import</button>
        </div>
    </form>
</div>
</body>

</html>
