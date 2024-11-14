$('#create-product-form').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: `/products/store}`,
        method: 'POST',
        data: $(this).serialize(),
        success: function(data) {
            if (data.success) {
                $('#product-list').append(`<div>${data.product.name}</div>`);
                $('#create-product-form')[0].reset();
                alert("Producto creado exitosamente.");
            }
        },
        error: function(xhr) {
            console.log("Error:", xhr);
        }
    });
});