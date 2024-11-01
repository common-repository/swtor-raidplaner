<h3>Delete a Raid</h3>
<label style="color:red"><?php echo $errors; ?></label>
<p>
	
	<?php 
	$quotes = $wpdb->get_results( 'SELECT * FROM ' . SWTOR_RAID_TABLE . ' WHERE rq_id=' . intval($_GET["raidid"]));

	if( !empty($quotes))
	{
		foreach($quotes as $quote)
		{ ?>
		<form method="POST" action="">
			<input type="hidden" name="action" value="delete">
			<input type="hidden" name="rq_id" value="<?php echo $quote->rq_id; ?>">
		    <table class="form-table" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="400"></td>
					<td colspan="6" width="100%">
						Would you realy want to delete the raid '<?php echo $quote->title; ?>' with the id '<?php echo $quote->rq_id; ?>'? 
						<input type='submit' value='Delete' class='button-secondary' />
					</td>
				</tr>
			</table>
		</form>
		<?php } 
	} ?>
</p>
