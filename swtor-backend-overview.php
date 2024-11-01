<table class="widefat">
<thead>
    <tr>
        <th class="regid">RegId</th>
        <th class="title">Title</th>
        <th class="mode">Mode</th>
        <th class="date">Date</th>
        <th class="time">Time</th>
        <th class="level">Level</th>
        <th class="team">Team*</th>
        <th class="author">Author</th>
        <th class="action">Action</th>
    </tr>
</thead>
<?php if ($backend) { ?>
<tfoot>
    <tr>
        <th>RegId</th>
        <th>Title</th>
        <th>Mode</th>
        <th>Date</th>
        <th>Time</th>
        <th>Level</th>
        <th>Team*</th>
        <th>Author</th>
        <th>Action</th>
    </tr>
</tfoot>
<?php } ?>
<tbody>
	<?php 
	$quotes = $wpdb->get_results(
					'SELECT rq_id, title, date, time, level, description, team, author, mode, booking, ' .
					'UNIX_TIMESTAMP(STR_TO_DATE(date, \'%d-%b-%Y\')) AS ts '.
					'FROM ' . SWTOR_RAID_TABLE . ' ORDER BY ts ASC'
			);

	$wrote = false;
	if( !empty($quotes))
	{
		$today = date("d-M-Y"); 
		
		foreach($quotes as $quote)
		{
			
			if (((strtotime($quote->date)-time()>0)|(date('d-M-Y', strtotime($quote->date)) == $today)) == !isset($_GET["raidarchive"]))
			{
				$wrote = true;
			?>
			   <tr>
			     <td><?php echo $quote->rq_id; ?></td>
			     <td><?php echo stripslashes($quote->title); ?></td>
			     <td><?php echo $quote->mode; ?></td>
			     <td <?php if (date('d-M-Y', strtotime($quote->date)) == $today) echo "style=\"color:red\""; ?>><?php echo $quote->date; ?></td>
			     <td><?php echo $quote->time; ?></td>
			     <td><?php echo $quote->level; ?></td>
			     <td><?php echo $quote->team; ?></td>
			     <td><?php echo $quote->author; ?></td>
			     <td>
			     	<?php if (!isset($_GET["raidarchive"])) {?>
				     	<?php if ($backend){ ?>
				     	<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php&raidaction=details&raidid='.$quote->rq_id); ?>">details</a> |
				     	<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php&raidaction=edit&raidid='.$quote->rq_id); ?>">edit / copy</a> | 
				     	<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php&raidaction=delete&raidid='.$quote->rq_id); ?>">delete</a>
				     	<?php } else {?>
				     	<a href="<?php echo get_raidurl("raidaction=details&raidid=".$quote->rq_id);?>">details</a>
				     	<?php } ?>
				    <?php } else if ($backend){ ?>
				    	<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php&raidarchive&raidaction=details&raidid='.$quote->rq_id); ?>">details</a> | 
				    	<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php&raidarchive&raidaction=delete&raidid='.$quote->rq_id); ?>">delete</a>
				    <?php } ?>
			     </td>
			   </tr>
		<?php } 
		} ?>
	<?php } if (!$wrote) { ?>
		<tr>
	     <td colspan="8" align="center"><label>There are no raids defined yet.</label></td>
	   </tr>
	<?php } ?>
</tbody>
</table>
<br/>
<span class="description" style="float:right;">
	*(Damage/Tank/Heal) - Today is the <?php echo strtoupper($today); ?>
	<?php if ($backend) { ?>
		<?php if (!isset($_GET["raidarchive"])) {?>
			<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php&raidarchive'); ?>">archive</a> |
		<?php } else { ?>
			<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php'); ?>">active</a> | 
		<?php } ?>
			<a href="<?php echo admin_url('admin.php?page=swtor-raidplaner/swtor-raider.php&raidaction=deleteall'); ?>">delete all</a>
	<?php } else if (is_user_logged_in()) {?>
		<a id="addRaid" href="<?php echo get_raidurl("showraidadd"); ?>">add raid</a>
	<?php } ?>
</span>