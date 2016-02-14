<?php
	require_once('class-db.php');

	if ( !class_exists('QUERY') ) {
		class QUERY {
			public function load_user_object($user_id) {
				global $db;
				
				$table = 's_users';
				
				$query = "
								SELECT * FROM $table
								WHERE id = $user_id
							";
				
				$obj = $db->select($query);
				
				if ( !$obj ) {
					return "No user found";
				}
				//return $obj;
				return $obj[0];			//original one
			}

			public function load_res_object($user_id) {
				global $db;
				
				$table = 's_restaurants';
				
				$query = "
								SELECT * FROM $table
								WHERE id = $user_id
							";
				
				$obj = $db->select($query);
				
				if ( !$obj ) {
					return "No user found";
				}
				//return $obj;
				return $obj[0];			//original one
			}
			
			public function load_all_user_objects() {
				global $db;
				
				$table = 's_users';
				
				$query = "
								SELECT * FROM $table
							";
				
				$obj = $db->select($query);
				
				if ( !$obj ) {
					return "No user found";
				}
				
				return $obj;
			}

			public function load_all_res_objects() {
				global $db;
				
				$table = 's_restaurants';
				
				$query = "
								SELECT * FROM $table
							";
				
				$obj = $db->select($query);
				
				if ( !$obj ) {
					return "No user found";
				}
				
				return $obj;
			}
			
			public function get_friends($user_id) {
				global $db;
				
				$table = 's_friends';
				
				$query = "
								SELECT id, friend_id FROM $table
								WHERE user_id = '$user_id'
							";
				
				$friends = $db->select($query);
				
				foreach ( $friends as $friend ) {
					$friend_ids[] = $friend->friend_id;
				}
				
				return $friend_ids;
			}

			public function get_restaurants($user_id) {
				global $db;
				
				$table = 's_visited';
				
				$query = "
								SELECT id, res_id FROM $table
								WHERE user_id = '$user_id'
							";
				
				$friends = $db->select($query);
				
				foreach ( $friends as $friend ) {
					$friend_ids[] = $friend->res_id;
				}
				
				return $friend_ids;
			}
			
			public function get_status_objects($user_id) {
				global $db;
				
				$table = 's_status';
				
				$friend_ids = $this->get_friends($user_id);
				
				if ( !empty ( $friend_ids ) ) {
					array_push($friend_ids, $user_id);
				} else {
					$friend_ids = array($user_id);
				}
				
				$accepted_ids = implode(', ', $friend_ids);
				
				$query = "
								SELECT * FROM $table
								WHERE user_id IN ($accepted_ids)
								ORDER BY status_time DESC
							";
				
				$status_objects = $db->select($query);
				
				return $status_objects;
			}

			public function get_rev_objects($res_id) {
				global $db;
				
				$table = 's_review';
				
				/*$friend_ids = $this->get_friends($user_id);
				
				if ( !empty ( $friend_ids ) ) {
					array_push($friend_ids, $user_id);
				} else {
					$friend_ids = array($user_id);
				}
				
				$accepted_ids = implode(', ', $friend_ids);*/
				
				$query = "
								SELECT * FROM $table
								WHERE res_id = '$res_id'
								ORDER BY rev_time DESC
							";
				
				$rev_objects = $db->select($query);
				
				return $rev_objects;
			}
			
			public function get_message_objects($user_id) {
				global $db;
				
				$table = 's_messages';
				
				$query = "
								SELECT * FROM $table
								WHERE message_recipient_id = '$user_id'
							";
				
				$messages = $db->select($query);
								
				return $messages;
			}
			
			public function do_user_directory() {
				$users = $this->load_all_user_objects();
				
				foreach ( $users as $user ) { ?>
					<div class="directory_item">
						<h3><a href="profile-view.php?id=<?php echo $user->id; ?>"><?php echo $user->user_name; ?></a></h3>
						<p><?php echo $user->user_email; ?></p>
					</div>
				<?php
				}
			}

			public function do_res_directory() {
				$users = $this->load_all_res_objects();
				
				foreach ( $users as $user ) { ?>
					<div class="directory_item">
						<h3><a href="res-view.php?id=<?php echo $user->id; ?>"><?php echo $user->res_name; ?></a></h3>
					</div>
				<?php
				}
			}
			
			public function do_friends_list($friends_array) {
				foreach ( $friends_array as $friend_id ) {
					$users[] = $this->load_user_object($friend_id);		//original one
				}
								
				foreach ( $users as $user ) { ?>
					<div class="directory_item">
						<h3><a href="profile-view.php?id=<?php echo $user->id; ?>"><?php echo $user->user_name; ?></a></h3>
						<p><?php echo $user->user_email; ?></p>
					</div>
				<?php
				}
			}

			public function do_res_list($friends_array) {
				foreach ( $friends_array as $friend_id ) {
					$users[] = $this->load_res_object($friend_id);		//original one
				}
								
				foreach ( $users as $user ) { ?>
					<div class="directory_item">
						<h3><a href="res-view.php?id=<?php echo $user->id; ?>"><?php echo $user->res_name; ?></a></h3>
					</div>
				<?php
				}
			}
			
			public function do_news_feed($user_id) {
				$status_objects = $this->get_status_objects($user_id);
				
				foreach ( $status_objects as $status ) {?>
					<div class="status_item">
						<?php $user = $this->load_user_object($status->user_id); ?>
						<h3><a href="profile-view.php?id=<?php echo $user->id; ?>"><?php echo $user->user_name; ?></a></h3>
						<p><?php echo $status->status_content; ?></p>
						<em><p><?php echo date('l, F jS, Y', $status->status_time); ?></p></em>
					</div>
				<?php
				}
			}

			public function do_rev_feed($res_id) {
				$rev_objects = $this->get_rev_objects($res_id);
				
				foreach ( $rev_objects as $rev ) {?>
					<div class="status_item">
						<?php $user = $this->load_user_object($rev->user_id); ?>
						<h3><a href="profile-view.php?id=<?php echo $user->id; ?>"><?php echo $user->user_name; ?></a></h3>
						<p><?php echo $rev->comment; ?></p>
						<em><p><?php echo date('l, F jS, Y', $rev->rev_time); ?></p></em>
					</div>
				<?php
				}
			}
			
			public function do_inbox($user_id) {
				$message_objects = $this->get_message_objects($user_id);
				
				foreach ( $message_objects as $message ) {?>
					<div class="status_item">
						<?php $user = $this->load_user_object($message->message_sender_id); ?>
						<h3>From: <a href="profile-view.php?id=<?php echo $user->id; ?>"><?php echo $user->user_name; ?></a></h3>
						<p><?php echo $message->message_subject; ?></p>
						<p><?php echo $message->message_content; ?></p>
						<em><p><?php echo date('l, F jS, Y', $message->message_time); ?></p></em>
					</div>
				<?php
				}
			}
		}
	}
	
	$query = new QUERY;
?>