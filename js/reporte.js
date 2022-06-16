$("#list-categorias").load("../data/reporte/list_categorias.php");
const frmEnviar = document.getElementById("frmEnviar");
const buscar = e =>{
    e.preventDefault();
    datos=new FormData(frmEnviar);
    $.ajax({
       url:"../controladores/reporte/reporteController.php",
        type:"POST",
        data:datos,
        processData: false,
        contentType: false, 
    }).done(function(r){
        $("#carga-report").html(r);
    });
}
frmEnviar.addEventListener("submit",buscar);
    
   