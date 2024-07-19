<?php

/*
* Plugin Name: ZorefShare
* Description: ZorefShare to Shares functionality
* Version: 1. 0
* Author: Feroz
*/

    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'zorefshare';
    $sql = "DROP TABLE IF EXISTS $table_name;
            CREATE TABLE $table_name(
            id mediumint(11) NOT NULL AUTO_INCREMENT,
            emp_id varchar(30) NOT NULL,
            emp_name varchar (30) NOT NULL,
            emp_email varchar (30) NOT NULL,
            emp_country varchar (30) NOT NULL,          
            PRIMARY KEY id(id)
            )$charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    add_action('admin_menu','zshare_menu');
    function zshare_menu()
    {

    add_menu_page('ZShare', 'ZShare', 'manage_options', 'zshare-list', 'zshare_list');
    add_submenu_page('zshare-list', 'ZShare List', 'ZShare List', 'manage_options', 'zshare_list', 'zshare_list');
    add_submenu_page('zshare-list', 'Add ZShare', 'Add ZShare', 'manage_options', 'zshare_add', 'zshare_add');
    add_submenu_page(null, 'Update ZShare', 'Update ZShare', 'manage_options', 'zshare_update', 'zshare_update');
    add_submenu_page(null, 'Delete ZShare', 'Delete ZShare', 'manage_options', 'zshare_delete', 'zshare_delete');
    add_submenu_page('zshare-list', 'ZShare List Shortcode', 'ZShare List Shortcode', 'edit_others_posts', 'zshare-shotcode', 'zshare_list');
   
    }
    function zshare_list()
    {
        echo "zshare list";    
        global $wpdb;
        $table_name = $wpdb->prefix.'zorefshare';
        $zshares = $wpdb->get_results($wpdb->prepare("select * FROM $table_name",""),ARRAY_A);
        if(count($zshares)>0): ?>
           <div>
             <table border="1" cellpadding="10">
                <tr>
                    <th>S.No</th>
                    <th>Emp Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Action</th>
                </tr>
                <?php 
                   $i=1;
                   foreach($zshares as $index=>$zs): ?>
                   <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $zs['emp_id']; ?></td>
                        <td><?php echo $zs['emp_name']; ?></td>
                        <td><?php echo $zs['emp_email']; ?></td>
                        <td><?php echo $zs['emp_country']; ?></td>
                        <?php if(is_admin()): ?>
                        <td>
                            <a href="admin.php?page=zshare_update&id=<?php echo $zs['id']; ?>">Edit</a>
                            <a href="admin.php?page=zshare_delete&id=<?php echo $zs['id']; ?>">Del</a>
                        </td>
                        <?php endif; ?>
                   </tr>
                   <?php endforeach; ?>
             </table>
           </div>
        <?php
        endif;
        
    }
    function zshare_add()
    {
        // echo "zshare add";
        global $wpdb;
        $table_name = $wpdb->prefix.'zorefshare';
        $msg ='';
        if(isset($_REQUEST['submit']))
        {              
            $wpdb->insert("$table_name",[
                "emp_id"=>$_REQUEST['emp_id'],
                "emp_name"=>$_REQUEST['emp_name'],
                "emp_email"=>$_REQUEST['emp_email'],
                "emp_country"=>$_REQUEST['emp_country']
            ]);  
            if($wpdb->insert_id>0){$msg='Saved Successfully';}
            else{$msg = "Failed to save data";}          
            echo "zshare post";

        }
        ?>
          <form method="post">
            <p>
                <label>Id</label>
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
                <label>Country</label>
                <select name="emp_country" id="cars">
                    <option value="usa">USA</option>
                    <option value="uk">UK</option>
                    <option value="canada">Canada</option>
                    <option value="australia">Australia</option>
                    <option value="newzealand">Newzealand</option>
                </select>
            </p>
            <p>
                <button type="submit" name="submit">Submit</button>
            </p>
          </form>
        <?php

    }
    function zshare_update()
    {
        //echo "zshare update";
        global $wpdb;
        $table_name = $wpdb->prefix.'zorefshare';
        $msg='';
        $id = isset($_REQUEST['id'])?intval($_REQUEST['id']):"";
        if(isset($_REQUEST['update']))
        { if(!empty($id)){
            $wpdb->update("$table_name",['emp_id'=>$_REQUEST['emp_id'],'emp_name'=>$_REQUEST['emp_name'],
            'emp_email'=>$_REQUEST['emp_email'],'emp_country'=>$_REQUEST['emp_country']],['id'=>$id]);
            $msg = 'Data Updated';
        }}
                $zs = $wpdb->get_row($wpdb->prepare("select * from $table_name where id=%d",$id),ARRAY_A); ?>
                <h4><?php echo $msg; ?></h4>
                <form method="post">
                    <p><label>Emp Id</label><input type="text" name="emp_id" value="<?php echo $zs['emp_id']; ?>" /></p>
                    <p><label>Name</label><input type="text" name="emp_name" value="<?php echo $zs['emp_name']; ?>" /></p>
                    <p><label>Email</label><input type="email" name="emp_email" value="<?php echo $zs['emp_email']?>"/></p>
                    <p><label>Country</label>
                            <select name="emp_country" id="emp_country">
                                <option value="usa" <?php echo ($zs['emp_country']=='usa')?'selected':'' ?> >USA</option>
                                <option value="uk" <?php echo ($zs['emp_country']=='uk')?'selected':'' ?> >UK</option>
                                <option value="canada" <?php echo ($zs['emp_country']=='canada')?'selected':'' ?> >Canada</option>
                                <option value="australia" <?php echo ($zs['emp_country']=='australia')?'selected':'' ?> >Australia</option>
                                <option value="newzealand" <?php echo ($zs['emp_country']=='newzealand')?'selected':'' ?> >Newzealand</option>
                            </select>
                    </p>
                    <p><button type="submit" name="update">Update</button></p>
                </form>
                <?php        

    }
    function zshare_delete()
    {
        echo "zshare delete";
        global $wpdb;
        $table_name = $wpdb->prefix.'zorefshare';
        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : "";
      //  $id=isset($_REQUEST['id'])? intval($_REQUEST['id']) :"");
        if(isset($_REQUEST['delete'])){
            if($_REQUEST['conf']=='yes'){
                $row_exist  = $wpdb->get_row($wpdb->prepare("select *from $table_name where id=%d",$id),ARRAY_A);
                if(count($row_exist)>0){ $wpdb->delete("$table_name", array('id' => $id,));}
                
            }?>
             <script>
                 location.href = "<?php echo site_url(); ?>/wp-admin/admin.php?page=zshare_list";
            </script>
        <?php }  ?>
        <form method="post">
            <p>
                <label>Are you sure want to delete</label>
                <input type="radio" name="conf" value="yes">YES
                <input type="radio" name="conf" value="no">NO
            </p>
            <p>
                <button type="submit" name="delete">Delete</button>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
            </p>
        </form>
        <?php
    }


?>