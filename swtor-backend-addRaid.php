<h3>Add a Raid</h3>
<label style="color:red"><?php echo $errors; ?></label>
<p>
	<script type="text/javascript">
	// Customizable variables
	var DefaultDateFormat = 'YYYY/MM/DD'; // If no date format is supplied, this will be used instead
	var HideWait = 3; // Number of seconds before the calendar will disappear
	var Y2kPivotPoint = 76; // 2-digit years before this point will be created in the 21st century
	var UnselectedMonthText = ''; // Text to display in the 1st month list item when the date isn't required
	var FontSize = 11; // In pixels
	var FontFamily = 'Tahoma';
	var CellWidth = 18;
	var CellHeight = 16;
	var ImageURL = '<?php echo plugins_url( '/img/calendar.jpg' , __FILE__ ); ?>';
	var NextURL = '<?php echo plugins_url( '/img/next.gif' , __FILE__ ); ?>';
	var PrevURL = '<?php echo plugins_url( '/img/prev.gif' , __FILE__ ); ?>';
	var CalBGColor = 'white';
	var TopRowBGColor = 'buttonface';
	var DayBGColor = 'lightgrey';
	</script>
	<script type="text/javascript" src="<?php echo plugins_url( '/calendarDateInput.js' , __FILE__ ); ?>"></script>
	<style type="text/css">
		#sraidCalender table td {
			padding:0px !important; 
			margin: 0px !important;
			width: 50px !important;
		}
		#sraidCalender table td img {
			padding-top: 5px !important;
		}
		
	</style>
				
	<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<input type="hidden" name="action" value="save">
	    <table class="form-table" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="400"><label>Title</label></td>
				<td colspan="6">
					<input type="text" name="sraid_title" id="sraid_title" value="<?php echo stripslashes($_POST["sraid_title"]); ?>" class="regular-text sraidtitle" />
				</td>
				<td width="100%"><span class="description sraiddescr">Enter the title of the raid.</span></td>
			</tr>
			<tr>
				<td><label>Mode</label></td>
				<td colspan="6">
					<select name="sraid_mode" size="1" class="regular-text sraidmode">
						<option <?php if ($_POST["sraid_mode"]=="") echo "selected"?>></option>
	      				<option <?php if ($_POST["sraid_mode"]=="Normal") echo "selected"?>>Normal</option>
	      				<option <?php if ($_POST["sraid_mode"]=="Hard") echo "selected"?>>Hard</option>
	      				<option <?php if ($_POST["sraid_mode"]=="Nightmare") echo "selected"?>>Nightmare</option>
					</select>
				</td>
				<td width="100%"><span class="description sraiddescr">Enter the difficulty mode of the raid.</span></td>
			</tr>
			<tr>
				<td><label>Date</label></td>
				<td colspan="6">
					<?php if (!isset($_POST["sraid_date"])) { ?>
						<div id="sraidCalender"><script>DateInput('sraid_date', true, 'DD-MON-YYYY')</script></div>
					<?php } else { ?>
						<div id="sraidCalender"><script>DateInput('sraid_date', true, 'DD-MON-YYYY', '<?php echo $_POST["sraid_date"]; ?>')</script></div>
					<?php } ?>
				</td>
				<td width="100%"><span class="description sraiddescr">Enter the date the raid would start.</span></td>
			</tr>
			<tr>
				<td><label>Time</label></td>
				<td colspan="6">
					<input type="text" name="sraid_time" id="sraid_time" size="5" value="<?php echo $_POST["sraid_time"]; ?>" class="regular-text" style="width:130px;"/>
					<span class="description">&nbsp;(hh:mm)</span>
				</td>
				<td width="100%"><span class="description sraiddescr">Enter the time the raid would start.</span></td>
			</tr>
			<tr>
				<td><label>Booking</label></td>
				<td colspan="6">
					<select name="sraid_booking" size="1" class="regular-text sraidbooking">
						<option value="" <?php if ($_POST["sraid_booking"]=="") echo "selected"?>></option>
						<option value="0" <?php if ($_POST["sraid_booking"]=="0") echo "selected"?>>no booking limit</option>
	      				<option value="1" <?php if ($_POST["sraid_booking"]=="1") echo "selected"?>>1 hour before</option>
	      				<option value="3" <?php if ($_POST["sraid_booking"]=="3") echo "selected"?>>3 hours before</option>
	      				<option value="8" <?php if ($_POST["sraid_booking"]=="8") echo "selected"?>>8 hours before</option>
	      				<option value="24" <?php if ($_POST["sraid_booking"]=="24") echo "selected"?>>1 day before</option>
	      				<option value="48" <?php if ($_POST["sraid_booking"]=="48") echo "selected"?>>2 days before</option>
	      				<option value="120" <?php if ($_POST["sraid_booking"]=="120") echo "selected"?>>5 days before</option>
	      				<option value="-1" <?php if ($_POST["sraid_booking"]=="-1") echo "selected"?>>only the leader can book</option>
					</select>
				</td>
				<td width="100%"><span class="description sraiddescr">Enter the time til the characters can join the member list.</span></td>
			</tr>
			<tr>
				<td><label>Level</label></td>
				<td colspan="6">
					<select name="sraid_level" size="1" class="regular-text sraidlevel">
						<option <?php if ($_POST["sraid_level"]=="") echo "selected"?>></option>
						<?php foreach(unserialize(SWTOR_RAIDLEVELS) as $lvl) {?>
							<option <?php if ($_POST["sraid_level"]==$lvl) echo "selected"?>><?php echo $lvl;?></option>
						<?php } ?>
					</select>
				</td>
				<td width="100%"><span class="description sraiddescr">Enter the level the players need to join.</span></td>
			</tr>
			<tr>
				<td valign="top"><label>Description</label></td>
				<td colspan="6">
					<textarea name="sraid_description" id="sraid_description" cols="55" rows="5" class="regular-text"><?php echo stripslashes($_POST["sraid_description"]); ?></textarea>
				</td>
				<td width="100%" valign="top"><span class="description sraiddescr">Enter a raid description.</span></td>
			</tr>
			<tr>
				<td valign="middel"><label>Team</label></td>
				<td style="padding-right:0px; margin:0px;">Damage:</td>
				<td><input type="text" name="sraid_team_dd" id="sraid_team_dd" size="2" value="<?php echo $_POST["sraid_team_dd"]; ?>" class="regular-text" style="width:30px;"/></td>
				<td style="padding:0px; margin:0px;">Tank:</td>
				<td><input type="text" name="sraid_team_tank" id="sraid_team_tank" size="2" value="<?php echo $_POST["sraid_team_tank"]; ?>" class="regular-text" style="width:30px;"/></td>
				<td style="padding:0px; margin:0px;">Heal:</td>
				<td><input type="text" name="sraid_team_heal" id="sraid_team_heal" size="2" value="<?php echo $_POST["sraid_team_heal"]; ?>" class="regular-text" style="width:30px;"/></td>
				<td valign="middle"><span class="description sraiddescr">Enter the amounts of player kind is needed.</span></td>
			</tr>
			<tr>
				<td></td>
				<td align="right" colspan="6">
					<input class="button-primary sraidadd" type="submit" name="Save" id="submitbutton" value="Add raid"/>
				</td>
				<td></td>
			</tr>
		</table>
	</form>
</p>
