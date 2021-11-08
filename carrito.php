<?php
  session_start();

  $id = $_REQUEST["id"];

  $_SESSION["productos_carro"][$id] = $id;



?>