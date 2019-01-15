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

		case "ON":
			?>
			   <a onclick="changeStatus('OFF')" class="btn btn-sm btn-success pull-right" style="font-size: 13px;padding: 0px 15px;height: 25px;line-height: 24px;">ON</a>
			<?php
		break;
						
		case "OFF":
            ?>
                 <a onclick="changeStatus('ON')"  class="btn btn-sm btn-danger pull-right"  style="font-size: 13px;padding: 0px 15px;height: 25px;line-height: 24px;">OFF</a>
			<?php
		break;
	}
?>