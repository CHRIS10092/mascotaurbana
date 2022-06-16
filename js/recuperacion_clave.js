const frmRecuperar = document.getElementById('frmRecuperar');
const txtCorreo = document.getElementById('txtCorreo');

const verificar = e => {
	e.preventDefault();

	if(txtCorreo.value == ''){
		alertify.error("Escriba el Correo de Recuperacion de Clave");
	}else if(!verificarCorreo(txtCorreo.value)){
		alertify.error("El Formato del Correo es Incorrecto");
	}else{
		enviarCorreo();
	}
}


const enviarCorreo = () => {

	data = new FormData(frmRecuperar);
	let url = "controladores/recuperar/index.php";
	http(url,'POST',data)
	.then(res => {
		if(res.res){
			$('#alertas').html(`<div class="alert alert-success">
				<strong>REVISAR!</strong> ${res.mensaje}.
				</div>`);

			alertify.success(res.mensaje);
			document.getElementById('btn-recuperar').disabled = true;
		}else{
			$('#alertas').html(`<div class="alert alert-danger">
				<strong>ERROR!</strong> ${res.mensaje}.
				</div>`);
			alertify.error(res.mensaje);
		}
	});

}

const http = async (url,metodo,data) => {

	const response = await fetch(url,{method:metodo,body:data});

	return await response.json();

}

const verificarCorreo = correo => {
	let res = false;
	let cont = 0; 

	for (let i = 0; i < correo.length; i++) {

		if(correo[i]=='@'){
			cont++;
		}
	}

	if(correo.includes("@") && correo.includes(".") && cont==1){

		indiceA = correo.indexOf("@");
		indiceB = correo.lastIndexOf(".");
		usuario = correo.substring(0,indiceA);
		organizacion = correo.substring(indiceA+1,indiceB);
		extension = correo.substring(indiceB+1,correo.length);

		if(indiceB > indiceA && usuario.length > 2 && organizacion.length >2 && extension.length >1 ){
			res = true;
		}

	}

	return res;

}

frmRecuperar.addEventListener("submit",verificar);

