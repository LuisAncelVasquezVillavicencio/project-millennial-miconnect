// Generated by CoffeeScript 2.1.0


	$('.error').click(function (event) {
      event.preventDefault();
      event.stopPropagation();
      return $.growl.error({
        message: "No se pudo perfinal el archivo "
      });
  });

  $('.notice').click(function (event) {
      event.preventDefault();
      event.stopPropagation();
      return $.growl.notice({
        message: "You have 4 notification"
      });
    });
    
    $('.warning').click(function (event) {
      event.preventDefault();
      event.stopPropagation();
      return $.growl.warning({
        message: "read all details carefully"
      });
    });
  


