@component('files.partials._file', compact('file'))
    @slot('links')
        <div class="level">
            <div class="level-left">
                <p class="level-item">
                    {{ $file->isFree() ? 'Free' : $file->price . '€' }}
                </p>
                <p class="level-item">
                    <a href="">Preview file</a>
                </p>
                <p class="level-item">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('approved-{{$file->id}}').submit();">Approved</a>
                </p>

                <form action="{{ route('admin.files.new.update', $file) }}" id="approved-{{ $file->id }}" method="POST" class="is-hidden">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                </form>

                <p class="level-item">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('reject-{{ $file->id }}').submit();">Reject</a>
                </p>

                <form action="{{ route('admin.files.new.destroy', $file) }}" id="reject-{{ $file->id }}" method="POST" class="is-hidden">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            </div>
        </div>
    @endslot
@endcomponent