(() => {
  const listaMensagens = document.getElementById('listaMensagens');
  const buscaInput = document.getElementById('buscaMensagem');
  const filtroSelect = document.getElementById('filtroRemetente');

  // Função para escapar texto evitando XSS
  function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  // Remove modais antigos para evitar acumulo no DOM
  function limparModaisAntigos() {
    document.querySelectorAll('[id^="modalMensagem"]').forEach(modal => modal.remove());
  }

  // Cria e insere modal para mensagem
  function criarModalMensagem(msg) {
    if (document.getElementById(`modalMensagem${msg.id}`)) return;

    const dataEnvio = new Date(msg.data_envio);
    const dataFormatada = isNaN(dataEnvio) ? 'Data inválida' : dataEnvio.toLocaleString();

    const modalHtml = `
    <div class="modal fade" id="modalMensagem${msg.id}" tabindex="-1" aria-labelledby="modalMensagem${msg.id}Label" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header">
            <h5 class="modal-title" id="modalMensagem${msg.id}Label">Assunto: ${escapeHtml(msg.assunto)}</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
          </div>
          <div class="modal-body">
            <p><strong>Remetente:</strong> ${escapeHtml(msg.remetente)}</p>
            <p><strong>Data:</strong> ${dataFormatada}</p>
            <hr>
            <p>${escapeHtml(msg.mensagem).replace(/\n/g, '<br>')}</p>
          </div>
          <div class="modal-footer flex-column align-items-start">
            <button
              class="btn btn-outline-success mb-2"
              data-bs-toggle="collapse"
              data-bs-target="#resposta${msg.id}"
              aria-expanded="false"
              aria-controls="resposta${msg.id}"
            >
              Responder
            </button>
            <div class="collapse w-100" id="resposta${msg.id}">
              <form action="../php/responder_mensagem_chat.php" method="POST" novalidate>
                <input type="hidden" name="mensagem_id" value="${msg.id}">
                <input type="hidden" name="remetente" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>">
                <textarea
                  name="resposta"
                  class="form-control bg-light text-dark mb-2"
                  rows="4"
                  placeholder="Digite sua resposta..."
                  required
                ></textarea>
                <button type="submit" class="btn btn-success">Enviar Resposta</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>`;

    document.body.insertAdjacentHTML('beforeend', modalHtml);
  }

  // Função para carregar e mostrar mensagens
  async function carregarMensagens() {
    limparModaisAntigos();

    const busca = encodeURIComponent(buscaInput.value.trim());
    const filtro = encodeURIComponent(filtroSelect.value);

    try {
      const response = await fetch(`../php/listar_mensagens_chat.php?busca=${busca}&filtro=${filtro}`);
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

      const data = await response.json();

      listaMensagens.innerHTML = '';

      if (!Array.isArray(data) || data.length === 0) {
        listaMensagens.innerHTML = '<p class="text-white">Nenhuma mensagem encontrada.</p>';
        return;
      }

      data.forEach(msg => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'list-group-item list-group-item-action bg-dark text-white border-bottom';
        btn.dataset.bsToggle = 'modal';
        btn.dataset.bsTarget = `#modalMensagem${msg.id}`;
        btn.setAttribute('role', 'listitem');
        btn.innerHTML = `
          <strong>📧 ${escapeHtml(msg.assunto)}</strong><br>
          <small>De: ${escapeHtml(msg.remetente)} | ${new Date(msg.data_envio).toLocaleString()}</small>
        `;
        listaMensagens.appendChild(btn);

        criarModalMensagem(msg);
      });
    } catch (err) {
      console.error('Erro ao carregar mensagens:', err);
      listaMensagens.innerHTML = '<p class="text-danger">Erro ao carregar mensagens.</p>';
    }
  }

  buscaInput.addEventListener('input', carregarMensagens);
  filtroSelect.addEventListener('change', carregarMensagens);

  // Carrega as mensagens ao abrir a página
  carregarMensagens();
})();
