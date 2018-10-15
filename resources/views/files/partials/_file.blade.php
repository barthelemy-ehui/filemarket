<article class="media">
    <div class="media-content">
        <div class="content">
            <strong>
                <a href="{{ route('files.show', $file) }}">{{ $file->title }}</a>
            </strong>
            <br/>
            {{ $file->overview_short }}
        </div>
        {{ $links }}
    </div>
</article>
