<?php

	class ui { // Pretty bare-bones at this point?
	
		function drawTile($title, $brand, $link = "#", $class = "bg-darkViolet fg-white", $padding = true, $id = "") { // Draws MetroUI tiles. A versatile function!
			?><a href="<?php echo $link; ?>" class="tile ol-transparent <?php echo $class; ?>" data-click="transform" <?php if(!empty($id)) { ?>id="<?php echo $id; ?>"<?php } ?>>
                <div class="tile-content icon ol-transparent">
                    <h5 class="  <?php echo $class; ?> <?php if($padding == true) { ?>padding10<?php } ?>"><?php echo $title; ?></h5>
                </div>
                
                <?php if(!empty($brand)) { ?><div class="brand bg-black fg-white text-center">
                	<?php echo $brand ?>
                </div><?php } ?>
            </a><?php 
		}
		
	}