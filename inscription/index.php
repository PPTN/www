<?php header("Access-Control-Allow-Origin: http://parti.pirate.tn"); // pour les Fonts ?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="الموقع الرسمي لحزب القراصنة في تونس">
    <meta name="author" content="حزب القراصنة">
    <link rel="icon" href="favicon.ico">
    <title>حزب القراصنة</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/ppbe.css" rel="stylesheet">
    <script type="application/ld+json">
	{
	  "@context" : "http://schema.org",
	  "@type" : "WebSite",
	  "name" : "حزب القراصنة",
	  "alternateName" : "Parti Pirate",
	  "url" : "http://www.partipirate.tn"
	}
   </script>
<style type="text/css">
:root .carbonad,
:root #content > #right > .dose > .dosesingle,
:root #content > #center > .dose > .dosesingle,
:root #carbonads-container
{display:none !important;}
</style>
    <!-- Custom styles for this template -->
<style>
.navbar-right { height: inherit; }
@font-face {
  font-family:'Scheherazade';
  src:url('../fonts/ScheherazadeRegOT.ttf');
}
@font-face {
  font-family:'Droid';
  src:url('../fonts/DroidKufi-Regular.ttf');
}
.dark .carousel-caption { background-color: rgba(0,0,0, 0.5); border-radius: 4px; }
.carousel-caption p { font: 200% Scheherazade; }
.carousel-caption h1 { font: 350% Scheherazade; }
#about p { font: 200% Scheherazade; text-align : justify;}
#about ul { font: 200% Scheherazade; }
#about h1, h2 { font: 350% Scheherazade; }
#about h3 { font: 150% Scheherazade; }
form {font-family: Droid;}
nav {font-family: Droid;}
footer {font-family: Droid;}
.btn {font-family: Droid;}
.alert {font-family: Droid;}
.modal-title {font-family: Droid;}
.modal-body {font-family: Droid;}
.dropdown-menu li a { text-align: right; }
nav .btn_enroll { background: transparent; border-color: white; }
</style>

  </head>
<!-- NAVBAR
================================================== -->
  <body itemscope itemtype="http://schema.org/Organization">
    <div id="main-nav" class="navbar-wrapper navbar navbar-inverse bs-docs-nav" style="min-height: 76px;">

      <div class="container">

        <nav class="navbar navbar-default navbar-static-top">
          <div class="container-fluid">
            <div class="navbar-header navbar-right">
              	<a class="navbar-brand" itemprop="url" href="http://partipirate.tn">
			<img itemprop="logo" src="../logo-ar.png" class="img-responsive" alt="Logo Parti Pirate Tunisie"/>
		</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="http://partipirate.tn">الصفحة الرّئيسية</a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>
	<div class="container-fluid" style="margin-top:90px" dir="rtl">
<form class="col-md-offset-4 col-md-4" method="post" action=".">
<?php	
function array2ini($data) {
	$m = "";
	foreach ($data as $k=>$v) { 
		$m .= $k.': '.$v."\n"; 
	}
	return $m;
}

	if ($_POST) {
		$DB = new PDO("sqlite:../inscription.sqlite3");
		$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $DB->prepare("insert into contacts (nom,email,tel,age,sexe,municipalite,inscri,date) values (:nom,:email,:tel,:age,:sexe,:municipalite,:inscri,:date)");
		$stmt->bindValue(':nom',$_POST['nom']);
		$stmt->bindValue(':email',$_POST['email']);
		$stmt->bindValue(':tel',$_POST['tel']);
		$stmt->bindValue(':age',$_POST['age']);
		$stmt->bindValue(':sexe',$_POST['sexe']);
		$stmt->bindValue(':municipalite',$_POST['municipalite']);
		$stmt->bindValue(':inscri',$_POST['inscri']);
		$stmt->bindValue(':date',date('c'));
		$stmt->execute();
		$message = array2ini($_POST);
		$usermail = $_POST['email'];
		$username = $_POST['nom'];
		mail("slim@localhost","Nouveau Pirate",$message,"From: PPTN Inscription <parti@pirate.tn>\r\nReply-to: $username <$usermail>");
		print '<div class="alert alert-success" role="alert">سجّلناك! تفقّد الميل، بش يجيك رابط لتأكيد العنوان <a class="btn btn-default" href="http://partipirate.tn">أرجع للصفحة الرّئيسية</a></div>';
	} else { 
?>


<div id="about">
<h2>
مرحبا بك في حزب القراصنة
</h2>
<p>
أدخل المعلومات بالعربي و الا بالسوري. كيف ما يساعدك. المعطيات هذه بش تخول لنا نشبكوك مع مواطنين آخرين في منطقتك
</p>
</div>
<div class="form-group">
<label>
الأسم و اللقب
</label>
    <input type="text" class="form-control" name="nom">
</div>
<div class="form-group">
<label>
البريد الالكتروني
</label>
    <input type="email" class="form-control" name="email" dir="ltr">
</div>
<div class="form-group">
<label>
رقم الهاتف الجوال
</label>
    <input type="text" class="form-control" name="tel">
</div>
<div class="form-group">
<label>
العمر
</label>
    <input type="text" class="form-control" name="age">
</div>

<div class="form-group">
<label>
البلديّة
</label>
    <input type="text" list="municipalites" class="form-control" name="municipalite">
	<datalist id="municipalites">
<?php
	$DB = new PDO("sqlite:../municipalites.sqlite3");
	$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $DB->prepare("select * from municipalites");
	$stmt->execute();
	while ($m = $stmt->fetch()) {
		print "<option>".$m['municipalite_ar']."</option>";
		print "<option>".$m['municipalite_fr']."</option>";
	}
?>
	</datalist>
</div>

<div class="radio" dir="ltr">
  <label>
    <input type="radio" name="sexe" value="femme">
    انثى
  </label>
</div>
<div class="radio" dir="ltr">
  <label>
    <input type="radio" name="sexe" value="homme">
    ذكر
  </label>
</div>
<p>
انتخبت في 2011 او 2014
<br />

    <input type="radio" name="inscri" value="oui">
    نعم
    <input type="radio" name="inscri" value="non">
    لا
</p>
<p>
  <button type="submit" class="btn btn-success">سجّل</button>
  <a class="btn btn-default" href="http://partipirate.tn">أرجع للصفحة الرّئيسية</a>
</p>
</form>
<?php } // no _POST ?>

   </div><!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>

</body></html>
