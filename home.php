<?php
	require_once "use_session.php"
	
?>


<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $author_name; ?>teeb veebi</title>
    <link rel="stylesheet" type="text/css" href="Styles/general.css">
</head>
<body>
	<header>
		<img id="banner" src="../../~andrus.rinde/media/pic/rif21_banner.png" alt="RIF21 bänner">
		<h1><?php echo $author_name; ?> arendab veebi</h1>
		<details>
			<summary>Selle lehe mõte</summary>
			<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat materjali!</p>
		</details>
		
        <hr>
	</header>
    
    <nav>
        <h2>Olulised lingid</h2>
        <ul>
            <li><a href="?logout=1">Logi välja</a></li>
            
        </ul>
    </nav>
        
	<main>
		<section>
			<h2>Avaleht</h2>
			
			
			
		</section>
		
<?php
	require_once "pagefooter.php";
?>	
