<?php
switch($action)
	{
		case "activate":
			?>
			    <button  onclick="changeStatus('deactivate',<?php echo $rowid; ?>)" class="btn btn-sm btn-success btn-mini">Active</button>
			<?php
		break;
						
		case "deactivate":
            ?>
                <button onclick="changeStatus('activate',<?php echo $rowid; ?>)" class="btn btn-sm btn-danger btn-mini">Deactive</button>
			<?php
		break;
	}
?>