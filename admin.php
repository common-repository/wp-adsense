<?
function print_editcode($title, $location)
{
?>
<table class="widefat" cellspacing="0">
	<thead>
	<tr>		
		<th scope="col" class="manage-column" onmouseout="document.body.style.cursor = 'default';" onmouseover="document.body.style.cursor = 'hand';" onclick="toggle('<? echo $location; ?>');"><? echo $title; ?></th>		
	</tr>
	</thead>
 
	<tbody class="plugins" id="<? echo $location; ?>" style="display:none;">

		<tr class='active'>
			<th scope='row' class='check-column'>
			
			<form method="post" action="options.php">
			<?php wp_nonce_field('update-options'); ?>
			<table>

			<tr valign="top">
			<th scope="row" style="border:0;" width="100">Shown %</th>
			<td style="border:0;"><input type="text" name="<? echo $location; ?>_code_frequency" value="<?php echo get_option($location.'_code_frequency'); ?>" /></td>
			</tr>

			<tr valign="top">
			<th scope="row" style="border:0;">Code</th>
			<td style="border:0;"><textarea cols="57" rows="20" name="<? echo $location; ?>_code"><?php echo get_option($location.'_code'); ?></textarea></td>
			</tr>

			</table>

			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="<? echo $location; ?>_code_frequency,<? echo $location; ?>_code" />

			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>

			</form>			
			
			</th>						
		</tr>

	</tbody>
</table>
<br/>
<?
}
?>