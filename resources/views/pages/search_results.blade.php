@include('templates.header')

<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top:100px; ">
    <div class="main-content" style="display: flex; flex-direction: column; width: 58%; padding:20px; row-gap:2px;">
        @if (!empty($searchTerm))
        <div>
            <p style=" margin:0; font-family: Poppins, sans-serif; font-weight:bold; background-color:white; padding:20px;">Results for : {{ $searchTerm }}</p>
        </div>
        @endif

        @if (isset($recommendations) && count($recommendations) > 0)
        <div style="background-color:white; padding:20px;">
            @foreach ($recommendations as $recommendation)
            {{ $recommendation }}
            @endforeach
        </div>
        @else
        <p>No recommendations found.</p>
        @endif
    </div>
</div>


@include('templates.footer')