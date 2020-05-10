<?php
require BASE.'/views/essentials/head.php';
?>

<section>
  <div class="row" id="dashboard">
    <div class="col-md-5 info">
      <h1>Consolidação de Maio</h1>
      <h2 class="subtitle">Total de recebíveis registrados</h2>
      <h2 class="price">R$ 3.000,00</h2>

      <div class="card">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Pessoa Física</li>
          <li class="list-group-item result"><h3>R$ 1000</h3></li>
          <li class="list-group-item">Pessoa Jurídica</li>
          <li class="list-group-item result"><h3>R$ 2000</h3></li>
        </ul>
      </div>

      <h2 class="subtitle">Principais devedores</h2>
      <h2 class="devedor">Itau Unibanco: R$ 3.000,88</h2>
      <h2 class="devedor">Caixa Federal: R$ 3.000,88</h2>
      <h2 class="devedor">Mercado Lanz: R$ 3.000,88</h2>
    </div>

    <div class="col-md-7 list">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@novo">Novo Recebível</button>
      <div class="list-box">
        <div class="line-box">
          <div class="field col-sm-2"><p>Nome</p>Stefano Kaefer</div>
          <div class="field col-sm-2"><p>CPF</p>046.173.330-70</div>
          <div class="field col-sm-2"><p>Valor</p>R$ 1.000,90</div>
          <div class="field col-sm-4"><p>Descrição</p>Titulo correspondente a venda de as condicionados</div>
          <div class="field col-sm-1"><p>Vencimento</p>12/08/2020</div>
        </div>
      </div>
  
    </div>
  </div>
  <!-- <div class="container">
    <div class="row">
        <div class="col-md-6">
          One of three columns
        </div>
        <div class="col-md-6">
          One of three columns
        </div>
        <div class="col-sm">
          One of three columns
        </div>
      </div>
    </div>
  <div class="container">
   
  </div> -->
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo Recebível</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-nome" class="col-form-label">Nome:</label>
            <input type="text" name="nome" class="form-control" id="recipient-nome">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">CPF/CNPJ:</label>
            <input type="text" name="cpfcnpj" class="form-control cpfcnpj" id="recipient-cpfcnpj">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Data de Nascimento:</label>
            <input type="text" name="data_nascimento" class="form-control date" id="recipient-nascimento">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Endereço:</label>
            <input type="text" name="endereco" class="form-control" id="recipient-endereco">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Descrição do título:</label>
            <textarea name="descricao" class="form-control" id="message-text"></textarea>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Valor:</label>
            <input type="text" name="valor" class="form-control money" id="recipient-valor">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Data de Vencimento:</label>
            <input type="text" name="data_vencimento" class="form-control date" id="recipient-final">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Criar</button>
      </div>
    </div>
  </div>
</div>
<?php
require BASE.'/views/essentials/footer.php';
?>