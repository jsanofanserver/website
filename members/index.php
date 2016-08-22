<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>JFS || Members</title>
<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/superhero/bootstrap.min.css" rel="stylesheet" integrity="sha256-o0IkLyCCWGBI+ryg6bL44/f8s4cb7+5bncR4LvU57a8= sha512-jptu6vg45XTY9uPX3vD5nHN4vASCN2hHl+fhmgkdd/px/bFHKMXmDXhkNmTiCpKqH6sliEPFakl2KZNav2Zo1Q==" crossorigin="anonymous">
<link href="../template.css" rel="stylesheet" type="text/css">
<link href="stylesheet.css" rel="stylesheet" type="text/css">
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-66064409-1', 'auto');
ga('send', 'pageview');
</script>
</head>

<body>
<div id="major_background"></div>
<div class="container" id="main">
	<br>
    <div class="row jmenu">
    	<div class="col-sm-2 col-sm-offset-1"><a href="../">Home</a></div>
        <div class="col-sm-2 active"><a href="#">Members</a></div>
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><a href="../map/">Overviewer</a></div>
        <div class="col-sm-2"><a href="../stats/">Stats</a></div>
        
    </div>
	<br>
    <div id="background">
		<h2>Members</h2>
        <?php
			$uuidnames = json_decode(file_get_contents("../req/uuidnames.json"), TRUE);
            foreach ($uuidnames as $member) {
                echo "<div class='user'><img src='https://minotar.net/helm/" . $member . "/130.png' alt='" . $member . "'><br>" . $member . "</div>";
            }
        ?>
    </div>
    <div id="ip">IP :: jsanofanserver.com</div>
</div>
<div id="logo"><a href="../"><img src="../images/logo.jpg"></a></div>
</body>
</html>