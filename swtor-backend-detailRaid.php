<table width="100%">
	<tr>
		<td width="50%" style="padding-right: 10px" valign="top">
			<h3>Details of the Raid</h3>
			<p>
				<?php 
				$quotes = $wpdb->get_results( 'SELECT * FROM ' . SWTOR_RAID_TABLE . ' WHERE rq_id=' . $_GET["raidid"]);
			
				if( !empty($quotes))
				{
					foreach($quotes as $quote)
					{ ?>	    
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
		</td>
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
					        <th>Raidpoints</th>
					        <th></th>
					        <th>Action</th>
					    </tr>
					</thead>
					<tfoot>
					    <tr>
					        <th>Name</th>
					        <th>Character</th>
					        <th>Kind(Level)</th>
					        <th>Role</th>
					        <th>Raidpoints</th>
					        <th></th>
					        <th>Action</th>
					    </tr>
					</tfoot>
					<tbody>
					<?php $quotes = $wpdb->get_results( 'SELECT * FROM ' . SWTOR_MEMBER_TABLE . ' WHERE raidid=' . $_GET["raidid"] . ' AND list=\'raid\'');

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
								<td><?php echo $quote->kind.' ('.$quote->level.')' ?></td>
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
											.sr_tooltip_<?php echo $quote->userid; ?> span.sr_info{display:none;color: #555;border: 1px solid #DFDFDF; background-color: #ddd; padding: 0px 3px;}
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
									<?php if (!isset($_GET["raidarchive"])||current_user_can('edit_posts')) {?>
			     					<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php&raidaction=memberdel&raidid='.$_GET["raidid"]."&userid=".$user->id."&character=".$quote->charname."&raidlist"); ?>">delete</a> | 
			     					<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php&raidaction=memberwait&raidid='.$_GET["raidid"]."&userid=".$user->id."&character=".$quote->charname); ?>">wait</a>
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
				<br/>
				<span class="description">Members at the list are fixed for playing.</span>
			</p>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<?php if (!isset($_GET["raidarchive"]) || current_user_can('edit_posts')) {?>
			<h3>Add members to the Raid</h3>
			<label style="color:red"><?php echo $errors; ?></label>
			<p>
				<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
					<input type="hidden" name="action" value="addmember">
					<table>
						<tr>
							<td width="100"><label>User</label></td>
							<td>
								<select name="sraid_userid" size="1" class="regular-text" style="width:200px;" onChange="this.form.submit()">
									<option value=""></option>
									<?php $aUsersID = $wpdb->get_col("SELECT $wpdb->users.ID FROM $wpdb->users ORDER BY $wpdb->users.user_nicename ASC"); ?>
									
									<?php foreach ( $aUsersID as $iUserID ) :
										$user = get_userdata( $iUserID );
									?>
										<option value="<?php echo $user->ID; ?>" <?php if ($user->ID==$_POST["sraid_userid"]) echo "selected";?>>
											<?php echo $user->user_nicename; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</td>
							<td width="100%"><span class="description">Select the user who want to play.</span></td>
						</tr>
						<tr>
							<td width="100"><label>Character</label></td>
							<td>
								<select name="sraid_character" size="1" class="regular-text" style="width:200px;">
									<option value=""></option>									
									<?php if ($_POST["sraid_userid"]!="")
									{
										$flags = array('user_mainchar', 'user_firsttwink', 'user_secondtwink', 'user_thirdtwink', 'user_fourthtwink', 'user_fifthtwink', 'user_sixthtwink', 'user_seventhtwink');
										
										foreach ( $flags as $flag ) :
											$char = esc_attr( get_the_author_meta( $flag, $_POST["sraid_userid"] ));
											$level = esc_attr( get_the_author_meta( $flag.'_lvl', $_POST["sraid_userid"] ));
											$codedchar = htmlentities($char, ENT_QUOTES);
											
											if ($char!="") {
											?>
												<option <?php if (($char==$_POST["sraid_character"])||($codedchar==$_POST["sraid_character"])) echo "selected"?> value="<?php echo $char; ?>">
													<?php echo $char.' ('.$level.')'; ?>
												</option>
											<?php }
										endforeach; 
									}?>
								</select>
							</td>
							<td width="100%"><span class="description">Select the character who want to play.</span></td>
						</tr>
						<tr>
							<td width="100"><label>List</label></td>
							<td>
								<select name="sraid_list" size="1" class="regular-text" style="width:200px;">
									<option value=""></option>
									<option value="raid" <?php if ($_POST["sraid_list"]=="raid") echo "selected";?>>
										Memberlist
									</option>
									<option value="wait" <?php if ($_POST["sraid_list"]=="wait") echo "selected";?>>
										Waitlist
									</option>
								</select>
							</td>
							<td><span class="description">Select the list on who the user want to be added.</span></td>
						</tr>
						<tr>
							<td></td>
							<td align="right">
								<?php if (isset($_POST["sraid_userid"])) {?>
									<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php&raidaction=resetraidpoints&userid='.$_POST["sraid_userid"].'&raidid='.$_GET["raidid"]); ?>">reset Raidpoints</a>
								<?php } ?>
							</td>
							<td align="left"><input class="button-primary" type="submit" name="Save" value="Add to list" id="submitbutton" /></td>
						</tr>
					</table>
				</form>
			</p>
			<?php } // end if raid isset archive?>
		</td>
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
					        <th>Raidpoints</th>
					        <th></th>
					        <th>Action</th>
					    </tr>
					</thead>
					<tfoot>
					    <tr>
					        <th>Name</th>
					        <th>Character</th>
					        <th>Kind(Level)</th>
					        <th>Role</th>
					        <th>Raidpoints</th>
					        <th></th>
					        <th>Action</th>
					    </tr>
					</tfoot>
					<tbody>
					<?php $quotes = $wpdb->get_results( 'SELECT * FROM ' . SWTOR_MEMBER_TABLE . ' WHERE raidid=' . $_GET["raidid"] . ' AND list=\'wait\'');

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
								<td><?php echo $quote->kind.' ('.$quote->level.')' ?></td>
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
											.sr_tooltip_<?php echo $quote->userid; ?> span.sr_info{display:none;color: #555;border: 1px solid #DFDFDF; background-color: #ddd; padding: 0px 3px;}
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
									<?php if (!isset($_GET["raidarchive"])||current_user_can('edit_posts')) {?>
			     					<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php&raidaction=memberdel&raidid='.$_GET["raidid"]."&userid=".$user->id."&character=".$quote->charname); ?>">delete</a> | 
			     					<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php&raidaction=memberraid&raidid='.$_GET["raidid"]."&userid=".$user->id."&character=".$quote->charname); ?>">raid</a>
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
				<br/>
				<span class="description">Members at the waiting list are replacement players.</span>
			</p>
		</td>
	</tr>
</table>
