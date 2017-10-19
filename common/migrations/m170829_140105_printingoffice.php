<?php
/*******************************************************************************
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 ******************************************************************************/

use common\models\User;
use common\models\UserInfo;
use frontend\models\SignupForm;
use yii\db\Schema;

class m170829_140101_printingoffice extends \yii\db\Migration
{


    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->addColumn('{{%product_gallery}}','hash_id','varchar(32)');
        $this->addColumn('{{%ticket_head}}','hash_id','varchar(32)');
        $this->addColumn('{{%taban_user_info}}','balance','varchar(12)');
    }

    public function safeDown()
    {
        $this->dropTable('{{%user_info}}');
        $this->dropTable('{{%transaction}}');
        $this->dropTable('{{%ticket_file}}');
        $this->dropTable('{{%ticket_body}}');
        $this->dropTable('{{%ticket_head}}');
        $this->dropTable('{{%slider}}');
        $this->dropTable('{{%settings}}');
        $this->dropTable('{{%role_options}}');
        $this->dropTable('{{%role}}');
        $this->dropTable('{{%product_property_step}}');
        $this->dropTable('{{%product_step_property}}');
        $this->dropTable('{{%product_gallery}}');
        $this->dropTable('{{%product}}');
        $this->dropTable('{{%order_status_log}}');
        $this->dropTable('{{%order_details}}');
        $this->dropTable('{{%order}}');
        $this->dropTable('{{%send_method}}');
        $this->dropTable('{{%notification}}');
        $this->dropTable('{{%menus}}');
        $this->dropTable('{{%page}}');
        $this->dropTable('{{%log_users}}');
        $this->dropTable('{{%log}}');
        $this->dropTable('{{%invoice}}');
        $this->dropTable('{{%inquery}}');
        $this->dropTable('{{%inquery_category}}');
        $this->dropTable('{{%auth_item_child}}');
        $this->dropTable('{{%auth_assignment}}');
        $this->dropTable('{{%users}}');
        $this->dropTable('{{%auth_item}}');
        $this->dropTable('{{%auth_rule}}');
        $this->dropTable('{{%access}}');
    }
}
