@props(['links'])

<div>
    <h1 class="text-lg font-bold">Community Contributions</h1>
    <ul class="mt-4">
        @foreach ($links as $link)
            <li class="mb-4 border-b border-gray-700 pb-2">
                <!-- Título del enlace -->
                <a href="/dashboard/{{ $link->channel->slug }}" class="text-blue-400 hover:underline">{{ $link->title }}</a>
                <br>
                <!-- Información del contribuyente -->
                <small class="text-gray-400">
                    Contributed by: {{ $link->creator->name }} - {{ $link->updated_at->diffForHumans() }}
                </small>

                <!-- Formulario de votación -->
                <form method="POST" action="/votes/{{ $link->id }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 rounded text-white 
                        {{ Auth::check() && Auth::user()->votedFor($link) ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-500 hover:bg-gray-600' }}"
                        {{ !Auth::check() || !Auth::user()->isTrusted() ? 'disabled' : '' }}>
                        {{ $link->users()->count() }}
                    </button>
                </form>
            </li>
        @endforeach
    </ul>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $links->links() }}
    </div>
</div>
