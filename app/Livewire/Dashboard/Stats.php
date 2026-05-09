<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class Stats extends Component
{
    public function render()
    {
        // Traemos todos los tickets del usuario actual
        $tickets = Ticket::where('user_id', Auth::id())->get();

        return view('livewire.dashboard.stats', [
            'total' => $tickets->count(),
            'abiertos' => $tickets->where('estado', 'abierto')->count(),
            'enProgreso' => $tickets->where('estado', 'en_progreso')->count(),
            'cerrados' => $tickets->where('estado', 'cerrado')->count(),
        ]);
    }
}
