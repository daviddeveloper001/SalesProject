$(document).ready(function() {
    // Manejador para eliminar ventas
    $('.btn-delete').on('click', function() {
        const saleId = $(this).data('id');

        if (confirm('¿Está seguro de que desea eliminar esta venta?')) {
            $.ajax({
                url: `/sales/${saleId}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Eliminar la fila de la tabla
                        $(`#sale-item-${saleId}`).remove();

                        // Mostrar mensaje de éxito
                        alert('Venta eliminada exitosamente');

                        // Si no hay más ventas, mostrar mensaje de "no hay registros"
                        if ($('#sale-list tbody tr').length === 0) {
                            $('#sale-list tbody').html(`
                            <tr>
                                <td colspan="8" style="text-align: center;">No se encontraron registros</td>
                            </tr>
                        `);
                        }
                    }
                },
                error: function(xhr) {
                    console.error('Error al eliminar la venta:', xhr);
                    alert('Ocurrió un error al eliminar la venta');
                }
            });
        }
    });
});