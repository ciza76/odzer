<?php

namespace Thunder;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Likes class
 */
class Likes extends Migration
{
	
	public function up()
	{

		/** create a table **/
		$this->addColumn('id int(11) NOT NULL AUTO_INCREMENT');
		$this->addColumn('user_id int(11) default 0 NULL');
		$this->addColumn('post_id int(11) default 0 NULL');
		$this->addColumn('disabled tinyint(1) default 0 NULL');
		$this->addPrimaryKey('id');
		$this->addKey('user_id');
		$this->addKey('post_id');
		$this->addKey('disabled');
		/*
		$this->addUniqueKey();
		*/
		$this->createTable('likes');
 
	} 

	public function down()
	{
		$this->dropTable('likes');
	}

}