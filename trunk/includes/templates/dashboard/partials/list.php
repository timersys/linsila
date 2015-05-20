<?php
/**
 * List partial
 *
 * @package Linsila
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="list" data-id="<?php echo $list->term_id;?>">
	<div class="list-header"><div class="handle">|||</div><?php echo $list->name;?>
		<div class="list-actions"><a href="#" class="" data-dropdown="list-drop" aria-controls="list-drop" data-options="align: left">x</a></div>
	</div>
</div>