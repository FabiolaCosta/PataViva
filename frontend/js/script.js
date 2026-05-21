document.addEventListener('DOMContentLoaded', () => {
    buscarAnimais();
});

function buscarAnimais() {
    const container = document.querySelector('.lista-animais');

    fetch('back_end_cli/buscar_animais.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro na requisição: ' + response.status);
            container.innerHTML = 'Não foi possível carregar os animais disponíveis para adoção. Por favor, tente novamente mais tarde.';
        }
        return response.json();
    })
    .then(data => {
        exibirAnimais(data);
    })
    .catch(error => {
        console.error('Falha ao buscar animais:', error);
        container.innerHTML = 'Não foi possível carregar os animais disponíveis para adoção. Por favor, tente novamente mais tarde.';
    });
}

function exibirAnimais(animais) {
    const container = document.querySelector('.lista-animais');
    container.innerHTML = '';

    if(animais.length === 0) {
        container.innerHTML = '<p>Nenhum animal disponível para adoção no momento.</p>';
        return;
    }

    animais.forEach(animal => {
        const card = document.createElement('div');
        card.className = 'animal-card';

        card.innerHTML = `
            <img src="${animal.foto}" alt="${animal.nome}" width="120">
            <h3>${animal.nome}</h3>
            <p><strong>Espécie:</strong> ${animal.especie}</p>
            <p><strong>Porte:</strong> ${animal.porte}</p>
            <p><strong>Idade:</strong> ${animal.idade} anos</p>
            <p><strong>Sexo:</strong> ${animal.sexo}</p>
            <p><strong>Descrição:</strong> ${animal.descricao}</p>
            <br>
            <a href="#" class="btn-adotar">Quero Adotar</a>
            <br>
        `;

        container.appendChild(card);
    });
}
