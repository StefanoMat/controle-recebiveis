$(document).ready(function () {
  $('.date').mask("00/00/0000", { placeholder: "__/__/____" });
  $('.money').mask('000.000.000.000.000,00', { reverse: true });

  var mask = '00.000.000/0000-00';

  $('.cpfcnpj').mask(mask, {
    onKeyPress: function (val, e, field, options) {
      var masks = ['000.000.000-009', '00.000.000/0000-00'];
      mask = (val.length <= 14) ? masks[0] : masks[1];
      if (val.length == 0) {
        mask = '00.000.000/0000-00';
      }
      field.mask(mask, options);
    }
  });
  $('.cpfcnpj-l').text(function () {
    var val = $(this).text();
    var masks = ['000.000.000-009', '00.000.000/0000-00'];
    mask = (val.length <= 11) ? masks[0] : masks[1];
    if (val.length == 0) {
      mask = '00.000.000/0000-00';
    }
    $(this).mask(mask);
  });

  openModalToEdit();
})

function openModalToEdit() {
  $('button.editar').on('click', function () {
    var fields = $(this).siblings();
    console.log(fields)
    $('#editModal #debtor_id').val($(fields[1]).val());
    $('#editModal #debt_id').val($(fields[2]).val());
    $('#editModal #nascimento').val($(fields[3]).val()).trigger('input');
    $('#editModal #endereco').val($(fields[4]).val());

    $('#editModal #nome').val($(fields[5]).data('value'));
    $('#editModal #cpfcnpj').val($(fields[6]).data('value')).trigger('input');
    $('#editModal #valor').val($(fields[7]).data('value')).trigger('input');
    $('#editModal #descricao').val($(fields[8]).data('value'));
    $('#editModal #final').val($(fields[9]).data('value')).trigger('input');
    $('#editModal').modal();
  })
}