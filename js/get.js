let wrapper = document.querySelector('tbody');

const getData = async () => {
    const response = await fetch('http://localhost:80/projeto_crud/get.php')
    const data = await response.json()

    if (data.status_code == 200) {
        const dados = data.dados;
        const total_entrada = data.total_entrada;
        const total_saida = data.total_saida;
        const entrada_field = document.querySelector('span.incomes');
        const saida_field = document.querySelector('span.expenses');
        const total_field = document.querySelector('span.total');
        total_field.innerHTML = data.total;
        entrada_field.innerHTML = total_entrada;
        saida_field.innerHTML = total_saida;
        for (let dado in dados) {
            console.log(dados[dado])
            let new_tr = document.createElement('tr')
            let new_td_titulo = document.createElement('td')
            new_td_titulo.innerHTML = dados[dado].titulo
            let new_td_valor = document.createElement('td')
            new_td_valor.innerHTML = dados[dado].valor
            let new_td_tipo = document.createElement('td')
            new_td_tipo.innerHTML = dados[dado].tipo
            new_tr.appendChild(new_td_titulo)
            new_tr.appendChild(new_td_valor)
            new_tr.appendChild(new_td_tipo)
            wrapper.appendChild(new_tr);
        }
    } else {
        console.log(data)
    }
}

getData();