@if($breadcrumbs)
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($breadcrumbs AS $breadcrumb)
                @if(isset($breadcrumb['active']))
                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['title'] }}</li>
                @else
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['title'] }}</a></li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif