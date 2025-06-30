
  function habilitarCampo(id) {
    const campo = document.getElementById(id);
    if (campo) campo.disabled = false;
  }
  // Função para preencher os campos automaticamente
document.addEventListener("DOMContentLoaded", function () {
  fetch("../php/carregar_aluno.php")
    .then(res => res.json())
    .then(data => {
      if (data.erro) {
        alert(data.erro);
        return;
      }

      document.getElementById("input-nome").value = data.nome || '';
      document.getElementById("select-genero").value = data.genero || '';
      document.getElementById("input-email").value = data.email || '';
      document.getElementById("input-cpf").value = data.cpf || '';
      document.getElementById("input-telefone").value = data.telefone || '';
    })
    .catch(err => {
      console.error("Erro ao carregar dados:", err);
    });
});
// Função Ajax para salvar os dados do aluno sem recarregar a página
document.getElementById("form-cadastro").addEventListener("submit", function (e) {
  e.preventDefault(); // evita recarregar a página

  const form = this;
  const formData = new FormData(form);

  // Verifica se foi escolhida "outra instituição"
  const selectInstituicao = document.getElementById("select-instituicao");
  const inputOutraInstituicao = document.getElementById("input-outra-instituicao");

  if (selectInstituicao.value === "outra") {
    const novaInstituicao = inputOutraInstituicao.value.trim();

    if (!novaInstituicao) {
      alert("Você selecionou 'Outra instituição', mas não preencheu o nome.");
      return;
    }

    formData.set("outra_instituicao", novaInstituicao); // Garante que o campo exista
  }

  fetch("../php/salvar_aluno.php", {
    method: "POST",
    body: formData,
  })
    .then(res => res.json())
    .then(data => {
      if (data.sucesso) {
        alert("Dados salvos com sucesso!");
        // Bloqueia os campos novamente
        document.querySelectorAll("#form-cadastro input, #form-cadastro select").forEach(el => el.disabled = true);
      } else {
        alert("Erro ao salvar: " + (data.erro || "erro desconhecido."));
      }
    })
    .catch(err => {
      console.error("Erro:", err);
      alert("Erro na requisição.");
    });
});


// Função psra trocar os botões ao salvar
document.querySelectorAll('.toggle-edit').forEach(btn => {
  btn.addEventListener('click', function () {
    const inputId = this.dataset.target;
    const input = document.getElementById(inputId);
    const icon = this.querySelector('i');

    if (input.disabled) {
      input.disabled = false;
      input.focus();
      icon.classList.remove('bi-pencil-fill');
      icon.classList.add('bi-check2');
    } else {
      input.disabled = true;
      icon.classList.remove('bi-check2');
      icon.classList.add('bi-pencil-fill');
    }
  });
});

// Função para ahabilitar o campo outras da instituição
  function verificarOutraInstituicao() {
    const select = document.getElementById('select-instituicao');
    const campo = document.getElementById('campoOutraInstituicao');
    const input = document.getElementById('input-outra-instituicao');

    if (select.value === 'outra') {
      campo.style.display = 'block';
      input.disabled = false;
    } else {
      campo.style.display = 'none';
      input.disabled = true;
    }
  }

  // Executa na carga, se for edição com valor já selecionado
  document.addEventListener('DOMContentLoaded', verificarOutraInstituicao);







