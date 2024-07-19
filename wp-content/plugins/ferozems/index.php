<?php
/*
* Plugin Name: Feroz ferozems
* Description: Feroz ferozems to explain the crud functionality.
* Version: 1.0
* Author: Feroz
*/

	global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'ferozems';
    $sql = "DROP TABLE IF EXISTS $table_name;
            CREATE TABLE $table_name(
            id mediumint(11) NOT NULL AUTO_INCREMENT,
            emp_id varchar(50) NOT NULL,
            emp_name varchar (250) NOT NULL,
            emp_email varchar (250) NOT NULL,
            emp_dept varchar (250) NOT NULL,          
            PRIMARY KEY id(id)
            )$charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // alter table
    $mytab = $wpdb->get_row("select *from $table_name");
    if(!isset($mytab->emp_marks)){
        $wpdb->query("alter table $table_name add emp_marks int(2)");
    }


add_action('admin_menu', 'da_display_esm_menu');
function da_display_esm_menu()
{

    add_menu_page('EMS', 'EMS', 'manage_options', 'emp-list', 'da_ems_list_callback');
    add_submenu_page('emp-list', 'Employee List', 'Employee List1', 'manage_options', 'emp-list', 'da_ems_list_callback');
    add_submenu_page('emp-list', 'Add Employee', 'Add Employee1', 'manage_options', 'add-emp', 'da_ems_add_callback');
    add_submenu_page(null, 'Update Employee', 'Update Employee', 'manage_options', 'update-emp', 'da_emp_update_call');
    add_submenu_page(null, 'Delete Employee', 'Delete Employee', 'manage_options', 'delete-emp', 'da_emp_delete_call');
    add_submenu_page('emp-list', 'Employee List Shortcode', 'Employee List Shortcode1', 'edit_others_posts', 'emp-shotcode', 'da_emp_shortcode_call');

}

function da_ems_add_callback()
{

    global $wpdb;
    $table_name = $wpdb->prefix . 'ferozems';
    $msg = '';
    if (isset($_REQUEST['submit'])) {        
        $wpdb->insert("$table_name", [
            "emp_id" => $_REQUEST['emp_id'],
            'emp_name' => $_REQUEST['emp_name'],
            'emp_email' => $_REQUEST['emp_email'],
            'emp_dept' => $_REQUEST['emp_dept'],
            'emp_marks'=>$_REQUEST['emp_marks']
        ]);


        if ($wpdb->insert_id > 0) {        	
            $msg = "Saved Successfully";
        } else {        	
            $msg = "Failed to save data";
        }
    }



    ?>
    <h4 id="msg"><?php echo $msg; ?></h4>

    <form method="post">

        <p>
            <label>EMP ID</label>
            <input type="text" name="emp_id" placeholder="Enter ID" required>

        </p>

        <p>
            <label>Name</label>
            <input type="text" name="emp_name" placeholder="Enter Name" required>

        </p>
        <p>
            <label>Email</label>
            <input type="email" name="emp_email" placeholder="Enter Email" required>
        </p>
        <p>
            <label>Department</label>
            <input type="text" name="emp_dept" placeholder="Enter Department" required>
        </p>
        <p>
            <label>Marks</label>
            <input type="number" maxlength=2 name="emp_marks" placeholder="Enter Marks">
        </p>

        <p>
            <button type="submit" name="submit">Submit</button>
        </p>
    </form>
<?php }

function da_emp_shortcode_call()
{ ?>

    <p>
        <label>Shortcode</label>
        <input type="text" value="[employee_list]">
    </p>
<?php }



//[employee_list]
add_shortcode('employee_list', 'da_ems_list_callback');
function da_ems_list_callback()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ferozems';
    $employee_list = $wpdb->get_results($wpdb->prepare("select * FROM $table_name", ""), ARRAY_A);
    if (count($employee_list) > 0): ?>
        <div style="margin-top: 40px;">
            <table border="1" cellpadding="10">
                <tr>
                    <th>S.No.</th>
                    <th>EMP ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Marks</th>
                    <?php if (is_admin()): ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
                <?php $i = 1;
                foreach ($employee_list as $index => $employee): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $employee['emp_id']; ?></td>
                        <td><?php echo $employee['emp_name']; ?></td>
                        <td><?php echo $employee['emp_email']; ?></td>
                        <td><?php echo $employee['emp_dept']; ?></td>
                        <td><?php echo $employee['emp_marks']; ?></td>
                        <?php if (is_admin()): ?>
                            <td>
                                <a href="admin.php?page=update-emp&id=<?php echo $employee['id']; ?>">Edit</a>
                                <a href="admin.php?page=delete-emp&id=<?php echo $employee['id']; ?>">Delete</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    <?php else:echo "<h2>Employee Record Not Found</h2>";endif;
}



function da_emp_update_call()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ferozems';
    $msg = '';
    $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : "";
    if (isset($_REQUEST['update'])) {
        if (!empty($id)) {
            $wpdb->update("$table_name", ["emp_id" => $_REQUEST['emp_id'], 'emp_name' => $_REQUEST['emp_name'], 'emp_email' => $_REQUEST['emp_email'], 
            'emp_dept' => $_REQUEST['emp_dept'],'emp_marks' => $_REQUEST['emp_marks']], ["id" => $id]);
            $msg = 'Data updated';
        }
    }
    $employee_details = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name where id = %d", $id), ARRAY_A); ?>
    <h4><?php echo $msg; ?></h4>
    <form method="post">
        <p>
            <label>EMP ID</label>
            <input type="text" name="emp_id" placeholder="Enter ID" value="<?php echo $employee_details['emp_id']; ?>"
                   required></p>
        <p><label>Name</label>
            <input type="text" name="emp_name" placeholder="Enter Name"
                   value="<?php echo $employee_details['emp_name']; ?>" required></p>
        <p><label>Email</label>
            <input type="email" name="emp_email" placeholder="Enter Email"
                   value="<?php echo $employee_details['emp_email']; ?>" required> </p>
        <p><label>Department</label>
            <input type="text" name="emp_dept" placeholder="Enter Department"
                   value="<?php echo $employee_details['emp_dept']; ?>" required></p>
        <p><label>Marks</label>
            <input type="number" name="emp_marks" placeholder="Enter Marks"
            value="<?php echo $employee_details['emp_marks']; ?>" ></p>
        <p> <button type="submit" name="update">Update</button>/p>
    </form>
<?php }
function da_emp_delete_call()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ferozems';
    $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : "";
    if (isset($_REQUEST['delete'])) {
        if ($_REQUEST['conf'] == 'yes') {
            $row_exits = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id), ARRAY_A);
            if (count($row_exits) > 0) {
                $wpdb->delete("$table_name", array('id' => $id,));
            }
        } ?>
        <script>
            location.href = "<?php echo site_url(); ?>/wp-admin/admin.php?page=emp-list";
        </script>
    <?php } ?>
    <form method="post">
        <p>
            <label>Are you sure want delete?</label><br>
            <input type="radio" name="conf" value="yes">Yes
            <input type="radio" name="conf" value="no" checked>No
        </p>
        <p>
            <button type="submit" name="delete">Delete</button>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </p>
    </form>

<?php }


?>
