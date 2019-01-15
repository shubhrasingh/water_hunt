<?php
switch($action)
    {
        case "activate":
            ?>
                <button  onclick="changeStatus('deactivate',<?php echo $rowid; ?>)" class="btn btn-xs btn-success">Active</button>
            <?php
        break;
                        
        case "deactivate":
            ?>

                <button onclick="changeStatus('activate',<?php echo $rowid; ?>)" class="btn btn-xs btn-danger">Deactive</button>
            <?php
        break;
    }
?>