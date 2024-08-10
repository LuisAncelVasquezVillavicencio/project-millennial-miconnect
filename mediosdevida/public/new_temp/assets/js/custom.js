$(document).ready(function(){

   $(".form-control").on("change",function(){
     if($(this).hasClass("is-invalid")){
         $(this).removeClass("is-invalid")
         $(this).next("small.text-danger").remove();
     }
   })
   
   $(".form-check-input").on("change",function(){
     if($(this).hasClass("is-invalid")){
         $(this).removeClass("is-invalid")
         $(this).parent().next("small.text-danger").remove();
     }
   })

   $(document).on('show.bs.modal','.modal', function () {
      $(".is-invalid").removeClass("is-invalid")
      $("small.text-danger").remove();
   })
   
})


function error_marker(data){
   
   
   $.each(data.errors,function(key,value){
      
      if(!$("#"+key).hasClass("is-invalid")){
         
         if(!$("#"+key).is(":checkbox")){
            $("#"+key).addClass("is-invalid")
            $("#"+key).parent().append("<small class='text-danger'>"+value+"</small>")
         }
         else{
            $("#"+key).addClass("is-invalid")
            $("#"+key).parent().parent().append("<small class='text-danger'>"+value+"</small>")
         }
         
         
      }
      
   })
   
}

function notification_custom(tipo,mensaje) {
   if(tipo == "success"){
      icon = "bx bx-check-circle";
   }
   
   else if(tipo == "warning"){
      icon = "bx bxs-message-x";
   }
   else{
      icon = "bx bxs-message-x";
   }
   
	Lobibox.notify(tipo, {
		pauseDelayOnHover: true,
		size: 'mini',
		icon: icon,
		continueDelayOnInactiveTab: false,
		position: 'bottom right',
		msg: mensaje
	});
}

$(document).ready(function(){
   window.emojiPicker = new EmojiPicker({
    emojiable_selector: '[data-emojiable=true]',
    assetsPath: 'new_temp/assets/plugins/emoji-picker-main/emoji-picker-main/lib/img',
    popupButtonClasses: 'fa fa-smile-o'
  });

   window.emojiPicker.discover();
})