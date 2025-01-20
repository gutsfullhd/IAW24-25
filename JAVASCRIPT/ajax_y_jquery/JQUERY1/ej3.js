$(document).ready(function () {
    
    $("#btn-aumentar").click(function () {
        $("#encabezado").css({
            "font-size": "2em",
            "color": "blue"
        }); 
        $(".pares").css({
            "font-size": "1.5em",
            "color": "green"
        }); 
    });

   
    $("#btn-disminuir").click(function () {
        $("#encabezado").css({
            "font-size": "1em",
            "color": "black"
        }); 
        $(".pares").css({
            "font-size": "1em",
            "color": "black"
        }); 
    });
});
