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
            <form method="POST" action="/votes/{{ $link->id }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 disabled:opacity-50
                        {{ !Auth::user()->isTrusted() ? 'disabled' : '' }}">
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