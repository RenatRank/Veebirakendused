<?php
	require_once "../../cnf.php";
	require_once "fnc_news.php";
	// require_once "fnc_general.php";
	//$_POST
	//$_GET
	//var_dump(	$_POST);
	//echo $_POST["newsInput"];
	$author_name = "Renat Ränk";
	$notice = null;
	$news_input_error = null;
	$news_input = "";
	$title_input = null;
	$expire_input = null;

	if(isset($_POST["newsSubmit"])){
		//kontrollime uudise pealkirja
		if(isset($_POST["newsInput"]) and !empty($_POST["newsInput"])){
			$news_input = $_POST["newsInput"];
		} else {
			$news_input_error = "Uudise sisu on puudu!";
		}
		if(isset($_POST["titleInput"]) and !empty($_POST["titleInput"])){
			$news_input = $_POST["titleInput"];
		} else {
			$news_input_error = "Uudise pealkiri on puudu!";
		}
		$title_input = $_POST["titleInput"];
		$expire_input = $_POST["expireInput"];
		
		$notice = $news_input_error;

		if(empty($news_input_error)){
			$notice = save_news($title_input, $news_input, $expire_input);
		}
	}
	
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
            <li><a href="https://www.tlu.ee/haapsalu">Tallinna Ülikooli Haapsalu kolledž</a></li>
            
        </ul>
    </nav>
        
	<main>
		<section>
			<h2>Lisa uudis</h2>
			<form method="POST">
				<label for="titleInput">Uudise pealkiri</label>
				<input type="text" id="titleInput" name="titleInput" placeholder="Kirjuta siia pealkiri ...">
				<br>
				<label for="newsInput">Uudise tekst</label><br>
				<textarea id="newsInput" name="newsInput" cols="60" rows="5" placeholder="Kirjuta siia uudise tekst ..."></textarea>
				<br><label for="expireInput">Uudise aegumise tähtaeg</label>
				<input type="date" id="expireInput" name="expireInput" >
				<br>
				<input type="submit" id="newsSubmit" name="newsSubmit" value="Salvesta uudis">
			</form>
			<?php echo "<p>" .$notice . "</p> \n"; ?>
			
		</section>
		
<?php
	require_once "pagefooter.php";
?>	
