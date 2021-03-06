<?php
require 'flight/Flight.php';
require 'flight/helpers.php';
require_once 'phpmailer/class.phpmailer.php';

$dbuser = 'zk1woweu_admin';
$dbpass = '6S8,fs)u.9Ra';

///////
// Connection to database
///////
Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=zk1woweu_terres',$dbuser,$dbpass),
  function($db){
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
);

Flight::map('getWinnerTourism', function($field) {
  $db = Flight::db();
  $sql = "SELECT id, title FROM tourismfilms WHERE $field = 1 ORDER BY id";
  $query = $db->prepare($sql);
  $query->execute();
  $i = 0;
  $film = [];
  while ($f = $query->fetch(PDO::FETCH_ASSOC)) {
    $film[$i]['id'] = $f['id'];
    $film[$i]['title'] = $f['title'];
    $sql = "SELECT * FROM evaluation_tourism WHERE film = :id";
    $q = $db->prepare($sql);
    $q->bindParam(':id', $f['id']);
    $q->execute();
    $eval = [];
    while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
      $eval[] = $row;
    }
    $suma = 0;
    $valoracions = count($eval);
    foreach ($eval as $p) {
      $sumaparcial = ($p['originalityscript'] + $p['rythm'] + $p['length'] + $p['photography'] + $p['sound'] + $p['edition'] + $p['specialeffects'] + $p['iseffective'] + $p['plot'] + $p['convincing']+ $p['attractive'] + $p['place_viewer'] + $p['place_stimulate'] + $p['specific_sell'] + $p['specific_clear'] + $p['specific_provide'] + $p['specific_focus'] + $p['specific_promote'] + $p['discuss'] + $p['attention'] + $p['awareness'])/ 21;
      $suma += $sumaparcial;
    }
    if ($valoracions != 0) {
      $film[$i]['total'] = round($suma / $valoracions, 4);
    } else {
      $film[$i]['total'] = 0;
    }
    $i++;
  }
  $valorations = [];
  $max = 0;
  for ($i=0; $i < sizeof($film); $i++) {
    $valorations[] = $film[$i]['total'];
  }
  $db = NULL;
  arsort($valorations);
  $ordre = array_keys($valorations);
  $winners['primer'] = $film[$ordre[0]];
  $winners['segon'] = $film[$ordre[1]];
  return $winners;
});

Flight::map('getWinnerDocumentary', function() {
  $db = Flight::db();
  $sql = "SELECT id, title FROM documentaryfilms";
  $query = $db->prepare($sql);
  $query->execute();
  $i = 0;
  $film = [];
  while ($f = $query->fetch(PDO::FETCH_ASSOC)) {
    $film[$i]['id'] = $f['id'];
    $film[$i]['title'] = $f['title'];
    $sql = "SELECT * FROM evaluation_documentary WHERE film = :id";
    $q = $db->prepare($sql);
    $q->bindParam(':id', $f['id']);
    $q->execute();
    $eval = [];
    while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
      $eval[] = $row;
    }
    $suma = 0;
    $valoracions = count($eval);
    foreach ($eval as $p) {
      $sumaparcial = ($p['originalityscript'] + $p['rythm'] + $p['length'] + $p['photography'] + $p['sound'] + $p['edition'] + $p['specialeffects'] + $p['iseffective'] + $p['plot'] + $p['convincing']+ $p['attractive'] + $p['place_viewer'] + $p['place_stimulate'] + $p['specific_travel'] + $p['specific_sustain'] + $p['specific_narrative'] + $p['specific_focus'] + $p['specific_reflection'] + $p['specific_suggest'] + $p['discuss'] + $p['attention'] + $p['awareness'])/ 22;
      $suma += $sumaparcial;
    }
    if ($valoracions != 0) {
      $film[$i]['total'] = round($suma / $valoracions, 4);
    } else {
      $film[$i]['total'] = 0;
    }
    $i++;
  }
  $valorations = [];
  $max = 0;
  for ($i=0; $i < sizeof($film); $i++) {
    $valorations[] = $film[$i]['total'];
  }
  $db = NULL;
  arsort($valorations);
  $ordre = array_keys($valorations);
  $winners['primer'] = $film[$ordre[0]];
  $winners['segon'] = $film[$ordre[1]];
  return $winners;
});

Flight::map('getWinnerCorporate', function() {
  $db = Flight::db();
  $sql = "SELECT id, title FROM corporatefilms";
  $query = $db->prepare($sql);
  $query->execute();
  $i = 0;
  $film = [];
  while ($f = $query->fetch(PDO::FETCH_ASSOC)) {
    $film[$i]['id'] = $f['id'];
    $film[$i]['title'] = $f['title'];
    $sql = "SELECT * FROM evaluation_corporate WHERE film = :id";
    $q = $db->prepare($sql);
    $q->bindParam(':id', $f['id']);
    $q->execute();
    $eval = [];
    while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
      $eval[] = $row;
    }
    $suma = 0;
    $valoracions = count($eval);
    foreach ($eval as $p) {
      $sumaparcial = ($p['originalityscript'] + $p['rythm'] + $p['length'] + $p['photography'] + $p['sound'] + $p['edition'] + $p['specialeffects'] + $p['iseffective'] + $p['plot'] + $p['convincing']+ $p['attractive'] + $p['place_viewer'] + $p['place_stimulate'] + $p['specific_green'] + $p['specific_csr'] + $p['specific_provide'] + $p['specific_portray'] + $p['discuss'] + $p['attention'] + $p['awareness'])/ 20;
      $suma += $sumaparcial;
    }
    if ($valoracions != 0) {
      $film[$i]['total'] = round($suma / $valoracions, 4);
    } else {
      $film[$i]['total'] = 0;
    }
    $i++;
  }
  $valorations = [];
  $max = 0;
  for ($i=0; $i < sizeof($film); $i++) {
    $valorations[] = $film[$i]['total'];
  }
  $db = NULL;
  arsort($valorations);
  $ordre = array_keys($valorations);
  $winners['primer'] = $film[$ordre[0]];
  $winners['segon'] = $film[$ordre[1]];
  return $winners;
});

///////
// Function to send HTML email
///////
Flight::map('htmlmail', function($name,$email,$password){

  $subject = "terres register confirmation";

  $htmlContent = '
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml" style="height: 100% !important; width: 100% !important; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; margin: 0 auto; padding: 0;">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="x-apple-disable-message-reformatting" />
  </head>
  <body width="100%" bgcolor="#FFFFFF" style="height: 100% !important; width: 100% !important; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; margin: 0 auto; padding: 0;">
    <style type="text/css">
      .button-td:hover { background: #555555 !important; border-color: #555555 !important; }
      .button-a:hover { background: #555555 !important; border-color: #555555 !important; }
    </style>
    <center style="width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #FFFFFF;">
      <div style="max-width: 680px; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; margin: auto;">
      <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto;">
        <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
          <td style="text-align: center; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 20px 0;" align="center">
            <img src="http://terres.info/img/logo-terres.png" width="200px" alt="Logo terres" border="0" style="font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; -ms-interpolation-mode: bicubic;" />
          </td>
        </tr>
      </table>
      <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto;">
        <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
          <td bgcolor="#ffffff" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important;">
            <img src="http://terres.info/img/Amp_MG_1390.jpg" width="680" height="" alt="Foto del delta del Ebro" border="0" align="center" style="width: 100% !important; max-width: 100% !important; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; -ms-interpolation-mode: bicubic; height: auto !important; margin-left: auto !important; margin-right: auto !important; background-color: #dddddd;" />
          </td>
        </tr>
        <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
          <td bgcolor="#ffffff" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important;">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto;">
              <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                <td style="text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 40px;" align="center">
                  <h3>Welcome <i>'.$name.'</i></h3>
                  <h4>Thanks for registering at terres Catalunya. To finish the process and upload your films, please access to the <a href="http://terres.info/login">intranet</a> with the following data</h4>
                </td>
              </tr>
              <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                <td style="text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 40px;" align="center">
                  <h3>Hola <i>'.$name.'</i></h3>
                  <h4>Gràcies per inscriure\'t a terres Catalunya. Per acabar el procés i poder pujar les teves pel·lícules, accedeix a la <a href="http://terres.info/login">intranet</a> amb les següents dades</h4>
                </td>
              </tr>
              <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                <td style="text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 40px;" align="center">
                  <h3>Hola <i>'.$name.'</i></h3>
                  <h4>Gracias por inscribirte en <strong>terres Catalunya</strong>.<br/>Para terminar el proceso y poder subir tus películas, accede a la <a href="http://terres.info/login">intranet</a> con los datos siguientes:</h4>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
          <td bgcolor="#ffffff" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important;">
            <table role="presentation" cellspacing="0" cellpadding="0" border="1px solid black" width="100%" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto;">
              <tr>
                <td style="padding:10px;background-color: #eceff1;"><strong>USER</strong></td>
                <td style="padding:10px;background-color: #eceff1;"><strong>PASSWORD</strong></td>
              </tr>
              <tr>
                <td style="padding:10px;">'.$email.'</td>
                <td style="padding:10px;">'.$password.'</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
          <td bgcolor="#ffffff" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important;">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto;">
              <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                <td style="text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 40px;" align="center">
                  <h4>Do you want to assist to terres LAB - Congress on Landscape, Tourism and Cinema? Take advantage of the special 20% reduction in the registration fee of terres LAB for all the producers submitting a film in terres Catalunya! In your intranet, you’ll find the link to the registration form.</h4>
                </td>
              </tr>
              <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                <td style="text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 40px;" align="center">
                  <h4>Vols assistir a terres LAB - Congrés sobre Paisatge, Turisme i Cinema? Aprofita el descompte especial del 20% en la taxa d\'inscripció a terres LAB per a tots els productors que presenten pel.lícules a terres Catalunya!<br>A la teva intranet trobaràs l’enllaç per formalitzar la inscripció.</h4>
                </td>
              </tr>
              <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                <td style="text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 40px;" align="center">
                  <h4>¿Quieres asistir a terres LAB, Congreso sobre Paisaje, Turismo y Cine? ¡Aprovecha el descuento especial del 20% en la tasa de inscripción a terres LAB para todos los productores que presentan películas a terres Catalunya! En tu intranet encontrarás el enlace para formalizar la inscripción.</h4>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto;">
        <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
          <td style="width: 100%; font-size: 14px; font-family: sans-serif; mso-height-rule: exactly; line-height: 18px; text-align: center; color: #888888; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 40px 10px;" align="center">
            <p>Thank you so much! / Moltes gràcies / ¡Muchas gracias!</p>
          </td>
        </tr>
      </table>
      <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto;">
        <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
          <td style="width: 100%; font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height: 18px; text-align: center; color: #888888; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 40px 10px;" align="center">
            FILMS NÒMADES GS, SL<br style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" /><span style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">Carrer Jaume I 44 entresòl 2a, 43870 Amposta, Tarragona, Spain</span><br style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" /><span style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">977 70 20 74</span>
          </td>
        </tr>
      </table>
      </div>
    </center>
  </body>
  </html>';

  // Set content-type header for sending HTML email
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  // Additional headers
  $headers .= 'From: terres International Film Festival <info@terres.info>' . "\r\n";
  $headers .= 'bcc: info@makeinapps.com' . "\r\n";

  // Send email
  if(mail($email,$subject,$htmlContent,$headers)):
    echo 'emailOK';
  else:
    echo 'emailKO';
  endif;
});

///////
// terres LAB mail
///////
Flight::map('terreslabmail', function($email){

  $subject = "terres LAB register confirmation";

  $htmlContent = '
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml" style="height: 100% !important; width: 100% !important; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; margin: 0 auto; padding: 0;">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="x-apple-disable-message-reformatting" />
  </head>
  <body width="100%" bgcolor="#FFFFFF" style="height: 100% !important; width: 100% !important; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; margin: 0 auto; padding: 0;">
    <style type="text/css">
      .button-td:hover { background: #555555 !important; border-color: #555555 !important; }
      .button-a:hover { background: #555555 !important; border-color: #555555 !important; }
    </style>
    <center style="width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #FFFFFF;">
      <div style="max-width: 680px; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; margin: auto;">
      <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto;">
        <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
          <td style="text-align: center; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 20px 0;" align="center">
            <img src="http://terres.info/img/terresLAB.png" width="200px" alt="Logo terres" border="0" style="font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; -ms-interpolation-mode: bicubic;" />
          </td>
        </tr>
      </table>
      <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto;">
        <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
          <td bgcolor="#ffffff" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important;">
            <img src="http://terres.info/img/tortosanocturn.jpg" width="680" height="" alt="Foto Tortosa" border="0" align="center" style="width: 100% !important; max-width: 100% !important; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; -ms-interpolation-mode: bicubic; height: auto !important; margin-left: auto !important; margin-right: auto !important; background-color: #dddddd;" />
          </td>
        </tr>
        <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
          <td bgcolor="#ffffff" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important;">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto;">
              <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                <td style="text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; color: #555555; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 40px;" align="center">
                  <h2>Gràcies per inscriure’t a terres LAB, Congrés sobre Paisatge, Turisme i Cinema.</h2>
                  <h2>Thanks for registering to terres LAB, Congress on Landscape, Tourism and Cinema.</h2>
                  <h2>Gracias por inscribirte en terres LAB, Congreso sobre Paisaje, Turismo y Cine.</h2>
                </td>
              </tr>
              <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                <td style="text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 40px;" align="center">
                  <h3>Estem elaborant el programa de terres LAB. En breu, rebràs un correu electrònic amb el programa.</h3>
                  <h3>We are competing the program of terres LAB. Soon, you will receive an e-mail with the program.</h3>
                  <h3>Estamos elaborando el programa de terres LAB. En breve, recibirás un correo electrónico con el programa.</h3>
                </td>
              </tr>
              <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                <td style="text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 40px;" align="center">
                  <h4>Vols allotjar-te a l’hotel on tindrà lloc terres LAB beneficiant-te d’una oferta especial del nostre partner?</h4>
                  <h4>Do you want to book a room in the hotel where terres LAB will take place? Benefit of our partner’s discount code!</h4>
                  <h4>¿Quieres alojarte en el hotel donde tendrá lugar terres LAB beneficiándote de una oferta especial de nuestro partner?</h4>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
          <td bgcolor="#ffffff" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important;">
            <table width="100%" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; margin: 0 auto;">
              <tr>
                <td style="text-align: center; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 20px 0;" align="center">
                  <a href="http://www.hotelcoronatortosa.com/bookingstep1/?idtokenprovider=100034427&lang=es&checkin=29%2F05%2F2017&nights=1&show_calendar=true&hsri=02040&bookinghost=&home=http%3A%2F%2Fwww.hotelcoronatortosa.com%2F&bookingpage=&clientCode=TERRESCAT&roomTypeId=&securepage=&maxNights=32&step=1#url=true" target="_blank"><img src="http://terres.info/img/patr_sbhotels.jpg" width="400px" alt="Logo terres" border="0" /></a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto;">
        <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
          <td style="width: 100%; font-size: 14px; font-family: sans-serif; mso-height-rule: exactly; line-height: 18px; text-align: center; color: #888888; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 40px 10px;" align="center">
            <p>Thank you so much! / Moltes gràcies / ¡Muchas gracias!</p>
          </td>
        </tr>
      </table>
      <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto;">
        <tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
          <td style="width: 100%; font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height: 18px; text-align: center; color: #888888; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; padding: 40px 10px;" align="center">
            FILMS NÒMADES GS, SL<br style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" /><span style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">Carrer Jaume I 44 entresòl 2a, 43870 Amposta, Tarragona, Spain</span><br style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" /><span style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">977 70 20 74</span>
          </td>
        </tr>
      </table>
      </div>
    </center>
  </body>
  </html>';

  // Set content-type header for sending HTML email
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  // Additional headers
  $headers .= 'From: terres International Film Festival <info@terres.info>' . "\r\n";

  // Send email
  if(mail($email,$subject,$htmlContent,$headers)):
    echo 'emailOK';
  else:
    echo 'emailKO';
  endif;
});

///////
// List all competitors
///////
Flight::route('GET /', function(){
  $db = Flight::db();

  $sql = "SELECT id,fullName,comName,country,factura,numfactura,firstEnter FROM competitors ORDER BY id";
  $comp = $db->prepare($sql);
  $comp->execute();
  $comps = [];
  while ($c = $comp->fetch(PDO::FETCH_ASSOC)) {
    $comps[] = $c;
  }

  $db = NULL;

  Flight::json($comps);
});

///////
// Get 1 competitor
///////
Flight::route('GET /competitor/@id', function($id){
  $db = Flight::db();

  $sql = "SELECT * FROM competitors WHERE id = :id";
  $comp = $db->prepare($sql);
  $comp->bindParam(':id', $id);
  $comp->execute();
  $c = $comp->fetch(PDO::FETCH_ASSOC);

  $sql = "SELECT id,nfilms FROM corporate WHERE user = :id";
  $comp = $db->prepare($sql);
  $comp->bindParam(':id', $id);
  $comp->execute();
  $c['corporate'] = $comp->fetch(PDO::FETCH_ASSOC);

  $sql = "SELECT id,nfilms FROM documentary WHERE user = :id";
  $comp = $db->prepare($sql);
  $comp->bindParam(':id', $id);
  $comp->execute();
  $c['documentary'] = $comp->fetch(PDO::FETCH_ASSOC);

  $sql = "SELECT id,nfilms FROM tourism WHERE user = :id";
  $comp = $db->prepare($sql);
  $comp->bindParam(':id', $id);
  $comp->execute();
  $c['tourism'] = $comp->fetch(PDO::FETCH_ASSOC);

  $sql = "SELECT id,title,section FROM corporatefilms WHERE id_cat_user = :user";
  $comp = $db->prepare($sql);
  $comp->bindParam(':user', $c['corporate']['id']);
  $comp->execute();
  $title = [];
  while ($t = $comp->fetch(PDO::FETCH_ASSOC)) {
    $title[] = $t;
  }
  $c['corporate']['title'] = $title;
  // $c['corporate']['title']['title'] = stripslashes($c['corporate']['title']['title']);

  $sql = "SELECT id,title,section FROM documentaryfilms WHERE id_cat_user = :user";
  $comp = $db->prepare($sql);
  $comp->bindParam(':user', $c['documentary']['id']);
  $comp->execute();
  $title = [];
  while ($t = $comp->fetch(PDO::FETCH_ASSOC)) {
    $title[] = $t;
  }
  $c['documentary']['title'] = $title;
  // $c['documentary']['title']['title'] = stripslashes($c['documentary']['title']['title']);

  $sql = "SELECT id,title,section FROM tourismfilms WHERE id_cat_user = :user";
  $comp = $db->prepare($sql);
  $comp->bindParam(':user', $c['tourism']['id']);
  $comp->execute();
  $title = [];
  while ($t = $comp->fetch(PDO::FETCH_ASSOC)) {
    $title[] = $t;
  }
  $c['tourism']['title'] = $title;
  // $c['tourism']['title']['title'] = stripslashes($c['tourism']['title']['title']);

  $db = NULL;

  Flight::json($c);
});

///////
// Add new competitor
///////
Flight::route('POST /', function(){
  $db = Flight::db();

  ///////
  // Function to generate a random password at registry
  ///////
  function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789,.()=*/@#-_{}";
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
    }
    return implode($pass);
  }

  $dades = file_get_contents('php://input');
  $dades = json_decode($dades,true);

  $sql = "INSERT INTO competitors ";
  $fields = '';
  $values = '';
  $newpass = randomPassword();
  foreach ($dades as $key=>$value) {
    $fields = $fields.$key.',';
    $values = $values.'"'.$value.'",';
  }
  $fields = $fields.'password';
  $values = $values.'"'.$newpass.'"';

  $sql = $sql.'('.$fields.') VALUES ('.$values.')';
  $insert = $db->prepare($sql);

  $res = -1;

  if ($insert->execute()) {
    $res = $db->lastInsertId();
    $mail = Flight::htmlmail($dades['fullName'],$dades['email'],$newpass);
  } else {
    $res = 0;
  }

  print_r($res);

  $db = NULL;
});

///////
// List all members registered to terres LAB
///////
Flight::route('GET /terreslab', function(){
  $db = Flight::db();

  $sql = "SELECT id,nom,cognoms,email,ciutat,pais,categoria FROM terreslab";
  $comp = $db->prepare($sql);
  $comp->execute();
  $comps = [];
  while ($c = $comp->fetch(PDO::FETCH_ASSOC)) {
    $comps[] = $c;
  }

  $db = NULL;

  Flight::json($comps);
});

///////
// List selected member registered to terres LAB
///////
Flight::route('GET /terreslab/@id', function($id){
  $db = Flight::db();

  $sql = "SELECT * FROM terreslab WHERE id = :id";
  $comp = $db->prepare($sql);
  $comp->bindParam(':id', $id);
  $comp->execute();
  $c = $comp->fetch(PDO::FETCH_ASSOC);

  $db = NULL;

  Flight::json($c);
});

///////
// Delete selected member registered to terres LAB
///////
Flight::route('DELETE /terreslab/@id', function($id){
  $db = Flight::db();

  $sql = "DELETE FROM terreslab WHERE id = :id";
  $comp = $db->prepare($sql);
  $comp->bindParam(':id', $id);
  $comp->execute();
  if ($comp->rowCount() > 0) {
    $header = 200;
    $res = "Usuari eliminat correctament";
  } else {
    $header = 404;
    $res = "L'usuari ja no existeix";
  }

  $db = NULL;

  Flight::json($res,$header);
});

///////
// Resend and password reset
///////
Flight::route('/resend/@id', function($id){

  ///////
  // Function to generate a random password at registry
  ///////
  function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789.()=*/@#-_{}";
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
    }
    return implode($pass);
  }

  $db = Flight::db();

  $sql = "SELECT fullName,email FROM competitors WHERE id = :id";
  $comp = $db->prepare($sql);
  $comp->bindParam(':id', $id);
  $comp->execute();
  $c = $comp->fetch(PDO::FETCH_ASSOC);
  $name = $c['fullName'];
  $email = $c['email'];
  $password = randomPassword();

  $sql = "UPDATE competitors SET password = :p, firstEnter = 1 WHERE id = :id";
  $reset = $db->prepare($sql);
  $reset->bindParam(':p', $password);
  $reset->bindParam(':id', $id);
  if ($reset->execute()) {
    $mail = Flight::htmlmail($name,$email,$password);
    print_r(' a l\'adreça '.$email);
  } else {
    print_r("Error amb base de dades");
  }

  $db = NULL;
});

///////
// Get info for a film
///////
Flight::route('GET /film/@cat/@id', function($cat,$id){
  $db = Flight::db();

  switch ($cat) {
    case "doc":
        $sql = "SELECT * FROM documentaryfilms WHERE id = :id";
        break;
    case "corp":
        $sql = "SELECT * FROM corporatefilms WHERE id = :id";
        break;
    case "tour":
        $sql = "SELECT * FROM tourismfilms WHERE id = :id";
        break;
  }

  $film = $db->prepare($sql);
  $film->bindParam(':id', $id);
  $film->execute();
  $f = $film->fetch(PDO::FETCH_ASSOC);

  $db = NULL;

  Flight::json($f);
});

///////
// Upload film
///////
Flight::route('/upload/@table/@id', function($table, $id) {
  $data = [];

  $name = $_FILES['file']['name'];
  $tmp = $_FILES['file']['tmp_name'];
  $url = $_SERVER['DOCUMENT_ROOT'].'/intranet/film/'.$name;
  try {
    move_uploaded_file($tmp,$url);
  } catch (Exception $e) {
    print_r($e);
  }

  $db = Flight::db();
  $sql = "UPDATE $table SET film=:film WHERE id=:id";
  $upload = $db->prepare($sql);
  $upload->bindParam(':film', $name);
  $upload->bindParam(':id', $id);

  if ($upload->execute()) {
    $data['status'] = 200;
    $data['message'] = 'Film upload successfull';
  }

  Flight::json($data);

  $db = NULL;
});

///////
// Add film to user
///////
Flight::route('POST /addfilm/@table/@id/@f', function($table, $id, $f) {
  $data = [];

  $film = file_get_contents('php://input');
  $film = json_decode($film, true);

  $db = Flight::db();

  if (isset($film['section'])) {
    $section = $film['section'];
  } else {
    $section = 1;
  }
  if (isset($film['titledoc'])) {
    $title = addslashes($film['titledoc']);
  } else if (isset($film['titletour'])) {
    $title = addslashes($film['titletour']);
  } else if (isset($film['titlecorp'])) {
    $title = addslashes($film['titlecorp']);
  }

  $tablefilm = $table.'films';

  if ($f == 'true') {
    $sql = "SELECT id FROM $table WHERE user = :id";
    $query = $db->prepare($sql);
    $query->bindParam(':id', $id);
    $query->execute();
    $res = $query->fetch(PDO::FETCH_ASSOC);
    $catid = $res['id'];
  } else {
    $sql = "SELECT id,nfilms FROM $table WHERE user = :id";
    $query = $db->prepare($sql);
    $query->bindParam(':id', $id);
    $query->execute();
    if ($query->rowCount() > 0) {
      $res = $query->fetch(PDO::FETCH_ASSOC);
      $catid = $res['id'];
      $nfilms = $res['nfilms'] + 1;
      $sql = "UPDATE $table SET nfilms=:nfilms WHERE id=:id";
      $query = $db->prepare($sql);
      $query->bindParam(':nfilms', $nfilms);
      $query->bindParam(':id', $catid);
      $query->execute();
    } else {
      $sql = "INSERT INTO $table (user,nfilms,date) VALUES (:user,1,CURDATE())";
      $query = $db->prepare($sql);
      $query->bindParam(':user', $id);
      $query->execute();
      $catid = $db->lastInsertId();
    }
  }

  $sql = "INSERT INTO $tablefilm (id_cat_user,section,title) VALUES (:catid,:section,:title)";
  $query = $db->prepare($sql);
  $query->bindParam(':catid', $catid);
  $query->bindParam(':title', $title);
  $query->bindParam(':section', $section);
  if ($query->execute()) {
    $data['status'] = 200;
  }

  $db = NULL;

  Flight::json($data);
});

///////
// Edit user payment fields
///////
Flight::route('POST /saveuser', function() {
  $data = file_get_contents('php://input');
  $data = json_decode($data, true);

  $db = Flight::db();

  $sql = "UPDATE competitors SET payment=:payment, factura=:factura, numfactura=:numfactura WHERE id=:id";
  $query = $db->prepare($sql);
  $query->bindParam(':payment', $data['payment']);
  $query->bindParam(':factura', $data['factura']);
  $query->bindParam(':numfactura', $data['numfactura']);
  $query->bindParam(':id', $data['id']);
  if ($query->execute()) {
    $response['status'] = 200;
  } else {
    $response['status'] = 500;
  }

  Flight::json($response);

  $db = NULL;
});

///////
// Edit user fields
///////
Flight::route('POST /modifyuser', function() {
  $data = file_get_contents('php://input');
  $data = json_decode($data, true);

  print_r($data);

  $db = Flight::db();

  $sql = "UPDATE competitors SET fullName=:fullName, comName=:comName, vat=:vat, address=:address, zip=:zip, country=:country, phone=:phone, email=:email, website=:website, facebook=:facebook WHERE id=:id";
  $query = $db->prepare($sql);
  $query->bindParam(':fullName', $data['fullName']);
  $query->bindParam(':comName', $data['comName']);
  $query->bindParam(':vat', $data['vat']);
  $query->bindParam(':address', $data['address']);
  $query->bindParam(':zip', $data['zip']);
  $query->bindParam(':country', $data['country']);
  $query->bindParam(':phone', $data['phone']);
  $query->bindParam(':email', $data['email']);
  $query->bindParam(':website', $data['website']);
  $query->bindParam(':facebook', $data['facebook']);
  $query->bindParam(':id', $data['id']);
  if ($query->execute()) {
    $response['status'] = 200;
  } else {
    $response['status'] = 500;
  }

  Flight::json($response);

  $db = NULL;
});

///////
// Edit user registered to Terres Lab
///////
Flight::route('POST /modifyassistent', function() {
  $data = file_get_contents('php://input');
  $data = json_decode($data, true);

  print_r($data);

  $db = Flight::db();

  $sql = "UPDATE terreslab SET nom=:nom, cognoms=:cognoms, email=:email, direccio=:direccio, ciutat=:ciutat, pais=:pais, categoria=:categoria, institucio=:institucio WHERE id=:id";
  $query = $db->prepare($sql);
  $query->bindParam(':nom', $data['nom']);
  $query->bindParam(':cognoms', $data['cognoms']);
  $query->bindParam(':email', $data['email']);
  $query->bindParam(':direccio', $data['direccio']);
  $query->bindParam(':ciutat', $data['ciutat']);
  $query->bindParam(':pais', $data['pais']);
  $query->bindParam(':categoria', $data['categoria']);
  $query->bindParam(':institucio', $data['institucio']);
  $query->bindParam(':id', $data['id']);
  if ($query->execute()) {
    $response['status'] = 200;
  } else {
    $response['status'] = 500;
  }

  Flight::json($response);

  $db = NULL;
});

///////
// Edit tourism film fields
///////
Flight::route('POST /modifytourfilm', function() {
  $data = file_get_contents('php://input');
  $data = json_decode($data, true);

  print_r($data);

  $db = Flight::db();

  $sql = "UPDATE tourismfilms SET ";
  $sql = $sql."title=:title,";
  $sql = $sql."synopsi=:synopsi,";
  $sql = $sql."director=:director,";
  $sql = $sql."producer=:producer,";
  if (isset($data['screenshot1']['base64'])) {
    $sql = $sql."screenshot1=:screenshot1,";
    $sql = $sql."screenshot1Type=:screenshot1Type,";
  }
  if (isset($data['screenshot2']['base64'])) {
    $sql = $sql."screenshot2=:screenshot2,";
    $sql = $sql."screenshot2Type=:screenshot2Type,";
  }
  if (isset($data['screenshot3']['base64'])) {
    $sql = $sql."screenshot3=:screenshot3,";
    $sql = $sql."screenshot3Type=:screenshot3Type,";
  }
  $sql = $sql."travel=:travel,";
  $sql = $sql."cultural=:cultural,";
  $sql = $sql."sports=:sports,";
  $sql = $sql."expedition=:expedition,";
  $sql = $sql."hotels=:hotels,";
  $sql = $sql."events=:events,";
  $sql = $sql."health=:health,";
  $sql = $sql."rural=:rural,";
  $sql = $sql."naturaltour=:naturaltour,";
  $sql = $sql."enotourism=:enotourism,";
  $sql = $sql."destinations=:destinations,";
  $sql = $sql."animation=:animation,";
  $sql = $sql."filmduration=:filmduration,";
  $sql = $sql."translate=:translate";
  $sql = $sql." WHERE id=:id";
  $query = $db->prepare($sql);
  $query->bindParam(':title', $data['title']);
  $query->bindParam(':synopsi', $data['synopsi']);
  $query->bindParam(':director', $data['director']);
  $query->bindParam(':producer', $data['producer']);
  if (isset($data['screenshot1']['base64'])) {
    $query->bindParam(':screenshot1', $data['screenshot1']['base64']);
    $query->bindParam(':screenshot1Type', $data['screenshot1']['filetype']);
  }
  if (isset($data['screenshot2']['base64'])) {
    $query->bindParam(':screenshot2', $data['screenshot2']['base64']);
    $query->bindParam(':screenshot2Type', $data['screenshot2']['filetype']);
  }
  if (isset($data['screenshot3']['base64'])) {
    $query->bindParam(':screenshot3', $data['screenshot3']['base64']);
    $query->bindParam(':screenshot3Type', $data['screenshot3']['filetype']);
  }
  $query->bindParam(':travel', $data['travel']);
  $query->bindParam(':cultural', $data['cultural']);
  $query->bindParam(':sports', $data['sports']);
  $query->bindParam(':expedition', $data['expedition']);
  $query->bindParam(':hotels', $data['hotels']);
  $query->bindParam(':events', $data['events']);
  $query->bindParam(':health', $data['health']);
  $query->bindParam(':rural', $data['rural']);
  $query->bindParam(':naturaltour', $data['naturaltour']);
  $query->bindParam(':enotourism', $data['enotourism']);
  $query->bindParam(':destinations', $data['destinations']);
  $query->bindParam(':animation', $data['animation']);
  $query->bindParam(':id', $data['id']);
  $query->bindParam(':filmduration', $data['filmduration']);
  $query->bindParam(':translate', $data['translate']);
  if ($query->execute()) {
    $response['status'] = 200;
  } else {
    $response['status'] = 500;
  }

  Flight::json($response);

  $db = NULL;
});

///////
// Edit documentary film fields
///////
Flight::route('POST /modifydocfilm', function() {
  $data = file_get_contents('php://input');
  $data = json_decode($data, true);

  print_r($data);

  $db = Flight::db();

  $sql = "UPDATE documentaryfilms SET ";
  $sql = $sql."title=:title,";
  $sql = $sql."synopsi=:synopsi,";
  $sql = $sql."director=:director,";
  $sql = $sql."producer=:producer,";
  $sql = $sql."filmduration=:filmduration,";
  $sql = $sql."translate=:translate,";
  if (isset($data['screenshot1']['base64'])) {
    $sql = $sql."screenshot1=:screenshot1,";
    $sql = $sql."screenshot1Type=:screenshot1Type,";
  }
  if (isset($data['screenshot2']['base64'])) {
    $sql = $sql."screenshot2=:screenshot2,";
    $sql = $sql."screenshot2Type=:screenshot2Type,";
  }
  if (isset($data['screenshot3']['base64'])) {
    $sql = $sql."screenshot3=:screenshot3,";
    $sql = $sql."screenshot3Type=:screenshot3Type,";
  }
  $sql = rtrim($sql, ',');
  $sql = $sql." WHERE id=:id";
  $query = $db->prepare($sql);
  $query->bindParam(':title', $data['title']);
  $query->bindParam(':synopsi', $data['synopsi']);
  $query->bindParam(':director', $data['director']);
  $query->bindParam(':producer', $data['producer']);
  $query->bindParam(':filmduration', $data['filmduration']);
  $query->bindParam(':translate', $data['translate']);
  if (isset($data['screenshot1']['base64'])) {
    $query->bindParam(':screenshot1', $data['screenshot1']['base64']);
    $query->bindParam(':screenshot1Type', $data['screenshot1']['filetype']);
  }
  if (isset($data['screenshot2']['base64'])) {
    $query->bindParam(':screenshot2', $data['screenshot2']['base64']);
    $query->bindParam(':screenshot2Type', $data['screenshot2']['filetype']);
  }
  if (isset($data['screenshot3']['base64'])) {
    $query->bindParam(':screenshot3', $data['screenshot3']['base64']);
    $query->bindParam(':screenshot3Type', $data['screenshot3']['filetype']);
  }
  $query->bindParam(':id', $data['id']);
  if ($query->execute()) {
    $response['status'] = 200;
  } else {
    $response['status'] = 500;
  }

  Flight::json($response);

  $db = NULL;
});

///////
// Edit corporate film fields
///////
Flight::route('POST /modifycorpfilm', function() {
  $data = file_get_contents('php://input');
  $data = json_decode($data, true);

  print_r($data);

  $db = Flight::db();

  $sql = "UPDATE corporatefilms SET ";
  $sql = $sql."title=:title,";
  $sql = $sql."synopsi=:synopsi,";
  $sql = $sql."director=:director,";
  $sql = $sql."producer=:producer,";
  $sql = $sql."filmduration=:filmduration,";
  $sql = $sql."translate=:translate,";
  if (isset($data['screenshot1']['base64'])) {
    $sql = $sql."screenshot1=:screenshot1,";
    $sql = $sql."screenshot1Type=:screenshot1Type,";
  }
  if (isset($data['screenshot2']['base64'])) {
    $sql = $sql."screenshot2=:screenshot2,";
    $sql = $sql."screenshot2Type=:screenshot2Type,";
  }
  if (isset($data['screenshot3']['base64'])) {
    $sql = $sql."screenshot3=:screenshot3,";
    $sql = $sql."screenshot3Type=:screenshot3Type,";
  }
  $sql = rtrim($sql, ',');
  $sql = $sql." WHERE id=:id";
  $query = $db->prepare($sql);
  $query->bindParam(':title', $data['title']);
  $query->bindParam(':synopsi', $data['synopsi']);
  $query->bindParam(':director', $data['director']);
  $query->bindParam(':producer', $data['producer']);
  $query->bindParam(':filmduration', $data['filmduration']);
  $query->bindParam(':translate', $data['translate']);
  if (isset($data['screenshot1']['base64'])) {
    $query->bindParam(':screenshot1', $data['screenshot1']['base64']);
    $query->bindParam(':screenshot1Type', $data['screenshot1']['filetype']);
  }
  if (isset($data['screenshot2']['base64'])) {
    $query->bindParam(':screenshot2', $data['screenshot2']['base64']);
    $query->bindParam(':screenshot2Type', $data['screenshot2']['filetype']);
  }
  if (isset($data['screenshot3']['base64'])) {
    $query->bindParam(':screenshot3', $data['screenshot3']['base64']);
    $query->bindParam(':screenshot3Type', $data['screenshot3']['filetype']);
  }
  $query->bindParam(':id', $data['id']);
  if ($query->execute()) {
    $response['status'] = 200;
  } else {
    $response['status'] = 500;
  }

  Flight::json($response);

  $db = NULL;
});

///////
// Register to terres LAB
///////
Flight::route('/addterreslab', function(){
    $db = Flight::db();
    $data = [];

    $dades = file_get_contents('php://input');
    $dades = mb_convert_encoding($dades, 'HTML-ENTITIES', "UTF-8");

    $post = json_decode($dades,true);

    $sql = "INSERT INTO terreslab(nom, cognoms, email, direccio, ciutat, pais, categoria) VALUES (:nom, :cognoms, :email, :direccio, :ciutat, :pais, :categoria)";

    $new = $db->prepare($sql);
    $new->bindParam(':nom', $post['nom']);
    $new->bindParam(':cognoms', $post['cognoms']);
    $new->bindParam(':email', $post['email']);
    $new->bindParam(':direccio', $post['direccio']);
    $new->bindParam(':ciutat', $post['city']);
    $new->bindParam(':pais', $post['country']);
    $new->bindParam(':categoria', $post['categoria']);

    if ($new->execute()) {
      $data['status'] = 200;
      $data['message'] = $post;
      $mail = Flight::terreslabmail($post['email']);
    } else {
      $data['status'] = 400;
      $data['message'] = 'Unknown error';
    }

    $db = NULL;

    Flight::json($data);
});

///////
// List all films by section
///////
Flight::route('GET /films', function(){
  $db = Flight::db();

  $films = [];

  $sql = "SELECT corporatefilms.id, competitors.fullName, director, title, translate, filmduration FROM corporatefilms LEFT JOIN corporate ON corporatefilms.id_cat_user = corporate.id LEFT JOIN competitors ON corporate.user = competitors.id";
  $q = $db->prepare($sql);
  $q->execute();
  $corporate = [];
  while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
    $corporate[] = $row;
  }

  $films['corporate'] = $corporate;

  $sql = "SELECT documentaryfilms.id, competitors.fullName, director, title, translate, filmduration FROM documentaryfilms LEFT JOIN documentary ON documentaryfilms.id_cat_user = documentary.id LEFT JOIN competitors ON documentary.user = competitors.id";
  $q = $db->prepare($sql);
  $q->execute();
  $documentary = [];
  while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
    $documentary[] = $row;
  }

  $films['documentary'] = $documentary;

  $sql = "SELECT tourismfilms.id, competitors.fullName, director, title, translate, filmduration FROM tourismfilms LEFT JOIN tourism ON tourismfilms.id_cat_user = tourism.id LEFT JOIN competitors ON tourism.user = competitors.id";
  $q = $db->prepare($sql);
  $q->execute();
  $tourism = [];
  while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
    $tourism[] = $row;
  }

  $films['tourism'] = $tourism;

  $db = NULL;

  Flight::json($films);
});

///////
// Create jury users
///////
Flight::route('POST /memberjury', function(){
  $db = Flight::db();
  $post = file_get_contents('php://input');
  $post = json_decode($post, true);

  $sql = "INSERT INTO jury(name, email, password) VALUES (:name,:email,:password)";
  $q = $db->prepare($sql);
  $q->bindParam(':name', $post['name']);
  $q->bindParam(':email', $post['email']);
  $q->bindParam(':password', $post['password']);
  if ($q->execute()) {
    $message = 'Usuari creat satisfactòriament';
    $header = 200;
  } else {
    $message = 'Hi ha hagut un problema, contacta amb Jordi ;-)';
    $header = 500;
  }

  $db = NULL;

  Flight::json($message,$header);
});

///////
// Get all jury members
///////
Flight::route('GET /memberjury', function(){
  $db = Flight::db();

  $sql = "SELECT * FROM jury ORDER BY id";
  $q = $db->prepare($sql);
  $q->execute();
  $members = [];
  while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
    $members[] = $row;
  }

  $db = NULL;

  Flight::json($members);
});

///////
// Get films valoration by category
///////
Flight::route('GET /valoration', function(){
  $db = Flight::db();

  $films = [];

  /*
      GET TOURISM FILM VALORATIONS
  */

  $sql = "SELECT tourismfilms.id, competitors.fullName, title, director FROM tourismfilms LEFT JOIN tourism ON tourismfilms.id_cat_user = tourism.id LEFT JOIN competitors ON tourism.user = competitors.id ORDER BY tourismfilms.id";
  $q = $db->prepare($sql);
  $q->execute();
  $tourism = [];
  while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
    $tourism[] = $row;
  }
  $films['tourism'] = $tourism;
  $index = 0;
  foreach ($films['tourism'] as $film) {
    $sql = "SELECT jury.name, jury, film, originalityscript, rythm, length, photography, sound, edition, specialeffects, iseffective, plot, convincing, attractive, place_viewer, place_stimulate, specific_sell, specific_clear, specific_provide, specific_focus, specific_promote, discuss, attention, awareness FROM evaluation_tourism LEFT JOIN jury ON evaluation_tourism.jury = jury.id WHERE film = :id";
    $q = $db->prepare($sql);
    $q->bindParam(':id', $film['id']);
    $q->execute();
    $eval = [];
    while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
      $eval[] = $row;
    }
    $films['tourism'][$index]['jury'] = $eval;
    $suma = 0;
    $valoracions = count($eval);
    $idjury = 0;
    foreach ($eval as $p) {
      $sumaparcial = ($p['originalityscript'] + $p['rythm'] + $p['length'] + $p['photography'] + $p['sound'] + $p['edition'] + $p['specialeffects'] + $p['iseffective'] + $p['plot'] + $p['convincing']+ $p['attractive'] + $p['place_viewer'] + $p['place_stimulate'] + $p['specific_sell'] + $p['specific_clear'] + $p['specific_provide'] + $p['specific_focus'] + $p['specific_promote'] + $p['discuss'] + $p['attention'] + $p['awareness'])/ 21;
      $films['tourism'][$index]['jury'][$idjury]['total'] = $sumaparcial;
      $suma += $sumaparcial;
      $idjury++;
    }
    if ($valoracions != 0) {
      $films['tourism'][$index]['total'] = round($suma / $valoracions, 4);
    } else {
      $films['tourism'][$index]['total'] = 0;
    }
    $index++;
  }

  /*
      GET CORPORATE FILM VALORATIONS
  */

  $sql = "SELECT corporatefilms.id, competitors.fullName, title, director FROM corporatefilms LEFT JOIN corporate ON corporatefilms.id_cat_user = corporate.id LEFT JOIN competitors ON corporate.user = competitors.id ORDER BY corporatefilms.id";
  $q = $db->prepare($sql);
  $q->execute();
  $corporate = [];
  while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
    $corporate[] = $row;
  }
  $films['corporate'] = $corporate;
  $index = 0;
  foreach ($films['corporate'] as $film) {
    $sql = "SELECT jury.name, jury, film, originalityscript, rythm, length, photography, sound, edition, specialeffects, iseffective, plot, convincing, attractive, place_viewer, place_stimulate, specific_green, specific_csr, specific_provide, specific_portray, discuss, attention, awareness FROM evaluation_corporate LEFT JOIN jury ON evaluation_corporate.jury = jury.id WHERE film = :id";
    $q = $db->prepare($sql);
    $q->bindParam(':id', $film['id']);
    $q->execute();
    $eval = [];
    while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
      $eval[] = $row;
    }
    $films['corporate'][$index]['jury'] = $eval;
    $suma = 0;
    $valoracions = count($eval);
    $idjury = 0;
    foreach ($eval as $p) {
      $sumaparcial = ($p['originalityscript'] + $p['rythm'] + $p['length'] + $p['photography'] + $p['sound'] + $p['edition'] + $p['specialeffects'] + $p['iseffective'] + $p['plot'] + $p['convincing']+ $p['attractive'] + $p['place_viewer'] + $p['place_stimulate'] + $p['specific_green'] + $p['specific_csr'] + $p['specific_provide'] + $p['specific_portray'] + $p['discuss'] + $p['attention'] + $p['awareness'])/ 20;
      $films['corporate'][$index]['jury'][$idjury]['total'] = $sumaparcial;
      $suma += $sumaparcial;
      $idjury++;
    }
    if ($valoracions != 0) {
      $films['corporate'][$index]['total'] = round($suma / $valoracions, 4);
    } else {
      $films['corporate'][$index]['total'] = 0;
    }
    $index++;
  }

  /*
      GET DOCUMENTARY FILM VALORATIONS
  */

  $sql = "SELECT documentaryfilms.id, competitors.fullName, title, director FROM documentaryfilms LEFT JOIN documentary ON documentaryfilms.id_cat_user = documentary.id LEFT JOIN competitors ON documentary.user = competitors.id ORDER BY documentaryfilms.id";
  $q = $db->prepare($sql);
  $q->execute();
  $documentary = [];
  while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
    $documentary[] = $row;
  }
  $films['documentary'] = $documentary;
  $index = 0;
  foreach ($films['documentary'] as $film) {
    $sql = "SELECT jury.name, jury, film, originalityscript, rythm, length, photography, sound, edition, specialeffects, iseffective, plot, convincing, attractive, place_viewer, place_stimulate, specific_travel, specific_sustain, specific_narrative, specific_focus, specific_reflection, specific_suggest, discuss, attention, awareness FROM evaluation_documentary LEFT JOIN jury ON evaluation_documentary.jury = jury.id WHERE film = :id";
    $q = $db->prepare($sql);
    $q->bindParam(':id', $film['id']);
    $q->execute();
    $eval = [];
    while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
      $eval[] = $row;
    }
    $films['documentary'][$index]['jury'] = $eval;
    $suma = 0;
    $valoracions = count($eval);
    $idjury = 0;
    foreach ($eval as $p) {
      $sumaparcial = ($p['originalityscript'] + $p['rythm'] + $p['length'] + $p['photography'] + $p['sound'] + $p['edition'] + $p['specialeffects'] + $p['iseffective'] + $p['plot'] + $p['convincing']+ $p['attractive'] + $p['place_viewer'] + $p['place_stimulate'] + $p['specific_travel'] + $p['specific_sustain'] + $p['specific_narrative'] + $p['specific_focus'] + $p['specific_reflection'] + $p['specific_suggest'] + $p['discuss'] + $p['attention'] + $p['awareness'])/ 22;
      $films['documentary'][$index]['jury'][$idjury]['total'] = $sumaparcial;
      $suma += $sumaparcial;
      $idjury++;
    }
    if ($valoracions != 0) {
      $films['documentary'][$index]['total'] = round($suma / $valoracions, 4);
    } else {
      $films['documentary'][$index]['total'] = 0;
    }
    $index++;
  }

  $db = NULL;

  Flight::json($films);
});

///////
// List all members registered to Sustainable Day
///////
Flight::route('GET /sustainable', function(){
  $db = Flight::db();

  $sql = "SELECT * FROM sustain";
  $comp = $db->prepare($sql);
  $comp->execute();
  $comps = [];
  while ($c = $comp->fetch(PDO::FETCH_ASSOC)) {
    $comps[] = $c;
  }

  $db = NULL;

  Flight::json($comps);
});

///////
// Delete selected member registered to Sustainable Day
///////
Flight::route('DELETE /sustainable/@id', function($id){
  $db = Flight::db();

  $sql = "DELETE FROM sustain WHERE id = :id";
  $comp = $db->prepare($sql);
  $comp->bindParam(':id', $id);
  $comp->execute();
  if ($comp->rowCount() > 0) {
    $header = 200;
    $res = "Usuari eliminat correctament";
  } else {
    $header = 404;
    $res = "L'usuari ja no existeix";
  }

  $db = NULL;

  Flight::json($res,$header);
});

///////
// Add to Sustainable Day
///////
Flight::route('POST /sustainable', function(){
  $db = Flight::db();
  $data = [];

  $dades = file_get_contents('php://input');
  $dades = mb_convert_encoding($dades, 'HTML-ENTITIES', "UTF-8");

  $post = json_decode($dades,true);

  ///////
  // Check if user is registered
  ///////
  $sql = "SELECT id FROM sustain WHERE email = :email LIMIT 1";
  $check = $db->prepare($sql);
  $check->bindParam(':email', $post['email']);
  $check->execute();
  $count = $check->rowCount();

  if ($count === 0){
    if (isset($post['comentaris'])) {
      $sql = "INSERT INTO sustain(nom, cognoms, email, direccio, ciutat, pais, comentaris) VALUES (:nom, :cognoms, :email, :direccio, :ciutat, :pais, :comentaris)";
    } else {
      $sql = "INSERT INTO sustain(nom, cognoms, email, direccio, ciutat, pais) VALUES (:nom, :cognoms, :email, :direccio, :ciutat, :pais)";
    }


    $new = $db->prepare($sql);
    $new->bindParam(':nom', $post['nom']);
    $new->bindParam(':cognoms', $post['cognoms']);
    $new->bindParam(':email', $post['email']);
    $new->bindParam(':direccio', $post['direccio']);
    $new->bindParam(':ciutat', $post['city']);
    $new->bindParam(':pais', $post['country']);
    if (isset($post['comentaris'])) {
      $new->bindParam(':comentaris', $post['comentaris']);
    }

    try {
      if ($new->execute()) {
        $data['status'] = 200;
        $data['message'] = 'User created succesfully';
      } else {
        $data['status'] = 400;
        $data['message'] = 'Unknown error';
      }
    } catch (Exception $e) {
      echo 'Exception: ',  $e->getMessage();
    }
  } else {
    $data['status'] = 404;
    $data['message'] = 'User exist';
  }

  $db = NULL;

  Flight::json($data);
});

///////
// List selected member registered to Sustainable day
///////
Flight::route('GET /sustainable/@id', function($id){
  $db = Flight::db();

  $sql = "SELECT * FROM sustain WHERE id = :id";
  $comp = $db->prepare($sql);
  $comp->bindParam(':id', $id);
  $comp->execute();
  $c = $comp->fetch(PDO::FETCH_ASSOC);

  $db = NULL;

  Flight::json($c);
});

///////
// Edit user registered to Sustainable day
///////
Flight::route('POST /modifysustain', function() {
  $data = file_get_contents('php://input');
  $data = json_decode($data, true);

  print_r($data);

  $db = Flight::db();

  $sql = "UPDATE sustain SET nom=:nom, cognoms=:cognoms, email=:email, direccio=:direccio, ciutat=:ciutat, pais=:pais, comentaris=:comentaris WHERE id=:id";
  $query = $db->prepare($sql);
  $query->bindParam(':nom', $data['nom']);
  $query->bindParam(':cognoms', $data['cognoms']);
  $query->bindParam(':email', $data['email']);
  $query->bindParam(':direccio', $data['direccio']);
  $query->bindParam(':ciutat', $data['ciutat']);
  $query->bindParam(':pais', $data['pais']);
  $query->bindParam(':comentaris', $data['comentaris']);
  $query->bindParam(':id', $data['id']);
  if ($query->execute()) {
    $response['status'] = 200;
  } else {
    $response['status'] = 500;
  }

  Flight::json($response);

  $db = NULL;
});

///////
// Get all tourfilm valorations by film
///////
Flight::route('GET /valtourfilm/@id', function($id) {
  $db = Flight::db();

  $sql = "SELECT tourismfilms.title, jury.name, evaluation_tourism.* FROM evaluation_tourism LEFT JOIN jury ON evaluation_tourism.jury = jury.id LEFT JOIN tourismfilms ON evaluation_tourism.film = tourismfilms.id WHERE evaluation_tourism.film = $id";
  $query = $db->prepare($sql);
  $query->execute();
  $evals = [];
  while ($c = $query->fetch(PDO::FETCH_ASSOC)) {
    $c['total'] = $c['originalityscript'] + $c['rythm'] + $c['length'] + $c['photography'] + $c['sound'];
    $c['total'] += ($c['edition'] + $c['specialeffects'] + $c['iseffective'] + $c['plot'] + $c['convincing']);
    $c['total'] += ($c['attractive'] + $c['place_viewer'] + $c['place_stimulate'] + $c['specific_sell'] + $c['specific_clear']);
    $c['total'] += ($c['specific_provide'] + $c['specific_focus'] + $c['specific_promote'] + $c['discuss'] + $c['attention']);
    $c['total'] += ($c['awareness']);
    $c['total'] = round($c['total'] / 21, 2);
    $evals[] = $c;
  }

  Flight::json($evals);

  $db = NULL;
});

///////
// Get all corporate valorations by film
///////
Flight::route('GET /valcorpfilm/@id', function($id) {
  $db = Flight::db();

  $sql = "SELECT corporatefilms.title, jury.name, evaluation_corporate.* FROM evaluation_corporate LEFT JOIN jury ON evaluation_corporate.jury = jury.id LEFT JOIN corporatefilms ON evaluation_corporate.film = corporatefilms.id WHERE evaluation_corporate.film = $id";
  $query = $db->prepare($sql);
  $query->execute();
  $evals = [];
  while ($c = $query->fetch(PDO::FETCH_ASSOC)) {
    $c['total'] = $c['originalityscript'] + $c['rythm'] + $c['length'] + $c['photography'] + $c['sound'];
    $c['total'] += ($c['edition'] + $c['specialeffects'] + $c['iseffective'] + $c['plot'] + $c['convincing']);
    $c['total'] += ($c['attractive'] + $c['place_viewer'] + $c['place_stimulate'] + $c['specific_green'] + $c['specific_csr']);
    $c['total'] += ($c['specific_provide'] + $c['specific_portray'] + $c['discuss'] + $c['attention'] + $c['awareness']);
    $c['total'] = round($c['total'] / 20, 2);
    $evals[] = $c;
  }

  Flight::json($evals);

  $db = NULL;
});

///////
// Get all documentary valorations by film
///////
Flight::route('GET /valdocfilm/@id', function($id) {
  $db = Flight::db();

  $sql = "SELECT documentaryfilms.title, jury.name, evaluation_documentary.* FROM evaluation_documentary LEFT JOIN jury ON evaluation_documentary.jury = jury.id LEFT JOIN documentaryfilms ON evaluation_documentary.film = documentaryfilms.id WHERE evaluation_documentary.film = $id";
  $query = $db->prepare($sql);
  $query->execute();
  $evals = [];
  while ($c = $query->fetch(PDO::FETCH_ASSOC)) {
    $c['total'] = $c['originalityscript'] + $c['rythm'] + $c['length'] + $c['photography'] + $c['sound'];
    $c['total'] += ($c['edition'] + $c['specialeffects'] + $c['iseffective'] + $c['plot'] + $c['convincing']);
    $c['total'] += ($c['attractive'] + $c['place_viewer'] + $c['place_stimulate'] + $c['specific_travel'] + $c['specific_sustain']);
    $c['total'] += ($c['specific_narrative'] + $c['specific_focus'] + $c['specific_reflection'] + $c['discuss'] + $c['attention']);
    $c['total'] += ($c['awareness'] + $c['specific_suggest']);
    $c['total'] = round($c['total'] / 22, 2);
    $evals[] = $c;
  }

  Flight::json($evals);

  $db = NULL;
});

Flight::route('POST /mailtocomps', function() {
  $post = Flight::request();

  $mail = new PHPMailer;
  $db = Flight::db();

  if (isset($post->files->file['tmp_name'])) {
    $file_tmp = $post->files->file['tmp_name'];
    $file_name = $post->files->file['name'];

    $mail->addAttachment($file_tmp, $file_name);
  }

  $subject = $post->data->email['subject'];
  $body = $post->data->email['body'];

  $sql = "SELECT fullName,email FROM competitors";
  $members = $db->prepare($sql);
  $members->execute();

  $mail->setFrom('contact@terres.info', 'terres Catalunya');
  $mail->addBCC('filmsnomades@gmail.com');

  $mail->isHTML(true);

  $body .= '<br><br><strong>terres Catalunya</strong><br><a href="https://terres.info">terres.info</a><br><br>#<br>T. 977 702 074<br><br><img src="https://terres.info/img/firmacorreu.jpg" />';

  $mail->Subject = $subject;
  $mail->Body    = $body;

  while ($member = $members->fetch(PDO::FETCH_ASSOC)) {
    $mail->addAddress($member['email'], $member['fullName']);

    if (!$mail->send()) {
        echo "Mailer Error (" . $member["email"] . ') ' . $mail->ErrorInfo . '\n';
        break; //Abandon sending
    } else {
        echo "Message sent to : " . $member['fullName'] . ' (' . $member['email'] . ')\n';
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
  }

  $mail = NULL;
  $db = NULL;
});

Flight::route('/testupload', function() {
  phpinfo();
});

///////
// List all members registered to Sustainable Day
///////
Flight::route('GET /sopar', function(){
  $db = Flight::db();

  $sql = "SELECT * FROM sopar";
  $comp = $db->prepare($sql);
  $comp->execute();
  $comps = [];
  while ($c = $comp->fetch(PDO::FETCH_ASSOC)) {
    $comps[] = $c;
  }

  $db = NULL;

  Flight::json($comps);
});

///////
// Delete selected member registered to Sustainable Day
///////
Flight::route('DELETE /sopar/@id', function($id){
  $db = Flight::db();

  $sql = "DELETE FROM sopar WHERE id = :id";
  $comp = $db->prepare($sql);
  $comp->bindParam(':id', $id);
  $comp->execute();
  if ($comp->rowCount() > 0) {
    $header = 200;
    $res = "Usuari eliminat correctament";
  } else {
    $header = 404;
    $res = "L'usuari ja no existeix";
  }

  $db = NULL;

  Flight::json($res,$header);
});

///////
// Add to Sustainable Day
///////
Flight::route('POST /sopar', function(){
  $db = Flight::db();
  $data = [];

  $dades = file_get_contents('php://input');
  $dades = mb_convert_encoding($dades, 'HTML-ENTITIES', "UTF-8");

  $post = json_decode($dades,true);

  ///////
  // Check if user is registered
  ///////
  $sql = "SELECT id FROM sopar WHERE email = :email LIMIT 1";
  $check = $db->prepare($sql);
  $check->bindParam(':email', $post['email']);
  $check->execute();
  $count = $check->rowCount();

  if ($count === 0){
    if (isset($post['comentaris'])) {
      $sql = "INSERT INTO sopar(nom, cognoms, email, direccio, ciutat, pais, comentaris, via) VALUES (:nom, :cognoms, :email, :direccio, :ciutat, :pais, :comentaris, 1)";
    } else {
      $sql = "INSERT INTO sopar(nom, cognoms, email, direccio, ciutat, pais, via) VALUES (:nom, :cognoms, :email, :direccio, :ciutat, :pais, 1)";
    }


    $new = $db->prepare($sql);
    $new->bindParam(':nom', $post['nom']);
    $new->bindParam(':cognoms', $post['cognoms']);
    $new->bindParam(':email', $post['email']);
    $new->bindParam(':direccio', $post['direccio']);
    $new->bindParam(':ciutat', $post['city']);
    $new->bindParam(':pais', $post['country']);
    if (isset($post['comentaris'])) {
      $new->bindParam(':comentaris', $post['comentaris']);
    }

    try {
      if ($new->execute()) {
        $data['status'] = 200;
        $data['message'] = 'User created succesfully';
      } else {
        $data['status'] = 400;
        $data['message'] = 'Unknown error';
      }
    } catch (Exception $e) {
      echo 'Exception: ',  $e->getMessage();
    }
  } else {
    $data['status'] = 404;
    $data['message'] = 'User exist';
  }

  $db = NULL;

  Flight::json($data);
});

///////
// List selected member registered to Sustainable day
///////
Flight::route('GET /assistentsopar/@id', function($id){
  $db = Flight::db();

  $sql = "SELECT * FROM sopar WHERE id = :id";
  $comp = $db->prepare($sql);
  $comp->bindParam(':id', $id);
  $comp->execute();
  $c = $comp->fetch(PDO::FETCH_ASSOC);

  $db = NULL;

  Flight::json($c);
});

///////
// Edit user registered to Sustainable day
///////
Flight::route('POST /modifysopar', function() {
  $data = file_get_contents('php://input');
  $data = json_decode($data, true);

  print_r($data);

  $db = Flight::db();

  $sql = "UPDATE sopar SET nom=:nom, cognoms=:cognoms, email=:email, direccio=:direccio, ciutat=:ciutat, pais=:pais, comentaris=:comentaris WHERE id=:id";
  $query = $db->prepare($sql);
  $query->bindParam(':nom', $data['nom']);
  $query->bindParam(':cognoms', $data['cognoms']);
  $query->bindParam(':email', $data['email']);
  $query->bindParam(':direccio', $data['direccio']);
  $query->bindParam(':ciutat', $data['ciutat']);
  $query->bindParam(':pais', $data['pais']);
  $query->bindParam(':comentaris', $data['comentaris']);
  $query->bindParam(':id', $data['id']);
  if ($query->execute()) {
    $response['status'] = 200;
  } else {
    $response['status'] = 500;
  }

  Flight::json($response);

  $db = NULL;
});

///////
// Get winners
///////
Flight::route('GET /winners', function() {
  // $db = Flight::db();
  $winners = [];

  $winners['tourism']['travel'] = Flight::getWinnerTourism('travel');
  $winners['tourism']['cultural'] = Flight::getWinnerTourism('cultural');
  $winners['tourism']['sports'] = Flight::getWinnerTourism('sports');
  $winners['tourism']['expedition'] = Flight::getWinnerTourism('expedition');
  $winners['tourism']['hotels'] = Flight::getWinnerTourism('hotels');
  $winners['tourism']['events'] = Flight::getWinnerTourism('events');
  $winners['tourism']['health'] = Flight::getWinnerTourism('health');
  $winners['tourism']['rural'] = Flight::getWinnerTourism('rural');
  $winners['tourism']['naturaltour'] = Flight::getWinnerTourism('naturaltour');
  $winners['tourism']['enotourism'] = Flight::getWinnerTourism('enotourism');
  $winners['tourism']['destinations'] = Flight::getWinnerTourism('destinations');
  $winners['tourism']['animation'] = Flight::getWinnerTourism('animation');
  $winners['documentary'] = Flight::getWinnerDocumentary();
  $winners['corporate'] = Flight::getWinnerCorporate();

  Flight::json($winners);
});

///////
// List all competitors
///////
Flight::route('GET /students', function(){
  $db = Flight::db();

  $sql = "SELECT * FROM terreslab_student";
  $comp = $db->prepare($sql);
  $comp->execute();
  $comps = [];
  while ($c = $comp->fetch(PDO::FETCH_ASSOC)) {
    $comps[] = $c;
  }

  $db = NULL;

  Flight::json($comps);
});

///////
// List one day assistants
///////
Flight::route('GET /oneday', function(){
  $db = Flight::db();

  $sql = "SELECT * FROM terreslab_oneday";
  $comp = $db->prepare($sql);
  $comp->execute();
  $comps = [];
  while ($c = $comp->fetch(PDO::FETCH_ASSOC)) {
    $comps[] = $c;
  }

  $db = NULL;

  Flight::json($comps);
});

Flight::start();
