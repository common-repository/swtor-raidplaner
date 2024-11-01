<table width="100%">
	<tr>
		<td width="50%" style="padding-right: 10px" valign="top">
			<h3 style="margin-bottom:0px">Details of the Raid</h3>
			<a href="<?php echo get_option('swtor_raider_url'); ?>">Back to raid overview</a>
			<p>
				<?php 
				$raidleadId = -1;
				$raidbooking = -1;
				$quotes = $wpdb->get_results( 'SELECT * FROM ' . SWTOR_RAID_TABLE . ' WHERE rq_id=' . intval($_GET["raidid"]));
			
				if( !empty($quotes))
				{
					foreach($quotes as $quote)
					{
						$booking = false;
						if ($quote->booking != "-1") {						
							$bookTime = strtotime($quote->date." ".$quote->time) - (intval($quote->booking) * 3600);
							$booking = ($bookTime-time() > 0);	// only book raid if true
						}
			
						$author = get_userdatabylogin($quote->author);
						if($author) $raidleadId = $author->ID;
					?>	    
					    <table cellpadding="0" cellspacing="0" border="0" class="widefat" width="100%">
							<tr>
								<td width="200"><label>Title</label></td>
								<td><?php echo stripslashes($quote->title); ?></td>
							</tr>
							<tr>
								<td><label>Mode</label></td>
								<td><?php echo $quote->mode; ?></td>
							</tr>	
							<tr>
								<td><label>Date</label></td>
								<td><?php echo $quote->date; ?></td>
							</tr>
							<tr>
								<td><label>Time</label></td>
								<td><?php echo $quote->time; ?></td>
							</tr>
							<tr>
								<td><label>Author</label></td>
								<td><?php echo $quote->author; ?></td>
							</tr>
							<tr>
								<td><label>Booking</label></td>
								<td>
									<?php 
										$raidbooking = $quote->booking;
										switch ($quote->booking) {
											case "0": echo "no booking limit"; break;
											case "1": echo "1 hour before"; break;
											case "3": echo "3 hours before"; break;
											case "8": echo "8 hours before"; break;
											case "24": echo "1 day before"; break;
											case "48": echo "2 days before"; break;
											case "120": echo "5 days before"; break;
											case "-1": echo "only the leader can book"; break;
											default: echo "not defined"; break;
										}
									?>
								</td>
							</tr>
							<tr>
								<td><label>Level</label></td>
								<td><?php echo $quote->level; ?></td>
							</tr>
							<tr>
								<td valign="top"><label>Description</label></td>
								<td><?php echo stripslashes($quote->description); ?></td>
							</tr>
							<tr>
								<?php 
									$team = $quote->team;
									$team = substr($team, 1, -1);
									$members = split('/',$team);
								?>
								<td valign="middel"><label>Team</label></td>
								<td>Damage:<?php echo $members[0]; ?> Tank:<?php echo $members[1]; ?> Heal:<?php echo $members[2]; ?></td>
							</tr>
						</table>
					<?php } 
				} ?>
			</p>
			<hr/>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<h3>Memberlist of the Raid</h3>
			<p>			    
			    <table class="widefat" width="45%">
			    	<thead>
					    <tr>
					        <th>Name</th>
					        <th>Character</th>
					        <th>Kind(Level)</th>
					        <th>Role</th>
					        <th>RP*</th>
					        <th></th>
					        <th>Action</th>
					    </tr>
					</thead>
					<tbody>
					<?php $quotes = $wpdb->get_results( 'SELECT * FROM ' . SWTOR_MEMBER_TABLE . ' WHERE raidid=' . intval($_GET["raidid"]) . ' AND list=\'raid\'');

					if( !empty($quotes))
					{
						foreach($quotes as $quote)
						{ 
							$user = get_userdata( $quote->userid );
						?>
							<tr>
								<td>
									<?php 
																			
										if (get_option('swtor_raider_setguestraiders')!="on") {
											
											echo $user->user_nicename;
											
										} else {
											
											echo $user->user_nicename;
											
											if (function_exists('current_user_is')) //s2Member installed?
											{
												if (!user_can($user->ID, "access_s2member_level1"))
												{
													echo "<span style=\"font-size:0.8em\"> (Guest)</span>";
												}
											}
										}
									?>
								</td>
								<td><?php echo $quote->charname; ?></td>
								<td>
									<?php if (file_exists(dirname(__FILE__) . '/img/'.$quote->kind.'.png')) {?>
									<img style="width:15px; height: 15px; padding-right:3px;" src="<?php echo plugins_url( 'img/'.$quote->kind.'.png' , __FILE__ ); ?>" alt="<?php echo $quote->kind; ?>">
									<?php } echo $quote->kind.' ('.$quote->level.')' ?>
								</td>
								<td><?php echo $quote->role; ?></td>
								<td><?php 
										$e = get_the_author_meta( 'user_raidpoint_op_count', $quote->userid );
										if ($e=="") echo 0;
										else echo $e;
									?>
								</td>
								<td>
									<?php if ($quote->comment != "") { ?>
										<style type="text/css">
										<!--
											a.sr_tooltip_<?php echo $quote->userid; ?> {text-decoration:none;}
											.sr_tooltip_<?php echo $quote->userid; ?> span.sr_info{display:none;}
											.sr_tooltip_<?php echo $quote->userid; ?>:hover span.sr_info{display:block;position:absolute; margin-left: 20px; margin-top: -30px;}
										-->
										</style>
										
										<a href="#hint" class="sr_tooltip_<?php echo $quote->userid; ?>">
											<img style="width:13px; height:13px; padding-right:3px; paddig-top:2px;" src="<?php echo plugins_url( 'img/comment.png' , __FILE__ ); ?>" alt="<?php echo stripslashes(trim($quote->comment)); ?>">
											<span class="sr_info"><?php echo stripslashes(trim($quote->comment)); ?></span>
										</a>
									<?php } ?>
								</td>
								<td>
									<?php if (($quote->userid==$current_user->ID)||($raidleadId==$current_user->ID)) {?>
										<?php if ($raidbooking!=-1) { ?>
			     						<a href="<?php echo get_raidurl("raidaction=memberdel&raidid=".$_GET["raidid"]."&userid=".$user->id."&character=".$quote->charname); ?>">delete</a>
			     						&nbsp;|&nbsp;<a href="<?php echo get_raidurl("raidaction=memberedit&raidid=".$_GET["raidid"]."&userid=".$user->id."&character=".$quote->charname); ?>">edit</a>
			     						<?php } if (($booking)||($raidleadId==$current_user->ID)) {?>
				     						&nbsp;|&nbsp;<a href="<?php echo get_raidurl("raidaction=memberwait&raidid=".$_GET["raidid"]."&userid=".$user->id."&character=".$quote->charname); ?>">wait</a>
				     					<?php } ?>
			     					<?php } ?>
								</td>
							</tr>
						<?php } 
					} else {?>
					<tr>
						<td colspan="7" align="center"><label>No members at this list yet.</label></td>
					</tr>
					<?php } ?>
				</table>
				<span class="swtor_raiderdescription">Members at the list are fixed for playing. *Raidpoints</span>
			</p>
			<hr/>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<h3>Waitlist of the Raid</h3>
			<p> 
			    <table class="widefat" width="45%">
			    	<thead>
					    <tr>
					        <th>Name</th>
					        <th>Character</th>
					        <th>Kind(Level)</th>
					        <th>Role</th>
					        <th>RP*</th>
					        <th></th>
					        <th>Action</th>
					    </tr>
					</thead>
					<tbody>
					<?php $quotes = $wpdb->get_results( 'SELECT * FROM ' . SWTOR_MEMBER_TABLE . ' WHERE raidid=' . intval($_GET["raidid"]) . ' AND list=\'wait\'');

					if( !empty($quotes))
					{
						foreach($quotes as $quote)
						{ 
							$user = get_userdata( $quote->userid );
						?>
							<tr>
								<td>
									<?php 
																			
										if (get_option('swtor_raider_setguestraiders')!="on") {
											
											echo $user->user_nicename;
											
										} else {
											
											echo $user->user_nicename;
											
											if (function_exists('current_user_is')) //s2Member installed?
											{
												if (!user_can($user->ID, "access_s2member_level1"))
												{
													echo "<span style=\"font-size:0.8em\"> (Guest)</span>";
												}
											}
										}
									?>			
								</td>
								<td><?php echo $quote->charname; ?></td>
								<td>
									<?php if (file_exists(dirname(__FILE__) . '/img/'.$quote->kind.'.png')) {?>
									<img style="width:15px; height: 15px; padding-right:3px;" src="<?php echo plugins_url( 'img/'.$quote->kind.'.png' , __FILE__ ); ?>" alt="<?php echo $quote->kind; ?>">
									<?php } echo $quote->kind.' ('.$quote->level.')' ?>
								</td>
								<td><?php echo $quote->role; ?></td>
								<td>
									<?php 
										$e = get_the_author_meta( 'user_raidpoint_op_count', $quote->userid );
										if ($e=="") echo 0;
										else echo $e;
									?>
								</td>
								
								<td>
									<?php if ($quote->comment != "") { ?>
										<style type="text/css">
										<!--
											a.sr_tooltip_<?php echo $quote->userid; ?> {text-decoration:none;}
											.sr_tooltip_<?php echo $quote->userid; ?> span.sr_info{display:none;}
											.sr_tooltip_<?php echo $quote->userid; ?>:hover span.sr_info{display:block;position:absolute; margin-left: 20px; margin-top: -30px;}
										-->
										</style>
										
										<a href="#hint" class="sr_tooltip_<?php echo $quote->userid; ?>">
											<img style="width:13px; height:13px; padding-right:3px; paddig-top:2px;" src="<?php echo plugins_url( 'img/comment.png' , __FILE__ ); ?>" alt="<?php echo stripslashes(trim($quote->comment)); ?>">
											<span class="sr_info"><?php echo stripslashes(trim($quote->comment)); ?></span>
										</a>
									<?php } ?>
								</td>
								
								<td>  
									<?php 
									
									
									if (($quote->userid==$current_user->ID)||($raidleadId==$current_user->ID)) {?>
			     						<a href="<?php echo get_raidurl("raidaction=memberdel&raidid=".$_GET["raidid"]."&userid=".$user->id."&character=".$quote->charname); ?>">delete</a>
			     						&nbsp;|&nbsp;
			     						<a href="<?php echo get_raidurl("raidaction=memberedit&raidid=".$_GET["raidid"]."&userid=".$user->id."&character=".$quote->charname); ?>">edit</a>
			     						<?php if (($booking)||($raidleadId==$current_user->ID)) {?>
				     						&nbsp;|&nbsp;<a href="<?php echo get_raidurl("raidaction=memberraid&raidid=".$_GET["raidid"]."&userid=".$user->id."&character=".$quote->charname); ?>">raid</a>
				     					<?php } ?>
			     					<?php } ?>
								</td>
								
							</tr>
						<?php } 
					} else {?>
					<tr>
						<td colspan="7" align="center"><label>No members at this list yet.</label></td>
					</tr>
					<?php } ?>
				</table>
				<span class="swtor_raiderdescription">Members at the waiting list are replacement players. *Raidpoints</span>
			</p>
			<hr/>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<?php if (!isset($_GET["raidarchive"]) && is_user_logged_in()) {?>
			<h3 style="margin-bottom:0px;">Join the Raid</h3>
			<span>To add a charackter to your list of characters just go to your profil (<a href="<?php echo admin_url( 'profile.php' ); ?>#sraider">link</a>).</span> 
			<label style="color:red"><?php echo $errors; ?></label>
			<p>
				<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
					<input type="hidden" name="action" value="addmember">
					<table cellpadding="5">
						<tr>
							<td width="100"><label>List</label></td>
							<td>
								<select name="sraid_list" size="1" class="regular-text" style="width:100%;">
									<option value=""></option>
									<?php if ($booking) { ?>
									<option value="raid" <?php if (($_POST["sraid_list"]=="raid")||($_GET["sraid_list"]=="raid")) echo "selected";?>>
										Memberlist
									</option>
									<?php } ?>
									<option value="wait" <?php if (($_POST["sraid_list"]=="wait")||($_GET["sraid_list"]=="wait")) echo "selected";?>>
										Waitlist
									</option>
								</select>
							</td>
							<td>
								<span class="swtor_raiderdescription">
									<?php if ($booking) { ?>Select the list on who the user want to be added.
									<?php } else { ?><b>The booking time is over! Only the raid leader can add you to the raid.</b><?php } ?>
								</span>
							</td>
						</tr>
						
						<tr>
							<td width="100"><label>Character</label></td>
							<td>
								<input type="hidden" name="sraid_userid"  value="<?php echo $current_user->ID; ?>"/>
								<select name="sraid_character" size="1" class="regular-text" style="width:100%;">
									<option value=""></option>									
									<?php if ($current_user->ID!="")
									{
										$flags = array('user_mainchar', 'user_firsttwink', 'user_secondtwink', 'user_thirdtwink', 'user_fourthtwink', 'user_fifthtwink', 'user_sixthtwink', 'user_seventhtwink');
										
										foreach ( $flags as $flag ) :
											$char = esc_attr( get_the_author_meta( $flag, $current_user->ID ));
											$level = esc_attr( get_the_author_meta( $flag.'_lvl', $current_user->ID ));
											$codedchar = htmlentities($char, ENT_QUOTES);
											
											if ($char!="") {
											?>
												<option <?php if (($codedchar==$_POST["sraid_character"])||($codedchar==$_GET["sraid_character"])||($char==$_POST["sraid_character"])||($char==$_GET["sraid_character"])) echo "selected"?> value="<?php echo $char; ?>">
													<?php echo $char.' ('.$level.')'; ?>
												</option>
											<?php }
										endforeach; 
									}?>
								</select>
							</td>
							<td width="100%"><span class="swtor_raiderdescription">Select the character who want to play.</span></td>
						</tr>
						
						<tr>
							<td width="100"><label>Comment</label></td>
							<td>
								<textarea name="sraid_comment" class="regular-text" style="width:95%; height:30px;"><?php echo stripslashes(trim($_POST["sraid_comment"].$_GET["sraid_comment"])); ?></textarea>
							</td>
							<td>
								<span class="swtor_raiderdescription">Add a public comment.</span>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" class="swtor_raideradd" name="Save" value="Add to raid" id="submitbutton" /></td>
							<td></td>
						</tr>
					</table>
				</form>
			</p>
			<?php } 
			if (!is_user_logged_in()) { ?>
				<b>You have to be logged in to join the raid</b>
			<?php } ?>
		</td>
	</tr>
</table>
