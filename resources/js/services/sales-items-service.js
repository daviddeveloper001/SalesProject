export class SalesItemsService {
    static async fetchItems(page = 1) {
        try {
            const response = await $.ajax({
                url: `/sales-items?page=${page}`,
                method: 'GET',
                dataType: 'json'
            });
            return response;
        } catch (error) {
            console.error('Error al cargar los elementos de venta:', error);
            throw error;
        }
    }

    static async deleteItem(saleItemId) {
        try {
            const response = await $.ajax({
                url: `/sales-items/${saleItemId}`,
                method: 'DELETE'
            });
            return response;
        } catch (error) {
            console.error('Error al eliminar el elemento:', error);
            throw error;
        }
    }
}