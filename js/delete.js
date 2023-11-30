async function deletarTransacao(title) {
    const response = await fetch(`http://localhost/projeto_crud/delete.php?title=${title}`)
    const data = await response.json()
    data.status == 200 && window.location.reload()
}