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
	<div class="list-content">
		<a href="#" class="add-job js-add-job radius button small tiny" data-reveal-id="js-new-job" >Add new job</a>
	</div>
</div>