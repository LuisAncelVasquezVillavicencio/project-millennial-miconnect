$('.select2').each(function(){
        
    busqueda = 1
    dropdownParent = $("body");
    
    if($(this).hasClass("select2Nobuscar")){
        busqueda = Infinity
    }
    
    if($(this).hasClass("select2modal")){
        modal = $(this).parent().parent().parent().parent().parent().parent().parent().attr('id')
        dropdownParent = $("#"+modal)
        
    }

    $(this).select2({
        minimumResultsForSearch: busqueda,
        dropdownParent:dropdownParent
    })
    
})

function resetHard(element){

    busqueda = 1
    dropdownParent = $("body");
    
    if($("#"+element).hasClass("select2Nobuscar")){
        busqueda = Infinity
    }
    
    if($("#"+element).hasClass("select2modal")){
        modal = $(this).parent().parent().parent().parent().parent().parent().parent().attr('id')
        dropdownParent = $("#"+modal)
        
    }

    $("#"+element).select2({
        minimumResultsForSearch: busqueda,
        dropdownParent:dropdownParent
    })
}
