<?php
/**
 * Dashboard Template
 *
 * @package Linsila
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}?>
<div id="lists-container">
	<?php
	// Grab all lists
	$lists = linsila_get_lists();
	foreach( $lists as $list ) {
		include( 'partials/list.php' );
	}
	?>
</div>
<ul id="list-drop" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
	<li><a href="#">This is a link</a></li>
	<li><a href="#">This is another</a></li>
	<li><a href="#">Yet another</a></li>
</ul>
<div class="add-a-list idle">
	<form>
		<span class="placeholder"><?php _e('Add a list...', 'linsila');?></span>
		<input type="text" placeholder="<?php _e('Add a list...', 'linsila');?>" class="list-name" autocomplete="off">
		<div class="edit-controls keep u-clearfix">
			<button type="submit" class="button radius confirm js-save-list tiny"><?php _e('Save', 'linsila');?><i class="lin-icon-spinner6 lin-spin"></i> </button>
			<a href="#" class="cancel js-cancel-edit">&times;</a>
		</div>
	</form>
</div>