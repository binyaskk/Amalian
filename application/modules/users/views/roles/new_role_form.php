<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
    <?php
   echo form_open('users/roles/save/'.$role->role_id,array('id'=>'role_form'));
   ?>
        <div id="required_fields_message">
            <?php echo $this->lang->line('common_fields_required_message'); ?>
        </div>
        <ul id="error_message_box"></ul>
        <fieldset id="role_basic_info">

            <?php $this->load->view("users/roles/form_basic_info"); ?>
        </fieldset>

        <fieldset id="role_permission_info">
            <legend>
                <?php echo $this->lang->line("roles_permission_info"); ?>
            </legend>
            <p>
                <?php echo $this->lang->line("roles_permission_desc"); ?>
            </p>
            <ul id="permission_list">
                <?php
         foreach($all_modules->result() as $module)
         {
         ?>
                    <li>
                        <?php
            $js = 'id="'.$module->module_id.'"';
             echo form_checkbox("permissions[]",$module->module_id,$this->User->has_permission($module->module_id,$user_info->user_id),$js); ?>
                            <label for="<?php echo $module->module_id ?>"></label>
                            <span class="medium"><?php echo $this->lang->line('module_'.$module->module_id);?>:</span>
                            <span class="small"><?php echo $this->lang->line('module_'.$module->module_id.'_desc');?></span>
                    </li>
                    <?php
         }
         ?>
            </ul>
            <?php
      echo form_submit(array(
      	'name'=>'submit',
      	'id'=>'submit',
      	'value'=>$this->lang->line('common_submit'),
      	'class'=>'submit_button float_right')
      );
      
      ?>
        </fieldset>
        <?php 
   echo form_close();
   ?>
            <style>
                /* for prevent auto scroll of checkbox )*/
                
                input[type="checkbox"] {
                    display: none;
                }

            </style>
            <script type='text/javascript'>
                //validation and submit handling
                $(document).ready(function() {
                    var csfrData = {};
                    csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
                    $(function() {
                        // Attach csfr data token
                        $.ajaxSetup({
                            data: csfrData
                        });
                    });
                    $('input[type="checkbox"]').addClass("filled-in");

                    $('#role_form').validate({
                        submitHandler: function(form) {
                            $(form).ajaxSubmit({
                                success: function(response) {
                                    var str = response.message;
                                    var success = response.success;
                                    var res = str.replace(/\\n/g, "\n");
                                    jAlert(res, 'Confirmation Dialog', function(r) {
                                        post_role_form_submit(response);
                                    });
                                },
                                dataType: 'json'
                            });
                        },
                        errorLabelContainer: "#error_message_box",
                        wrapper: "li",
                        rules: {
                            role_name: {
                                required: true,
                                minlength: 3,
                                maxlength: 250
                            },

                        },
                        messages: {
                            role_name: {
                                required: "<?php echo $this->lang->line('roles_rolename_required'); ?>",
                                minlength: "<?php echo $this->lang->line('roles_rolename_minlength'); ?>",
                                maxlength: "<?php echo $this->lang->line('roles_rolename_maxlength'); ?>"
                            }
                        }
                    });
                });

            </script>
