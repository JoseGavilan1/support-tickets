<?php

namespace App\Livewire\Tickets;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\Mensaje;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads; // <- Importamos la magia de subida

#[Layout('layouts.app')]
class Show extends Component
{
    use WithFileUploads; // <- Activamos la subida de archivos

    public Ticket $ticket;
    public $nuevoMensaje = '';
    public $archivo; // <- Variable para guardar la imagen temporal

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function enviarMensaje()
    {
        $this->validate([
            'nuevoMensaje' => 'required|min:2',
            'archivo' => 'nullable|image|max:2048', // Opcional, solo imágenes, máximo 2MB
        ]);

        $rutaArchivo = null;

        // Si el usuario subió un archivo, lo guardamos en la carpeta public/adjuntos
        if ($this->archivo) {
            $rutaArchivo = $this->archivo->store('adjuntos', 'public');
        }

        Mensaje::create([
            'ticket_id' => $this->ticket->id,
            'user_id' => Auth::id(),
            'contenido' => $this->nuevoMensaje,
            'archivo_path' => $rutaArchivo // Guardamos la ruta en la base de datos
        ]);

        // Limpiamos el formulario
        $this->reset(['nuevoMensaje', 'archivo']);
    }

    public function cambiarEstado($nuevoEstado)
    {
        if (in_array($nuevoEstado, ['abierto', 'en_progreso', 'cerrado'])) {
            $this->ticket->update(['estado' => $nuevoEstado]);

            $nombreEstado = strtoupper(str_replace('_', ' ', $nuevoEstado));
            Mensaje::create([
                'ticket_id' => $this->ticket->id,
                'user_id' => Auth::id(),
                'contenido' => '🔄 El estado del ticket ha cambiado a: ' . $nombreEstado
            ]);
        }
    }

    public function render()
    {
        $mensajes = $this->ticket->mensajes()->with('user')->get();

        return view('livewire.tickets.show', [
            'mensajes' => $mensajes
        ]);
    }
}
