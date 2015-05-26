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
<div class="add-a-list js-editable idle">
	<form>
		<span class="placeholder"><?php _e('Add a list...', 'linsila');?></span>
		<input type="text" placeholder="<?php _e('Add a list...', 'linsila');?>" class="list-name js-input" autocomplete="off" data-action="linsila_create_list">
		<?php linsila_edit_controls( 'js-save-list' );?>
	</form>
</div>

<div id="js-new-job" class="reveal-modal medium" data-reveal aria-labelledby="add-job-title" aria-hidden="true" role="dialog">
	<div class="job-title-container js-editable idle">
		<h3 class="job-title placeholder">Job Title........</h3>
		<textarea name="job-title" id="job-title" class="js-input" placeholder="Job Title........" data-action="linsila_save_job_title"></textarea>
		<?php linsila_edit_controls( 'js-save-job-title' );?>
	</div> - <h4>In progress</h4>
	<form data-abide>
		<div class="row">
			<div class="large-8 columns">
				<label><?php _e('Job title', 'linsila');?>
					<input type="text" required placeholder="<?php _e('Enter project name or small description', 'linsila');?>" />
				</label>
				<small class="error"><?php _e('Project name is required', 'linsila');?></small>
			</div>
		</div>
		<div class="row">
			<div class="large-8 columns">
				<label><?php _e('Client / Group', 'linsila');?>
					<select name="client" class="js-client-dropdown">
						<option value="">Add one</option>
					</select>
				</label>
			</div>
		</div>
	</form>
	<p><a href="#" data-reveal-id="secondModal" class="secondary button">Second Modal...</a></p>
	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>