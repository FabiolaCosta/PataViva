// Função para abrir o modal com as informações do usuário
async function abrirModalUsuario(idUsuario) {
    const usuario = await buscaInfoUsuario(idUsuario);

    if (!usuario) {
        mostrarErroUsuario();
        return;
    }

    $.confirm({
        title: `Informações de ${usuario.nome}`,
        content: montarHtmlUsuario(usuario),
        type: 'blue',
        boxWidth: '40%',
        useBootstrap: false,
        buttons: {
            fechar: {
                text: 'Fechar',
                btnClass: 'btn-blue'
            }
        }
    });
}

// Função para montar o HTML do modal com as informações do usuário
function montarHtmlUsuario(usuario) {

    return `
        <div class="modal-usuario">

            <div class="secao">
                <h4>👤 Dados pessoais</h4>

                <p><strong>Nome:</strong> ${usuario.nome}</p>
                <p><strong>Email:</strong> ${usuario.email}</p>
                <p><strong>Telefone:</strong> ${formatarTelefone(usuario.telefone)}</p>
                <p><strong>Data de nascimento:</strong> ${formatarData(usuario.data_nascimento)}</p>
            </div>

            <div class="secao">
                <h4>📍 Endereço</h4>

                <p>
                    ${usuario.rua}, ${usuario.numero}
                    <br>
                    ${usuario.bairro}
                    <br>
                    ${usuario.cidade} - ${usuario.estado}
                    <br>
                    CEP: ${formatarCEP(usuario.cep)}
                </p>
            </div>

            <div class="secao">
                <h4>🏠 Moradia</h4>

                <p><strong>Tipo:</strong> ${usuario.tipo_moradia}</p>
                <p><strong>Situação:</strong> ${usuario.situacao_imovel}</p>
                <p><strong>Possui quintal:</strong> ${booleanTexto(usuario.possui_quintal)}</p>
                <p><strong>Possui telas:</strong> ${booleanTexto(usuario.possui_telas)}</p>
                <p><strong>Possui outros animais:</strong> ${booleanTexto(usuario.possui_outros_animais)}</p>
            </div>

            <div class="secao">
                <h4>🐶 Experiência com animais</h4>

                <p>${usuario.experiencia_animais}</p>
            </div>

        </div>
    `;
}

function mostrarErroUsuario() {

    $.alert({
        title: 'Atenção!',
        content: 'Não foi possível carregar as informações do usuário. Por favor, tente novamente mais tarde.',
        type: 'orange',
        boxWidth: '30%',
        useBootstrap: false,
        buttons: {
            fechar: {
                text: 'Fechar',
                btnClass: 'btn-orange'
            }
        }
    });

}

// Função para buscar as informações do usuário no backend
async function buscaInfoUsuario(idUsuario) {
    try {
        const response = await fetch(
            '../backend/buscar_usuario.php?usuario_id=' + idUsuario
        );

        if (!response.ok) {
            throw new Error('Erro na requisição: ' + response.status);
        }

        const data = await response.json();

        return data;

    } catch (error) {
        console.error('Falha ao buscar usuário:', error);
        return null;
    }
}

function aprovarAdocao(idSolicitacao) {
    $.confirm({
        title: 'Aprovar adoção',
        content: 'Tem certeza que deseja aprovar esta solicitação de adoção?',
        type: 'green',
        boxWidth: '40%',
        useBootstrap: false,
        buttons: {
            sim: {
                text: 'Sim',
                btnClass: 'btn-green',
                action: function() {
                    window.location.href = `../backend/aprovar_adocao.php?sol_id=${idSolicitacao}`;        
                }
            },
            nao: {
                text: 'Não',
                btnClass: 'btn-default'
            }
        }
    });
}

function negarAdocao(idSolicitacao) {
    $.confirm({
        title: 'Negar adoção',
        content: 'Tem certeza que deseja negar esta solicitação de adoção?',
        type: 'red',
        boxWidth: '40%',
        useBootstrap: false,
        buttons: {
            sim: {
                text: 'Sim',
                btnClass: 'btn-red',
                action: function() {
                    window.location.href = `../backend/negar_adocao.php?sol_id=${idSolicitacao}`;        
                }
            },
            nao: {
                text: 'Não',
                btnClass: 'btn-default'
            }
        }
    });
}

// Funções auxiliares para formatação de dados
function booleanTexto(valor) {
    return valor == 1 ? 'Sim' : 'Não';
}

function formatarTelefone(telefone) {
    return telefone.replace(
        /(\d{2})(\d{5})(\d{4})/,
        '($1) $2-$3'
    );
}

function formatarCEP(cep) {
    return cep.replace(
        /(\d{5})(\d{3})/,
        '$1-$2'
    );
}

function formatarData(data) {
    return new Date(data).toLocaleDateString('pt-BR');
}