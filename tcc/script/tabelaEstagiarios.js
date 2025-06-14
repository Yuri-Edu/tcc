$(document).ready(function() {
    $('#tabelaEstagios').DataTable({
        "ajax": "php/listarEstagios.php",
        "columns": [
            { "data": "empresa" },
            { "data": "curso" },
            { "data": "duracao" },
            { "data": "periodo" },
            { 
                "data": "inicio",
                "render": function(data) {
                    return new Date(data).toLocaleDateString();
                }
            },
            { 
                "data": "termino",
                "render": function(data) {
                    return new Date(data).toLocaleDateString();
                }
            },
            { "data": "status" },
            { "data": "nome_estagiario" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return `
                        <button class="btn btn-outline-light btn-sm"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-light btn-sm"><i class="bi bi-trash"></i></button>
                        <button class="btn btn-outline-light btn-sm"><i class="bi bi-paperclip"></i></button>
                        <button class="btn btn-outline-light btn-sm"><i class="bi bi-check-circle"></i></button>
                    `;
                }
            }
        ],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "Nenhum registro encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(filtrado de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primeiro",
                "last": "Último",
                "next": "Próximo",
                "previous": "Anterior"
            }
        }
    });
});
