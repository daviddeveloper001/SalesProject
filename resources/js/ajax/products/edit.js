$('#update-product-form').on('submit', function(e) {
    e.preventDefault();
    const productId = $('#product-id').val();

    $.ajax({
        url: `/products/${productId}`,
        method: 'PUT',
        data: $(this).serialize(),
        success: function(data) {
            if (data.success) {
                $('#product-table').append(`<div>${data.product.name}</div>`);
                $('#update-product-form')[0].reset();
                alert("Producto actualizado exitosamente.");
                window.location.href = "/products";
            }
        },
        error: function(xhr) {
            console.log("Error:", xhr);
        }
    });
});