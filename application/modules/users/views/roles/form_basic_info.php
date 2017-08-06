<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
    <?php if ($role->role_id!=''){ ?>
        <div class="field_row clearfix">
            <?php echo form_label($this->lang->line('roles_id').':', 'role_id',array()); ?>
                <div class='form_field'>
                    <?php echo form_label($role->role_id, 'role_id2',array()); ?>
                </div>
        </div>
        <?php } ?>

            <div class="field_row clearfix">
                <?php echo form_label($this->lang->line('roles_name').':', 'role_name',array('class'=>'required')); ?>
                    <div class='form_field'>
                        <?php echo form_input(array(
         'name'=>'role_name',
         'id'=>'role_name',
         'value'=>$role->role_name)
         );?>
                    </div>
            </div>
