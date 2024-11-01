<?php
/*
   Plugin Name: SWTOR Raider Plugin
   Plugin URI: http://veteres-unlimited.de/raidplaner/wordpress-plugin/
   Description: The Raidplaner plugin for the MMORPG Starwars: The old Republic.
   Author: Tobias Hillebrand
   Author URI: http://veteres-unlimited.de
   Version: 1.1.2
*/

define('SWTOR_RAID_TABLE',$wpdb->prefix . 'swtor_raids');
define('SWTOR_MEMBER_TABLE',$wpdb->prefix . 'swtor_raidmembers');
define('SWTOR_CALENDER_TABLE', $wpdb->prefix . 'eventscalendar_main');
define('SWTOR_RAIDLEVELS', serialize(array("0-10", "11-20", "21-30", "31-40", "41-49", "50-55", "55+")));

if( !class_exists( 'myPlugin' ) ) {
   class myPlugin {

	    function __construct() {
	    	register_activation_hook( __FILE__, array( &$this, 'activate' ) );
	        register_deactivation_hook( __FILE__, array( &$this, 'deactivate' ) );
	    }
	
	    function activate() {
	      	
			// profile settings
	        add_action( 'personal_options_update', array( &$this, 'save_extra_profile_fields' ) );
			add_action( 'edit_user_profile_update', array( &$this, 'save_extra_profile_fields' ) );
			
			add_action( 'show_user_profile', array( &$this, 'show_extra_profile_fields' ) );
			add_action( 'edit_user_profile', array( &$this, 'show_extra_profile_fields' ) );
			
			// backend
			add_action('admin_bar_menu', array( &$this, 'profileAddAdminMenu' ));
			add_action('admin_menu', array( &$this, 'profileAddMenu' ));
			
			// frontend 
			if (!is_admin())
				add_shortcode('raidplaner', array( &$this, 'echoRaidplaner' ));
	    }
	
	   	function deactivate() {

			// profile settings
	        remove_action( 'personal_options_update', array( &$this, 'save_extra_profile_fields' ) );
			remove_action( 'edit_user_profile_update', array( &$this, 'save_extra_profile_fields' ) );
			
			remove_action( 'show_user_profile', array( &$this, 'my_show_extra_profile_fields' ) );
			remove_action( 'edit_user_profile', array( &$this, 'my_show_extra_profile_fields' ) );
			
			// backend
			remove_action('admin_menu', array( &$this, 'profileAddMenu' ));
			
			// frontend 
			if (!is_admin())
				remove_shortcode('raidplaner', array( &$this, 'echoRaidplaner' ));
	    }
			
		// profile settings: save settings  
		function save_extra_profile_fields( $user_id ) {
	
			if ( !current_user_can( 'edit_user', $user_id ) )
				return false;
		
			/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
			update_usermeta( $user_id, 'user_mainchar', $_POST['user_mainchar'] );
			update_usermeta( $user_id, 'user_mainchar_lvl', $_POST['user_mainchar_lvl'] );
			update_usermeta( $user_id, 'user_mainchar_kind', $_POST['user_mainchar_kind'] );
			update_usermeta( $user_id, 'user_mainchar_role', $_POST['user_mainchar_role'] );
			
			update_usermeta( $user_id, 'user_firsttwink', $_POST['user_firsttwink'] );
			update_usermeta( $user_id, 'user_firsttwink_lvl', $_POST['user_firsttwink_lvl'] );
			update_usermeta( $user_id, 'user_firsttwink_kind', $_POST['user_firsttwink_kind'] );
			update_usermeta( $user_id, 'user_firsttwink_role', $_POST['user_firsttwink_role'] );	
			
			update_usermeta( $user_id, 'user_secondtwink', $_POST['user_secondtwink'] );
			update_usermeta( $user_id, 'user_secondtwink_lvl', $_POST['user_secondtwink_lvl'] );
			update_usermeta( $user_id, 'user_secondtwink_kind', $_POST['user_secondtwink_kind'] );
			update_usermeta( $user_id, 'user_secondtwink_role', $_POST['user_secondtwink_role'] );		
			
			update_usermeta( $user_id, 'user_thirdtwink', $_POST['user_thirdtwink'] );
			update_usermeta( $user_id, 'user_thirdtwink_lvl', $_POST['user_thirdtwink_lvl'] );
			update_usermeta( $user_id, 'user_thirdtwink_kind', $_POST['user_thirdtwink_kind'] );
			update_usermeta( $user_id, 'user_thirdtwink_role', $_POST['user_thirdtwink_role'] );	
			
			update_usermeta( $user_id, 'user_fourthtwink', $_POST['user_fourthtwink'] );
			update_usermeta( $user_id, 'user_fourthtwink_lvl', $_POST['user_fourthtwink_lvl'] );
			update_usermeta( $user_id, 'user_fourthtwink_kind', $_POST['user_fourthtwink_kind'] );
			update_usermeta( $user_id, 'user_fourthtwink_role', $_POST['user_fourthtwink_role'] );	
			
			update_usermeta( $user_id, 'user_fifthtwink', $_POST['user_fifthtwink'] );
			update_usermeta( $user_id, 'user_fifthtwink_lvl', $_POST['user_fifthtwink_lvl'] );
			update_usermeta( $user_id, 'user_fifthtwink_kind', $_POST['user_fifthtwink_kind'] );
			update_usermeta( $user_id, 'user_fifthtwink_role', $_POST['user_fifthtwink_role'] );	
			
			update_usermeta( $user_id, 'user_sixthtwink', $_POST['user_sixthtwink'] );
			update_usermeta( $user_id, 'user_sixthtwink_lvl', $_POST['user_sixthtwink_lvl'] );
			update_usermeta( $user_id, 'user_sixthtwink_kind', $_POST['user_sixthtwink_kind'] );
			update_usermeta( $user_id, 'user_sixthtwink_role', $_POST['user_sixthtwink_role'] );	
			
			update_usermeta( $user_id, 'user_seventhtwink', $_POST['user_seventhtwink'] );
			update_usermeta( $user_id, 'user_seventhtwink_lvl', $_POST['user_seventhtwink_lvl'] );
			update_usermeta( $user_id, 'user_seventhtwink_kind', $_POST['user_seventhtwink_kind'] );
			update_usermeta( $user_id, 'user_seventhtwink_role', $_POST['user_seventhtwink_role'] );	
			
			update_usermeta( $user_id, 'user_raidpoint_op_count', $_POST['user_raidpoint_op_count'] );
		}
		  
		// profile settings: show settings
		function show_extra_profile_fields( $user ) {	 
			$checked = "";
			include (dirname(__FILE__) . '/swtor-profil-form.php');
		}
		
		// backend menu
		function profileAddMenu() {
  			add_menu_page('SW:ToR Raider', 'SW:ToR Raider', 7, __FILE__, array( &$this, 'addRaid' ));
			add_submenu_page(__FILE__, 'Archiv', 'Archiv', 7, 'showArchive', array( &$this, 'showArchive' ));
			add_submenu_page(__FILE__, 'Options', 'Options', 10, 'options', array( &$this, 'options' ));
		}
				
		/**
		 * Add's new global menu, if $href is false menu is added but registred as submenuable
		 *
		 * $name String
		 * $id String
		 * $href Bool/String
		 *
		 * @return void
		 * @author Janez Troha
		 **/
		function add_root_menu($name, $id, $href = FALSE)
		{
			global $wp_admin_bar;
			
		    if ( !current_user_can( 'edit_posts' ) || !is_admin_bar_showing() )
		      return;
		
		    $wp_admin_bar->add_node( array(
		    'id' => $id,
		    'title' => $name,
		    'href' => $href ) );
		}
		
		/**
	     * Add's new submenu where additinal $meta specifies class, id, target or onclick parameters
		 *
		 * $name String
		 * $link String
		 * $root_menu String
		 * $meta Array
		 *
		 * @return void
		 * @author Janez Troha
		 **/
		 function add_sub_menu($name, $link, $root_menu, $meta = FALSE)
		 {
		    global $wp_admin_bar;
			
		    if ( !current_user_can( 'edit_posts' ) || !is_admin_bar_showing() )
		      return;
		    
		    $wp_admin_bar->add_menu( array(
		    'parent' => $root_menu,
		    'title' => $name,
		    'href' => $link,
		    'meta' => $meta) );
		    
		 }
		
		// Add admin bar menu
		 function profileAddAdminMenu() {
		    $this->add_root_menu("SW:ToR Raider", "swtorraid");
		    $this->add_sub_menu("SW:ToR Raider", "/wp-admin/admin.php?page=swtor-raidplaner/swtor-raider.php", "swtorraid");
		    $this->add_sub_menu("Archiv", "/wp-admin/admin.php?page=showArchive", "swtorraid");
			if (current_user_can('manage_options'))
			{
		    	$this->add_sub_menu("Options", "/wp-admin/admin.php?page=options", "swtorraid");
			}
		  }
		  
		// Frontend: show raidplaner at shortcode page
		function echoRaidplaner() {
			$html = "";	
			if (is_user_logged_in() || (get_option('swtor_raider_setshowever')=="on")) {
				$html .= myPlugin::showRaid(false);
			} else {
				$html .= "<p>You must be logged in to view the raid planer!</p>";
			}
			
			$html .= "<p>powered by <a href=\"http://veteres-unlimited.de/raidplaner/wordpress-plugin/\" style=\"font-size:0.9em\">veteres-unlimited.de</a></p>";		
			$html .= $content;
			
			return $html;
		}
		
		// print the raid planer at backend
		function addRaid() {
			echo myPlugin::showRaid(true);
		}
		
		// print the raid archive at the backend
		function showArchive() {
			$_GET["raidarchive"] = "on";
			echo myPlugin::showRaid(true);
		}

		// checks the database table to exist.
		static function checkRaidTableExists() {
			global $wpdb;
			$table_name = SWTOR_RAID_TABLE;
			if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name)
			{
				$sql = "CREATE TABLE " . $table_name . " (
				rq_id INT(11) NOT NULL AUTO_INCREMENT,
				title VARCHAR(200),
				date VARCHAR(100),
				time VARCHAR(100),
				level VARCHAR(100),
				description TEXT,
				team VARCHAR(100),
				author VARCHAR (100),
				PRIMARY KEY  id (rq_id)
				);";
		 
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($sql);

				add_option("rq_db_version", 1.0);
			}
	        //for updates
	        $installed_ver = get_option( "rq_db_version" );
	        
			if ($installed_ver == "1.0") {

				$sql = "ALTER TABLE " . $table_name . " ADD mode VARCHAR(100)";
				
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				$wpdb->query($sql);

				update_option("rq_db_version", 1.1);
			}

			if ($installed_ver == "1.1") {

				$sql = "ALTER TABLE " . $table_name . " ADD booking VARCHAR(4)";
				
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				$wpdb->query($sql);

				update_option("rq_db_version", 1.2);
			}
			
			
		}

		// validate the entries from the raid planer 
		static function checkRaidValues() {
			$err = "";
			if ($_POST["sraid_title"]=="") $err .= "Fail to set title!<br>";
			if ($_POST["sraid_time"]=="") $err .= "Fail to set time!<br>";
			$t = split(':',$_POST["sraid_time"]);
			if (count($t)!=2) $err .= "Fail to set time value!<br>";
			if ($_POST["sraid_booking"]=="") $err .= "Fail to set required booking limit!<br>";
			if ($_POST["sraid_level"]=="") $err .= "Fail to set required level!<br>";
			if ($_POST["sraid_description"]=="") $err .= "Fail to set description!<br>";
			if ($_POST["sraid_team_dd"]=="") $err .= "Fail to set damaging team members!<br>";
			if ($_POST["sraid_team_tank"]=="") $err .= "Fail to set tanking team members!<br>";
			if ($_POST["sraid_team_heal"]=="") $err .= "Fail to set healing team members!<br>";
			if ($err!="") return $err;
			
			if (!is_numeric($_POST["sraid_team_dd"])) $err .= "Team-damage-counter has to be numeric!<br>";
			if (!is_numeric($_POST["sraid_team_tank"])) $err .= "Team-tank-counter has to be numeric!<br>";
			if (!is_numeric($_POST["sraid_team_heal"])) $err .= "Team-heal-counter has to be numeric!<br>";
			if ($t[0]>24) $err .= "Time hour has to be between 0 and 24!<br>";
			if ($t[1]>59) $err .= "Time minute has to be between 0 and 59!<br>";

			return $err;
		}
		
		// checks the database table to exist.
		static function checkMemberTableExists() {
			global $wpdb;
			$table_name = SWTOR_MEMBER_TABLE;

			if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name)
			{
				$sql = "CREATE TABLE " . $table_name . " (
				id INT(11) NOT NULL AUTO_INCREMENT,
				raidid INT(100),
				userid INT(100),
				charname VARCHAR(100),
				kind VARCHAR(100),
				level VARCHAR(100),
				role VARCHAR(100),
				list VARCHAR(100),
				PRIMARY KEY  id (id)
				);";
		 
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($sql);

				add_option("mq_db_version", 1.0);
			}
			//for updates
	        $installed_ver = get_option( "mq_db_version" );
			
			if ($installed_ver == "1.0") {

				$sql = "ALTER TABLE " . $table_name . " ADD comment TEXT";
				
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				$wpdb->query($sql);

				update_option("mq_db_version", 1.1);
			}
			
	        //for updates
	        $installed_ver = get_option( "mq_db_version" );
		}
		
		// validate the entries from the member list 
		static function checkMemberValues() {
			$err = "";
			if ($_POST["sraid_userid"]=="" || $_POST["sraid_userid"]=="0") $err .= "Fail to set the user!<br>";
			if ($_POST["sraid_character"]=="") $err .= "Fail to set the character!<br>";
			if ($_POST["sraid_list"]=="") $err .= "Fail to set the list!<br>";

			return $err;
		}
		
		// returns the next raid
		static function showNextRaid() {
			global $wpdb;
			global $current_user;
  			get_currentuserinfo();
			$content = "";
			
			$quotes = $wpdb->get_results(
					'SELECT rq_id, title, date, time, level, description, team, author, mode, booking, ' .
					'UNIX_TIMESTAMP(STR_TO_DATE(date, \'%d-%b-%Y\')) AS ts '.
					'FROM ' . SWTOR_RAID_TABLE . ' ' .
					'WHERE UNIX_TIMESTAMP(STR_TO_DATE(date, \'%d-%b-%Y\')) >= UNIX_TIMESTAMP(NOW()-INTERVAL 1 DAY) '.
					'ORDER BY ts ASC'
			);
			
			if( !empty($quotes))
			{
				$today = date("d-M-Y");
				$i = get_option('swtor_amountshowraids');
				foreach($quotes as $quote)
				{
					if ((strtotime($quote->date)-time()>0)|(date('d-M-Y', strtotime($quote->date)) == $today)) {
						
						$content .= "<div class=\"raid\">";
						$content .= "<span class=\"title\">".$quote->title;
						if ($quote->mode != "")
						{
							$content .= " (".$quote->mode.")";
						}
						$content .= "</span><br>";
						if (date('d-M-Y', strtotime($quote->date)) == $today) $content .= "<span class=\"today\">".$quote->date."</span>";
						else $content .= $quote->date;
						$content .= " at " . $quote->time;
						$content .= " (<a href=\"".get_raidurl("raidaction=details&raidid=".$quote->rq_id)."\">details</a>)";
						$content .= "</div>";
						
						$i--;
					}

					if ($i <= 0) break;
				}
			}
			else
			{
				$content .= "<div class=\"raid\" style=\"text-align: center\">No raid planed.";
				$content .= "</div>";
			}
			
			$content .= "<div class=\"swtor-raider-advertise\" style=\"text-align: center; font-weight: bold;\">";				
			$content .= "<a href=\"http://www.hardwareluxx.de/community/f314/prodigy-mluxx-ein-kraftzwerg-auf-testosteron-1014047.html\" target=\"_blank\">- Please click for me! -</a>";
			$content .= "</div>";
			
			return $content;
		}
		
		// get the raid planer
		static function showRaid($backend) {
			
			try {
				
				global $wpdb;
				global $current_user;
	  			get_currentuserinfo();
						
				if (($_POST["action"]=="save") || ($_POST["sraid_copy"]=="on")) {
					myPlugin::checkRaidTableExists();
					$errors = myPlugin::checkRaidValues();
					
					if ($errors == "") {
						
						$query = "INSERT INTO ".SWTOR_RAID_TABLE.
							" (title, mode, date, time, booking, level, description, team, author) " .
				        	"VALUES (".
				        	"'".mysql_real_escape_string($_POST["sraid_title"])."',".
				        	"'".mysql_real_escape_string($_POST["sraid_mode"])."',".
				        	"'".mysql_real_escape_string($_POST["sraid_date"])."',".
				        	"'".mysql_real_escape_string($_POST["sraid_time"])."',".
				        	"'".mysql_real_escape_string($_POST["sraid_booking"])."',".
				        	"'".mysql_real_escape_string($_POST["sraid_level"])."',".
				        	"'".mysql_real_escape_string($_POST["sraid_description"])."',".
				        	"'(".mysql_real_escape_string($_POST["sraid_team_dd"])."/".
				        		mysql_real_escape_string($_POST["sraid_team_tank"])."/".
				        		mysql_real_escape_string($_POST["sraid_team_heal"]).")',".
				        	"'".$current_user->user_login."')";
	
						$results = $wpdb->query( $query );
						
						if (function_exists('filterEventsCalendarLarge') && (get_option("swtor_raider_seteventcalender") == "on")) {
							$query = "SELECT * FROM ".SWTOR_RAID_TABLE.
								" WHERE title LIKE '".mysql_real_escape_string($_POST["sraid_title"])."%' ".
								" AND date LIKE '".mysql_real_escape_string($_POST["sraid_date"])."' ".
								" AND time LIKE '".mysql_real_escape_string($_POST["sraid_time"])."' ";
								
							$data = $wpdb->get_row($query);		
						
							$calenderDate = date('Y-m-d', strtotime($_POST["sraid_date"]));
							$calenderLink = get_raidurl("raidaction=details&raidid=".$data->rq_id);
							
							$query = "INSERT INTO ".SWTOR_CALENDER_TABLE.
								" (eventTitle, eventDescription, eventLocation, eventLinkout, ".
								"eventStartDate, eventStartTime, eventEndDate, eventEndTime, accessLevel, postID) " .
					        	"VALUES (".
					        	"'[Raid] ".mysql_real_escape_string($_POST["sraid_title"]);
								
								if ($_POST["sraid_mode"]!="") {
									$query .= " (".mysql_real_escape_string($_POST["sraid_mode"]).")";
								}				        	
					        	$query .= "',".
					        	"'".mysql_real_escape_string($_POST["sraid_description"])."',".
					        	"'',".
					        	"'".$calenderLink."',".
					        	"'".$calenderDate."',".
					        	"'".mysql_real_escape_string($_POST["sraid_time"])."',".
					        	"'".$calenderDate."',".
					        	"'".mysql_real_escape_string($_POST["sraid_time"])."',".
					        	"'public',".
					        	"0)";			        	
	
							$results = $wpdb->query( $query );
						}
						$_POST["action"]="done";	
					}	
				}
				
				if ($_POST["action"]=="update") {
					myPlugin::checkRaidTableExists();
					$errors = myPlugin::checkRaidValues();
	
					if ($errors == "") {
						$query = "UPDATE ".SWTOR_RAID_TABLE." SET ".
				        	"title='".mysql_real_escape_string($_POST["sraid_title"])."', ".
				        	"mode='".mysql_real_escape_string($_POST["sraid_mode"])."', ".
				        	"date='".mysql_real_escape_string($_POST["sraid_date"])."',".
				        	"time='".mysql_real_escape_string($_POST["sraid_time"])."',".
				        	"booking='".mysql_real_escape_string($_POST["sraid_booking"])."',".
				        	"level='".mysql_real_escape_string($_POST["sraid_level"])."',".
				        	"description='".mysql_real_escape_string($_POST["sraid_description"])."',".
				        	"team='(".mysql_real_escape_string($_POST["sraid_team_dd"])."/".
				        		mysql_real_escape_string($_POST["sraid_team_tank"])."/".
				        		mysql_real_escape_string($_POST["sraid_team_heal"]).")' ".
				        	//"author='".$current_user->user_login."' ".
				        	"WHERE rq_id=" . mysql_real_escape_string($_POST["rq_id"]);
	
						$results = $wpdb->query( $query );
						
						if (function_exists('filterEventsCalendarLarge') && (get_option("swtor_raider_seteventcalender") == "on")) {
																		
							$calenderDate = date('Y-m-d', strtotime($_POST["sraid_date"]));
							$calenderLink = get_raidurl("raidaction=details&raidid=".mysql_real_escape_string($_POST["rq_id"]));
							
							$query = "UPDATE ".SWTOR_CALENDER_TABLE." SET ".
								"eventTitle='[Raid] ".mysql_real_escape_string($_POST["sraid_title"]).
								" (".mysql_real_escape_string($_POST["sraid_mode"]).")',".
								"eventDescription='".mysql_real_escape_string($_POST["sraid_description"])."',".
								"eventLocation='',".
								"eventStartDate='".$calenderDate."',".
								"eventStartTime='".mysql_real_escape_string($_POST["sraid_time"])."',".
								"eventEndDate='".$calenderDate."',".
								"eventEndTime='".mysql_real_escape_string($_POST["sraid_time"])."',".
								"accessLevel='public',".
								"postID=0 ".
								"WHERE eventLinkout='".$calenderLink."'";	        	
	
							$results = $wpdb->query( $query );
						}
						
						$_POST["action"]="done";	
					}	
				}
				
				if ($_POST["action"]=="delete") {
					myPlugin::checkRaidTableExists();
	
					$query = "DELETE FROM ".SWTOR_RAID_TABLE." WHERE rq_id=" . mysql_real_escape_string($_POST["rq_id"]);
					$results = $wpdb->query( $query );
					
					$query = "DELETE FROM ".SWTOR_MEMBER_TABLE." WHERE raidid=" . mysql_real_escape_string($_POST["rq_id"]);
					$results = $wpdb->query( $query );
					
					if (function_exists('filterEventsCalendarLarge') && (get_option("swtor_raider_seteventcalender") == "on")) {
						$calenderLink = "?raidaction=details&raidid=".mysql_real_escape_string($_POST["rq_id"]);
						$query = "DELETE FROM ".SWTOR_CALENDER_TABLE." WHERE eventLinkout LIKE '%".$calenderLink."'";
						$results = $wpdb->query( $query );
					}
					
					$_POST["action"]="done";					
				}
				
				if (($_POST["action"]=="addmember") && ($_POST["sraid_character"]!=""))
				{
					myPlugin::checkMemberTableExists();
					$errors = myPlugin::checkMemberValues();
					
					if ($errors == "") {
	
						$flags = array(
							'user_mainchar', 
							'user_firsttwink', 
							'user_secondtwink', 
							'user_thirdtwink', 
							'user_fourthtwink', 
							'user_fifthtwink', 
							'user_sixthtwink',
							'user_seventhtwink',
						);
						
						$level = ""; $role = "";
						foreach ( $flags as $flag ) :
							
							$char = esc_attr( get_the_author_meta( $flag, $_POST["sraid_userid"] ));
							if ($char != "")
							{
								$codedchar = htmlentities($char, ENT_QUOTES);
															
								if ($char==$_POST["sraid_character"]) {
									$level = esc_attr( get_the_author_meta( $flag.'_lvl', $_POST["sraid_userid"] ));
									$role = esc_attr( get_the_author_meta( $flag.'_role', $_POST["sraid_userid"] ));
									$kind = esc_attr( get_the_author_meta( $flag.'_kind', $_POST["sraid_userid"] ));
									
									echo $level.",".$role.",".$kind."<br>";
								}
							}
							
						endforeach; 
						
						if ($level=="") {
							$errors .= "The character level is not defined. Maybe you have to update your profile!<br/>";
						}	
						if ($role=="") {
							$errors .= "The character role is not defined. Maybe you have to update your profile!<br/>";
						}
						if ($kind=="") {
							$errors .= "The character kind is not defined. Maybe you have to update your profile!<br/>";
						}
						$usercount = $wpdb->get_var('SELECT COUNT(*) FROM '.SWTOR_MEMBER_TABLE.' WHERE userid='.$_POST["sraid_userid"].' AND raidid='.$_GET["raidid"]);
						if (intval($usercount)>0) {
							$errors .= "The user is already set to a list! Only one character per user allowed.<br/>";
						}	
							
						$raid = $wpdb->get_row( 'SELECT * FROM '.SWTOR_RAID_TABLE.' WHERE rq_id='.$_GET["raidid"]);
						$levels = unserialize(SWTOR_RAIDLEVELS);
						if (!in_array($level, $levels)) {
							$errors .= "The character level is not defined correctly. Maybe you have to update your profile!<br/>";
						}
						else if (array_search($raid->level, $levels) > array_search($level, $levels)) {
								$errors .= "The character level does not match the raid level range. Maybe you have to update your profile!<br/>";
						}
						$rolecount = $wpdb->get_var('SELECT COUNT(*) FROM '.SWTOR_MEMBER_TABLE.' WHERE raidid='.$_GET["raidid"].' AND role=\''.$role.'\' AND list=\'raid\'');		
						$team = $raid->team;
						$team = substr($team, 1, -1);
						$members = split('/',$team);
						
						if ($_POST["sraid_list"]=="raid") {
							if ($role=="Damage") {
								if ($members[0]==$rolecount) {
									$errors .= "The damage role slots are currently booked! You can only be placed within the wait list.<br/>";
								}
							}
							if ($role=="Tank") {
								if ($members[1]==$rolecount) {
									$errors .= "The tank role slots are currently booked! You can only be placed within the wait list.<br/>";
								}
							}
							if ($role=="Heal") {
								if ($members[2]==$rolecount) {
									$errors .= "The heal role slots are currently booked! You can only be placed within the wait list.<br/>";
								}
							}
						}
	
						if ($errors=="")
						{
							$query = "INSERT INTO ".SWTOR_MEMBER_TABLE.
								" (raidid, userid, charname, kind, level, role, list, comment) " .
					        	"VALUES (".
					        	"'".mysql_real_escape_string($_GET["raidid"])."',".
					        	"'".mysql_real_escape_string($_POST["sraid_userid"])."',".
					        	"'".mysql_real_escape_string($_POST["sraid_character"])."',".
					        	"'".mysql_real_escape_string($kind)."',".
					        	"'".mysql_real_escape_string($level)."',".
					        	"'".mysql_real_escape_string($role)."',".
					        	"'".mysql_real_escape_string($_POST["sraid_list"])."',".
					        	"'".mysql_real_escape_string($_POST["sraid_comment"])."')";
		
							$results = $wpdb->query( $query );
							$_POST["action"]="done";
							
							if ($_POST["sraid_list"]=="raid") {
								// increment operation counter
								$opCount = get_the_author_meta( 'user_raidpoint_op_count', $_POST["sraid_userid"] );
								if ($opCount=="") $opCount==0;
								$opCount = intval($opCount);
								$opCount += 1;
								update_usermeta( $_POST["sraid_userid"], 'user_raidpoint_op_count', $opCount );
							}
						}
					}	
				}
	
				if ($_GET["raidaction"]=="resetraidpoints") {
					update_usermeta( $_GET["userid"], 'user_raidpoint_op_count', 0 );
					$_GET['raidaction']="memberdel";
				}
				
				if ($_GET["raidaction"]=="memberwait") {
					myPlugin::checkMemberTableExists();
					
					$query = "UPDATE ".SWTOR_MEMBER_TABLE." SET ".
				        	"list='wait' ".
				        	"WHERE raidid=" . mysql_real_escape_string($_GET["raidid"])." ".
				        	"AND userid=". mysql_real_escape_string($_GET["userid"]);
	
					$results = $wpdb->query( $query );
					$_GET["raidaction"]="details";
					
					// decrement operation counter
					$opCount = get_the_author_meta( 'user_raidpoint_op_count', $_GET["userid"] );
					if ($opCount=="") $opCount==0;
					$opCount = intval($opCount);
					$opCount -= 1;
					if ($opCount<0) $opCount=0;
					update_usermeta( $_GET["userid"], 'user_raidpoint_op_count', $opCount );
				}
				
				if ($_GET["raidaction"]=="memberraid") {
					myPlugin::checkMemberTableExists();
					
					$flags = array('user_mainchar', 'user_firsttwink', 'user_secondtwink', 'user_thirdtwink');
					$level = ""; $role = "";
					foreach ( $flags as $flag ) :
						$char = esc_attr( get_the_author_meta( $flag, $_GET["userid"] ));
						if ($char==$_GET["character"]) {
							$level = esc_attr( get_the_author_meta( $flag.'_lvl', $_GET["userid"] ));
							$role = esc_attr( get_the_author_meta( $flag.'_role', $_GET["userid"] ));
						}
					endforeach; 
					
					$raid = $wpdb->get_row( 'SELECT * FROM '.SWTOR_RAID_TABLE.' WHERE rq_id='.$_GET["raidid"]);
					$rolecount = $wpdb->get_var('SELECT COUNT(*) FROM '.SWTOR_MEMBER_TABLE.' WHERE raidid='.$_GET["raidid"].' AND role=\''.$role.'\' AND list=\'raid\'');		
					$team = $raid->team;
					$team = substr($team, 1, -1);
					$members = split('/',$team);
					
					$errors="";
	
					if ($role=="Damage") {
						if ($members[0]==$rolecount) {
							$errors .= "The damage role slots are currently booked! You can only be placed within the wait list.<br/>";
						}
					}
					if ($role=="Tank") {
						if ($members[1]==$rolecount) {
							$errors .= "The tank role slots are currently booked! You can only be placed within the wait list.<br/>";
						}
					}
					if ($role=="Heal") {
						if ($members[2]==$rolecount) {
							$errors .= "The heal role slots are currently booked! You can only be placed within the wait list.<br/>";
						}
					}
					
					if ($errors=="") {
						$query = "UPDATE ".SWTOR_MEMBER_TABLE." SET ".
					        	"list='raid' ".
					        	"WHERE raidid=" . mysql_real_escape_string($_GET["raidid"])." ".
					        	"AND userid=". mysql_real_escape_string($_GET["userid"]);
		
						$results = $wpdb->query( $query );
						
						// increment operation counter
						$opCount = get_the_author_meta( 'user_raidpoint_op_count', $_GET["userid"] );
						if ($opCount=="") $opCount==0;
						$opCount = intval($opCount);
						$opCount += 1;
						update_usermeta( $_GET["userid"], 'user_raidpoint_op_count', $opCount );
					}
					$_GET["raidaction"]="details";
				}
				
				if ($_GET['raidaction']=="memberedit") {
					myPlugin::checkMemberTableExists();
					
					$query = "SELECT * FROM " . SWTOR_MEMBER_TABLE . " ".
							"WHERE raidid=" . mysql_real_escape_string($_GET["raidid"])." ".
				        	"AND userid=". mysql_real_escape_string($_GET["userid"]);
				        	
					$quotes = $wpdb->get_results($query);

					if( !empty($quotes))
					{
						foreach($quotes as $quote)
						{
							$_POST["sraid_list"] = $quote->list;
							$_POST["sraid_character"] = $quote->charname;
							$_POST["sraid_comment"] = $quote->comment;
						}
					}					
					
					$query = "DELETE FROM ".SWTOR_MEMBER_TABLE." ".
				        	"WHERE raidid=" . mysql_real_escape_string($_GET["raidid"])." ".
				        	"AND userid=". mysql_real_escape_string($_GET["userid"]);
	
					$results = $wpdb->query( $query );				
					
					// decrement operation counter				
					if (isset($_GET['raidlist'])) {
						$opCount = get_the_author_meta( 'user_raidpoint_op_count', $_GET["userid"] );
						if ($opCount=="") $opCount==0;
						$opCount = intval($opCount);
						$opCount -= 1;
						update_usermeta( $_GET["userid"], 'user_raidpoint_op_count', $opCount );
					}
					
					$edited = true;
					$_GET["raidaction"]="details";
					$_POST["action"]="done";
				}
				
				if ($_GET['raidaction']=="memberdel") {
					myPlugin::checkMemberTableExists();
					
					$query = "DELETE FROM ".SWTOR_MEMBER_TABLE." ".
				        	"WHERE raidid=" . mysql_real_escape_string($_GET["raidid"])." ".
				        	"AND userid=". mysql_real_escape_string($_GET["userid"]);
	
					$results = $wpdb->query( $query );				
					
					// decrement operation counter				
					if (isset($_GET['raidlist'])) {
						$opCount = get_the_author_meta( 'user_raidpoint_op_count', $_GET["userid"] );
						if ($opCount=="") $opCount==0;
						$opCount = intval($opCount);
						$opCount -= 1;
						update_usermeta( $_GET["userid"], 'user_raidpoint_op_count', $opCount );
					}
					
					$_GET["raidaction"]="details";
					$_POST["action"]="done";
				}
				?>
				
				<?php ob_start(); ?>
				
				<div class="wrap swtor_raidplaner">
					<?php if ($backend) { ?>
					<h2>SW:ToR Raid Planer</h2>
					<p>
						This is a simple raid planer to use for the mmorpg 'Starwars: The old Republic'.<br/>
						The charackter informations are set within the user profiles. To add the raid planer to the frontend, just add the shortcode [ raidplaner ] to a page.<br/>
					</p>
					<?php }
						if ($backend || ($_GET["raidaction"]!="details")) {
							if (!isset($_GET["raidarchive"])) 
								echo "<h3>SW:ToR Raider Overview</h3>";
							else
								echo "<h3>SW:ToR Raider Archive</h3>";
						}
					?>
					<p>
					<?php if ($backend || ($_GET["raidaction"]!="details")) {
							if (!$backend && function_exists('filterEventsCalendarLarge')) {
								echo filterEventsCalendarLarge();
							} 
							include(dirname(__FILE__) . '/swtor-backend-overview.php');
						}
					?>
					</p>
					
					<?php if ($_POST["action"]=="done") {
						include (dirname(__FILE__) . '/swtor-backend-doneRaid.php');
					} else if ($backend && $_GET["raidaction"]=="details") {
						include (dirname(__FILE__) . '/swtor-backend-detailRaid.php');
					} else if (!$backend && $_GET["raidaction"]=="details") {
						include (dirname(__FILE__) . '/swtor-frontend-detailRaid.php');
					} else if ($backend && ($_GET["raidaction"]=="edit")) {
						include (dirname(__FILE__) . '/swtor-backend-editRaid.php');
					} else if ($backend && ($_GET["raidaction"]=="delete")) {
						include (dirname(__FILE__) . '/swtor-backend-deleteRaid.php');
					} else if (($backend || isset($_GET['showraidadd'])) && !isset($_GET["raidarchive"])) {
						include (dirname(__FILE__) . '/swtor-backend-addRaid.php'); 
					}				
					?>
					
				</div>
				<?php
				$inhalte = ob_get_contents();
				ob_end_clean();
				
				return $inhalte;
			}
			catch (Exception $e)
		    {
		        echo get_class($e)." thrown within the exception handler. Message: ".$e->getMessage()." on line ".$e->getLine();
		    }
		}
		
		// show the options at the backend
		function options() {
			global $wpdb;
			
			if ($_POST["action"]=="saveOptions") {
				update_option("swtor_raider_url", $_POST["swtor_raider_url"]);
				update_option("swtor_raider_seteventcalender", $_POST["swtor_raider_seteventcalender"]);
				update_option("swtor_raider_setguestraiders", $_POST["swtor_raider_setguestraiders"]);
				update_option("swtor_raider_setclasses", $_POST["swtor_raider_setclasses"]);
				update_option("swtor_raider_setshowever", $_POST["swtor_raider_setshowever"]);
				
				if ($_POST["swtor_raider_resetraidpoints"]=="on") {
					$wp_user_search = $wpdb->get_results("SELECT ID FROM $wpdb->users ORDER BY ID");
					foreach ( $wp_user_search as $userid ) {
						$user_id = (int) $userid->ID;
						update_usermeta( $user_id, 'user_raidpoint_op_count', 0 );
					}
				}
			}
			
			include (dirname(__FILE__) . '/swtor-backend-options.php');
		}
		
	}
}

// parse the url 
function get_raidurl($get)
{
	$url = get_option("swtor_raider_url");
	if (strpos($url,"?")===false)
	{
		return $url."?".$get;
	}
	
	return $url."&".$get;
}

// shows the widget content
function raider_widget_nextRaid_display()
{
    $content = "<h2 class=\"widgettitle\">Next Raid</h2>";
	$content .= myPlugin::showNextRaid();
	echo $content;
}
function swtor_widget_control ()
{
	$data = get_option('swtor_amountshowraids');
  ?>
  <p>
  	<label>Max. amount of Raids: <input name="swtor_amountshowraids" type="text" value="<?php echo $data; ?>" /></label>
  </p>
  <?php
   if (isset($_POST['swtor_amountshowraids'])){
    update_option('swtor_amountshowraids', $_POST['swtor_amountshowraids']);
  }
}
wp_register_sidebar_widget(
    'swtor_nextraider',        
    'SW:ToR Raider - Next Raid',
    'raider_widget_nextRaid_display', 
    array(                  // options
        'description' => 'Shows next Raid'
    )
);
register_widget_control(
	'swtor_nextraider',
	'swtor_widget_control'
);

// main
if( class_exists( 'myPlugin' ) ) {
   $myPluginObject = new myPlugin();
}

if( isset( $myPluginObject ) ) {
   add_action( 'init', array( &$myPluginObject, 'activate' ) );
}
?>