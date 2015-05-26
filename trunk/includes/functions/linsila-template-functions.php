<?php
/**
 * Prints edit controls for editable areas
 */
function linsila_edit_controls( ) {
	?><div class="edit-controls keep u-clearfix">
		<button type="submit" class="button radius confirm js-save-editable tiny"><?php _e('Save', 'linsila');?><i class="lin-icon-spinner6 lin-spin"></i> </button>
		<a href="#" class="cancel js-cancel-edit">&times;</a>
	</div><?php
}