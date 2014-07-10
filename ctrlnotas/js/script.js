/*
 * Main Script
 */

jQuery(function(){
    
    jQuery("a#edit").fancybox({
        'width'			: '75%',
        'height'		: '75%',
        'autoScale'		: false,
        'transitionIn'		: 'elastic',
        'transitionOut'		: 'none',
        'type'			: 'iframe'
    });
});

jQuery(function(){
    
    jQuery("a#report").fancybox({
        'width'			: '75%',
        'height'		: '85%',
        'autoScale'		: false,
        'transitionIn'		: 'elastic',
        'transitionOut'		: 'none',
        'type'			: 'iframe'
    });
});
//Funcion para seleccionar grado
function selectgrade(x) {
	jQuery("#grado").html("");
	//Usaremos la funcion getJson, ya establecida de jQuery
	jQuery.getJSON(url+'ajax.php?mat='+x, function(data){
		for (var x = 0; x < data.length; x++) {
			jQuery("<option />").attr("value", data[x].idg).html(data[x].nombreg).appendTo("#grado");
		}
	});
}

//Funcion para seleccionar grado
function selectgradeA(x) {
	jQuery("#grado").html("");
	//Usaremos la funcion getJson, ya establecida de jQuery
	jQuery.getJSON(url+'ajax.php?admin_gd=opt&mat_id='+x, function(data){
            jQuery("<option />").attr("value","").html("Seleccione Grado").appendTo("#grado");
		for (var x = 0; x < data.length; x++) {
			jQuery("<option />").attr("value", data[x].idg).html(data[x].nombreg).appendTo("#grado");
		}
	});
}

//Funcion para seleccionar Materia
function selectMat(x) {
	jQuery("#materia").html("");
	//Usaremos la funcion getJson, ya establecida de jQuery
	jQuery.getJSON(url+'ajax.php?admin_mat=opt&docnt_id='+x, function(data){
            jQuery("<option />").attr("value","").html("Seleccione Materia").appendTo("#materia");
		for (var x = 0; x < data.length; x++) {
			jQuery("<option />").attr("value", data[x].idm).html(data[x].nombrem).appendTo("#materia");
		}
	});
}

//Funciones para calcular promedios de notas
function _calculate_(x){
    return false;
}
