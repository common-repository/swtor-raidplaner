	<a name="sraider">
	<h3>SW:ToR Raider: Profile informations</h3>
	<table class="form-table">
		<tr>
			<th><label>Maincharakter</label></th>
			<td width="200">
				<input type="text" name="user_mainchar" id="user_mainchar" value="<?php echo esc_attr( get_the_author_meta( 'user_mainchar', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your name of the main char.</span>
			</td>
			<td width="50">
				<?php $value = esc_attr( get_the_author_meta( 'user_mainchar_lvl', $user->ID ) );?>
				<select name="user_mainchar_lvl" size="1" class="regular-text">
					<option <?php if ($value=="") echo "selected"?>></option>
					<?php foreach(unserialize(SWTOR_RAIDLEVELS) as $lvl) {?>
						<option <?php if ($value==$lvl) echo "selected"?>><?php echo $lvl;?></option>
					<?php } ?>
				</select><br />
				<span class="description">The level.</span>
			</td>
			<td width="150">
				<select name="user_mainchar_kind" size="1" class="regular-text">
				<?php 
					$kind = esc_attr( get_the_author_meta( 'user_mainchar_kind', $user->ID ) );
					include (dirname(__FILE__) . '/swtor-profil-form-classes-select.php');
				?>
    			</select><br />
				<span class="description">Your class of the main char.</span>
			</td>
			<td width="100%">
				<?php $role = esc_attr( get_the_author_meta( 'user_mainchar_role', $user->ID ) );?>
				<select name="user_mainchar_role" size="1" class="regular-text">
					<option <?php if ($role=="") echo "selected"?>></option>
      				<option <?php if ($role=="Tank") echo "selected"?>>Tank</option>
					<option <?php if ($role=="Damage") echo "selected"?>>Damage</option>
					<option <?php if ($role=="Heal") echo "selected"?>>Heal</option>
    			</select><br />
				<span class="description">Your role of the main char.</span>
			</td>
		</tr>
		
		<tr>
			<th><label>1.Twink</label></th>
			<td width="200">
				<input type="text" name="user_firsttwink" id="user_firsttwink" value="<?php echo esc_attr( get_the_author_meta( 'user_firsttwink', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your name of your first twink.</span>
			</td>
			<td width="50">
				<?php $value = esc_attr( get_the_author_meta( 'user_firsttwink_lvl', $user->ID ) );?>
				<select name="user_firsttwink_lvl" size="1" class="regular-text">
					<option <?php if ($value=="") echo "selected"?>></option>
					<?php foreach(unserialize(SWTOR_RAIDLEVELS) as $lvl) {?>
						<option <?php if ($value==$lvl) echo "selected"?>><?php echo $lvl;?></option>
					<?php } ?>
				</select><br />
				<span class="description">The level.</span>
			</td>
			<td width="150">
				<select name="user_firsttwink_kind" size="1" class="regular-text">
				<?php 
					$kind = esc_attr( get_the_author_meta( 'user_firsttwink_kind', $user->ID ) );
					include (dirname(__FILE__) . '/swtor-profil-form-classes-select.php');
				?>
    			</select><br />
				<span class="description">Your class of your first twink.</span>
			</td>
			<td width="100%">
				<?php $role = esc_attr( get_the_author_meta( 'user_firsttwink_role', $user->ID ) );?>
				<select name="user_firsttwink_role" size="1" class="regular-text">
					<option <?php if ($role=="") echo "selected"?>></option>
      				<option <?php if ($role=="Tank") echo "selected"?>>Tank</option>
					<option <?php if ($role=="Damage") echo "selected"?>>Damage</option>
					<option <?php if ($role=="Heal") echo "selected"?>>Heal</option>
    			</select><br />
				<span class="description">Your role of your first twink.</span>
			</td>
		</tr>
		
		<tr>
			<th><label>2.Twink</label></th>
			<td width="200">
				<input type="text" name="user_secondtwink" id="user_secondtwink" value="<?php echo esc_attr( get_the_author_meta( 'user_secondtwink', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your name of your second twink.</span>
			</td>
			<td width="50">
				<?php $value = esc_attr( get_the_author_meta( 'user_secondtwink_lvl', $user->ID ) );?>
				<select name="user_secondtwink_lvl" size="1" class="regular-text">
					<option <?php if ($value=="") echo "selected"?>></option>
					<?php foreach(unserialize(SWTOR_RAIDLEVELS) as $lvl) {?>
						<option <?php if ($value==$lvl) echo "selected"?>><?php echo $lvl;?></option>
					<?php } ?>
				</select><br />
				<span class="description">The level.</span>
			</td>
			<td width="150">
				<select name="user_secondtwink_kind" size="1" class="regular-text">
				<?php 
					$kind = esc_attr( get_the_author_meta( 'user_secondtwink_kind', $user->ID ) );
					include (dirname(__FILE__) . '/swtor-profil-form-classes-select.php');
				?>
    			</select><br />
				<span class="description">Your class of your second twink.</span>
			</td>
			<td width="100%">
				<?php $role = esc_attr( get_the_author_meta( 'user_secondtwink_role', $user->ID ) );?>
				<select name="user_secondtwink_role" size="1" class="regular-text">
					<option <?php if ($role=="") echo "selected"?>></option>
      				<option <?php if ($role=="Tank") echo "selected"?>>Tank</option>
					<option <?php if ($role=="Damage") echo "selected"?>>Damage</option>
					<option <?php if ($role=="Heal") echo "selected"?>>Heal</option>
    			</select><br />
				<span class="description">Your role of your second twink.</span>
			</td>
		</tr>
		
		<tr>
			<th><label>3.Twink</label></th>
			<td width="200">
				<input type="text" name="user_thirdtwink" id="user_thirdtwink" value="<?php echo esc_attr( get_the_author_meta( 'user_thirdtwink', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your name of your third twink.</span>
			</td>
			<td width="50">
				<?php $value = esc_attr( get_the_author_meta( 'user_thirdtwink_lvl', $user->ID ) );?>
				<select name="user_thirdtwink_lvl" size="1" class="regular-text">
					<option <?php if ($value=="") echo "selected"?>></option>
					<?php foreach(unserialize(SWTOR_RAIDLEVELS) as $lvl) {?>
						<option <?php if ($value==$lvl) echo "selected"?>><?php echo $lvl;?></option>
					<?php } ?>
				</select><br />
				<span class="description">The level.</span>
			</td>
			<td width="150">
				<select name="user_thirdtwink_kind" size="1" class="regular-text">
				<?php 
					$kind = esc_attr( get_the_author_meta( 'user_thirdtwink_kind', $user->ID ) );
					include (dirname(__FILE__) . '/swtor-profil-form-classes-select.php');
				?>
    			</select><br />
				<span class="description">Your class of your third twink.</span>
			</td>
			<td width="100%">
				<?php $role = esc_attr( get_the_author_meta( 'user_thirdtwink_role', $user->ID ) );?>
				<select name="user_thirdtwink_role" size="1" class="regular-text">
					<option <?php if ($role=="") echo "selected"?>></option>
      				<option <?php if ($role=="Tank") echo "selected"?>>Tank</option>
					<option <?php if ($role=="Damage") echo "selected"?>>Damage</option>
					<option <?php if ($role=="Heal") echo "selected"?>>Heal</option>
    			</select><br />
				<span class="description">Your role of your third twink.</span>
			</td>
		</tr>
		
		<tr>
			<th><label>4.Twink</label></th>
			<td width="200">
				<input type="text" name="user_fourthtwink" id="user_fourthtwink" value="<?php echo esc_attr( get_the_author_meta( 'user_fourthtwink', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your name of your fourth twink.</span>
			</td>
			<td width="50">
				<?php $value = esc_attr( get_the_author_meta( 'user_fourthtwink_lvl', $user->ID ) );?>
				<select name="user_fourthtwink_lvl" size="1" class="regular-text">
					<option <?php if ($value=="") echo "selected"?>></option>
					<?php foreach(unserialize(SWTOR_RAIDLEVELS) as $lvl) {?>
						<option <?php if ($value==$lvl) echo "selected"?>><?php echo $lvl;?></option>
					<?php } ?>
				</select><br />
				<span class="description">The level.</span>
			</td>
			<td width="150">
				<select name="user_fourthtwink_kind" size="1" class="regular-text">
				<?php 
					$kind = esc_attr( get_the_author_meta( 'user_fourthtwink_kind', $user->ID ) );
					include (dirname(__FILE__) . '/swtor-profil-form-classes-select.php');
				?>
    			</select><br />
				<span class="description">Your class of your fourth twink.</span>
			</td>
			<td width="100%">
				<?php $role = esc_attr( get_the_author_meta( 'user_fourthtwink_role', $user->ID ) );?>
				<select name="user_fourthtwink_role" size="1" class="regular-text">
					<option <?php if ($role=="") echo "selected"?>></option>
      				<option <?php if ($role=="Tank") echo "selected"?>>Tank</option>
					<option <?php if ($role=="Damage") echo "selected"?>>Damage</option>
					<option <?php if ($role=="Heal") echo "selected"?>>Heal</option>
    			</select><br />
				<span class="description">Your role of your fourth twink.</span>
			</td>
		</tr>
		
		<tr>
			<th><label>5.Twink</label></th>
			<td width="200">
				<input type="text" name="user_fifthtwink" id="user_fifthtwink" value="<?php echo esc_attr( get_the_author_meta( 'user_fifthtwink', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your name of your fifth twink.</span>
			</td>
			<td width="50">
				<?php $value = esc_attr( get_the_author_meta( 'user_fifthtwink_lvl', $user->ID ) );?>
				<select name="user_fifthtwink_lvl" size="1" class="regular-text">
				<option <?php if ($value=="") echo "selected"?>></option>
					<?php foreach(unserialize(SWTOR_RAIDLEVELS) as $lvl) {?>
						<option <?php if ($value==$lvl) echo "selected"?>><?php echo $lvl;?></option>
					<?php } ?>
				</select><br />
				<span class="description">The level.</span>
			</td>
			<td width="150">
				<select name="user_fifthtwink_kind" size="1" class="regular-text">
				<?php 
					$kind = esc_attr( get_the_author_meta( 'user_fifthtwink_kind', $user->ID ) );
					include (dirname(__FILE__) . '/swtor-profil-form-classes-select.php');
				?>
    			</select><br />
				<span class="description">Your class of your fifth twink.</span>
			</td>
			<td width="100%">
				<?php $role = esc_attr( get_the_author_meta( 'user_fifthtwink_role', $user->ID ) );?>
				<select name="user_fifthtwink_role" size="1" class="regular-text">
					<option <?php if ($role=="") echo "selected"?>></option>
      				<option <?php if ($role=="Tank") echo "selected"?>>Tank</option>
					<option <?php if ($role=="Damage") echo "selected"?>>Damage</option>
					<option <?php if ($role=="Heal") echo "selected"?>>Heal</option>
    			</select><br />
				<span class="description">Your role of your fifth twink.</span>
			</td>
		</tr>	
		
		<tr>
			<th><label>6.Twink</label></th>
			<td width="200">
				<input type="text" name="user_sixthtwink" id="user_sixthtwink" value="<?php echo esc_attr( get_the_author_meta( 'user_sixthtwink', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your name of your sixth twink.</span>
			</td>
			<td width="50">
				<?php $value = esc_attr( get_the_author_meta( 'user_sixthtwink_lvl', $user->ID ) );?>
				<select name="user_sixthtwink_lvl" size="1" class="regular-text">
					<option <?php if ($value=="") echo "selected"?>></option>
					<?php foreach(unserialize(SWTOR_RAIDLEVELS) as $lvl) {?>
						<option <?php if ($value==$lvl) echo "selected"?>><?php echo $lvl;?></option>
					<?php } ?>
				</select><br />
				<span class="description">The level.</span>
			</td>
			<td width="150">
				<select name="user_sixthtwink_kind" size="1" class="regular-text">
				<?php 
					$kind = esc_attr( get_the_author_meta( 'user_sixthtwink_kind', $user->ID ) );
					include (dirname(__FILE__) . '/swtor-profil-form-classes-select.php');
				?>
    			</select><br />
				<span class="description">Your class of your sixth twink.</span>
			</td>
			<td width="100%">
				<?php $role = esc_attr( get_the_author_meta( 'user_sixthtwink_role', $user->ID ) );?>
				<select name="user_sixthtwink_role" size="1" class="regular-text">
					<option <?php if ($role=="") echo "selected"?>></option>
      				<option <?php if ($role=="Tank") echo "selected"?>>Tank</option>
					<option <?php if ($role=="Damage") echo "selected"?>>Damage</option>
					<option <?php if ($role=="Heal") echo "selected"?>>Heal</option>
    			</select><br />
				<span class="description">Your role of your sixth twink.</span>
			</td>
		</tr>	
		
		
		<tr>
			<th><label>7.Twink</label></th>
			<td width="200">
				<input type="text" name="user_seventhtwink" id="user_seventhtwink" value="<?php echo esc_attr( get_the_author_meta( 'user_seventhtwink', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your name of your seventh twink.</span>
			</td>
			<td width="50">
				<?php $value = esc_attr( get_the_author_meta( 'user_seventhtwink_lvl', $user->ID ) );?>
				<select name="user_seventhtwink_lvl" size="1" class="regular-text">
					<option <?php if ($value=="") echo "selected"?>></option>
					<?php foreach(unserialize(SWTOR_RAIDLEVELS) as $lvl) {?>
						<option <?php if ($value==$lvl) echo "selected"?>><?php echo $lvl;?></option>
					<?php } ?>
				</select><br />
				<span class="description">The level.</span>
			</td>
			<td width="150">
				<select name="user_seventhtwink_kind" size="1" class="regular-text">
				<?php 
					$kind = esc_attr( get_the_author_meta( 'user_seventhtwink_kind', $user->ID ) );
					include (dirname(__FILE__) . '/swtor-profil-form-classes-select.php');
				?>
    			</select><br />
				<span class="description">Your class of your seventh twink.</span>
			</td>
			<td width="100%">
				<?php $role = esc_attr( get_the_author_meta( 'user_seventhtwink_role', $user->ID ) );?>
				<select name="user_seventhtwink_role" size="1" class="regular-text">
					<option <?php if ($role=="") echo "selected"?>></option>
      				<option <?php if ($role=="Tank") echo "selected"?>>Tank</option>
					<option <?php if ($role=="Damage") echo "selected"?>>Damage</option>
					<option <?php if ($role=="Heal") echo "selected"?>>Heal</option>
    			</select><br />
				<span class="description">Your role of your seventh twink.</span>
			</td>
		</tr>	
		
		<tr>
			<th><label>Raidpoints</label></th>
			<td width="200" colspan="4">
				<input type="text" name="user_raidpoint_op_count" id="user_raidpoint_op_count" style="width:40px;" <?php if (!current_user_can('level_10')) echo "readonly=\"readonly\""; ?> value="<?php echo esc_attr( get_the_author_meta( 'user_raidpoint_op_count', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Raidpoints can only be edit by admin and are a counter of operations you had done.</span>
			</td>
		</tr>
		
	</table>