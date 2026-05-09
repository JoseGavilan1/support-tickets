<?php

namespace App\Livewire\Tickets;

use Livewire\Component;
use App\Models\Ticket;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class Index extends Component
{
    // Variables vinculadas al formulario
    public $titulo = '';
    public $descripcion = '';
    public $prioridad = 'media';

    // Variable para controlar si mostramos el formulario o la tabla
    public $mostrandoFormulario = false;

    // Función para guardar el ticket
    public function guardarTicket()
    {
        // 1. Validamos los datos
        $this->validate([
            'titulo' => 'required|min:5|max:255',
            'descripcion' => 'required|min:10',
            'prioridad' => 'required|in:baja,media,alta',
        ]);

        // 2. Creamos el ticket en la BD
        Ticket::create([
            'user_id' => Auth::id(),
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'prioridad' => $this->prioridad,
            'estado' => 'abierto', // Por defecto arranca abierto
        ]);

        // 3. Limpiamos el formulario y volvemos a la tabla
        $this->reset(['titulo', 'descripcion', 'mostrandoFormulario']);
        $this->prioridad = 'media';
    }

    public function render()
    {
        // Traemos los tickets del usuario logueado
        $tickets = Ticket::where('user_id', Auth::id())->latest()->get();

        return view('livewire.tickets.index', [
            'tickets' => $tickets
        ]);
    }
}
