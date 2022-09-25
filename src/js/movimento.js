$(document).ready(function () {
    // DataTable
    $('.ui.table').DataTable({
        processing: true,
        autoWidth: false,
        lengthChange: false,
        ordering: false,
        language: {
            url: '/js/DataTables/languages/Portuguese-Brasil.json'
        }
    });
});
// Função para abrir o modal de nova receita
function adicionarReceita() {
    $('.ui.modal-receita').modal({
        closable: false,
        observeChanges: true,
        onApprove: function () {
            const form = $('#form-receita').form({
                inline: true,
                fields: {
                    descricao: {
                        identifier: 'descricao',
                        rules: [{
                            type: 'empty',
                            prompt: 'Por favor, informe a descrição da receita'
                        }]
                    },
                    categoria: {
                        identifier: 'categoria',
                        rules: [{
                            type: 'empty',
                            prompt: 'Por favor, selecione a categoria'
                        }
                        ]
                    },
                    forma_pagamento: {
                        identifier: 'forma_pagamento',
                        rules: [{
                            type: 'empty',
                            prompt: 'Por favor, selecione a forma de pagamento'
                        }
                        ]
                    },
                    valor: {
                        identifier: 'valor',
                        rules: [{
                            type: 'empty',
                            prompt: 'Por favor, informe o valor da receita'
                        }]
                    },
                    data: {
                        identifier: 'data',
                        rules: [{
                            type: 'empty',
                            prompt: 'Por favor, informe a data da receita'
                        }]
                    }
                }
            });
            if ($(form).form('is valid')) {
                this.handleSave();
            } else {
                return false;
            }
        },
        onHide: function () {
            $('form').form('clear');
        }
    }).modal('show');
}

// Função para abrir o modal de nova despesa
function adicionarDespesa() {
    $('.ui.modal-despesa').modal({
        closable: false,
        observeChanges: true,
        onApprove: function () {
            const form = $('#form-despesa').form({
                inline: true,
                fields: {
                    descricao: {
                        identifier: 'descricao',
                        rules: [{
                            type: 'empty',
                            prompt: 'Por favor, informe a descrição da despesa'
                        }]
                    },
                    categoria: {
                        identifier: 'categoria',
                        rules: [{
                            type: 'empty',
                            prompt: 'Por favor, selecione a categoria'
                        }
                        ]
                    },
                    forma_pagamento: {
                        identifier: 'forma_pagamento',
                        rules: [{
                            type: 'empty',
                            prompt: 'Por favor, selecione a forma de pagamento'
                        }
                        ]
                    },
                    valor: {
                        identifier: 'valor',
                        rules: [{
                            type: 'empty',
                            prompt: 'Por favor, informe o valor da despesa'
                        }]
                    },
                    data: {
                        identifier: 'data',
                        rules: [{
                            type: 'empty',
                            prompt: 'Por favor, informe a data da despesa'
                        }]
                    }
                }
            });
            if ($(form).form('is valid')) {
                this.handleSave();
            } else {
                return false;
            }
        },
        onHide: function () {
            $('form').form('clear');
        }
    }).modal('show');
}