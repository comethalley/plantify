<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>

<body>
    <h1>Search Results</h1>

    <div id="searchResults">
        @if ($recommendations->isEmpty())
        <div style="text-align: center;" class="notFound">No results found</div>
        @else
        <div style="max-width: 600px; margin: 0 auto;">
            <ul>
                @foreach ($recommendations as $recommendation)
                <li>{{ $recommendation }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</body>

</html>