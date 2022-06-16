<?php
    session_start();
    session_destroy();
    session_unset();
    echo "<script>alert('Cerrando .....');</script>";
    echo "<script>window.location = '../';</script>"; 