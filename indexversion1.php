<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>MASCOTA URBANA</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

  <link rel="stylesheet" href="./style.css">
</head>

<body>

<?php
require_once "templates/cabecera.php";
?>
<div class="container-slider">
    <div class="slider" id="slider">
      <div class="slider__section">
        <img src="imagenes/logocomprasegura.jpg" alt="" class="slider__img">
        <div class="slider__content">
          <h2 class="slider__title">MASCOTA URBANA</h2>
          <p class="slider__txt">Disfruta de esto.</p>
          <a href="" class="btn-shop">COMPRA YA!</a>
        </div>
      </div>
      <div class="slider__section">
        <img src="imagenes/2.jpg" alt="" class="slider__img">
        <div class="slider__content">
          <h2 class="slider__title">Zapato</h2>
          <p class="slider__txt">Disfruta de esto.</p>
          <a href="" class="btn-shop">COMPRA YA!</a>
        </div>
      </div>
      <div class="slider__section">
        <img src="imagenes/4.jpg" alt="" class="slider__img">
        <div class="slider__content">
          <h2 class="slider__title">Zapato</h2>
          <p class="slider__txt">Disfruta de esto.</p>
          <a href="" class="btn-shop">COMPRA YA!</a>
        </div>
      </div>
      <div class="slider__section">
        <img src="imagenes/3.jpg" alt="" class="slider__img">
        <div class="slider__content">
          <h2 class="slider__title">Zapato</h2>
          <p class="slider__txt">Disfruta de esto.</p>
          <a href="" class="btn-shop">COMPRA YA!</a>
        </div>
      </div>
    </div>
    <div class="slider__btn slider__btn--right" id="btn-right">&#62;</div>
    <div class="slider__btn slider__btn--left" id="btn-left">&#60;</div>
  </div>
  <main class="main" id="compra">
    <div class="container">
      <h2 class="main-title">Nuestros Productos</h2>
      <section class="container-products">
        <div class="product">
          <img src="imagenes/6.jpg" alt="" class="product__img">
          <div class="product__description">
            <h3 class="product__title">Sue Booties </h3>
            <span class="product__price">$75.00</span>
          </div>
          <i class="product__icon fas fa-cart-plus"></i>

        </div>
        <div class="product">
          <img src="imagenes/2.jpg" alt="" class="product__img">
          <div class="product__description">
            <h3 class="product__title">Jennifer Soul</h3>
            <span class="product__price">$75.00</span>
          </div>
          <i class="product__icon fas fa-cart-plus"></i>
        </div>
        <div class="product">
          <img src="imagenes/7.jpg" alt="" class="product__img">
          <div class="product__description">
            <h3 class="product__title">Eva Sneakers</h3>
            <span class="product__price">$75.00</span>
          </div>
          <i class="product__icon fas fa-cart-plus"></i>
        </div>
        <div class="product">
          <img src="imagenes/8.jpg" alt="" class="product__img">
          <div class="product__description">
            <h3 class="product__title">Summy Espadrilles</h3>
            <span class="product__price">$75.00</span>
          </div>
          <i class="product__icon fas fa-cart-plus"></i>
        </div>
      </section>
      <section class="container__testimonials">
        <h2 class="section__title">Creadora</h2>
        <h3 class="testimonial__title">Gabriela Salcedo </h3>
        <p class="testimonial__txt">Lo mejor para ti</p>
      </section>

      <div class="container-editor">
        <div class="editor__item">
          <img src="imagenes/3.jpg" alt="" class="editor__img">
          <p class="editor__circle">Mira tu estilo</p>
        </div>
        <div class="editor__item">
          <img src="https://images.pexels.com/photos/261856/pexels-photo-261856.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="" class="editor__img">
          <p class="editor__circle">Mira tu estilo</p>
        </div>
      </div>
      <section class="container-tips">
        <div class="tip">
          <i class="far fa-hand-paper"></i>
          <h2 class="tip__title">Garantizado</h2>
          <p class="tip__txt">y efectivo</p>
          <a href="" class="btn-shop">Compra ahora</a>
        </div>
        <div class="tip">
          <i class="fas fa-rocket"></i>
          <h2 class="tip__title">Compra rapida</h2>
          <p class="tip__txt">y segura</p>
          <a href="" class="btn-shop">Compra ahora</a>
        </div>
        <div class="tip">
          <i class="fas fa-cog"></i>
          <h2 class="tip__title">ventajas</h2>
          <p class="tip__txt">inigualables</p>
          <a href="" class="btn-shop">Compra ahora</a>
        </div>
      </section>
    </div>    
  </main>
  <footer class="main-footer" id="pie">
  <div class="footer__section">
    <h2 class="footer__title">FHORMA</h2>
    <p class="footer__txt">No importa lo grandes que sean tus zapatos si no logras nada en ellos.</p>
  </div>
  <div class="footer__section">
    <h2 class="footer__title">NOS ENCONTRAMOS:</h2>
    <p class="footer__txt">Ecuador</p>
    <h2 class="footer__title">CONTACTO: </h2>
    <p class="footer__txt">celular: </p>
    <p class="footer__txt">correo: </p>
  </div>
  <div class="footer__section">
    <h2 class="footer__title">ENLACES</h2>
    <a href="index.php" class="footer__link">Inicio</a>
    <!-- <a href="" class="footer__link">About</a> -->
    <a href="" class="footer__link">Facebook</a>
    <a href="#" class="footer__link">Instagram</a>
    <a href="" type="email" class="footer__link">Correo</a>
  </div>
  <div class="footer__section">
    <img src="imagenes/fhorma23.png" alt="Fhroma"  width="100" height="300">
  </div>
  <p class="copy">© 2022 . derechos reservados| </p>
</footer>
<!-- partial -->
<script  src="script.js"></script>

</body>

</html>
