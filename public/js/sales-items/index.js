$(document).ready(function() {
    function fetchSaleItems() {
        $.ajax({
            url: `/sales-items}`,
            method: 'GET',
            success: function(data) {
                $('#sale-items-list tbody').html('');

                if (data.saleItems.length > 0) {
                    data.saleItems.forEach(item => {
                        $('#sale-items-list tbody').append(`
                        <tr id="sale-item-${item.id}">
                            <td>${item.id}</td>
                            <td>${item.product ? item.product.name : 'Nombre no disponible'}</td>
                            <td>${item.product ? item.product.format_price : 'Precio no disponible'}</td>
                            <td>${item.product ? item.product.format_description : 'Descripción no disponible'}</td>
                            <td>${item.quantity}</td>
                            <td>${item.created_at}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-danger btn-sm btn-delete" 
                                            data-id="${item.id}" 
                                            title="Eliminar">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `);
                    });
                } else {
                    $('#sale-items-list tbody').html(`
                    <tr>
                        <td colspan="7" style="text-align: center;">No se encontraron registros</td>
                    </tr>
                `);
                }
            },
            error: function(xhr) {
                console.error('Error al cargar los elementos de venta:', xhr);
            }
        });
    }


    $(document).on('click', '.btn-delete', function() {
        const saleItemId = $(this).data('id');

        if (confirm('¿Está seguro de que desea eliminar este elemento?')) {
            $.ajax({
                url: `/sales-items/${saleItemId}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {

                        $(`#sale-item-${saleItemId}`).remove();

                        alert('Elemento eliminado exitosamente');

                        if ($('#sale-items-list tbody tr').length === 0) {
                            $('#sale-items-list tbody').html(`
                            <tr>
                                <td colspan="7" style="text-align: center;">No se encontraron registros</td>
                            </tr>
                        `);
                        }
                    }
                },
                error: function(xhr) {
                    console.error('Error al eliminar el elemento:', xhr);
                    alert('Ocurrió un error al eliminar el elemento');
                }
            });
        }
    });

    fetchSaleItems();
});