
	<option <?php if ($kind=="") echo "selected"?> value=""> ------- select your class ------- </option>
	
<?php if (get_option('swtor_raider_setclasses')!="swtor_None") { ?>
	
	<!-- SW:ToR Imperium -->
	<?php if (get_option('swtor_raider_setclasses')!="swtor_Republic") { ?>
		<optgroup label="SW:ToR Imperium" id="swtor_imp">
			<option <?php if ($kind=="Inquisitor-Assassin") echo "selected"?>>Inquisitor-Assassin</option>
			<option <?php if ($kind=="Inquisitor-Sorcerer") echo "selected"?>>Inquisitor-Sorcerer</option>
			<option <?php if ($kind=="Warrior-Juggernaut") echo "selected"?>>Warrior-Juggernaut</option>
			<option <?php if ($kind=="Warrior-Maurader") echo "selected"?>>Warrior-Maurader</option>
			<option <?php if ($kind=="Bountyhunter-Powertech") echo "selected"?>>Bountyhunter-Powertech</option>
			<option <?php if ($kind=="Bountyhunter-Mercenary") echo "selected"?>>Bountyhunter-Mercenary</option>
			<option <?php if ($kind=="Agent-Operative") echo "selected"?>>Agent-Operative</option>
			<option <?php if ($kind=="Agent-Sniper") echo "selected"?>>Agent-Sniper</option>
		</optgroup>			
	<?php } ?>
	
	<!-- SW:ToR Republic -->
	<?php if (get_option('swtor_raider_setclasses')!="swtor_Imperium") { ?>
		<optgroup label="SW:ToR Republic" id="swtor_rep">
			<option <?php if ($kind=="Consular-Sage") echo "selected"?>>Consular-Sage</option>
			<option <?php if ($kind=="Consular-Shadow") echo "selected"?>>Consular-Shadow</option>
			<option <?php if ($kind=="Knight-Guardian") echo "selected"?>>Knight-Guardian</option>
			<option <?php if ($kind=="Knight-Sentinel") echo "selected"?>>Knight-Sentinel</option>
			<option <?php if ($kind=="Trooper-Vanguard") echo "selected"?>>Trooper-Vanguard</option>
			<option <?php if ($kind=="Trooper-Commando") echo "selected"?>>Trooper-Commando</option>
			<option <?php if ($kind=="Smuggler-Scoundrel") echo "selected"?>>Smuggler-Scoundrel</option>
			<option <?php if ($kind=="Smuggler-Gunslinger") echo "selected"?>>Smuggler-Gunslinger</option>
		</optgroup>			
	<?php } ?>
	
<?php } ?>
