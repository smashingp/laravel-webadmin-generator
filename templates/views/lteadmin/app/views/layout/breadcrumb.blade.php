                <section class="content-header">
                    <h1>
                        {{ $section }}
                        <small>{{ $secdesc }}</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
@if (is_array($breadcrumb))
    @foreach($breadcrumb as $item)
        @if ($item['url'] == "")
                        <li class="{{ $item['active'] }}}">{{ $item['name'] }}</li>
        @else
                        <li class="{{ $item['active'] }}}"><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
        @endif
    @endforeach
@else
    <li class="active">{{ $breadcrumb }}</li>
@endif                        
                    </ol>
                </section>