const frm = document.getElementById('frm')
const usuario = document.getElementById('usuario')
const clave = document.getElementById('clave')
const sucursal = document.getElementById('sucursal')

const login = e =>{
	e.preventDefault()
	if(usuario.value == "" || usuario.value === null || clave.value == "" || clave.value === null ){
		alert("Las credenciales son obligatorias")
	}else{
		data = new FormData(frm)
		fetch("controladores/login/index.php",{
			method:"POST",
			body:data
		}).then(res => res.json())
		  .then(res =>{
		  	if(res.res){
		  		if(res.tipo == 1){
		  			sucursal.innerHTML=`<option value="0">Seleccione</option>`
		  		    res.data.map(el => {
		  			    sucursal.innerHTML+=`<option value="${el.codigo}">${el.nombre}</option>`
		  		    })
		  		}else{
		  			window.location ="ver_informacion.php"
		  		}
		  		
		       
		  	}else{
		  		alert(res.sms)
		  	}
		  	
		  })
	}

}

const entryCompany = el =>{
	if(el.value !="0"){
		data = new FormData()
		data.append("sucursal",el.value)
		fetch("controladores/login/get_sucursal.php",{
			method:"POST",
			body:data
		}).then(res => window.location = "app/inicio.php")
	}
	

}

frm.addEventListener("submit",login)
