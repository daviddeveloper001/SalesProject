$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function fetchSaleItems(page = 1) {
    $.ajax({
        url: `/sales-items?page=${page}`,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#saleItems-table tbody').html('');

            if (data.saleItems.data.length > 0) {
                data.saleItems.data.forEach(item => {
                    $('#saleItems-table tbody').append(`
                    <tr id="sale-item-${item.id}">
                        <td>${item.id}</td>
                        <td>${item.product ? item.product.name : 'Nombre no disponible'}</td>
                        <td>${item.product ? item.product.format_price : 'Precio no disponible'}</td>
                        <td>${item.product ? item.product.format_description : 'Descripción no disponible'}</td>
                        <td>${item.quantity}</td>
                        <td>${item.formatted_created}</td>
                        <td>
                            <div class="btn-group" role="group">
                            
                                <button type="button" class="btn btn-danger btn-sm btn-delete sale-item-delete" 
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
                $('#saleItems-table tbody').html(`
                <tr>
                    <td colspan="7" style="text-align: center;">No se encontraron registros</td>
                </tr>
            `);
            }

            // Actualiza la paginación
            updatePagination(data.saleItems);
        },
        error: function(xhr) {
            console.error('Error al cargar los elementos de venta:', xhr);
        }
    });
}

function updatePagination(saleItems) {
    $('#pagination-sales-items').html('');  // Limpia la paginación actual
    
    let paginationLinks = `<ul class="pagination">`;
    
    // Enlace a la página anterior
    if (saleItems.prev_page_url) {
        paginationLinks += `<li class="page-item">
                                <a class="page-link" href="#" data-page="${saleItems.current_page - 1}"><i class="fa fa-angle-left"></i>
                                <span class="sr-only">Previous</span></span></a>
                            </li>`;
    } else {
        paginationLinks += `<li class="page-item disabled">
                                <span class="page-link"><i class="fa fa-angle-left"></i>
                                <span class="sr-only">Previous</span></span>
                            </li>`;
    }
    
    // Enlaces de cada página
    for (let i = 1; i <= saleItems.last_page; i++) {
        paginationLinks += `<li class="page-item ${i === saleItems.current_page ? 'active' : ''}">
                                <a class="page-link" href="#" data-page="${i}">${i}</a>
                            </li>`;
    }

    // Enlace a la página siguiente
    if (saleItems.next_page_url) {
        paginationLinks += `<li class="page-item">
                                <a class="page-link" href="#" data-page="${saleItems.current_page + 1}"><i class="fa fa-angle-right"></i>
                                <span class="sr-only">Next</span></a>
                            </li>`;
    } else {
        paginationLinks += `<li class="page-item disabled">
                                <span class="page-link"><i class="fa fa-angle-right"></i>
                                <span class="sr-only">Next</span></span>
                            </li>`;
    }

    paginationLinks += `</ul>`;
    $('#pagination-sales-items').html(paginationLinks);  // Inserta los enlaces en el div de paginación
}
$(document).ready(function() {
    if (window.location.pathname === '/sales-items') {
        fetchSaleItems();
    }

// Evento para manejar clics en los enlaces de paginación de saleItems
$(document).on('click', '#pagination-sales-items .page-link', function(e) {
    e.preventDefault(); // Evita el comportamiento predeterminado del enlace
    
    // Obtén el número de página del atributo data-page
    const page = $(this).data('page');
    
    // Llama a fetchSaleItems con la página seleccionada
    if (page) {
        fetchSaleItems(page);
    }
});


    $(document).on('click', '.sale-item-delete', function() {
        const saleItemId = $(this).data('id');

        if (confirm('¿Está seguro de que desea eliminar este elemento?')) {
            $.ajax({
                url: `/sales-items/${saleItemId}`,
                method: 'DELETE',
                success: function(response) {
                    if (response.success) {

                        $(`#sale-item-${saleItemId}`).remove();

                        alert('Elemento eliminado exitosamente');

                        if ($('#saleItems-table tbody tr').length === 0) {
                            $('#saleItems-table tbody').html(`
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


});