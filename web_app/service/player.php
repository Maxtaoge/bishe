
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<?php 
	include('../conn.php');
	$id=$_GET['id'];
	if($_GET['action'] == "play"){
		$q="select * from upload_movie where upload_id=$id limit 1";//设置查询指令
		$result=mysql_query($q);//执行查询
		if($result){
	 while($row=mysql_fetch_assoc($result))//将result结果集中查询结果取出一条
{
	$pic=$row["pic_name"];

	?>
	<meta charset=utf-8>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
</script>
<script>

  var status=0;
    $(document).ready(function(){  
    var video = $('#myvideo');  
    $("#play").click(function(){ if( status==1){
    	video[0].pause(); 
    	status=0;
    	}
    	else {
    		video[0].play();
    		status=1;
    		
    	}
    
        });  
  
    $("#pause").click(function(){ video[0].pause(); });  
    $("#go10").click(function(){  video[0].currentTime+=10;  });
    $("#back10").click(function(){  video[0].currentTime-=10;  });
    $("#rate1").click(function(){  video[0].playbackRate+=2;  });
    $("#rate0").click(function(){  video[0].playbackRate-=2;  });
    $("#volume1").click(function(){  video[0].volume+=0.1;  });
    $("#volume0").click(function(){  video[0].volume-=0.1;  });
    $("#muted1").click(function(){  video[0].muted=true;  });
    $("#muted0").click(function(){  video[0].muted=false;  });
    $("#full").click(function(){ 
      video[0].webkitEnterFullscreen(); // webkit类型的浏览器
      video[0].mozRequestFullScreen();  // FireFox浏览器
    });
});
    $(document).keydown(function(event){ 
    	//判断当event.keyCode 为37时（即左方面键），执行函数to_left(); 
    	//判断当event.keyCode 为39时（即右方面键），执行函数to_right(); 
    	var video = $('#myvideo'); 
    	 if(event.keyCode == 37){ 
    		 video[0].currentTime-=10;
    	        }else if (event.keyCode == 39){
    	        	video[0].currentTime+=10;
    	        } 
    	       
    	}); 

</script>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>TGM MOVIE</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Google Webfonts -->
	<link href='http://fonts.useso.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
	<link href='http://fonts.useso.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../css/icomoon.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="../css/magnific-popup.css">
	<!-- Salvattore -->
	<link rel="stylesheet" href="../css/salvattore.css">
	<!-- Theme Style -->
	<link rel="stylesheet" href="../css/style.css">
	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div id="fh5co-offcanvass">
		<a href="#" class="fh5co-offcanvass-close js-fh5co-offcanvass-close">Menu <i class="icon-cross"></i> </a>
		<h1 class="fh5co-logo"><a class="navbar-brand" href="index.html">Hydrogen</a></h1>
		<ul>
			<li><a href="index.html">Home</a></li>
			<li><a href="about.html">About</a></li>
			<li class="active"><a href="pricing.html">Pricing</a></li>
			<li><a href="contact.html">Contact</a></li>
		</ul>
		<h3 class="fh5co-lead">Connect with us</h3>
		<p class="fh5co-social-icons">
			<a href="#"><i class="icon-twitter"></i></a>
			<a href="#"><i class="icon-facebook"></i></a>
			<a href="#"><i class="icon-instagram"></i></a>
			<a href="#"><i class="icon-dribbble"></i></a>
			<a href="#"><i class="icon-youtube"></i></a>
		</p>
	</div>
	<header id="fh5co-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a href="#" class="fh5co-menu-btn js-fh5co-menu-btn">Menu <i class="icon-menu"></i></a>
					<a class="navbar-brand" href="index.html"><?php echo $row['movie_name']; ?></a>		
				</div>
			</div>
		</div>
	</header>
	<!-- END .header -->

	<div id="fh5co-main">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h4><?php echo '影片：'.$row['major_actor'].$row['describ']; ?></h4>
			         <div style="text-align:center;">
            <video id="myvideo" width="60%">
    <source src="<?php echo $row['movie_link']; ?>" type="video/mp4" />
    
        
               </video>
               <hr>
          <button id="play">&#x25BA;</button>
            <button id="go10">快进10秒</button>
           <button id="back10">快退10秒</button>
            <button id="rate1">播放速度+</button>
            <button id="rate0">播放速度-</button>
            <button id="volume1">声音+</button>
            <button id="volume0">声音-</button>
             <button id="muted1">静音</button>
             <button id="muted0">解除静音</button>
             <button id="full">全屏</button>
        </div> 
					
	              </div>
					
				</div>
        		
        	</div>
       </div>
	</div>
<?php 
}
}
else {
	echo "没有这条记录";
}
}
?>
	
 
	<footer id="fh5co-footer">
		
		<div class="container">
			<div class="row row-padded">
				<div class="col-md-12 text-center">
					<p class="fh5co-social-icons">
						<a href="#"><i class="icon-twitter"></i></a>
						<a href="#"><i class="icon-facebook"></i></a>
						<a href="#"><i class="icon-instagram"></i></a>
						<a href="#"><i class="icon-dribbble"></i></a>
						<a href="#"><i class="icon-youtube"></i></a>
					</p>
					<p><small>&copy; Hydrogen Free HTML5 Template. All Rights Reserved. <br>More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a> | Images by: <a href="http://pexels.com" target="_blank">Pexels</a> </small></p>
				</div>
			</div>
		</div>
	</footer>


	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="../js/jquery.waypoints.min.js"></script>
	<!-- Magnific Popup -->
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<!-- Salvattore -->
	<script src="../js/salvattore.min.js"></script>
	<!-- Main JS -->
	<script src="../js/main.js"></script>

	

	
</body>
</html>

