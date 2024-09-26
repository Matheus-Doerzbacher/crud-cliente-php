/* Funções Login */
function login() {
    if (!validarCamposLogin()) {
        return;
    }

    var formData = new FormData(document.getElementById('login-form'));

    $.ajax({
        url: 'login_usuario.php',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.includes('sucesso')) {
                window.location.href = '../home/search_usuario.php';
            } else {
                console.error(response);
            }
        },
        error: function (xhr, status, error) {
            alert('Erro ao fazer login');
            console.log('Erro ao fazer login: ' + error);
        }
    });
}

function validarCamposLogin() {
    var email = document.getElementById('email');
    var senha = document.getElementById('password');

    if (email.value == '') {
        email.focus();
        return false;
    }

    if (senha.value == '') {
        senha.focus();
        return false;
    }

    return true;
}
/* Funções Login */

/* Funções Cadastro */
function consultaCEP() {
    var cep = document.getElementById('cep');

    url = 'https://viacep.com.br/ws/' + cep.value + '/json/';
    fetch(url)
        .then(response => response.json())
        .then(result => {
            console.log(result);
            document.getElementById('cidade').value = result.localidade;
            document.getElementById('estado').value = result.estado;
        })
        .catch(error => {
            alert('CEP não encontrado');
        });
}

function cadastrar() {
    if (!validarCamposCadastro()) {
        return;
    }

    var formData = new FormData(document.getElementById('cadastro-form'));

    $.ajax({
        url: 'cadastro_usuario.php',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.includes('sucesso')) {
                window.location.href = '../login/index.html';
            } else {
                console.log(response);
            }
        },
        error: function (xhr, status, error) {
            console.log('Erro ao cadastrar: ' + error);
        }
    });
}

function validarCamposCadastro() {
    var nome = document.getElementById('nome');
    var sobrenome = document.getElementById('sobrenome');
    var cpf = document.getElementById('cpf');
    var rg = document.getElementById('rg');
    var email = document.getElementById('email');
    var telefone = document.getElementById('telefone');
    var senha = document.getElementById('senha');
    var confirSenha = document.getElementById('confir-senha');
    var cep = document.getElementById('cep');
    var endereco = document.getElementById('endereco');
    var numero = document.getElementById('numero');
    var bairro = document.getElementById('bairro');
    var cidade = document.getElementById('cidade');
    var estado = document.getElementById('estado');
    var imagem = document.getElementById('imagem');

    if (nome.value == '') {
        nome.focus();
        return false;
    }

    if (sobrenome.value == '') {
        sobrenome.focus();
        return false;
    }

    if (cpf.value == '') {
        cpf.focus();
        return false;
    }

    if (rg.value == '') {
        rg.focus();
        return false;
    }

    if (email.value == '') {
        email.focus();
        return false;
    }
    if (telefone.value == '') {
        telefone.focus();
        return false;
    }

    if (senha.value == '') {
        senha.focus();
        return false;
    }

    if (confirSenha.value == '') {
        confirSenha.focus();
        return false;
    }

    if (senha.value != confirSenha.value) {
        alert('Senhas não conferem');
        senha.focus();
        return false;
    }

    if (cep.value == '') {
        cep.focus();
        return false;
    }

    if (endereco.value == '') {
        endereco.focus();
        return false;
    }

    if (cidade.value == '') {
        cidade.focus();
        return false;
    }

    if (estado.value == '') {
        estado.focus();
        return false;
    }

    return true;
}

function mascaraCpf(i) {
    var v = i.value;

    if (isNaN(v[v.length - 1])) {
        // impede entrar outro caractere que não seja número
        i.value = v.substring(0, v.length - 1);
        return;
    }

    i.setAttribute('maxlength', '14');
    if (v.length == 3 || v.length == 7) i.value += '.';
    if (v.length == 11) i.value += '-';
}

function mascaraRg(i) {
    var v = i.value;

    if (isNaN(v[v.length - 1])) {
        // impede entrar outro caractere que não seja número
        i.value = v.substring(0, v.length - 1);
        return;
    }

    i.setAttribute('maxlength', '12');
    if (v.length == 2 || v.length == 6) i.value += '.';
    if (v.length == 10) i.value += '-';
}

function mascaraFone(i) {
    var v = i.value;

    // Remove todos os caracteres que não sejam números
    v = v.replace(/\D/g, "");

    // Limita o número de caracteres a 11 dígitos
    if (v.length > 11) {
        v = v.substring(0, 11);
    }

    // Aplica a formatação condicionalmente
    if (v.length > 0) {
        v = "(" + v;
    }
    if (v.length > 3) {
        v = v.substring(0, 3) + ") " + v.substring(3);
    }
    if (v.length > 9) {
        v = v.substring(0, 9) + "-" + v.substring(9);
    }

    // Atualiza o valor do input
    i.value = v;
}

function mascaraCep(i) {
    var v = i.value;

    // Impede a inserção de caracteres que não sejam números
    if (isNaN(v[v.length - 1])) {
        i.value = v.substring(0, v.length - 1);
        return;
    }

    i.setAttribute('maxlength', '9');
    if (v.length == 5) i.value += '-';
}
/* Funções Cadastro */

/* Funções Update */
$(document).ready(function () {
    $('#update-button').on('click', function () {
        var formData = new FormData($('#form_update_usuario')[0]);

        $.ajax({
            url: 'update_usuario_function.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                alert(response);
                if (response.toLowerCase().includes('sucesso')) {
                    window.location.href = '../home/search_usuario.php';
                }
            },
            error: function () {
                alert('Erro ao atualizar o usuário. Por favor, tente novamente.');
            }
        });
    });
});

$(document).ready(function () {
    $('#deleteButton').on('click', function () {
        var formData = new FormData($('#form_update_usuario')[0]);

        $.ajax({
            url: '../delete/delete_user.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.toLowerCase().includes('sucesso')) {
                    window.location.href = '../login';
                }
            },
            error: function () {
                alert('Erro ao atualizar o usuário. Por favor, tente novamente.');
            }
        });
    });
});
/* Funções Update */