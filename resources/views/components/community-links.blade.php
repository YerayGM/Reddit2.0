@props(['links'])
<div>
    <h1 class="text-lg font-bold">Community Contributions</h1>
    <ul class="mt-4">
        @foreach ($links as $link)
            <li class="mb-4 border-b border-gray-700 pb-2">
                <a href="/dashboard/{{ $link->channel->slug }}" class="text-blue-400 hover:underline">{{ $link->title }}</a>
                <br>
                <small class="text-gray-400">
                    Contributed by: {{ $link->creator->name }} - {{ $link->updated_at->diffForHumans() }}
                </small>
            </li>
        @endforeach
    </ul>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $links->links() }}
    </div>
</div>
