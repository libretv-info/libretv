<?php
// ================================================
// salir.php - Redirección + anuncio AdSense
// ================================================

// Lista de canales y enlaces reales
$canales = [
  "espn" => "https://www.espn.com",
  "foxsports" => "https://www.foxsports.com",
  "bein" => "https://www.beinsports.com",
  "sky" => "https://www.skysports.com",
  "dazn" => "https://www.dazn.com",
  "tnt" => "https://tntsports.com",
  "tyc" => "https://www.tycsports.com",
  "directv" => "https://www.directvsports.com",
  "eurosport" => "https://www.eurosport.com",
  "tudn" => "https://www.tudn.com",
  "win" => "https://www.winsports.co",
  "deportv" => "https://www.deportv.gob.ar",
  "cdf" => "https://www.cdf.cl",
  "goltv" => "https://www.goltv.tv",
  "claro" => "https://www.clarosports.com",
  "sporttv" => "https://www.sporttv.pt",
  "abudhabi" => "https://www.adsports.ae",
  "dubai" => "https://www.dubaisports.ae"
];

// Obtener el ID del canal
$id = $_GET['id'] ?? '';

if (isset($canales[$id])) {
  $url = $canales[$id];

  // Registrar clic (opcional)
  $log = date('Y-m-d H:i:s') . " | Canal: $id | IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
  file_put_contents("clicks.txt", $log, FILE_APPEND);

  // Mostrar anuncio antes de redirigir
  echo "
  <html>
  <head>
    <meta http-equiv='refresh' content='5;url=$url'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Redirigiendo a $id...</title>
    <style>
      body {font-family: Arial, sans-serif; background:#111; color:#fff; text-align:center; padding-top:100px;}
      a {color:#00b4ff;}
      .contenedor {max-width:600px; margin:auto;}
      .anuncio {margin: 30px auto; text-align:center;}
    </style>
  </head>
  <body>
    <div class='contenedor'>
      <h2>?? Redirigiendo a <strong>$id</strong>...</h2>
      <p>Por favor espera unos segundos o haz clic abajo si no eres redirigido automáticamente.</p>

      <div class='anuncio'>
        <!-- ?? Bloque de anuncio de Google AdSense -->
        <script async src='https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8295149857934845'
             crossorigin='anonymous'></script>
        <ins class='adsbygoogle'
             style='display:block'
             data-ad-client='ca-pub-8295149857934845'
             data-ad-slot='1234567890'  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8295149857934845"
     crossorigin="anonymous"></script>
             data-ad-format='auto'
             data-full-width-responsive='true'></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </div>

      <p><a href='$url'>Ir ahora a $id ?</a></p>
    </div>
  </body>
  </html>
  ";
  exit;
}

// Si no existe el canal
echo '? Canal no encontrado.';
?>
