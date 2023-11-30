// function editState(title, valor, tipo) {
//     const form_wrapper = document.querySelector('div.form-wrapper')
//     const form = document.querySelector('form.newItem');
//     const titleInput = document.querySelector('input[name="titulo"]');   
//     const valueInput = document.querySelector('input[name="valor"]');   
//     const typeSelect = document.querySelector('select[name="tipo"]');   
//     const tipoOptionEntrada = document.querySelector('option[value="entrada"]');   
//     const tipoOptionsaida = document.querySelector('option[value="saida"]');   
//     const btn = document.querySelector('button#btnNew');
//     console.log(titleInput);
//     console.log(valueInput);
//     console.log(tipoOptionEntrada);
//     console.log(tipoOptionsaida);
//     console.log(btn)


//     // populate inputs
//     titleInput.value = title
//     valueInput.value = valor
//     tipo == 'entrada' ? typeSelect.value = 'entrada' : typeSelect.value = 'saida'

//     // delete form
//     form.remove();

//     const new_form = document.createElement('form');
//     new_form.classList.add('newItem');
//     new_form.setAttribute('id', 'edit');

//     new_form.appendChild(titleInput)
//     new_form.appendChild(valueInput)
//     typeSelect.appendChild(tipoOptionEntrada)
//     typeSelect.appendChild(tipoOptionsaida)
//     new_form.appendChild(typeSelect)
//     new_form.appendChild(btn);

//     form_wrapper.appendChild(new_form)
// }


function editState(title, value, type) {
    const old_form = document.querySelector('form.newItem');
    old_form.remove()
    // Create the form element
    var formElement = document.createElement("form");
    formElement.className = "newItem";
    formElement.id = "edit";
    formElement.setAttribute('onsubmit', 'handleEdit()')

    // Create and append the div for description
    var divDescElement = document.createElement("div");
    divDescElement.className = "divDesc";

    var labelDescElement = document.createElement("label");
    labelDescElement.htmlFor = "desc";
    labelDescElement.textContent = "Descrição";

    var inputDescElement = document.createElement("input");
    inputDescElement.type = "text";
    inputDescElement.name = "titulo";
    inputDescElement.id = "desc";
    inputDescElement.required = true;
    inputDescElement.value = title || ''; // Set the provided title or an empty string

    divDescElement.appendChild(labelDescElement);
    divDescElement.appendChild(inputDescElement);

    // Create and append the div for amount
    var divAmountElement = document.createElement("div");
    divAmountElement.className = "divAmount";

    var labelAmountElement = document.createElement("label");
    labelAmountElement.htmlFor = "amount";
    labelAmountElement.textContent = "Valor";

    var inputAmountElement = document.createElement("input");
    inputAmountElement.type = "number";
    inputAmountElement.name = "valor";
    inputAmountElement.id = "amount";
    inputAmountElement.required = true;
    inputAmountElement.value = value || ''; // Set the provided value or an empty string

    divAmountElement.appendChild(labelAmountElement);
    divAmountElement.appendChild(inputAmountElement);

    // Create and append the div for type
    var divTypeElement = document.createElement("div");
    divTypeElement.className = "divType";

    var labelTypeElement = document.createElement("label");
    labelTypeElement.htmlFor = "type";
    labelTypeElement.textContent = "Tipo";

    var selectTypeElement = document.createElement("select");
    selectTypeElement.name = "tipo";
    selectTypeElement.id = "type";

    var optionEntradaElement = document.createElement("option");
    optionEntradaElement.value = "entrada";
    optionEntradaElement.textContent = "Entrada";
    if (type === "entrada") {
        optionEntradaElement.selected = true; // Set selected if type is "entrada"
    }

    var optionSaidaElement = document.createElement("option");
    optionSaidaElement.value = "saida";
    optionSaidaElement.textContent = "Saída";
    if (type === "saida") {
        optionSaidaElement.selected = true; // Set selected if type is "saida"
    }

    selectTypeElement.appendChild(optionEntradaElement);
    selectTypeElement.appendChild(optionSaidaElement);

    divTypeElement.appendChild(labelTypeElement);
    divTypeElement.appendChild(selectTypeElement);

    // Create and append the button
    var buttonElement = document.createElement("button");
    buttonElement.type = "submit";
    buttonElement.id = "btnNew";
    buttonElement.textContent = "Salvar";

    // Append all elements to the form
    formElement.appendChild(divDescElement);
    formElement.appendChild(divAmountElement);
    formElement.appendChild(divTypeElement);
    formElement.appendChild(buttonElement);

    // Append the form to the body
    const form_wrapper = document.querySelector('div.form-wrapper')

    form_wrapper.appendChild(formElement);
}