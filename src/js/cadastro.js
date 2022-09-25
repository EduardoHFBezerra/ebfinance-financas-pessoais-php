$(document).ready(function () {
    // Validar form cadastro
    $('#form-cadastro')
        .form({
            inline: true,
            fields: {
                nome: {
                    identifier: 'nome',
                    rules: [{
                        type: 'empty',
                        prompt: 'Por favor, informe o nome completo'
                    }, {
                        type: 'regExp[/^[a-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑA-Z _]*$/]',
                        prompt: 'Por favor, informe apenas letras'
                    }, {
                        type: 'maxLength[100]',
                        prompt: 'O nome deve ter no máximo {ruleValue} caracteres',
                    }]
                },
                usuario: {
                    identifier: 'usuario',
                    rules: [{
                        type: 'empty',
                        prompt: 'Por favor, informe o usuário'
                    }, {
                        type: 'regExp[/^[a-zA-Z0-9]*$/]',
                        prompt: 'O usuário deve conter apenas letras e números, sem espaços',
                    }]
                },
                senha: {
                    identifier: 'senha',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Por favor, informe a senha'
                        }, {
                            type: 'maxLength[12]',
                            prompt: 'A senha deve ter no máximo {ruleValue} caracteres',
                        }
                    ]
                },
                confirma_senha: {
                    identifier: 'confirma_senha',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Por favor, informe a senha'
                        }, {
                            type: 'match[senha]',
                            prompt: 'As senhas devem ser iguais',
                        }
                    ]
                }
            }
        });
});