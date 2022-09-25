$(document).ready(function () {
    // Validar form login
    $('#form-login')
        .form({
            inline: true,
            fields: {
                usuario: {
                    identifier: 'usuario',
                    rules: [{
                        type: 'empty',
                        prompt: 'Por favor, informe o usuário'
                    }]
                },
                senha: {
                    identifier: 'senha',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Por favor, informe a senha'
                        }
                    ]
                }
            }
        });
});