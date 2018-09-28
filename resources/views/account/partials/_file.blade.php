@component('files.partials._file', compact('file'))
    @slot('links')
        <div class="level">
            <div class="level-left">
                <p class="level-item">
                    {{ $file->isFree() ? 'Free' : $file->price . '€' }}
                </p>

                @if(!$file->aspproved)
                    <p class="level-item">
                        Pending Approval
                    </p>
                @endif
                <p class="level-item">
                    {{ $file->live ? 'Live' : 'Not live' }}
                </p>
                <a href="{{ route('account.files.edit', $file) }}" class="level-item">Make changes</a>
            </div>
        </div>
    @endslot
@endcomponent