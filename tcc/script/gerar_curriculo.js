document.getElementById("salvarCurriculo").addEventListener("click", function () {
    const calcularIdade = (dataNascimento) => {
        if (!dataNascimento) return '';
        const nascimento = new Date(dataNascimento);
        const hoje = new Date();
        let idade = hoje.getFullYear() - nascimento.getFullYear();
        const m = hoje.getMonth() - nascimento.getMonth();
        if (m < 0 || (m === 0 && hoje.getDate() < nascimento.getDate())) {
            idade--;
        }
        return idade;
    };

    const nome = document.getElementById("nome").value || '';
    const dataNascimento = document.getElementById("dataNascimento").value || '';

    const dadosCurriculo = {
        nome,
        dataNascimento,
        idade: calcularIdade(dataNascimento),
        email: document.getElementById("email").value || '',
        telefone: document.getElementById("telefone").value || '',
        cidade: document.getElementById("cidade").value || '',
        estado: document.getElementById("estado").value || '',
        linkedin: document.getElementById("linkedin").value || '',
        portfolio: document.getElementById("portfolio").value || '',
        sobreMim: document.getElementById("sobreMim").value || '',
        objetivoProfissional: document.getElementById("objetivoProfissional").value || '',

        experiencias: Array.from(document.querySelectorAll("#experiencias .experiencia-item")).map(item => ({
            empresa: item.querySelector("input[placeholder='Nome da empresa']")?.value || '',
            cargo: item.querySelector("input[placeholder='Seu cargo']")?.value || '',
            inicio: item.querySelectorAll("input[type='month']")[0]?.value || '',
            fim: item.querySelectorAll("input[type='month']")[1]?.value || '',
            atualmente: item.querySelector("input[type='checkbox']")?.checked || false,
            atividades: item.querySelector("textarea")?.value || ''
        })),

        formacoes: Array.from(document.querySelectorAll("#formacoes .formacao-item")).map(item => ({
            instituicao: item.querySelector("input[placeholder='Nome da instituição']")?.value || '',
            curso: item.querySelector("input[placeholder='Nome do curso']")?.value || '',
            grau: item.querySelectorAll("select")[0]?.value || '',
            situacao: item.querySelectorAll("select")[1]?.value || '',
            inicio: item.querySelectorAll("input[type='month']")[0]?.value || '',
            fim: item.querySelectorAll("input[type='month']")[1]?.value || ''
        })),

        idiomas: Array.from(document.querySelectorAll("#idiomas .idioma-item")).map(item => ({
            idioma: item.querySelector("input")?.value || '',
            nivel: item.querySelector("select")?.value || ''
        })),

        habilidadesTecnicas: Array.from(document.querySelectorAll("#habilidades-tecnicas .habilidade-item")).map(item => ({
            habilidade: item.querySelector("input")?.value || '',
            nivel: item.querySelector("select")?.value || ''
        })),

        softSkills: document.getElementById("softSkills").value || '',

        certificacoes: Array.from(document.querySelectorAll("#certificacoes .certificacao-item")).map(item => ({
            nome: item.querySelectorAll("input")[0]?.value || '',
            instituicao: item.querySelectorAll("input")[1]?.value || ''
        }))
    };
fetch("../php/gerar_curriculo.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify(dadosCurriculo)
})
.then(response => {
    if (!response.ok) throw new Error("Erro ao gerar o PDF");
    return response.blob();
})
.then(blob => {
    const url = URL.createObjectURL(blob);
    window.open(url, "_blank");
})
.catch(error => {
    alert("Erro ao gerar currículo: " + error.message);
});
});
