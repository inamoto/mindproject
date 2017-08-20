!function ($) {
  $(function(){
    $('[data-toggle=confirmation]').confirmation({
      rootSelector: '[data-toggle=confirmation]',
      onConfirm: function() {
        //alert('You choosed ' + this[0].id);
        document.getElementById('form_remove'+this[0].id).submit();
      },
      //onConfirm: formDestroySubmit,
      // other options
    });
  })
}(window.jQuery);

function formDestroySubmit(e) {  
  aaa = document.getElementById('form_remove');
  document.getElementById('form_remove'+e).submit();
};

