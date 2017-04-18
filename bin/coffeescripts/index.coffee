$('document').ready(function() {
  $('.add_another').click(function() {
      $("#tbl").append('<tr><td><input type="text" class="txtbox" value="" /></td><td><input type="text" class="txtbox" value="" /></td><td><input type="text" class="txtbox" value="" /></td></tr>');
   });
})