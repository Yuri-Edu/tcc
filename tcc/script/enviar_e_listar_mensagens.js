document.getElementById('formMensagem').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);

  fetch('enviar_mensagem.php', {
    method: 'POST',
    body: formData
  }).then(res => res.json())
    .then(data => {
      if (data.status === 'sucesso') {
        alert('Mensagem enviada com sucesso!');
        carregarMensagens();
      }
    });
});

function carregarMensagens() {
  fetch('listar_mensagens.php?usuario_id=2') // ID do usuário logado
    .then(res => res.json())
    .then(mensagens => {
      const container = document.getElementById('listaMensagens');
      container.innerHTML = '';
      mensagens.forEach(msg => {
        const item = document.createElement('button');
        item.className = 'list-group-item list-group-item-action bg-dark text-white border-bottom';
        item.innerHTML = `<strong>📧 ${msg.assunto}</strong><br>
                          <small>De: ${msg.nome_remetente} | ${msg.data_envio}</small>`;
        container.appendChild(item);
      });
    });
}

carregarMensagens();
