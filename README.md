🛠️ Sistema de Tickets de Soporte (TALL Stack)
Una aplicación web moderna y reactiva diseñada para la gestión de incidencias técnicas. Este proyecto demuestra el uso avanzado del TALL Stack, logrando interactividad en tiempo real tipo SPA (Single Page Application) manteniendo toda la lógica centralizada en el backend.

Se eliminó la necesidad de escribir controladores API tradicionales o manipular el DOM con JavaScript puro, delegando la reactividad directamente a los componentes de Livewire.

🚀 Tecnologías Utilizadas (TALL Stack)
Tailwind CSS: Diseño de interfaz moderno, responsivo y utilitario.

Alpine.js: Manejo de micro-interacciones en el frontend (menús, modales, transiciones).

Laravel (PHP 8): Framework robusto para el backend, enrutamiento, ORM y seguridad.

Livewire 3: Componentes dinámicos que sincronizan el estado entre el frontend y la base de datos en tiempo real.

✨ Características Principales
Dashboard Analítico: Panel de control con métricas en tiempo real que resume el estado global del sistema (Tickets Totales, Abiertos, En Progreso y Cerrados).

Gestión de Incidencias (CRUD): Creación de tickets de soporte con asignación de niveles de prioridad y control de estado.

Chat Interactivo: Hilo de conversación en tiempo real para cada ticket. Los mensajes se envían y renderizan sin recargar la página.

Gestión de Archivos Adjuntos: Soporte integrado para adjuntar imágenes (capturas de error) directamente en el chat utilizando el trait WithFileUploads de Livewire, con almacenamiento seguro.

Auditoría Automática de Estados: Botones de acción rápida para cambiar el estado del ticket (Reabrir, Marcar en Progreso, Cerrar) que generan automáticamente un registro de auditoría visual en el historial de la conversación.

⚙️ Despliegue Local
Si deseas clonar y probar este proyecto en tu entorno local, sigue estos pasos:

Clonar el repositorio:

git clone https://github.com/JoseGavilan1/support-tickets.git
cd support-tickets
Instalar dependencias de PHP y Node:

composer install
npm install
Configurar el entorno y la Base de Datos:
Copia el archivo de variables de entorno y genera la clave de la aplicación:

cp .env.example .env
php artisan key:generate

Ejecutar Migraciones y Enlazar el Storage:
Prepara la base de datos y crea el enlace simbólico para que las imágenes adjuntas sean visibles:

php artisan migrate
php artisan storage:link
Compilar assets y levantar el servidor:

npm run dev
php artisan serve

👨‍💻 Autor
José Gavilán Desarrollador Fullstack
