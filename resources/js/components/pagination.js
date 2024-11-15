export class Pagination {
    constructor(containerId) {
        this.container = $(containerId);
    }

    render(paginationData) {
        this.container.html('');
        
        let paginationLinks = `<ul class="pagination">`;
        paginationLinks += this.createPrevButton(paginationData);
        paginationLinks += this.createPageNumbers(paginationData);
        paginationLinks += this.createNextButton(paginationData);
        paginationLinks += `</ul>`;
        
        this.container.html(paginationLinks);
    }

    createPrevButton(data) {
        if (data.prev_page_url) {
            return `<li class="page-item">
                        <a class="page-link" href="#" data-page="${data.current_page - 1}">
                            <i class="fa fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>`;
        }
        return `<li class="page-item disabled">
                    <span class="page-link">
                        <i class="fa fa-angle-left"></i>
                        <span class="sr-only">Previous</span>
                    </span>
                </li>`;
    }

    createPageNumbers(data) {
        let links = '';
        for (let i = 1; i <= data.last_page; i++) {
            links += `<li class="page-item ${i === data.current_page ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>`;
        }
        return links;
    }

    createNextButton(data) {
        if (data.next_page_url) {
            return `<li class="page-item">
                        <a class="page-link" href="#" data-page="${data.current_page + 1}">
                            <i class="fa fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>`;
        }
        return `<li class="page-item disabled">
                    <span class="page-link">
                        <i class="fa fa-angle-right"></i>
                        <span class="sr-only">Next</span>
                    </span>
                </li>`;
    }
}