@component('files.partials._file', compact('file'))
    @slot('links')
        <div class="level">
            <div class="level-left">
                <p class="level-item">
                    {{ $file->isFree() ? 'Free' : $file->price . '€' }}
                </p>
                <p class="level-item">
                    <a href="">Preview changes</a>
                </p>
                <p class="level-item">
                    <a href="#">Approved</a>
                </p>

                <p class="level-item">
                    <a href="#">Reject</a>
                </p>

            </div>
        </div>
    @endslot
@endcomponent