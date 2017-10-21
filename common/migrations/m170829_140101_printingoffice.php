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
        $this->createTable('{{%temp}}', [
            'id' => $this->primaryKey(),
            'key1' => $this->text(),
            'key2' => $this->text(),
            'key3' => $this->text()
        ], $tableOptions);
        $this->createTable('{{%access}}', [
            'id' => $this->primaryKey(),
            'role_id' => $this->integer(11)->notNull(),
            'page_id' => $this->integer(11)->notNull(),
            'lock' => $this->bigInteger(20),
        ], $tableOptions);
        $this->createTable('{{%auth_rule}}', [
            'name' => $this->string(64)->notNull(),
            'data' => $this->text(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'lock' => $this->bigInteger(20),
            'PRIMARY KEY ([[name]])',
        ], $tableOptions);
        $this->createTable('{{%auth_item}}', [
            'name' => $this->string(64)->notNull(),
            'type' => $this->integer(11)->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->text(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'lock' => $this->bigInteger(20),
            'PRIMARY KEY ([[name]])',
            'FOREIGN KEY ([[rule_name]]) REFERENCES {{%auth_rule}} ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'hash_id' => $this->string(20)->notNull()->unique(),
            'fullname' => $this->string(100),
            'RoleID' => $this->integer(11),
            'Image' => $this->string(100),
            'auth_key' => $this->string(32),
            'access_token' => $this->string(128),
            'password_hash' => $this->string(255),
            'password_reset_token' => $this->string(255),
            'email' => $this->string(255),
            'status' => $this->smallInteger(6)->defaultValue(10),
            'IsPrivate' => $this->integer(11),
            'LastLoginIP' => $this->string(16),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'imei' => $this->string(255)->defaultValue(''),
            'UUID' => $this->char(32),
            'lock' => $this->bigInteger(20),
            'mode' => $this->smallInteger(6)->defaultValue(1),
            'VerificationCode' => $this->Integer(11),
        ], $tableOptions);
        $this->createTable('{{%auth_assignment}}', [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'created_at' => $this->integer(11),
            'lock' => $this->bigInteger(20),
            'PRIMARY KEY ([[item_name]], [[user_id]])',
            'FOREIGN KEY ([[item_name]]) REFERENCES {{%auth_item}} ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[user_id]]) REFERENCES {{%users}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%auth_item_child}}', [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
            'lock' => $this->bigInteger(20),
            'PRIMARY KEY ([[parent]], [[child]])',
            'FOREIGN KEY ([[child]]) REFERENCES {{%auth_item}} ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%inquery_category}}', [
            'id' => $this->primaryKey(),
            'catname' => $this->string(255)->notNull(),
            'description' => $this->string(1000),
            'date' => $this->datetime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
        ], $tableOptions);
        $this->createTable('{{%inquery}}', [
            'id' => $this->primaryKey(),
            'uid' => $this->integer(11),
            'qdescription' => $this->string(2000)->notNull(),
            'qfile' => $this->string(255),
            'qdate' => $this->datetime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'adate' => $this->datetime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'afile' => $this->string(255),
            'adescription' => $this->string(2000)->notNull(),
            'category' => $this->integer(11),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'FOREIGN KEY ([[category]]) REFERENCES {{%inquery_category}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[uid]]) REFERENCES {{%users}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%invoice}}', [
            'id' => $this->integer(11)->notNull(),
            'date' => $this->datetime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'uid' => $this->integer(11)->notNull(),
            'status' => $this->integer(11)->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'discount' => $this->decimal(10, 0),
            'tax' => $this->decimal(10, 0),
            'paymentmethod' => $this->string(255)->notNull(),
            'paydate' => $this->datetime(),
            'description' => $this->string(255),
            'title' => $this->string(255),
            'paycode' => $this->string(255),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'PRIMARY KEY ([[id]])',
        ], $tableOptions);
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'userfullname' => $this->string(255)->defaultValue('0'),
            'ip' => $this->string(16)->notNull(),
            'module' => $this->string(100)->notNull(),
            'action' => $this->string(100)->notNull(),
            'type' => $this->integer(2)->notNull(),
            'time' => $this->integer(11),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
        ], $tableOptions);
        $this->createTable('{{%log_users}}', [
            'id' => $this->primaryKey(),
            'source_id' => $this->integer(11),
            'dest_id' => $this->integer(11)->notNull(),
            'module' => $this->string(50)->notNull(),
            'type' => $this->string(50)->notNull(),
            'description' => $this->text()->notNull(),
            'date' => $this->datetime()->notNull(),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
        ], $tableOptions);
        $this->createTable('{{%page}}', [
            'id' => $this->integer(11)->notNull(),
            'title' => $this->string(255),
            'css' => $this->text(),
            'html' => $this->text(),
            'js' => $this->text(),
            'uid' => $this->integer(11),
            'meta' => $this->text(),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'PRIMARY KEY ([[id]])',
        ], $tableOptions);
        $this->createTable('{{%menus}}', [
            'id' => $this->integer(11)->notNull(),
            'title' => $this->string(255)->notNull(),
            'link' => $this->string(255),
            'pageID' => $this->integer(11),
            'parent' => $this->integer(11),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'PRIMARY KEY ([[id]])',
            'FOREIGN KEY ([[pageID]]) REFERENCES {{%page}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[parent]]) REFERENCES {{%menus}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

        $this->createTable('{{%notification}}', [
            'id' => $this->primaryKey(),
            'resiverID' => $this->integer(11)->notNull(),
            'module' => $this->string(50)->notNull(),
            'type' => $this->string(50)->notNull(),
            'description' => $this->text(),
            'visited' => $this->integer(11)->defaultValue(0),
            'time' => $this->datetime()->notNull(),
            'uid' => $this->integer(11),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'FOREIGN KEY ([[uid]]) REFERENCES {{%users}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%send_method}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'price' => $this->decimal(10, 2),
            'status' => $this->integer(11),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
        ], $tableOptions);
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'uid' => $this->integer(255)->notNull(),
            'date' => $this->datetime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'address' => $this->string(255),
            'telephone' => $this->string(255),
            'mobile' => $this->string(255),
            'description' => $this->string(255),
            'send_method' => $this->integer(11),
            'status' => $this->integer(11)->notNull(),
            'tax' => $this->decimal(10, 2),
            'discount' => $this->decimal(10, 2),
            'price' => $this->decimal(10, 2)->notNull(),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'FOREIGN KEY ([[send_method]]) REFERENCES {{%send_method}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%order_details}}', [
            'id' => $this->primaryKey(),
            'price' => $this->decimal(10, 2)->notNull(),
            'total_price' => $this->decimal(10, 2),
            'total' => $this->string(255)->notNull(),
            'dimensions' => $this->string(255),
            'name' => $this->string(255),
            'file' => $this->string(255),
            'type_name' => $this->string(255),
            'order_id' => $this->integer(11),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'FOREIGN KEY ([[order_id]]) REFERENCES {{%order}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%order_status_log}}', [
            'id' => $this->primaryKey(),
            'status' => $this->integer(11),
            'date' => $this->datetime(),
            'description' => $this->string(255),
            'uid' => $this->integer(11),
            'order_id' => $this->integer(11),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'FOREIGN KEY ([[order_id]]) REFERENCES {{%order}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[uid]]) REFERENCES {{%users}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'description' => $this->text(),
            'specification' => $this->text(),
            'technical_specification' => $this->text(),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'status' => $this->integer()->notNull(),
            'hash_id'=>$this->string(30)->unique(),
        ], $tableOptions);
        $this->createTable('{{%product_gallery}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11),
            'url' => $this->string(255),
            'img_name' => $this->string(255),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'FOREIGN KEY ([[product_id]]) REFERENCES {{%product}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%product_step_property}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(255),
            'title' => $this->string(255),
            'price' => $this->decimal(10, 2),
            'mintotal' => $this->integer(11),
            'requre' => $this->smallInteger(4),
            'product_id' => $this->integer(11),
            'value' => $this->string(255),
            'UUID' => $this->string(32),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'FOREIGN KEY ([[product_id]]) REFERENCES {{%product}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%product_property_step}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'product_property' => $this->integer(11),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'FOREIGN KEY ([[product_property]]) REFERENCES {{%product_step_property}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%role}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'description' => $this->text()->notNull(),
            'RegisterTime' => $this->datetime()->notNull(),
            'status' => $this->integer(11)->notNull(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
        ], $tableOptions);
        $this->createTable('{{%role_options}}', [
            'id' => $this->integer(11)->notNull(),
            'name' => $this->string(75)->notNull(),
            'description' => $this->text()->notNull(),
            'status' => $this->integer(11)->notNull(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
        ], $tableOptions);
        $this->createTable('{{%settings}}', [
            'setting_id' => $this->primaryKey(),
            'setting_key' => $this->string(255)->notNull(),
            'setting_value' => $this->text()->notNull(),
            'setting_description' => $this->text(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
        ], $tableOptions);
        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),
            'picture' => $this->string(100)->notNull(),
            'position' => $this->integer(11)->notNull(),
            'FID' => $this->integer(11),
            'url' => $this->string(255),
            'description' => $this->text(),
            'UUID' => $this->string(32),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
        ], $tableOptions);
        $this->createTable('{{%ticket_head}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'department' => $this->string(255),
            'topic' => $this->string(255),
            'status' => $this->integer(1)->defaultValue('0'),
            'date_update' => $this->timestamp(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'FOREIGN KEY ([[user_id]]) REFERENCES {{%users}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%ticket_body}}', [
            'id' => $this->primaryKey(),
            'id_head' => $this->integer(11)->notNull(),
            'name_user' => $this->string(255),
            'text' => $this->text(),
            'client' => $this->integer(1)->defaultValue(0),
            'date' => $this->timestamp(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'FOREIGN KEY ([[id_head]]) REFERENCES {{%ticket_head}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%ticket_file}}', [
            'id' => $this->integer(11)->notNull(),
            'id_body' => $this->integer(11)->notNull(),
            'fileName' => $this->string(255)->notNull(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'PRIMARY KEY ([[id]])',
            'FOREIGN KEY ([[id_body]]) REFERENCES {{%ticket_body}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(),
            'uid' => $this->integer(11),
            'date' => $this->datetime(),
            'price' => $this->decimal(10, 0),
            'description' => $this->string(255),
            'invoice' => $this->integer(11),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'FOREIGN KEY ([[uid]]) REFERENCES {{%users}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        $this->createTable('{{%user_info}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'family' => $this->string(255),
            'workname' => $this->string(255),
            'state' => $this->string(255),
            'city' => $this->string(255),
            'tel1' => $this->string(255),
            'tel2' => $this->string(255),
            'tel3' => $this->string(255),
            'mob1' => $this->string(255),
            'mob2' => $this->string(255),
            'birthday' => $this->date(),
            'website' => $this->string(255),
            'nationCode' => $this->string(10),
            'postalcode' => $this->string(10),
            'jobcategory' => $this->string(255),
            'address' => $this->string(255),
            'file' => $this->string(255),
            'lat' => $this->string(255),
            'lng' => $this->string(255),
            'charge' => $this->decimal(10, 0),
            'uid' => $this->integer(11),
            'UUID' => $this->string(32),
            'lock' => $this->bigInteger(20),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'created_by' => $this->bigInteger(20),
            'updated_by' => $this->bigInteger(20),
            'deleted_by' => $this->bigInteger(20),
            'restored_by' => $this->bigInteger(20),
            'gender' => $this->integer(11),
            'vocation' => $this->string(255),
            'FOREIGN KEY ([[uid]]) REFERENCES {{%users}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

        $this->addColumn('{{%product_gallery}}','hash_id','varchar(32)');
        $this->addColumn('{{%ticket_head}}','hash_id','varchar(32)');

        $user=User::find()->one();
        if (empty($user)){
            $user=new User();
            $user->id=1;
            $user->username='00000000000';
            $user->setPassword('22250603652000');
            $user->generateAuthKey();
            $user->fullname= Yii::t('common', 'Admin User Fullname');
            $user->email=Yii::$app->systemCore->AdminEmail;
            $user->status=User::STATUS_ACTIVE;
            $user->hash_id=hash('adler32',1);

            $user->validate();
            $user->save();
            $info=new UserInfo();
            $info->name='مدیر';
            $info->family='سایت';
            $info->uid=1;

            $info->save();
            // the following three lines were added:


        }



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
