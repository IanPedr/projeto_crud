

function handleSubmit(e) {
    e.preventDefault();
    let data = {
        titulo: document.querySelector('input[name="titulo"]').value,
        valor: document.querySelector('input[name="valor"]').value,
        tipo: document.querySelector('select[name="tipo"]').value
    }

    fetch('post.php', {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then((response) => response.json())
    .then(data => {
        console.log(data)
        if (data.status_code == 200) {
            const dados = data.dados;

            const entrada_field = document.querySelector('span.incomes');
            const saida_field = document.querySelector('span.expenses');
            const total_field = document.querySelector('span.total');

            if (dados.tipo == 'entrada') {
                // atualizar entrada
                const entrada_atual_value = entrada_field.innerHTML;
                const new_value = parseFloat(entrada_atual_value) + parseFloat(dados.valor)
                entrada_field.innerHTML = new_value;

                // atualizar total
                 const total_atual_value = total_field.innerHTML;
                 const new_total_value = parseFloat(total_atual_value) + parseFloat(dados.valor);
                 total_field.innerHTML = new_total_value;
            } 

            if (dados.tipo == 'saida') {
                // atualizar saida
                const saida_atual_value = saida_field.innerHTML;
                const new_saida_value = parseFloat(saida_atual_value) + parseFloat(dados.valor)
                saida_field.innerHTML = new_saida_value;

                // atualizar total
                 const total_atual_value = total_field.innerHTML;
                 const new_total_value = parseFloat(total_atual_value) - parseFloat(dados.valor);
                 total_field.innerHTML = new_total_value;
            }

            let new_tr = document.createElement('tr')
            let new_td_titulo = document.createElement('td')
            new_td_titulo.innerHTML = dados.titulo
            let new_td_valor = document.createElement('td')
            new_td_valor.innerHTML = dados.valor
            let new_td_tipo = document.createElement('td')
            new_td_tipo.innerHTML = dados.tipo
            let new_td_actions = document.createElement('td')
            new_td_actions.innerHTML = `
            <button class="edit" onclick="editState('${dados.titulo}', '${dados.valor}', '${dados.tipo}')">
                <img src="./img/pencil-simple.svg"> 
            </button> 
            <button class="delete" onclick="deletarTransacao('${dados.titulo}')">
                <img src="./img/trash.svg"> 
            </button>`
            new_tr.appendChild(new_td_titulo)
            new_tr.appendChild(new_td_valor)
            new_tr.appendChild(new_td_tipo)
            new_tr.appendChild(new_td_actions)
            wrapper.appendChild(new_tr);
        
    }})
} 
var form = document.querySelector('form#add')
// form.addEventListener('submit',(e) => alert('add'))
form.addEventListener('submit',(e) => handleSubmit(e))