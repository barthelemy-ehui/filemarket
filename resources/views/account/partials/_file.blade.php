<article class="media">
    <div class="media-content">
        <div class="content">
            <strong>
                <a href="#">{{ $file->title }}</a>
            </strong>
            <br/>
            {{ $file->overview_short }}
        </div>
        <div class="level">
            <div class="level-left">
                <p class="level-item">
                    {{ $file->isFree() ? 'Free' : $file->price . '€' }}
                </p>

                @if(!$file->approved)
                    <p class="level-item">
                        Pending Approval
                    </p>
                @endif
                <p class="level-item">
                    {{ $file->live ? 'Live' : 'Not live' }}
                </p>
                <a href="#" class="level-item">Make changes</a>
            </div>
        </div>
    </div>
</article>
