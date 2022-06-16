<header class="main-header">
  <div class="container container--flex">
    <div class="main-header__container">
      <h1 class="main-header__title">MASCOTA URBANA</h1>
      <span class="icon-menu" id="btn-menu"><i class="fas fa-bars"></i></span>
      <nav class="main-nav" id="main-nav">
        <ul class="menu">
          <li class="menu__item"><a href="" class="menu__link">Inicio</a></li>
          <!-- <li class="menu__item"><a href="" class="menu__link">Sobre Nosotros</a></li>
            <li class="menu__item"><a href="" class="menu__link">Quienes somos</a></li> -->
          <li class="menu__item"><a href="#compra" class="menu__link">Tienda</a></li>
          <li class="menu__item"><a href="#pie" class="menu__link">Contactos</a></li>
          <li class="menu__item"><a href="#pie" class="menu__link">Filtros</a></li>
        </ul>
      </nav>
    </div>
    <div class="main-header__container">
      <span class="main-header__txt">¿Necesitas Ayuda?</span>
      <p class="main-header__txt"><i class="fas fa-phone"></i> Contacto:</p>
    </div>
    <div class="main-header__container">
      <div class="col-md-7 col-lg-6 ml-auto">
                <form id="frm">
                    <div class="row">

                        <!-- USER Name -->
                        <div class="input-group col-lg-6 mb-4">
                          
                         <!--           <i class="fa fa-user text-muted"></i>-->
                          
                            <input type="text" name="usuario" id="usuario" autocomplete="off"
                                placeholder="Digite su Usuario" class="form-control bg-white border-left-0 border-md">
                        </div>

                        <!-- PASS -->
                        <div class="input-group col-lg-6 mb-4">
                      
                            <input type="password" name="clave" id="clave" placeholder="Digite su Clave"
                                autocomplete="off" class="form-control bg-white border-left-0 border-md">
                        </div>


                        <!-- Submit Button -->
                        <div class="form-group col-lg-12 mx-auto mb-0">
                       
                            <select id="sucursal"  name="sucursal" onchange="entryCompany(this)"
                                class="form-control bg-white border-left-0 border-md"></select>
                            <button>
                                <span class="font-weight-bold">Entrar</span>
                            </button>

                        </div>

                                               <!-- Already Registered -->
                        <div class="text-center w-100">
                            <p class="text-muted font-weight-bold"><a href="recuperacion_clave.php"
                                    class="text-primary ml-2">Olvidaste tu contraseña ?</a></p>
                        </div>

                    </div>
                </form>
            </div>
    </div>
  </div>
</header>
<script type="text/javascript">
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

</script>