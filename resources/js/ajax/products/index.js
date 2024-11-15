// Configuración para incluir el token CSRF en todas las peticiones Ajax
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Función para obtener y mostrar productos con paginación
function fetchProducts(page = 1) {
    $.ajax({
        url: `/products?page=${page}`,  // URL con el número de página
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#product-table tbody').html('');  // Limpia el contenido de la tabla
            
            // Itera sobre los productos y los muestra en la tabla
            data.products.data.forEach(product => {
                $('#product-table tbody').append(`
                    <tr id="product-${product.id}">
                        <td>${product.id}</td>
                        <td>${product.format_name}</td>
                        <td>${product.format_price}</td>
                        <td>${product.format_description}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="/products/${product.id}/edit" class="btn btn-primary btn-sm mr-2 rounded" title="Editar"><i class="fas fa-edit"></i> Editar</a>
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="${product.id}" title="Eliminar">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>
                `);
            });

            // Actualiza la paginación
            updatePagination(data.products);
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            alert("Ocurrió un error al cargar los productos.");
        }
    });
}

// Función para actualizar los enlaces de paginación en el frontend con estilo Bootstrap 4
function updatePagination(products) {
    $('#pagination').html('');  // Limpia la paginación actual
    
    let paginationLinks = `<ul class="pagination">`;
    
    // Enlace a la página anterior
    if (products.prev_page_url) {
        paginationLinks += `<li class="page-item">
                                <a class="page-link" href="#" data-page="${products.current_page - 1}"><i class="fa fa-angle-left"></i>
                                <span class="sr-only">Previous</span></span></a>
                            </li>`;
    } else {
        paginationLinks += `<li class="page-item disabled">
                                <span class="page-link"><i class="fa fa-angle-left"></i>
                                <span class="sr-only">Previous</span></span>
                            </li>`;
    }
    
    // Enlaces de cada página
    for (let i = 1; i <= products.last_page; i++) {
        paginationLinks += `<li class="page-item ${i === products.current_page ? 'active' : ''}">
                                <a class="page-link" href="#" data-page="${i}">${i}</a>
                            </li>`;
    }

    // Enlace a la página siguiente
    if (products.next_page_url) {
        paginationLinks += `<li class="page-item">
                                <a class="page-link" href="#" data-page="${products.current_page + 1}"><i class="fa fa-angle-right"></i>
                                <span class="sr-only">Next</span></a>
                            </li>`;
    } else {
        paginationLinks += `<li class="page-item disabled">
                                <span class="page-link"><i class="fa fa-angle-right"></i>
                                <span class="sr-only">Next</span></span>
                            </li>`;
    }

    paginationLinks += `</ul>`;
    $('#pagination').html(paginationLinks);  // Inserta los enlaces en el div de paginación
}

$(document).ready(function() {
    // Carga inicial de productos en la primera página
    fetchProducts();

    // Evento para manejar el click en los enlaces de paginación sin recargar la página
    $(document).on('click', '.page-link', function(event) {
        event.preventDefault();
        const page = $(this).data('page');
        if (page) {
            fetchProducts(page);
        }
    });
    

    // Evento para eliminar un producto
    $(document).on('click', '.btn-delete', function() {
        const productId = $(this).data('id');

        if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
            $.ajax({
                url: `/products/${productId}`,
                method: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        $(`#product-${productId}`).remove();
                        alert("Producto eliminado exitosamente.");
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert("Ocurrió un error al eliminar el producto.");
                }
            });
        }
    });
});
