<div class="card margin-top-20">
    @isset($tag)
        <div class="tag">
            <span class="label {{ $coverColor }}">{{ $tag }}</span>
        </div>
    @endisset
    <div class="card-image">
        <img src="{{ $image }}">
        <div class="card-image-headline {{ $coverColor }}"></div>
    </div>
    <div class="content">
        <h4>
            <b>
                {{ $title }}
            </b>
        </h4>
        @isset($body)
            <p>
                {!! $body !!}
            </p>
        @endisset

        @isset($action)
            <a href="{{ $url }}" class="btn {{ isset($actionColor) ? $actionColor : "btn-success" }} {{ isset($hidden) ? $hidden : "" }}">{{ $action }}</a>
        @endisset
    </div>
</div>