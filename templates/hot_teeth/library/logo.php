<?php
/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2015 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/?>
<div class="cell mp_<?php echo $mposition[0]; ?> span<?php echo $mposition[1]; ?>">
    <div class="cell_pad">
 		<?php if($logoImageSwitch) { ?>
        <div class="sparky_logo_image"><a href="<?php echo $this->baseurl; ?>"><img src="<?php echo $this->baseurl."/".$logoImageFile; ?>" alt="<?php echo $logoImageAlt; ?>" /></a></div>
		<?php }else{ ?>
        <div class="sparky_logo"><a href="index.php"><?php echo $logoText; ?></a></div>
        <div class="sparky_slogan"><?php echo $sloganText; ?></div>
        <?php } ?>
    </div>
</div>