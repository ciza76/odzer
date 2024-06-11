<?php

namespace Thunder;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Comments class
 */
class Comments extends Migration
{
	
	public function up()
	{

		/** create a table **/
		$this->addColumn('id int(11) NOT NULL AUTO_INCREMENT');
		$this->addColumn('post_id int(11) default 0 NOT NULL');
		$this->addColumn('user_id int(11) default 0 NOT NULL');
		$this->addColumn('comment varchar(1024) NULL');
		$this->addColumn('date_created datetime NULL');
		$this->addColumn('date_updated datetime NULL');
		$this->addPrimaryKey('id');
		$this->addKey('post_id');
		$this->addKey('user_id');
		/*
		$this->addUniqueKey();
		*/
		$this->createTable('comments');
 
	} 

	public function down()
	{
		$this->dropTable('comments');
	}

}