$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function fetchProducts() {
    $.ajax({
        url: `/products`,
        method: 'GET',
        success: function(data) {
            $('#product-list tbody').html('');  
            
            data.products.forEach(product => {
                $('#product-list tbody').append(`
                    <tr id="product-${product.id}">
                        <td>${product.id}</td>
                        <td>${product.name}</td>
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
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            alert("Ocurrió un error al cargar los productos.");
        }
    });
}


$(document).ready(function() {
    fetchProducts();

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
