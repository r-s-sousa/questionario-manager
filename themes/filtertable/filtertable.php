<!-- INCLUI DATATABLE -->
<script src="<?= asset('js/jquery.dataTables.min.js') ?>"></script>

<script>
    $(document).ready(function() {
        $('#tabela').DataTable({
            scrollY: 500,
            paging: true,
            scrollCollapse: false,
            ordering: true,
            columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
            "language": {
                "lengthMenu": "Mostrando _MENU_ itens por página",
                "zeroRecords": "Nada encontrado, desculpe",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum item cadastrado",
                "infoFiltered": "(Filtrado a partir de _MAX_ itens)"
            }
        });
    });
</script>
