<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ticket #{{ $ticket->id }}: {{ $ticket->titulo }}
            </h2>
            <a href="{{ route('tickets.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-bold">
                &larr; Volver a la lista
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-6">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg border-l-4 border-indigo-500">
                <h3 class="font-bold text-lg text-gray-900 mb-2">Descripción del problema:</h3>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $ticket->descripcion }}</p>

                <div class="mt-4 pt-4 border-t border-indigo-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-bold text-gray-700">Estado actual:</span>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                            {{ $ticket->estado === 'cerrado' ? 'bg-green-100 text-green-800' : ($ticket->estado === 'en_progreso' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                            {{ strtoupper(str_replace('_', ' ', $ticket->estado)) }}
                        </span>
                    </div>

                    <div class="flex gap-2">
                        @if($ticket->estado !== 'abierto')
                            <button wire:click="cambiarEstado('abierto')" class="text-xs bg-white border border-blue-500 text-blue-600 hover:bg-blue-50 font-bold py-1 px-3 rounded transition-colors">
                                Reabrir
                            </button>
                        @endif

                        @if($ticket->estado !== 'en_progreso')
                            <button wire:click="cambiarEstado('en_progreso')" class="text-xs bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded transition-colors">
                                Marcar en Progreso
                            </button>
                        @endif

                        @if($ticket->estado !== 'cerrado')
                            <button wire:click="cambiarEstado('cerrado')" class="text-xs bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-3 rounded transition-colors">
                                Cerrar Ticket
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="font-bold text-lg text-gray-900 mb-4">Conversación</h3>

                <div class="space-y-4 mb-6">
                    @forelse ($mensajes as $mensaje)
                        <div class="p-4 rounded-lg {{ $mensaje->user_id === auth()->id() ? 'bg-indigo-50 ml-12' : 'bg-gray-50 mr-12' }}">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-bold text-sm text-gray-900">{{ $mensaje->user->name }}</span>
                                <span class="text-xs text-gray-500">{{ $mensaje->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-800">{{ $mensaje->contenido }}</p>
                            @if($mensaje->archivo_path)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $mensaje->archivo_path) }}" alt="Archivo adjunto" class="max-w-sm rounded-lg shadow-md border border-gray-200">
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500 italic text-center py-4">No hay mensajes aún. Escribe el primero.</p>
                    @endforelse
                </div>

                <form wire:submit="enviarMensaje" class="mt-4 border-t pt-4">
                    <textarea wire:model="nuevoMensaje" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Escribe tu respuesta aquí..."></textarea>
                    @error('nuevoMensaje') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror

                    <div class="flex justify-between items-center mt-2">
                        <div class="flex items-center">
                            <input type="file" wire:model="archivo" id="archivo_upload" class="hidden" accept="image/*">
                            <label for="archivo_upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold py-2 px-4 rounded border border-gray-300 transition-colors flex items-center gap-2">
                                📎 Adjuntar Imagen
                            </label>

                            <div wire:loading wire:target="archivo" class="ml-3 text-sm text-indigo-600 font-semibold">
                                Cargando archivo...
                            </div>

                            @if ($archivo)
                                <span class="ml-3 text-sm text-green-600 font-semibold">✓ Imagen lista</span>
                            @endif
                        </div>
                        @error('archivo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded transition-colors" wire:loading.attr="disabled">
                            Enviar
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
