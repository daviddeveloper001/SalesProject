export class SalesItemsTable {
    constructor(tableId) {
        this.tableBody = $(`${tableId} tbody`);
    }

    renderItems(items) {
        this.tableBody.html('');

        if (items.length > 0) {
            items.forEach(item => {
                this.tableBody.append(this.createItemRow(item));
            });
        } else {
            this.renderEmptyMessage();
        }
    }

    createItemRow(item) {
        return `
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
        `;
    }

    renderEmptyMessage() {
        this.tableBody.html(`
            <tr>
                <td colspan="7" style="text-align: center;">No se encontraron registros</td>
            </tr>
        `);
    }

    removeItem(itemId) {
        $(`#sale-item-${itemId}`).remove();
        
        if (this.tableBody.find('tr').length === 0) {
            this.renderEmptyMessage();
        }
    }
}