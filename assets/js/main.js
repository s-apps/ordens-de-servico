window.onload = function() {
    const href = window.location.href;
    const params = href.split('/');
    urlParam = params[params.length - 2];

    if(urlParam == 'servicos') {
        const erro = document.getElementById('erro');
        document.getElementById('servicos').addEventListener('submit', (e) =>{
            e.preventDefault();
            const servico_id = document.getElementById('servico_id') ? document.getElementById('servico_id').value : 0;
            const nome = document.getElementById('nome').value;
            const referencia = document.getElementById('referencia').value;
            const formData = new FormData();
            formData.append('nome', nome);
            formData.append('referencia', referencia);
            formData.append('servico_id', servico_id);
            const request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   if(request.responseText != ''){
                      erro.textContent = request.responseText;
                      return;
                   }
                   window.location.href = '/servicos.php';
                }
            };
            if(servico_id) {
                request.open('POST', '/database/servico/update.php');
            } else {
                request.open('POST', '/database/servico/adicionar.php');
            }
            request.send(formData);    
        });
    }

    if(urlParam == 'clientes') {
        const erro = document.getElementById('erro');
        document.getElementById('clientes').addEventListener('submit', (e) =>{
            e.preventDefault();
            const cliente_id = document.getElementById('cliente_id') ? document.getElementById('cliente_id').value : 0;
            const nome = document.getElementById('nome').value;
            const formData = new FormData();
            formData.append('nome', nome);
            formData.append('cliente_id', cliente_id);
            const request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   if(request.responseText != ''){
                      erro.textContent = request.responseText;
                      return;
                   }
                   window.location.href = '/clientes.php';
                }
            };
            if(cliente_id) {
                request.open('POST', '/database/cliente/update.php');
            } else {
                request.open('POST', '/database/cliente/adicionar.php');
            }
            request.send(formData);    
        });
    }

    if(urlParam == 'ordens') {
        const erro = document.getElementById('erro');
        document.getElementById('ordens').addEventListener('submit', (e) =>{
            e.preventDefault();
            const ordem_id = document.getElementById('ordem_id') ? document.getElementById('ordem_id').value : 0;
            const cliente = document.getElementById('cliente_id').value;
            const servico = document.getElementById('servico_id').value;
            const formData = new FormData();
            formData.append('cliente', cliente);
            formData.append('servico', servico);
            formData.append('ordem_id', ordem_id);
            const request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   if(request.responseText != ''){
                      erro.textContent = request.responseText;
                      return;
                   }
                   window.location.href = '/';
                }
            };
            if(ordem_id) {
                request.open('POST', '/database/ordem/update.php');
            } else {
                request.open('POST', '/database/ordem/adicionar.php');
            }
            request.send(formData);    
        });
    }

    if (urlParam == 'pecas') {
        const erro = document.getElementById('erro');
        document.getElementById('pecas').addEventListener('submit', (e) =>{
            e.preventDefault();
            const peca_id = document.getElementById('peca_id') ? document.getElementById('peca_id').value : 0;
            const nome = document.getElementById('nome').value;
            const referencia = document.getElementById('referencia').value;
            const formData = new FormData();
            formData.append('nome', nome);
            formData.append('referencia', referencia);
            formData.append('peca_id', peca_id);
            const request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   if(request.responseText != ''){
                      erro.textContent = request.responseText;
                      return;
                   }
                   window.location.href = '/pecas.php';
                }
            };
            if(peca_id) {
                request.open('POST', '/database/peca/update.php');
            } else {
                request.open('POST', '/database/peca/adicionar.php');
            }
            request.send(formData);    
        });
    }
};

function inativar(el)
{
    const confirma = confirm("Confirma a inativação?");
    if(confirma) {
        const id = el.dataset.id;
        const tabela = el.dataset.tabela;
        const tr = document.getElementById('tr_' + id);
        const formData = new FormData();
        formData.append('id', id);
        formData.append('tabela', tabela);
        const request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                tr.style.display = 'none';
            }
        };
        request.open('POST', '/database/common/inativar.php');
        request.send(formData);        
    }
}

function cancelarOrdem(el)
{
    const confirma = confirm("Confirma o cancelamento?");
    if(confirma) {
        const ordem_id = el.dataset.id;
        const tr = document.getElementById('tr_' + ordem_id);
        const formData = new FormData();
        formData.append('ordem_id', ordem_id);
        const request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                tr.style.display = 'none';
            }
        };
        request.open('POST', '/database/ordens/cancelar.php');
        request.send(formData);        
    }
}
