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
<?php
require BASE.'/views/essentials/footer.php';
?>