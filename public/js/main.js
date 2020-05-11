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
})