// Função para abrir o modal de novo pagamento
function adicionarPagamento() {
    $('.ui.modal-pagamento').modal({
        closable: false,
        observeChanges: true,
        onApprove: function () {
            const form = $('#form-pagamento').form({
                inline: true,
                fields: {
                    forma_pagamento: {
                        identifier: 'forma_pagamento',
                        rules: [{
                            type: 'empty',
                            prompt: 'Por favor, informe a forma de pagamento'
                        }, {
                            type: 'regExp[/^[a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9 _-]*$/]',
                            prompt: 'Por favor, informe apenas letras e números'
                        }, {
                            type: 'maxLength[30]',
                            prompt: 'O pagamento deve ter no máximo {ruleValue} caracteres',
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
// Função para abrir o modal de nova categoria de receita
function adicionarCategoriaReceita() {
    $('.ui.modal-categoria-receita').modal({
        closable: false,
        observeChanges: true,
        onApprove: function () {
            const form = $('#form-categoria-receita').form({
                inline: true,
                fields: {
                    categoria: {
                        identifier: 'categoria',
                        rules: [{
                            type: 'empty',
                            prompt: 'Por favor, informe a categoria'
                        }, {
                            type: 'regExp[/^[a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9 _-]*$/]',
                            prompt: 'Por favor, informe apenas letras e números'
                        }, {
                            type: 'maxLength[30]',
                            prompt: 'A categoria deve ter no máximo {ruleValue} caracteres',
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
// Função para abrir o modal de nova categoria de despesa
function adicionarCategoriaDespesa() {
    $('.ui.modal-categoria-despesa').modal({
        closable: false,
        observeChanges: true,
        onApprove: function () {
            const form = $('#form-categoria-despesa').form({
                inline: true,
                fields: {
                    categoria: {
                        identifier: 'categoria',
                        rules: [{
                            type: 'empty',
                            prompt: 'Por favor, informe a categoria'
                        }, {
                            type: 'regExp[/^[a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9 _-]*$/]',
                            prompt: 'Por favor, informe apenas letras e números'
                        }, {
                            type: 'maxLength[30]',
                            prompt: 'A categoria deve ter no máximo {ruleValue} caracteres',
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