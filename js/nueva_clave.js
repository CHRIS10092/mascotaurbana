const frmCambiar = document.getElementById('frmCambiar');
const txtClave = document.getElementById('txtClave');
const txtRepitaClave = document.getElementById('txtRepitaClave');

const verificar = e => {
	e.preventDefault();

	if(txtClave.value == ''){
		alertify.error('Escribir Nueva Clave de Acceso');
	}else if(!verificarFormatoClave(txtClave.value)){
		alertify.error('El Formato de la Clave debe Tener Mayusculas,Minusculas,Numeros,Caracteres Especiales');
	}else if(txtRepitaClave.value == ''){
		alertify.error('Repita la Nueva Clave de Acceso');
	}else if(txtClave.value != txtRepitaClave.value){
		alertify.error('Las Claves no Coinciden');
	}else{
		cambiarClave();
	}

}

const cambiarClave = () => {
	let data = new FormData(frmCambiar);
	let url = "controladores/recuperar/cambiar.php";

	http(url,'POST',data)
	.then(res => {
		if(res.res){
			$('#alertas').html(`<div class="alert alert-success">
				<strong>REVISAR!</strong> ${res.mensaje}.
				</div>`);

			alertify.success(res.mensaje);
			document.getElementById('btn-cambiar').disabled = true;
		}else{
			$('#alertas').html(`<div class="alert alert-danger">
				<strong>ERROR!</strong> ${res.mensaje}.
				</div>`);
			alertify.error(res.mensaje);
		}
	})

}

const verificarFormatoClave = contrasenna => {
	if(contrasenna.length >= 8)
			{		
				var mayuscula = false;
				var minuscula = false;
				var numero = false;
				var caracter_raro = false;
				
				for(var i = 0;i<contrasenna.length;i++)
				{
					if(contrasenna.charCodeAt(i) >= 65 && contrasenna.charCodeAt(i) <= 90)
					{
						mayuscula = true;
					}
					else if(contrasenna.charCodeAt(i) >= 97 && contrasenna.charCodeAt(i) <= 122)
					{
						minuscula = true;
					}
					else if(contrasenna.charCodeAt(i) >= 48 && contrasenna.charCodeAt(i) <= 57)
					{
						numero = true;
					}
					else
					{
						caracter_raro = true;
					}
				}
				if(mayuscula == true && minuscula == true && caracter_raro == true && numero == true)
				{
					return true;
				}
			}
			return false;
}


const http = async (url,metodo,data) => {

	const response = await fetch(url,{method:metodo,body:data});

	return await response.json();

}

frmCambiar.addEventListener('submit',verificar);