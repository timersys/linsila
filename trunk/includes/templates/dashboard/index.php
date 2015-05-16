<?php
/**
 * Dashboard Template
 *
 * @package Linsila
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="add-a-list idle">
	<form>
		<span class="placeholder"><?php _e('Add a list...', 'linsila');?></span>
		<input type="text" placeholder="<?php _e('Add a list...', 'linsila');?>" class="list-name" autocomplete="off">
		<div class="edit-controls keep u-clearfix">
			<button type="submit" class="button radius confirm js-save-list tiny"><?php _e('Save', 'linsila');?></button>
			<a href="#" class="cancel js-cancel-edit">&times;</a>
		</div>
	</form>
</div>