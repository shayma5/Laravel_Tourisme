<table class="table" id="{{ $tableId }}">
    <thead>
        <tr>
            <th class="text-center">
                @if($tableId !== 'owned-souvenirs')
                    <input type="checkbox" id="select-all-available-souvenirs" onclick="toggleAllAvailableSouvenirs()">
                @endif
            </th>
            <th class="text-center">Nom</th>
            <th class="text-center">Prix</th>
            <th class="text-center">Stock</th>
            <th class="text-center">Appartenance</th>
        </tr>
    </thead>
    <tbody>
        @foreach($souvenirs as $souvenir)
        <tr>
            <td class="text-center">
                @if($magasin->souvenirs->contains($souvenir->id))
                    <input type="checkbox" name="souvenirs[]" value="{{ $souvenir->id }}" checked disabled>
                    <input type="hidden" name="souvenirs[]" value="{{ $souvenir->id }}">
                @else
                    <input type="checkbox" name="souvenirs[]" value="{{ $souvenir->id }}">
                @endif
            </td>
            <td class="text-center">{{ $souvenir->nom }}</td>
            <td class="text-center">{{ $souvenir->prix }}€</td>
            <td class="text-center">{{ $souvenir->nbr_restant }}</td>
            <td class="text-center">
                @if($magasin->souvenirs->contains($souvenir->id))
                    ✔️
                @else
                    ❌
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="card-body">
    <div class="demo">
        <ul class="pagination pg-primary" id="pagination-{{ $tableId }}">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<script>
function initPagination(tableId) {
    const itemsPerPage = 5;
    const tableRows = document.querySelectorAll(`#${tableId} tbody tr`);
    const pageCount = Math.ceil(tableRows.length / itemsPerPage);
    let currentPage = 1;

    function showPage(page) {
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        tableRows.forEach((row, index) => {
            row.style.display = (index >= start && index < end) ? '' : 'none';
        });

        document.querySelectorAll(`#pagination-${tableId} .page-item`).forEach(item => {
            item.classList.remove('active');
        });
        document.querySelector(`#pagination-${tableId} .page-item:nth-child(${page + 1})`).classList.add('active');
    }

    const paginationList = document.querySelector(`#pagination-${tableId}`);
    paginationList.innerHTML = `
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
    `;

    for (let i = 1; i <= pageCount; i++) {
        paginationList.innerHTML += `
            <li class="page-item ${i === 1 ? 'active' : ''}">
                <a class="page-link" href="#">${i}</a>
            </li>
        `;
    }

    paginationList.innerHTML += `
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    `;

    document.querySelectorAll(`#pagination-${tableId} .page-link`).forEach((button, index) => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            if (index === 0) {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                }
            } else if (index === pageCount + 1) {
                if (currentPage < pageCount) {
                    currentPage++;
                    showPage(currentPage);
                }
            } else {
                currentPage = index;
                showPage(currentPage);
            }
        });
    });

    showPage(1);
}

document.addEventListener('DOMContentLoaded', function() {
    initPagination('{{ $tableId }}');
});
</script>

<script>
function toggleAllAvailableSouvenirs() {
    const mainCheckbox = document.getElementById('select-all-available-souvenirs');
    const checkboxes = document.querySelectorAll('input[name="souvenirs[]"]:not([disabled])');
    
    for (let checkbox of checkboxes) {
        checkbox.checked = mainCheckbox.checked;
    }
}
</script>
