<?php
require BASE.'/views/essentials/head.php';
$recebiveis = json_decode($data)->debts;
$totais = json_decode($data)->totals;
$principais_devedores = json_decode($data)->topDebtors;
?>

<section>
  <div class="row" id="dashboard">
    <div class="col-md-5 info">
      <h1>Consolidação de Maio</h1>
      <h2 class="subtitle">Total de recebíveis registrados</h2>
      <h2 class="price">R$ <label class="money"><?= isset($totais[0]->total) ? $totais[0]->total : '-' ?></label></h2>

      <div class="card">
        <ul class="list-group list-group-flush">
        <li class="list-group-item">Pessoa Jurídica</li>
          <li class="list-group-item result"><h3>R$ <label class="money"><?= isset($totais[0]->juridica) ? $totais[0]->juridica : '-' ?></label></h3></li>
          <li class="list-group-item">Pessoa Física</li>
          <li class="list-group-item result"><h3>R$ <label class="money"><?= isset($totais[0]->fisica) ? $totais[0]->fisica : '-' ?></label></h3></li>
        </ul>
      </div>

      <h2 class="subtitle">Principais devedores</h2>
      <?php 
      if (!empty($principais_devedores)):
        foreach($principais_devedores as $devedor):?>
      <h2 class="devedor"><?= $devedor->name ?></h2>
      <h3>R$ <label class="money"><?= $devedor->value ?></label></h3>
      <?php 
        endforeach; 
      endif; ?>
    </div>

    <div class="col-md-7 list">
    <button type="button" class="btn btn-primary novo" data-toggle="modal" data-target="#fieldsModal" data-whatever="@novo">Novo Recebível</button>
     
    <div class="list-box">
      <?php 
      if (!empty($recebiveis)):
        foreach($recebiveis as $nota):
        ?> 
        
          <div class="line-box">
          <button type="button" class="btn btn-info btn-sm line editar">EDITAR</button>
          <a href="/delete/<?=$nota->debtor_id?>/<?=$nota->debt_id?>" class="btn btn-danger btn-sm line sec">APAGAR</a>
            <input type="hidden" id="debtor_id" value="<?=$nota->debtor_id?>"/>
            <input type="hidden" id="debt_id" value="<?=$nota->debt_id?>"/>
            <input type="hidden" id="data_nascimento" value="<?php 
            $date = new DateTime($nota->birthdate); 
            echo $date->format('d/m/Y');
            ?>"/>
            <input type="hidden" id="endereco" value="<?=$nota->address?>"/>
            <div class="field col-sm-2" data-value="<?= $nota->name ?? ''?>"><p>Nome</p><?= $nota->name ?? '-'?></div>
            <div class="field col-sm-3" data-value="<?= $nota->cpf_cnpj ?? '' ?>"><p>Documento</p><label class="cpfcnpj-l"><?= $nota->cpf_cnpj ?? '-' ?></label></div>
            <div class="field col-sm-2" data-value="<?= $nota->value ?? '' ?>"><p >Valor</p>R$ <label class="money"><?= $nota->value ?? '-' ?></label></div>
            <div class="field col-sm-3" data-value="<?= $nota->debt_description  ?? ''?>"><p>Descrição</p><?= $nota->debt_description  ?? '-'?></div>
            <div class="field col-sm-1" data-value="
            <?php
              $date = new DateTime($nota->end_date); 
              echo $date->format('d/m/Y');
            ?>"><p>Vencimento</p><?php
                echo $date->format('d/m/Y');
              ?> 
            </div>
          </div>
        <?php 
        endforeach;
      endif; ?>
      </div>
    </div>
  </div>
</section>
<div class="modal fade" id="fieldsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo Recebível</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          
            <div class="form-group">
              <label for="recipient-nome" class="col-form-label">Nome:</label>
              <input type="text" name="nome" class="form-control" id="recipient-nome" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">CPF/CNPJ:</label>
              <input type="text" name="cpfcnpj" class="form-control cpfcnpj" id="recipient-cpfcnpj" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Data de Nascimento:</label>
              <input type="text" name="data_nascimento" class="form-control date" id="recipient-nascimento" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Endereço:</label>
              <input type="text" name="endereco" class="form-control" id="recipient-endereco" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Descrição do título:</label>
              <textarea name="descricao" class="form-control" id="message-text" required></textarea>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Valor:</label>
              <input type="text" name="valor" class="form-control money" id="recipient-valor" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Data de Vencimento:</label>
              <input type="text" name="data_vencimento" class="form-control date" id="recipient-final" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Criar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Recebível</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/edit" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          
            <div class="form-group">
              <label for="nome" class="col-form-label">Nome:</label>
              <input type="hidden" name="debt_id" class="form-control" id="debt_id">
              <input type="hidden" name="debtor_id" class="form-control" id="debtor_id">
              <input type="text" name="nome" class="form-control" id="nome" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">CPF/CNPJ:</label>
              <input type="text" name="cpfcnpj" class="form-control cpfcnpj" id="cpfcnpj" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Data de Nascimento:</label>
              <input type="text" name="data_nascimento" class="form-control date" id="nascimento" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Endereço:</label>
              <input type="text" name="endereco" class="form-control" id="endereco" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Descrição do título:</label>
              <textarea name="descricao" class="form-control" id="descricao" required></textarea>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Valor:</label>
              <input type="text" name="valor" class="form-control money" id="valor" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Data de Vencimento:</label>
              <input type="text" name="data_vencimento" class="form-control date" id="final" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Editar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
require BASE.'/views/essentials/footer.php';
?>