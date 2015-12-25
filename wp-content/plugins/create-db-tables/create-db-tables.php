<?php
/**
 * Plugin Name: Create DB Tables
 * Plugin URI:  http://jppreusdev.com/development/wordpress-plugins/create-db-tables/
 * Description: Extremely simple way for developers to create new tables inside the existing WordPress database. Forget the annoying process of opening phpMyAdmin, logging in, then typing out the full SQL command for your new table. With this plugin, everything you need to do is located on one simple to use page, and you don't have to type out any SQL queries! This plugin also keeps record of the tables you've created. It is perfect for the developer who wants to quickly and easily add new database tables in a quick and effective manner.
 * Version:     1.1.1
 * Author:      James Preus | @JPPreusDev
 * Author URI:  http://jppreusdev.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require 'create-new-table.php';

function cdbt_create_db_tables_create_menu() {

	//create new top-level menu
	add_menu_page('Create DB Tables', 'Create DB Tables', 'administrator', 'create-db-tables', 'cdbt_create_db_tables_settings_page' , 'dashicons-editor-table', 81 );
	
	add_submenu_page( 'create-db-tables', 'Add New Table', 'Add New Table', 'administrator', 'add-new-table', 'cdbt_add_new_table_page' );

}
add_action('admin_menu', 'cdbt_create_db_tables_create_menu');



function cdbt_create_db_tables_settings_page() {
	?>
<div class="wrap">
	<h2>Create DB Tables 
		<a href="<?php echo admin_url('admin.php?page=add-new-table'); ?>" class="page-title-action">
			Add New Table
		</a>
	</h2>
	
	<?php
	$query = $_SERVER['QUERY_STRING'];
	$table_name = str_replace('page=create-db-tables&create_new_table_success=true&table_name=', '', $query);
	?>
	
	<?php
	/**
	 * Alert: New Table Created
	 */

	if ($_SERVER['QUERY_STRING'] == 'page=create-db-tables&create_new_table_success=true&table_name=' . $table_name) { ?>
	<div class="updated">
		<p><strong>Success!</strong> The following table has been added to the database: "<span style="font-weight: 800;"><?php echo $table_name; ?></span>"</p>
	</div>
	<?php } ?>


	<?php
	/**
	 * Alert: Error Creating Table
	 */

	if ($_SERVER['QUERY_STRING'] == 'page=create-db-tables&create_new_table_success=false') { ?>
	<div class="error">
		<p><?php _e( '<strong>Error:</strong> An error has occured. Please try again.' ); ?></p>
	</div>
	<?php } ?>


	<?php
	/**
	 * Alert: No Data Submitted
	 */		

	if ($_SERVER['QUERY_STRING'] == 'page=create-db-tables&create_new_table_success=null') { ?>
	<div class="error">
		<p><?php _e( '<strong>Error:</strong> You did not submit any data. Fill out the form and try again.' ); ?></p>
	</div>
	<?php } ?>
	
	<section style="margin-top: 30px;">
	
		<table id="tables">
			<th>
				<tr>
					<td><h3>Tables Created</h3></td>
				</tr>
			</th>
		<?php
		$options = get_option('create_wordpress_tables_created_tables');
		if($options == null) {
			echo '<tr><td>You have not created any tables yet...</td></tr>';
		}
		$explode = explode(',', $options);
		foreach($explode as $option) { ?>
		<tr>
			<td><?php echo $option; ?></td>
		</tr>
		<?php } ?>
		</table>
		
		
	</section>
	
	
</div>

<?php 
}

function cdbt_add_new_table_page() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	cdbt_add_page_styles();
	?>
<div class="wrap">
	<h2>Add New Table
		<a href="<?php echo admin_url('admin.php?page=create-db-tables'); ?>" class="page-title-action">
			Cancel
		</a>
	</h2>
	
	<section style="margin-top: 15px;">
		
		<div style="width: 700px;margin-bottom: 30px;">

			<span><strong>Important Notes:</strong></span>
			<ul>
				<li style="padding-left:15px;">• Your table will automatically include a row named "id" with the type set to "bigint(20)" and includes the auto_increment setting as the first row in the table.</li>
				<li style="padding-left:15px;">• The table's charset is automatically set to the WordPress standard "utf8mb4_unicode_ci".</li>
			</ul>

		</div>
		
		<form id="create-table" method="post" action="<?php echo admin_url('admin-post.php'); ?>">

			<input type="hidden" name="action" value="add_table">

			<fieldset class="row-fieldset">
				<label id="table-name">Table Name:</label>
				<span style="position: relative; top: 2px;"><?php echo $prefix; ?></span><input type="text" class="table-name" name="table_name" size="30" id="table-name">
				<span>(Alphanumeric only, no special charaters.)</span>
			</fieldset>

			<div id="rows">
				
				<fieldset class="row-fieldset"><label id="row-label">Row:</label><input type="text" class="name-input" name="name[]" placeholder="Name" size="20"><input type="text" class="type-input" name="type[]" placeholder="Type [Ex: bigint(20)]" size="20"><span id="null-label">Null</span><input type="checkbox" class="null-input" name="null[]"><input type="text" class="default-input" name="default[]" placeholder="Default Value" size="20"><span id="unique-label">Unique</span><input type="checkbox" class="unique-input" name="unique[]"></fieldset>
				
			</div>

			<div id="add-row">
				<button type="button" class="add-row button-secondary">Add Row</button>
			</div>
			
			<fieldset>
				<input type="hidden" id="items" name="items" value="1" />
			</fieldset>

			<fieldset>
				<button type="submit" class="button button-primary button-large">Create Table</button>
			</fieldset>

		</form>

		<script>
			jQuery(function($) {
				$('.add-row').click(function () {
					$('#items').val(function(i, val) { return +val+1 });
					var rowHTML = '<fieldset class="row-fieldset"><label id="row-label">Row:</label><input type="text" class="name-input" name="name[]" placeholder="Name" size="20"><input type="text" class="type-input" name="type[]" placeholder="Type [Ex: bigint(20)]" size="20"><span id="null-label">Null</span><input type="checkbox" class="null-input" name="null[]"><input type="text" class="default-input" name="default[]" placeholder="Default Value" size="20"><span id="unique-label">Unique</span><input type="checkbox" class="unique-input" name="unique[]"></fieldset>';
					$('#rows').append(rowHTML);
				});
				$("input.name-input").on({
				  keydown: function(e) {
					if (e.which === 32)
					  return false;
				  },
				  change: function() {
					this.value = this.value.replace(/\s/g, "");
				  }
				});
				$("input.table-name").on({
				  keydown: function(e) {
					if (e.which === 32)
					  return false;
				  },
				  change: function() {
					this.value = this.value.replace(/\s/g, "");
				  }
				});
			});
		</script>

	</section>
	
</div>

<?php 
}

function cdbt_add_page_styles() {
	?>
<style>
	#table-name,
	#row-label {
		padding-right:25px;
		font-weight: 600;
	}
	input[type="text"], input[type="checkbox"] {
		margin-right: 10px!important;
	}
	#null-label,
	#unique-label {
		padding-right: 5px;
	}
	.row-fieldset {
		margin-bottom: 15px;
		display: inline-table;
	}
	#rows {
		margin-bottom: 15px;
	}
	#add-row {
		margin-bottom: 20px;
	}
</style>
<?php
}

add_action( 'admin_post_add_table', 'cdbt_create_new_table' );


?>