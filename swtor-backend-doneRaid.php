<h3>Done</h3>
<label style="color:red"><?php echo $errors; ?></label>
<p>
    <table class="form-table" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td width="400"></td>
			<td colspan="6" width="100%">
				<b>Successfully done!</b> -
				<?php if ($backend) { ?>
					<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php'); ?>">Add another raid</a>
				<?php } if (isset($_GET["raidid"])) {
					 if ($backend) {
					 	if ($_GET["raidaction"]!="delete") { echo " | "; ?>
							<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php&raidaction=details&raidid='.$_GET["raidid"]); ?>">Show last raid details</a>
					<?php }
					 } else {?>
						Forwarding within <b><span id="countDown"></span></b> seconds to raid details! 	
						<a href="<?php echo get_raidurl("raidaction=details&raidid=".$_GET["raidid"]); ?>">Link</a>
					<?php } ?>
				<?php } ?>
			</td>
		</tr>
	</table>
</p>

<script type="text/javascript">

window.onload = function() {
	startCountDown(2, 1000, swtorForwarding);
}

	function startCountDown(i, p, f) {
		//	store parameters
		var pause = p;
		var fn = f;
		//	make reference to div
		var countDownObj = document.getElementById("countDown");
		if (countDownObj == null) {
			//	bail
			return;
		}
		countDownObj.count = function(i) {
			//	write out count
			countDownObj.innerHTML = i;
			if (i == 0) {
			//	execute function
			fn();
			//	stop
			return;
		}
	
		setTimeout(function() {
			//	repeat
			countDownObj.count(i - 1);
		},
		pause
		);
	}
	//	set it going
	countDownObj.count(i);
	}

	function swtorForwarding() {	
		window.location.href = "<?php 
		
			if ($edited) {
				echo get_raidurl(
					"raidaction=details&raidid=".$_GET["raidid"].
					"&sraid_list=".$_POST["sraid_list"].
					"&sraid_character=".$_POST["sraid_character"].
					"&sraid_comment=".$_POST["sraid_comment"]
				);
			}
			else {
				echo get_raidurl(
					"raidaction=details&raidid=".$_GET["raidid"]
				);
			}
			
			?>";
	}

</script>