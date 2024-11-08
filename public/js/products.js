
$(document).ready(function() {
    $('.btn-delete').on('click', function() {
        const productId = $(this).data('id');

        if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
            $.ajax({
                url: `/products/${productId}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Elimina la fila del producto del DOM
                        $(`#product-${productId}`).remove();
                        alert("Producto eliminado exitosamente.");
                    }
                },
                error: function(xhr) {
                    alert("Ocurrió un error al eliminar el producto.");
                }
            });
        }
    });
});
