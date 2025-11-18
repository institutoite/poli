<div>
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:ignore.self></div>
    <div class="fixed inset-0 z-10 overflow-y-auto" wire:ignore.self>
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Historial de Movimientos</h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Fecha</th>
                                <th class="px-4 py-2">Usuario</th>
                                <th class="px-4 py-2">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historial as $log)
                                <tr>
                                    <td class="border px-4 py-2">{{ $log['created_at'] }}</td>
                                    <td class="border px-4 py-2">{{ $log['user']['name'] ?? 'Desconocido' }}</td>
                                    <td class="border px-4 py-2">{{ ucfirst($log['action']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="$emit('cerrarModal')" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('mostrarModal', () => {
        // Mostrar el modal
        document.querySelector('[wire\\:ignore.self]').classList.remove('hidden');
    });

    window.addEventListener('cerrarModal', () => {
        // Ocultar el modal
        document.querySelector('[wire\\:ignore.self]').classList.add('hidden');
    });
</script>