<div class="wrap">
	<h2>SW:ToR Raider Options</h2>
	<?php if ($_POST["action"]=="saveOptions"): ?>
		<div id="message" class="updated">
			<p><strong>Changes saved.</strong></p>
		</div>
	<?php endif; ?>
	<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<input name="action" value="saveOptions" type="hidden" />
		<table class="form-table" width="600">
			<tr>
				<td width="100"><b>Raidplaner Url</b></td>
				<td width="400"><input type="text" name="swtor_raider_url" style="width:400px" value="<?php echo get_option('swtor_raider_url'); ?>" /></td>
				<td><span class="description">The url where the shortcode [ raidplaner ] was set.</span></td>
			</tr>
			<tr>
				<td><b>Event Calender</b></td>
				<td><input type="checkbox" name="swtor_raider_seteventcalender" <?php if (get_option('swtor_raider_seteventcalender')=="on") echo "checked"; ?>/><label for="swtor_raider_seteventcalender"> Add to Events calender.</label></td>
				<td><span class="description">Also add raids to the events calender plugin (<a href="http://wordpress.org/extend/plugins/events-calendar/" target="_blank">link</a>)</span></td>
			</tr>	
			<tr>
				<td><b>Guest Raiders</b></td>
				<td><input type="checkbox" name="swtor_raider_setguestraiders" <?php if (get_option('swtor_raider_setguestraiders')=="on") echo "checked"; ?>/><label for="swtor_raider_setguestraiders"> Allow subscribers to raid as guest.</label></td>
				<td><span class="description">Subscribers will add to a raid with comment 'guest' while s2Members of minimal level 1 will be added normal (<a href="http://www.s2member.com/" target="_blank">s2Member</a>)</span></td>
			</tr>
			<tr>
				<td><b>Show ever</b></td>
				<td><input type="checkbox" name="swtor_raider_setshowever" <?php if (get_option('swtor_raider_setshowever')=="on") echo "checked"; ?>/><label for="swtor_raider_setshowever"> Show raider if not logged in.</label></td>
				<td><span class="description">Shows the raid planer as readonly even if a user is not logged in.</span></td>
			</tr>
			<tr>
				<td><b>Reset Raidpoints</b></td>
				<td><input type="checkbox" name="swtor_raider_resetraidpoints"/><label for="swtor_raider_resetraidpoints"> Reset raidpoints.</label></td>
				<td><span class="description">Set the raidpoints of all users to zero</span></td>
			</tr>
			<tr>
				<td><b>SW:ToR Classes</b></td>
				<td>
					<input type="radio" name="swtor_raider_setclasses" value="swtor_Imperium" <?php if (get_option('swtor_raider_setclasses')=="swtor_Imperium") echo "checked"; ?>><label style="padding-right: 20px;"> Imperium</label>
    				<input type="radio" name="swtor_raider_setclasses" value="swtor_Republic" <?php if (get_option('swtor_raider_setclasses')=="swtor_Republic") echo "checked"; ?>><label style="padding-right: 20px;"> Republic</label>
    				<input type="radio" name="swtor_raider_setclasses" value="swtor_Both" <?php if (get_option('swtor_raider_setclasses')=="swtor_Both") echo "checked"; ?>><label style="padding-right: 20px;"> Both</label>
    				<input type="radio" name="swtor_raider_setclasses" value="swtor_None" <?php if (get_option('swtor_raider_setclasses')=="swtor_None") echo "checked"; ?>><label style="padding-right: 20px;"> None</label>
				</td>
				<td><span class="description">Choose the kind of classes the players could define.</span></td>
			</tr>
			<tr>
				<td></td>
				<td align="right">
					<?php if ($_POST["swtor_raider_resetraidpoints"]=="on") echo "<span style=\"color:red;\">Raidpoints reset done!</span>"; ?>
					<input class="button-primary" type="submit" name="Save options" value="Save options" id="submitbutton" />
				</td>
				<td></td>
			</tr>					
	</form>
</div>