<?php
	session_start();
	require_once "fnc_general.php";
	require_once "fnc_news.php";
	require_once "../../cnf.php";
	require_once "fnc_user.php";
	

	$notice = null;
	$email = null;
	$email_error = null;
	$password_error = null;

	$author_name = "Renat Ränk ";
	
	//Piltide kataloog
	$photo_dir = "hkphotos/";
	$all_files = read_dir_content($photo_dir);
	//näitame juhuslikku fotot
	
	$allowed_photo_types = ["image/jpeg", "image/png"];
	$photo_files = check_if_photo($all_files, $photo_dir, $allowed_photo_types);
	
	$photo_count =count ($photo_files);
	//echo $photo_count;
	$random_num = mt_rand(0,$photo_count - 1);
	$random_num2 = mt_rand(0,$photo_count - 1);
	$random_num3 = mt_rand(0,$photo_count - 1);

	while ($random_num == $random_num2){
		$random_num2 = mt_rand(0,$photo_count - 1);
	}
	$random_num3 = mt_rand(0,$photo_count - 1);
	while ($random_num == $random_num3 OR $random_num2 == $random_num3){
		$random_num3 = mt_rand(0,$photo_count - 1);
	}

	$photo_html = "\n" .'<img src="' .$photo_dir . $photo_files[$random_num]. '"alt=Haapsalu Kolledz" class="photoframe"> '."\n";
	$photo_html2 = "\n" .'<img src="' .$photo_dir . $photo_files[$random_num2]. '"alt=Haapsalu Kolledz" class="photoframe"> '."\n";
	$photo_html3 = "\n" .'<img src="' .$photo_dir . $photo_files[$random_num3]. '"alt=Haapsalu Kolledz" class="photoframe"> '."\n";

	$full_time_now = date("d.m.Y H:s");
	$weekday_now = date("N");
	$weekday_names_et = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	$day_category = "Lihtsalt päev";
	if($weekday_now <= 5) {
		$day_category = "kooli-või tööpäev";
	} else{
		$day_category = "normaalsete inimeste puhkepäev";	
	}

// mis osa päevast: hommik, päev, õhtu, öö
	$day_state = "päev";	
	$time_hours = date("H");
	if($time_hours>=0 AND $time_hours<7){
		$day_state = "öö";
	} 
	if($time_hours>=7 AND $time_hours<12){
		$day_state = "hommik";
	} 	
	if($time_hours>=12 AND $time_hours<18){
		$day_state = "päevaaeg";
	} 
	if($time_hours>=18 AND $time_hours<=23){
		$day_state = "õhtu";
	} 

	$semester_begin = new DateTime("2022-1-31");
	$semester_end = new DateTime("2022-6-30");
	$semester_duration = $semester_begin->diff($semester_end);
	$semester_duration_days = $semester_duration->format("%r%a");
	$from_semester_begin = $semester_begin ->diff(new DateTime("now"));
	$from_semester_begin_days = $from_semester_begin->format("%r%a");
	if($from_semester_begin_days > 0){
		if($from_semester_begin_days <= $semester_duration_days){
		$semester_meter = "\n" .'<p>Semester edeneb: <meter min="0" max="' .$semester_duration_days . '" value="' .$from_semester_begin_days .'"></meter>.</p>'. "\n";
		}else{
			$semester_meter = "\n <p>Semester on lõppenud!</p> \n";
		}
	}elseif($from_semester_begin_days === 0){
		$semester_meter = "\n <p>Semester algab täna!</p> \n";
	} else {
		$semester_meter = "\n <p> Semestri alguseni on jäänud ". (abs($from_semester_begin_days)+1)." päeva! </p> \n";
	}

	
	if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST["login_submit"])){
			if(empty($email)){
                $email_error = $_POST;
            }
        } else {
            $email_error = "Palun sisesta oma e-posti aadress!";
        }
		//parooli kontroll
		if(isset($_POST["password_input"]) and !empty($_POST["password_input"])){
            if(strlen($_POST["password_input"]) < 8){
                $password_error = "Sisestatud salasõna on liiga lühike!";
            }
        } else {
            $password_error = "Palun sisesta salasõna!";
        }
		if(empty($email_error) and empty($password_error)){
			$notice = sign_in($email, $_POST["password_input"]);
		} else{
			$notice = $email_error. " ".$password_error;
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
		<h1><?php echo $author_name; ?>arendab veebi</h1>
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
       
	<hr>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="email" name="email_input" placeholder="email ehk kasutajatunnus" value="<?php echo $email; ?>">
        <input type="password" name="password_input" placeholder="salasõna">
        <input type="submit" name="login_submit" value="Logi sisse">
		<span><?php echo $notice; ?></span>
    </form>
    <p>Loo omale <a href="add_user.php">kasutajakonto</a></p>
    <hr>	


	<main>
		<section>
			<h2>Natuke aja kohta</h2>
			
			<p>Lehe avamise hetk: <?php echo $weekday_names_et[$weekday_now - 1] . ", " .$full_time_now.", on ".$day_category;?></p> 
			<p>Praegu on <?php echo $day_state ?></p>
			<?php echo $semester_meter; ?>
		</section>
		<section>
			<h2>Vaated Haapsalu kolledžile</h2>
			<?php echo $photo_html; ?>
			<?php echo $photo_html2; ?>
			<?php echo $photo_html3; ?>
	<!--		<figure>
				<img src="../../~andrus.rinde/media/photos/HK_600x400/IMG_3238.JPG" alt="TLÜ Haapsalu kolledži hoone" class="photoframe">
				<figcaption>Vaade TLÜ Haapsalu kolledži hoonele Lihula poolt</figcaption>
			</figure>
			<figure>
				<img src="../../~andrus.rinde/	media/photos/HK_600x400/IMG_4761.JPG" alt="TLÜ Haapslau kolledži arvutiklass 205" class="photoframe">
				<figcaption>Vaade TLÜ Haapsalu kolledži arvutiklassi</figcaption>
			</figure> -->
		</section>
		<section>
			<h2>Viimane uudis</h2>
			
			<?php echo latest_news(); ?>
			
		</section>
<?php
	require_once "pagefooter.php";
?>	
