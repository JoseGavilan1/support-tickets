<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sistema de Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">{{ $mostrandoFormulario ? 'Crear Nuevo Ticket' : 'Mis Tickets Recientes' }}</h3>

                        <button
                            wire:click="$toggle('mostrandoFormulario')"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition-colors">
                            {{ $mostrandoFormulario ? 'Volver a la lista' : '+ Nuevo Ticket' }}
                        </button>
                    </div>

                    @if($mostrandoFormulario)
                        <form wire:submit="guardarTicket" class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Título del problema</label>
                                <input type="text" wire:model="titulo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @error('titulo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Descripción detallada</label>
                                <textarea wire:model="descripcion" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                                @error('descripcion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Prioridad</label>
                                <select wire:model="prioridad" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="baja">Baja</option>
                                    <option value="media">Media</option>
                                    <option value="alta">Alta</option>
                                </select>
                                @error('prioridad') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded transition-colors" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="guardarTicket">Enviar Ticket</span>
                                    <span wire:loading wire:target="guardarTicket">Guardando...</span>
                                </button>
                            </div>
                        </form>

                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 border">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prioridad</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($tickets as $ticket)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 font-bold">
    <a href="{{ route('tickets.show', $ticket->id) }}" class="text-indigo-600 hover:underline">
        #{{ $ticket->id }}
    </a>
</td>
                                            <td class="px-6 py-4 font-medium text-gray-900">{{ $ticket->titulo }}</td>
                                            <td class="px-6 py-4">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ strtoupper($ticket->estado) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-gray-500">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                    {{ $ticket->prioridad === 'alta' ? 'bg-red-100 text-red-800' : ($ticket->prioridad === 'media' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                    {{ ucfirst($ticket->prioridad) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                                No hay tickets registrados aún. ¡Eres libre de problemas!
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
