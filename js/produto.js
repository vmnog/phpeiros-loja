// Função que é chamada quando usuario seleciona arquivo no produto-formulario.php
// a funcao pega o nome do upload e coloca na label, confirmando que o arquivo foi selecionado
function showname() {
    var name = document.getElementById('fileInput');
    // alert('Selected file: ' + name.files.item(0).name);
    var produtoNome = name.files.item(0).name;
    // alert(produtoNome);
    document.getElementById('fileInputLabel').innerHTML = produtoNome;
};


