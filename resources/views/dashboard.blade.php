<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __@foreach ($links as $link)
                        <li>{{$link->title}}</li>
                    @endforeach
                    {{$links->links() }}}}
                    <!--Lo que hace este código es recorrer una colección de enlaces ($links) y generar una lista de elementos HTML (<li>) para cada uno 
                    de ellos, mostrando el título de cada enlace. Al final, utiliza el método links() para generar los enlaces de paginación si la colección 
                    está paginada.-->
                    
                    <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>
                    <!--Este código en Blade (Laravel) muestra información adicional sobre un enlace, específicamente quién lo contribuyó y cuándo fue actualizado, en un formato amigable para el usuario.-->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
