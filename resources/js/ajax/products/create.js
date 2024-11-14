$('#create-product-form').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: `/products`,
        method: 'POST',
        data: $(this).serialize(),
        success: function(data) {
            if (data.success) {
                $('#product-table').append(`<div>${data.product.name}</div>`);
                $('#create-product-form')[0].reset();
                alert("Producto creado exitosamente.");
            }
        },
        error: function(xhr) {
            console.log("Error:", xhr);
        }
    });
});