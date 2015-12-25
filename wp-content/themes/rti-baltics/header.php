<?php 

global $delta; $delta = 0.0;







?>



<!DOCTYPE html>

<script type="text/javascript"> 

var $buoop = {}; 

$buoop.ol = window.onload; 

window.onload=function(){ 

 try {if ($buoop.ol) $buoop.ol();}catch (e) {} 

 var e = document.createElement("script"); 

 e.setAttribute("type", "text/javascript"); 

 e.setAttribute("src", "//browser-update.org/update.js"); 

 document.body.appendChild(e); 

} 

</script> 



<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name='yandex-verification' content='482505dd74cbd3c7' />
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://rti-baltika.ru/js/jquery.floatThead.js"></script>
<script src="http://rti-baltika.ru/jquery.sticky-kit.js"></script>

		<script type="text/javascript" src="http://rti-baltika.ru/vibor/selects.js"></script>

  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<title><?php the_title(); ?></title>

<!--[if lt IE 9]>

<script src="<?php print get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>

<![endif]-->



<!--[if lt IE 9]>

<link rel='stylesheet'   href='<?php print get_template_directory_uri(); ?>/css/ie.css?ver=20121010' type='text/css' media='all' />

<![endif]-->


<link rel='stylesheet'  href='<?php bloginfo('stylesheet_url'); ?>' type='text/css' media='all' />

<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

<meta http-equiv="Cache-Control" content="no-cache">

<link rel="icon" href="/wp-content/uploads/2013/10/favicon.jpg" type="image/icon">

<?php wp_head(); ?><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" >
<script>
  $(function() {
    $( document ).tooltip();
  });
  </script>

<script>

(function($){

	$(function() {

		$(".cycler").cycler({delay: 3000, 'easing': 'easeOutBounce', speed: 1000});

		

		

		

	})

	

	

	

})(jQuery);

</script>
<style>
  label {
    display: inline-block;font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
	font-size: 62.5%;
    font-size:16px!important;
  }
.ui-tooltip {
	padding: 8px;
	position: absolute;
	z-index: 9999;
	max-width: 500px;
	-webkit-box-shadow: 0 0 5px #aaa;
	box-shadow: 0 0 5px #aaa;background:#fff;
}
body .ui-tooltip {
	border-width: 2px; background:#fff;
}
  </style>


</head>



<body <?php body_class();?>>

<div class="wrapper">
		<header class="header">
			<a href="/" class="header__logo">
				<div class="logo__slogan">МИР САЛЬНИКОВ</div>
				<div class="logo__text">продажа резино-технических изделий оптом и в розницу</div>
			</a>
			<div class="header__phone">8-495-133-59-35</div>

<div class="header__phone2">E-mail: <a href="mailto:rti-baltika@ya.ru">rti-baltika@ya.ru</a></div>

			<nav class="header__nav">
									<?php wp_nav_menu(array('menu' => 'Главное меню', 'menu_class' => 'menu menu-horizontal', 'container' => '')); ?>

			</nav>
		</header>