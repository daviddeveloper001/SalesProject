import { setupAjax } from '../config.js';
import { SalesItemsService } from '../services/sales-items-service';
import { SalesItemsTable } from '../components/sales-items-table';
import { Pagination } from '../components/pagination';

export class SalesItemsPage {
    constructor() {
        this.table = new SalesItemsTable('#saleItems-table');
        this.pagination = new Pagination('#pagination-sales-items');
        this.initializeEvents();
    }

    async initialize() {
        setupAjax();
        if (window.location.pathname === '/sales-items') {
            await this.fetchSaleItems();
        }
    }

    initializeEvents() {
        $(document).on('click', '#pagination-sales-items .page-link', this.handlePaginationClick.bind(this));
        $(document).on('click', '.sale-item-delete', this.handleDeleteClick.bind(this));
    }

    async handlePaginationClick(e) {
        e.preventDefault();
        const page = $(e.currentTarget).data('page');
        if (page) {
            await this.fetchSaleItems(page);
        }
    }

    async handleDeleteClick(e) {
        const saleItemId = $(e.currentTarget).data('id');
        
        if (confirm('¿Está seguro de que desea eliminar este elemento?')) {
            try {
                const response = await SalesItemsService.deleteItem(saleItemId);
                if (response.success) {
                    this.table.removeItem(saleItemId);
                    alert('Elemento eliminado exitosamente');
                }
            } catch (error) {
                alert('Ocurrió un error al eliminar el elemento');
            }
        }
    }

    async fetchSaleItems(page = 1) {
        try {
            const data = await SalesItemsService.fetchItems(page);
            this.table.renderItems(data.saleItems.data);
            this.pagination.render(data.saleItems);
        } catch (error) {
            console.error('Error fetching sale items:', error);
        }
    }
}