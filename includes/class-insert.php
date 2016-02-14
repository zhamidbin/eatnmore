<?php
	require_once('class-db.php');
	
	if ( !class_exists('INSERT') ) {
		class INSERT {
			public function update_user($user_id, $postdata) {
				global $db;
				
				$table = 's_users';
				
				$query = "
								UPDATE $table
								SET user_email='$postdata[user_email]', user_pass='$postdata[user_pass]', user_name='$postdata[user_name]'
								WHERE ID=$user_id
							";

				return $db->update($query);
			}
			
			public function add_friend($user_id, $friend_id) {
				global $db;
				
				$table = 's_friends';
				
				$query = "
								INSERT INTO $table (user_id, friend_id)
								VALUES ('$user_id', '$friend_id')
							";
				
				return $db->insert($query);
			}

			public function add_restaurant($user_id, $res_id) {
				global $db;
				
				$table = 's_visited';
				
				$query = "
								INSERT INTO $table (user_id, res_id)
								VALUES ('$user_id', '$res_id')
							";
				
				return $db->insert($query);
			}
			
			public function remove_friend($user_id, $friend_id) {
				global $db;
				
				$table = 's_friends';
				
				$query = "
								DELETE FROM $table 
								WHERE user_id = '$user_id'
								AND friend_id = '$friend_id'
							";
				
				return $db->insert($query);
			}
			
			public function add_status($user_id, $postdata) {
				global $db;
				
				$table = 's_status';
				
				$query = "
								INSERT INTO $table (user_id, status_time, status_content)
								VALUES ($user_id, '$postdata[status_time]', '$postdata[status_content]')
							";
				
				return $db->insert($query);
			}

			public function add_review($user_id, $res_id, $postdata) {
				global $db;
				
				$table = 's_review';
				
				$query = "
								INSERT INTO $table (user_id, res_id, rev_time, comment)
								VALUES ($user_id, $res_id, '$postdata[rev_time]', '$postdata[comment]')
							";
				
				return $db->insert($query);
			}
			
			public function send_message($postdata) {
				global $db;
				
				$table = 's_messages';
				
				$query = "
								INSERT INTO $table (message_time, message_sender_id, message_recipient_id, message_subject, message_content)
								VALUES ('$postdata[message_time]', '$postdata[message_sender_id]', '$postdata[message_recipient_id]', '$postdata[message_subject]', '$postdata[message_content]')
							";
				
				return $db->insert($query);
			}
		}
	}
	
	$insert = new INSERT;
?>