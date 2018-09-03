<?php

require_once 'phpmailer/PHPMailerAutoload.php';

$config = require_once 'config/config.php';

$hasNameError = false;
$hasEmailError = false;
$hasMessageError = false;

$senderName = '';
$senderEmail = '';
$message = '';

if (count($_POST)) {
    $senderName = isset($_POST['name']) ? stripslashes(trim($_POST['name'])) : '';
    $senderEmail = isset($_POST['email']) ? stripslashes(trim($_POST['email'])) : '';
    $message = isset($_POST['message']) ? stripslashes(trim($_POST['message'])) : '';

    if (strlen($senderName) < 1) {
        $hasNameError = true;
    }
    if (strlen($senderEmail) < 1 || !filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
        $hasEmailError = true;
    }
    if (strlen($message) < 1) {
        $hasMessageError = true;
    }

    if (!$hasNameError && !$hasEmailError && !$hasMessageError) {
        $mail = new PHPMailer;

        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = $config['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['username'];
        $mail->Password = $config['password'];
        $mail->SMTPSecure = $config['security'];
        $mail->Port = $config['port'];

        $mail->setFrom($config['sendFrom'], '[ContactForm]');
        $mail->addAddress($config['sendTo'], '');
        $mail->addReplyTo($senderEmail, $senderName);

        $mail->isHTML(true);

        $mail->Subject = '[ContactForm] Wiadomość z formularza kontaktowego';
        $mail->Body = '<p>' . $message . '</p>';

        if(!$mail->send()) {
            die($mail->ErrorInfo);
        } else {
            header('Location: ' . $config['thankYouPage']);
            exit;
        }
    }


}

?>
<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>WebDev Natalia – Fronted Developer with React + Redux</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	 crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
	 crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700,800#x7CRoboto:400,700" rel="stylesheet">

	<link href="css/slick.css" rel="stylesheet" type="text/css" />
	<link href="css/main.css" rel="stylesheet" type="text/css" />

	<link rel="icon" type="image/png" href="img/favicon2.png">

</head>

<body>

	<div class="lds-ring" id="loadingDiv"><div></div><div></div><div></div><div></div></div>
	<header class="header" id="header">
		<nav class="navbar navbar-expand-md fixed-top">
			<div class="container">
				<a href="#header" class="navbar-brand scrollable">
					<svg version="1.1" id="WebDevNatalia" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
					 y="0px" viewBox="0 0 320 47" style="enable-background:new 0 0 320 47;" xml:space="preserve">
						<g>
							<path class="st0" d="M0.7,10.7h7.9l4.3,19.4l4.4-14.9v-4.6h6.6l5.6,19.5l4.5-19.5h7.9l-7.5,32.2h-7.5l-5.4-18.6l-5.8,18.6H8.2
										L0.7,10.7z"></path>
							<path class="st0" d="M41.1,31c0-7.6,4.2-12.4,12.4-12.4c7.5,0,11.9,4.2,11.9,10.7v4.2H48.5c0.8,3.2,3.4,4.2,8.1,4.2
										c2.6,0,5.6-0.5,7.4-1.3v5.3c-2.3,1-5.5,1.5-9.2,1.5C46.5,43.4,41.1,39.3,41.1,31z M58.3,29v-1.1c0-2.3-1.3-3.8-4.6-3.8
										c-3.9,0-5.2,1.5-5.2,4.9H58.3z"></path>
							<path class="st0" d="M76.8,40.9l-0.4,2h-7V9.2h8.1v11.1c1.8-1,4.2-1.6,6.6-1.6c7,0,11.2,3.6,11.2,12.2c0,8.6-4.3,12.6-11,12.6
										C81.1,43.4,78.8,42.5,76.8,40.9z M87,30.9c0-4.7-1.6-6.3-5.1-6.3c-1.8,0-3.4,0.5-4.5,1.5v9.7c1.2,1.2,2.8,1.8,4.5,1.8
										C85.6,37.5,87,35.4,87,30.9z"></path>
							<path class="st0" d="M97.8,10.7h14c9.8,0,15.1,4.6,15.1,16.3c0,11.1-5.2,15.9-15.1,15.9h-14V10.7z M110.7,36.7c5.2,0,8-1.8,8-9.7
										c0-8-2.4-10.1-8-10.1h-4.8v19.8H110.7z"></path>
							<path class="st0" d="M128.5,31c0-7.6,4.2-12.4,12.4-12.4c7.5,0,11.9,4.2,11.9,10.7v4.2h-16.8c0.8,3.2,3.4,4.2,8.1,4.2
										c2.6,0,5.6-0.5,7.4-1.3v5.3c-2.3,1-5.5,1.5-9.2,1.5C133.9,43.4,128.5,39.3,128.5,31z M145.7,29v-1.1c0-2.3-1.3-3.8-4.6-3.8
										c-3.9,0-5.2,1.5-5.2,4.9H145.7z"></path>
							<path class="st0" d="M153.3,19.2h8.4l5.2,15.4l5.3-15.4h8.4l-9.4,23.7h-8.6L153.3,19.2z"></path>
							<path class="st0" d="M230.1,31.8c-4.6,10-2.9,16.1,2.9,13.5c3.5-1.6,2.5,2-1.1,1.9c-6.8-0.3-8.8-4.9-6.1-13
										c1.8-5.2,11-22.1,11.8-27.2c0.6-3.5-2.6-3.6-6.1-1.9c-3.7,1.8-7.5,4.9-11.1,9.1c-7,8.6-12.2,20.6-15.5,27.4
										c-0.8,1.8-4.5,1.9-4.1,0.3c2.4-3.6,10.3-19.2,12.7-29.8C216.3-1,206.3,0,197.7,5.4c-14.8,9.2-16.5,27.5-6.5,27.5
										c10.5,0,16.8-15.4,7.8-14.3c-1,0.1-0.6-0.7-0.1-0.8c11.9-2.9,5.4,16-7.9,16c-6.4,0-11.8-6.4-7.6-16.6c2.4-5.8,8-10.8,13.7-14
										c8.3-4.5,21-5.3,19.5,7.1c-0.5,3.9-2.5,7.9-4.2,11.7c-2.6,5.7-0.7,2,0.3,0.6c1.8-2.8,4.1-6,6.6-9c3.8-4.6,8-8.7,11.9-10.4
										c4.7-2.2,10.4-2.1,10.3,3.4C241.4,12.4,235.1,21,230.1,31.8z"></path>
							<path class="st0" d="M247.6,40c-1.7,0.1-4-1.2-2.5-6.5c-0.8,1.3-2.2,3.3-3.6,4.7c-5.8,5.5-9.6-3.3-2-12.3c3-3.5,8.8-5.4,11.6-2.3
										c0.7,0.8,0.3,1.6-0.5,1.5c-0.6-1.9-2.4-2.3-4.3-1.3c-2.3,1.3-4.8,4.2-6.7,7.2c-0.4,0.7-1.8,3.2-2,5c-0.5,3.5,2.3,3.1,4.6,0.3
										c1.8-2.1,3.2-4.6,4.5-7c1.1-2.1,1.8-3.3,3.4-3.2c0.6,0,1.4,0.4,2.1,0.2c-1,1-4,6.3-4.7,9.4c-0.4,2-0.1,3,0.5,3
										c2.1,0.1,5.4-6.3,6.5-8.4c0.4-0.9,1.2-0.6,0.7,0.4C253.6,33.7,250.6,39.7,247.6,40z"></path>
							<path class="st0" d="M266.6,22h-2.9c-1.7,2.9-3.7,5.6-6.7,8.3c-0.5,1.3-1.2,5.1-1.2,5.1c-0.8,3.3,1.5,3.8,3.2,2.6
										c2.3-1.7,4-4.9,5.3-7.6c0.4-0.9,1.1-0.7,0.6,0.3c-2.2,4.6-3,6-4.9,7.8c-2.7,2.6-7.7,1.8-6.9-3.8c0.5-3.4,2.3-8.9,3.9-12.8h-2.6
										c-0.6,0-0.5-1.1,0.1-1.1h3c1.2-2.5,2.4-5,3.7-7.1c3.5-6.1,8.9-5.2,5.2,2.8c-0.7,1.5-1.4,2.9-2.2,4.3h2.4
										C267.2,20.9,267.1,22,266.6,22z M260.2,22c-1.1,2.4-2,4.9-2.7,6.6c1.9-2,3.6-4.3,5-6.6H260.2z M264.3,13.6
										c-1.2,1.7-2.3,4.5-3.5,7.3h2.5c1-1.7,1.8-3.5,2.5-5.1C266.7,13.7,267.4,9.2,264.3,13.6z"></path>
							<path class="st0" d="M275.1,40c-1.7,0.1-4-1.2-2.5-6.5c-0.8,1.3-2.2,3.3-3.6,4.7c-5.8,5.5-9.6-3.3-2-12.3c3-3.5,8.8-5.4,11.6-2.3
										c0.7,0.8,0.3,1.6-0.5,1.5c-0.5-1.9-2.4-2.3-4.3-1.3c-2.3,1.3-4.9,4.2-6.7,7.2c-0.4,0.7-1.8,3.2-2.1,5c-0.5,3.5,2.3,3.1,4.6,0.3
										c1.8-2.1,3.2-4.6,4.5-7c1.1-2.1,1.8-3.3,3.4-3.2c0.7,0,1.4,0.4,2.1,0.2c-1.1,1-4,6.3-4.7,9.4c-0.4,2-0.2,3,0.5,3
										c2.1,0.1,5.4-6.3,6.5-8.4c0.5-0.9,1.2-0.6,0.7,0.4C281.1,33.7,278.1,39.7,275.1,40z"></path>
							<path class="st0" d="M284.7,30.2c-0.3,0.8-0.8,2-1,3.3c-1.5,6,2.5,6.9,5.2,3.2c1.7-2.4,3.1-5.1,3.7-6.4c0.5-0.8,1.2-0.8,0.8,0.3
										c-1.3,2.7-3.8,9.4-8.9,9.4c-5.6,0-3.2-6.8-2.4-9.9c1.6-5.6,4.7-12.8,7.6-17.7c3.6-6,9-5.3,5.4,2.8
										C292.6,20.4,289.6,25.8,284.7,30.2z M293,12.2c-2.5,3.5-6.4,12.4-7.9,16.4c3.6-3.6,7.2-9.5,9.1-14.2C295.2,12.2,295.7,8.4,293,12.2
										z"></path>
							<path class="st0" d="M294.2,38.8c0.8,0.1,1.7-0.5,2.3-1c1.7-1.7,3.3-4.8,4.7-7.6c0.4-0.9,1.1-0.5,0.7,0.5c-1.3,2.8-4.2,9.2-7.9,9.2
										c-3.8,0-3.8-3.9-2.7-6.5l3.2-8.2c0.4-0.9-0.3-1.8-0.5-2.1l2.8,0c1.6,0,1.6,0.5,1.1,1.8l-4,9.4c0,0-0.5,1.1-0.6,1.5
										C292.7,37.3,292.8,38.7,294.2,38.8z M297.8,21c-1.2,0-1.9-0.9-1.8-2.1c0.2-1.1,1.3-2,2.4-2c1.2,0,2,0.9,1.8,2
										C300,20.1,299,21,297.8,21z"></path>
							<path class="st0" d="M311.9,40c-1.7,0.1-4-1.2-2.5-6.5c-0.8,1.3-2.2,3.3-3.6,4.7c-5.8,5.5-9.6-3.3-2-12.3c3-3.5,8.8-5.4,11.6-2.3
										c0.7,0.8,0.3,1.6-0.5,1.5c-0.5-1.9-2.4-2.3-4.3-1.3c-2.3,1.3-4.9,4.2-6.7,7.2c-0.4,0.7-1.8,3.2-2.1,5c-0.5,3.5,2.3,3.1,4.6,0.3
										c1.8-2.1,3.2-4.6,4.5-7c1.1-2.1,1.8-3.3,3.4-3.2c0.7,0,1.4,0.4,2.1,0.2c-1,1-4,6.3-4.6,9.4c-0.4,2-0.2,3,0.5,3
										c2.1,0.1,5.4-6.3,6.5-8.4c0.5-0.9,1.2-0.6,0.7,0.4C317.9,33.7,314.9,39.7,311.9,40z"></path>
						</g>
					</svg>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false"
				 aria-label="Toggle navigation">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbar">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a href="#header" class="nav-link scrollable">Home</a>
						</li>
						<li class="nav-item">
							<a href="#about" class="nav-link scrollable">About</a>
						</li>
						<li class="nav-item">
							<a href="#skills" class="nav-link scrollable">Skills</a>
						</li>
						<li class="nav-item">
							<a href="#portfolio" class="nav-link scrollable">Portfolio</a>
						</li>
						<li class="nav-item">
							<a href="#contact" class="nav-link scrollable">Contact</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="hero">
			<div class="container">
				<h1>Natalia Migas – Frontend Developer</h1>
				<h2>
					<span class="color-txt">React + Redux.</span> Remote / Łódź</h2>
				<div class="text-center">
					<a href="#portfolio" class="btn btn-main scrollable">Portfolio</a>
				</div>
			</div>
			<span class="circle one d-none d-xl-block"></span>
			<span class="circle two d-none d-xl-block"></span>
			<span class="circle three d-none d-xl-block"></span>
			<span class="circle four d-none d-xl-block"></span>
			<span class="circle five d-none d-xl-block"></span>
			<span class="circle six d-none d-xl-block"></span>
			<span class="circle d-none d-xl-block"></span>
		</div>
	</header>
	<section class="about" id="about">
		<div class="text-center">
			<h2 class="heading">About</h2>
		</div>
		<div class="container">
			<div class="row about-intro">
				<div class="pic-wrapper col-xl-3 col-lg-3 col-sm-3">
					<img src="img/me.jpg" alt="natalia migas photo" class="rounded-circle img-fluid pic-me">
				</div>
				<div class="ul-wrapper col-xl-3 col-lg-4 col-sm-4  col-xs-12">
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							<i class="fas fa-user color-txt"></i>Natalia Migas</li>
						<li class="list-group-item">
							<i class="fas fa-map-marker-alt color-txt"></i>Łódź, Poland
						</li>
						<li class="list-group-item">
							<a href="http://github.com/natalia-migas" target="_blank">
								<i class="fab fa-github color-txt"></i>Github
							</a>
						</li>
						<li class="list-group-item">
							<a href="https://www.linkedin.com/in/natalia-migas-9483a3b0/" target="_blank">
								<i class="fab fa-linkedin color-txt"></i>Linkedin
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="row about-text">
				<div class="col-md-10 m-auto">
					<p>My name is Natalia, I was born in Kraków and I moved to Łódź at the end of 2016. I graduated from master's studies political science with specialization political marketing.</p>
					<p>I became interested in programming during writing my master thesis about internet marketing when I raised the issue of websites positioning. Right after my master's defense I started my self-study of programming and I loved it! <i class="fas fa-heart"></i></p>
					<p>After about a year of intense learning I found a job as frontend developer. I was creating websites in: HTML, CSS (Sass), JavaScript (mostly jQuery), Bootstrap, and I set up these websites on WordPress.</p>
					<p>After a while I decided that I would like to participate in bigger projects and focus mostly on JavaScript and learn React with Redux. I quit my job and from June I focused on self-study of JS, React + Redux, and now I'm looking for a job related to this.</p>
					<p>In my free time I like to ride a bike, go to the swimming pool, play computer (and xbox) games, watch netflix/showmax and cook. I am cheerful, open, hardworking, honest person, I love animals, and my biggest dream is to travel accross most of Europe, South and West America.</p>
				</div>
			</div>
		</div>
	</section>
	<section class="skills" id="skills">
		<div class="text-center">
			<h2 class="heading">Skills</h2>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-8 mx-md-auto">
					<h2>Main skills</h2>
					<h3>HTML</h3>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%"></div>
					</div>
					<h3>CSS (Sass)</h3>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width: 93%"></div>
					</div>
					<h3>Bootstrap 3/4</h3>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%"></div>
					</div>
					<h3>
						<strong>JavaScript</strong>
					</h3>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
					</div>
					<h3>jQuery</h3>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%"></div>
					</div>
					<h3>
						<strong>React</strong>
					</h3>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%"></div>
					</div>
					<h3>
						<strong>Redux</strong>
					</h3>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 15%"></div>
					</div>
					<h3>WordPress</h3>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%"></div>
					</div>
					<h3>Photoshop</h3>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%"></div>
					</div>
				</div>
				<div class="col-xl-1 d-none d-xl-block"></div>
				<div class="col-xl-5 col-lg-6 addit-wrapper">
					<h2>Additional skills</h2>
					<p>
						<strong>Technologies:</strong> git (basics), npm (basics), Microsoft Office, Corel Photopaint, GIMP, Slack, ActiveCollab</p>
					<p>
						<strong>Other:</strong> Driving license cat. B, skill of self-study, fast-learning, time organization, communication</p>
					<h4>
						<strong>Languages</strong>
					</h4>
					<table class="table table-hover table-responsive">
						<thead>
							<tr>
								<th scope="col" class="lang">
									<i class="fas fa-language"></i>
								</th>
								<th scope="col">Listening</th>
								<th scope="col">Reading</th>
								<th scope="col">Writing</th>
								<th scope="col">Speaking</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">English</th>
								<td>B2/C1</td>
								<td>B2/C1</td>
								<td>B1/B2</td>
								<td>B1</td>
							</tr>
							<tr>
								<th scope="row">Polish</th>
								<td>Native</td>
								<td>Native</td>
								<td>Native</td>
								<td>Native</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="skills-slider">
						<div class="img-wrapper">
							<img src="img/logos/html.png" alt="html" class="img-fluid mx-auto">
						</div>
						<div class="img-wrapper">
							<img src="img/logos/css.png" alt="css" class="img-fluid mx-auto">
						</div>
						<div class="img-wrapper">
							<img src="img/logos/js-logo.png" alt="js" class="img-fluid mx-auto">
						</div>
						<div class="img-wrapper">
							<img src="img/logos/react.png" alt="react" class="img-fluid mx-auto">
						</div>
						<div class="img-wrapper">
							<img src="img/logos/redux.png" alt="redux" class="img-fluid mx-auto">
						</div>
						<div class="img-wrapper">
							<img src="img/logos/sass.png" alt="sass" class="img-fluid mx-auto">
						</div>
						<div class="img-wrapper">
							<img src="img/logos/bootstrap.png" alt="bootstrap" class="img-fluid mx-auto">
						</div>
						<div class="img-wrapper">
							<img src="img/logos/jqueryn.png" alt="jquery" class="img-fluid mx-auto">
						</div>
						<div class="img-wrapper">
							<img src="img/logos/ps.jpg" alt="ps" class="img-fluid mx-auto">
						</div>
						<div class="img-wrapper">
							<img src="img/logos/wp-logo.png" alt="wp" class="img-fluid mx-auto">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="portfolio" id="portfolio">
		<div class="text-center">
			<h2 class="heading">Portfolio</h2>
		</div>
		<div class="container">
			<div class="tabs-wrapper">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="sites-tab" data-toggle="tab" href="#sites" role="tab" aria-controls="sites" aria-selected="true">Websites</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="apps-tab" data-toggle="tab" href="#apps" role="tab" aria-controls="apps" aria-selected="false">Applications</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="sites" role="tabpanel" aria-labelledby="sites-tab">
						<div class="row">
							<div class="col-sm-6">
								<div class="img-wrapper">
									<img src="img/portfolio/portfolio8.jpg" class="img-fluid site-img" alt="site screenshot">
									<div class="mask">
										<p>Car service DAWO</p>
										<a href="http://www.dawo.info.pl/" target="_blank">
											<i class="fas fa-eye"></i>
										</a>
									</div>
								</div>
								<div class="img-wrapper">
									<img src="img/portfolio/portfolio4.jpg" class="img-fluid site-img" alt="site screenshot">
									<div class="mask">
										<p>Online store with smoke sensors</p>
										<a href="https://czujniki.co/" target="_blank">
											<i class="fas fa-eye"></i>
										</a>
									</div>
								</div>
								<div class="img-wrapper">
									<img src="img/portfolio/portfolio1.jpg" class="img-fluid site-img" alt="site screenshot">
									<div class="mask">
										<p>Healthy lifestyle blog template</p>
										<a href="https://natalia-migas.github.io/my-projects/bootstrap-project/" target="_blank">
											<i class="fas fa-eye"></i>
										</a>
										<a href="https://github.com/natalia-migas/my-projects/tree/master/bootstrap-project" target="_blank">
											<i class="fab fa-github"></i>
										</a>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="img-wrapper">
									<img src="img/portfolio/portfolio5.jpg" class="img-fluid site-img" alt="site screenshot">
									<div class="mask">
										<p>Winter Springs High School</p>
										<a href="http://www.winterspringshs.scps.k12.fl.us/" target="_blank">
											<i class="fas fa-eye"></i>
										</a>
									</div>
								</div>
								<div class="img-wrapper">
									<img src="img/portfolio/portfolio3.jpg" class="img-fluid site-img" alt="site screenshot">
									<div class="mask">
										<p>MoGo template</p>
										<a href="https://natalia-migas.github.io/my-projects/weekly-webdev-challenge35/" target="_blank">
											<i class="fas fa-eye"></i>
										</a>
										<a href="https://github.com/natalia-migas/my-projects/tree/master/weekly-webdev-challenge35" target="_blank">
											<i class="fab fa-github"></i>
										</a>
									</div>
								</div>
								<div class="img-wrapper">
									<img src="img/portfolio/portfolio12.jpg" class="img-fluid site-img" alt="site screenshot">
									<div class="mask">
										<p>My old portfolio</p>
										<a href="http://webdevnatalia.com/portfolio-old/" target="_blank">
											<i class="fas fa-eye"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="apps" role="tabpanel" aria-labelledby="apps-tab">
						<div class="row">
							<div class="col-sm-6">
								<div class="img-wrapper">
									<img src="img/portfolio/portfolio13.jpg" class="img-fluid site-img" alt="site screenshot">
									<div class="mask">
										<p>React without redux/context api - Memory Game</p>
										<a href="http://webdevnatalia.com/memory-game/" target="_blank">
											<i class="fas fa-eye"></i>
										</a>
										<a href="https://github.com/natalia-migas/memory-game" target="_blank">
											<i class="fab fa-github"></i>
										</a>
									</div>
								</div>
								<div class="img-wrapper">
									<img src="img/portfolio/portfolio10.jpg" class="img-fluid site-img" alt="site screenshot">
									<div class="mask">
										<p>Vanilla JS Paper-rock-scissors Game - Object oriented programming training</p>
										<a href="http://webdevnatalia.com/paper-rock-scissors/" target="_blank">
											<i class="fas fa-eye"></i>
										</a>
										<a href="https://github.com/natalia-migas/paper-rock-scissors" target="_blank">
											<i class="fab fa-github"></i>
										</a>
									</div>
								</div>
								<div class="img-wrapper">
									<img src="img/portfolio/portfolio9.jpg" class="img-fluid site-img" alt="site screenshot">
									<div class="mask">
										<p>List of movies to watch. Simple vanilla JS app (adding, removing, searching, sorting, drag & drop)</p>
										<a href="http://webdevnatalia.com/movies/" target="_blank">
											<i class="fas fa-eye"></i>
										</a>
										<a href="https://github.com/natalia-migas/list-of-movies-vanilla-js" target="_blank">
											<i class="fab fa-github"></i>
										</a>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="img-wrapper">
									<img src="img/portfolio/portfolio14.jpg" class="img-fluid site-img" alt="site screenshot">
									<div class="mask">
										<p>React + Redux first CRUD app with fake API.</p>
										<a href="http://webdevnatalia.com/contactmanager/" target="_blank">
											<i class="fas fa-eye"></i>
										</a>
										<a href="https://github.com/natalia-migas/contactmanager" target="_blank">
											<i class="fab fa-github"></i>
										</a>
									</div>
								</div>
								<div class="img-wrapper">
									<img src="img/portfolio/portfolio11.jpg" class="img-fluid site-img" alt="site screenshot">
									<div class="mask">
										<p>Vanilla JS compare items app. Template literals, AJAX, JSON to HTML - training</p>
										<a href="http://webdevnatalia.com/compare-products/" target="_blank">
											<i class="fas fa-eye"></i>
										</a>
										<a href="https://github.com/natalia-migas/compare-products" target="_blank">
											<i class="fab fa-github"></i>
										</a>
									</div>
								</div>
								<div class="img-wrapper">
									<img src="img/portfolio/portfolio7.jpg" class="img-fluid site-img" alt="site screenshot">
									<div class="mask">
										<p>Simple Vanilla JS digital clock</p>
										<a href="https://natalia-migas.github.io/my-projects/simple-digital-clock/" target="_blank">
											<i class="fas fa-eye"></i>
										</a>
										<a href="https://github.com/natalia-migas/my-projects/tree/master/simple-digital-clock" target="_blank">
											<i class="fab fa-github"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="contact" id="contact">
		<div class="text-center">
			<h2 class="heading">Contact</h2>
		</div>
		<div class="container">
			<div class="row contact-wrapper">
				<div class="col-12 col-sm-6 col-xl-5">
					<?php if (isset($_GET['status']) && $_GET['status'] === 'OK'): ?> Message sent
					<?php else: ?>
					<form class="form-horizontal" method="POST">
						<div class="form-group">
							<label for="contact-form--name" class="sr-only">Name:</label>
							<input type="text" class="form-control" name="name" id="contact-form--name" placeholder="Your name..." value="<?= $senderName; ?>" required>
							<?php if ($hasNameError): ?>
							<div class="form-error">
								Name is Required.
							</div>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="contact-form--email" class="sr-only">E-mail:</label>
							<input type="email" class="form-control" name="email" id="contact-form--email" placeholder="Your e-mail address..." value="<?= $senderEmail; ?>" required>
							<?php if ($hasEmailError): ?>
							<div class="form-error">
								Invalid e-mail address.
							</div>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="contact-form--message" class="sr-only">Message:</label>
							<textarea class="form-control" name="message" id="contact-form--message" rows="11" placeholder="Message..." required><?= $message; ?></textarea>
							<?php if ($hasMessageError): ?>
							<div class="form-error">
								Message is required.
							</div>
							<?php endif; ?>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-main">Send</button>
						</div>
					</form>
					<?php endif; ?>
				</div>
				<div class="col-lg-2 d-none d-xl-block"></div>
				<div class="col-12 col-sm-6 col-xl-5">
					<ul>
						<li>
							<a href="mailto:kontakt@webdevnatalia.com">
								<i class="fas fa-envelope color-txt"></i>kontakt@webdevnatalia.com</a>
						</li>
						<li>
							<a href="https://www.linkedin.com/in/natalia-migas-9483a3b0/" target="_blank">
								<i class="fab fa-linkedin color-txt"></i>Linkedin
								</i>
							</a>
						</li>
						<li>
							<a href="http://github.com/natalia-migas" target="_blank">
								<i class="fab fa-github-square color-txt"></i>Github</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<footer class="footer">
		<p class="text-center">Natalia Migas 2018 &copy; All rights reserved.</p>
	</footer>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	 crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
	 crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
	 crossorigin="anonymous"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>