<?php
	require_once('includes/class-query.php');
	require_once('includes/class-insert.php');
	require_once('load.php');
	require_once('index.php');
	
	if ( !empty ( $_POST ) ) {
		if ( $_POST['type'] == 'add' ) {
			$add_friend = $insert->add_restaurant($_POST['user_id'], $_POST['res_id']);
		}
		
		/*if ( $_POST['type'] == 'remove' ) {
			$remove_friend = $insert->remove_friend($_POST['user_id'], $_POST['friend_id']);
		}*/
	}

	if ( !empty ( $_POST ) ) {
		$res_id = $_GET['id'];
		$add_review = $insert->add_review($logged_user_id, $res_id, $_POST);
	}

	//$logged_user_id = 3;
	//echo $logged_user_id;
	
	if ( !empty ( $_GET['id'] ) ) {
		$res_id = $_GET['id'];
		$user = $query->load_res_object($res_id); 
	}
	else 
		die();
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $user->res_name; ?></title>
		<link rel="stylesheet" href="css/style.css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
		<script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
      }
    };
    var map;

    function load() {
      map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(<?php echo $user->lat; ?>, <?php echo $user->long; ?>),
        zoom: 16,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
      downloadUrl("phpsqlajax_genxml.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("res_name");
          var address = markers[i].getAttribute("address");
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b> <br/>" + address;
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //]]>

  </script>
	</head>
	<body onload="load()">
		<div id="navigation">
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="profile-view.php">My Profile</a></li>
				<li><a href="profile-edit.php">Edit Profile</a></li>
				<li><a href="friends-directory.php">Members</a></li>
				<li><a href="friends-list.php">Following</a></li>
				<li><a href="feed-view.php">Timeline</a></li>
				<li><a href="feed-post.php">Share Status</a></li>
				<li><a href="messages-inbox.php">Inbox</a></li>
				<li><a href="messages-compose.php">Compose</a></li>
				<li><a href="res-directory.php">Find Restaurant</a></li>
				<li><a href="res-list.php">My Restaurants</a></li>
			</ul>
		</div>
		<h1><?php echo $user->res_name; ?></h1>
		<div class="content" style="float: right">
			 
			<p>Cuisine: <?php echo $user->cuisine; ?></p>
			<p>Location: <?php echo $user->address.','.' '.$user->area; ?></p>
			<!-- <?php if ( !$mine ) : ?>
				<?php if ( !in_array($user_id, $friends) ) : ?> -->
					<p>
						<form method="post">
							<input name="user_id" type="hidden" value="<?php echo $logged_user_id; ?>" />
							<input name="res_id" type="hidden" value="<?php echo $res_id; ?>" />
							<input name="type" type="hidden" value="add" />
							<input type="submit" value="Mark as been there" />
						</form>
					</p> <!--
				<?php else : ?>
					<p>
						<form method="post">
							<input name="user_id" type="hidden" value="<?php echo $logged_user_id; ?>" />
							<input name="friend_id" type="hidden" value="<?php echo $user_id; ?>" />
							<input name="type" type="hidden" value="remove" />
							<input type="submit" value="Remove Friend" />
						</form>
					</p>
				<?php endif; ?>
			<?php endif; ?> -->
		</div>
    
    <div id="map" style="width: 600px; height: 400px"></div>
    
    <div class="content" style="float: left">
		<form method="post"> 
			<input name="rev_time" type="hidden" value="<?php echo time() ?>" />
			<p>Reviews</p>
			<textarea style="width: 450px; height: 150px" placeholder="Recommend your favorite dishes or something everyone should try here..." 
				name="comment"></textarea>
			<p>
				<input style="color:#ffffff; background-color:#339966; width:150px; height:25px;" 
					type="submit" value="Post" />
			</p>
		</form>
	</div>

	<div class="content" style="float: right">
		<?php $query->do_rev_feed($_GET['id']); ?>
	</div>


	</body>
</html>