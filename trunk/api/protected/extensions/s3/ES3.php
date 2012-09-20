<?php

/**
 * ES3 class file.
 *
 * ES3 is a wrapper for the excellent S3.php class provided by Donovan Sch�nknecht (@link http://undesigned.org.za/2007/10/22/amazon-s3-php-class)
 * This wrapper contains minimal functionality as there is only so much I want to allow access to from the Yii public end
 *
 * @version 0.1
 *
 * @uses CFile
 * @author Dana Luther (dana.luther@gmail.com)
 * @copyright Copyright &copy; 2010 Dana Luther
 */
 class ES3 extends CApplicationComponent
{

	private $_s3;
	public $aKey; // AWS Access key
	public $sKey; // AWS Secret key	
	public $bucket;
	public $lastError="";

	private function getInstance(){
		if ($this->_s3 === NULL)
			$this->connect();
		return $this->_s3;
	}

	/**
	 * Instance the S3 object
	 */
	public function connect()
	{
		if ( $this->aKey === NULL || $this->sKey === NULL )
			throw new CException('S3 Keys are not set.');
			
		$this->_s3 = new S3($this->aKey,$this->sKey);
	}
	
	/**
	 * @param string $original File to upload - can be any valid CFile filename
	 * @param string $uploaded Name of the file on destination -- can include directory separators
	 */
	public function upload( $original, $uploaded="", $bucket="" )
	{
		
		
		$s3 = $this->getInstance();
		
		if( $bucket == "" )
		{
			$bucket = $this->bucket;
		}
		
		if ($bucket === NULL || trim($bucket) == "")
		{
			throw new CException('Bucket param cannot be empty');
		}
		
		$file = Yii::app()->file->set($original);
	
		if(!$file->exists)
			throw new CException('Origin file not found');
		
		$fs1 = $file->size;
		
		if ( !$fs1 )
		{
			$this->lastError = "Attempted to upload empty file.";
			return false;
		}
	
		if (trim($uploaded) == ""){
			$uploaded = $original;
		}
		
		//if (!$s3->putObject($s3->inputResource(fopen($file->getRealPath(), 'r'), $fs1), $bucket, $uploaded, S3::ACL_PUBLIC_READ))
		echo $file->getRealPath();
		//if (!$s3->putObject($s3->inputResource( fopen($file->getRealPath(), 'rb'), $fs1), $bucket, $uploaded, S3::ACL_PUBLIC_READ))
		if (!$s3->putObjectFile( $original, $bucket, $uploaded, S3::ACL_PUBLIC_READ))
		{
			$this->lastError = "Unable to upload file.";
			return false;
		}
		return true;
	}
	
	// Testing connection :p
	public function buckets()
	{
		$s3 = $this->getInstance();
		return $this->_s3->listBuckets();
	}
	
	// Passthru function for basic functions
	public function call( $func )
	{
		$s3 = $this->getInstance();
		return $s3->$func();
	}

}
?>

object(Model_User)#34 (34) {
  ["_table_name":protected]=>
  string(5) "users"
  ["_created_column":protected]=>
  array(2) {
    ["column"]=>
    string(11) "create_date"
    ["format"]=>
    string(11) "Y-m-d H:i:s"
  }
  ["_updated_column":protected]=>
  array(2) {
    ["column"]=>
    string(11) "update_date"
    ["format"]=>
    string(11) "Y-m-d H:i:s"
  }
  ["_belongs_to":protected]=>
  array(1) {
    ["person"]=>
    array(2) {
      ["model"]=>
      string(6) "person"
      ["foreign_key"]=>
      string(9) "person_id"
    }
  }
  ["_has_one":protected]=>
  array(1) {
    ["person"]=>
    array(2) {
      ["model"]=>
      string(6) "person"
      ["foreign_key"]=>
      string(7) "user_id"
    }
  }
  ["_has_many":protected]=>
  array(10) {
    ["devices"]=>
    array(4) {
      ["model"]=>
      string(6) "device"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      NULL
      ["far_key"]=>
      string(9) "device_id"
    }
    ["contacts"]=>
    array(4) {
      ["model"]=>
      string(7) "contact"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      NULL
      ["far_key"]=>
      string(10) "contact_id"
    }
    ["groups"]=>
    array(4) {
      ["model"]=>
      string(5) "group"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      NULL
      ["far_key"]=>
      string(8) "group_id"
    }
    ["memberships"]=>
    array(4) {
      ["model"]=>
      string(5) "group"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      string(13) "group_members"
      ["far_key"]=>
      string(8) "group_id"
    }
    ["messages"]=>
    array(4) {
      ["model"]=>
      string(7) "message"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      NULL
      ["far_key"]=>
      string(10) "message_id"
    }
    ["received_messages"]=>
    array(4) {
      ["model"]=>
      string(7) "message"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      string(18) "message_recipients"
      ["far_key"]=>
      string(10) "message_id"
    }
    ["favorites"]=>
    array(4) {
      ["model"]=>
      string(7) "message"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      string(17) "message_favorites"
      ["far_key"]=>
      string(10) "message_id"
    }
    ["iosreceipts"]=>
    array(4) {
      ["model"]=>
      string(10) "iosreceipt"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      NULL
      ["far_key"]=>
      string(13) "iosreceipt_id"
    }
    ["preferences"]=>
    array(4) {
      ["model"]=>
      string(15) "user_preference"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      NULL
      ["far_key"]=>
      string(13) "preference_id"
    }
    ["products"]=>
    array(4) {
      ["model"]=>
      string(7) "product"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      string(14) "products_users"
      ["far_key"]=>
      string(10) "product_id"
    }
  }
  ["_load_with":protected]=>
  array(0) {
  }
  ["_validation":protected]=>
  NULL
  ["_object":protected]=>
  array(9) {
    ["id"]=>
    string(3) "214"
    ["person_id"]=>
    string(5) "37807"
    ["username"]=>
    string(8) "sandwyrm"
    ["passwd"]=>
    string(15) "7895123immerman"
    ["facebook_access_token"]=>
    string(144) "BAAB27AxG43UBAPDQH8JMZBSu4oPbz4Jn9fj8Ls3ZAVcF8sq0ZCLvMvYjsTpjAdBvjos53wFecInCO5TmOnA6NZAhAZB9E9rM2PdPpHX4oUgr7cDWpCTP0qq79ElNyk9fzJMwYVeHahwZDZD"
    ["twitter_auth_token"]=>
    string(0) ""
    ["create_date"]=>
    string(19) "2012-04-16 10:36:45"
    ["update_date"]=>
    string(19) "2012-06-04 02:01:36"
    ["delete_date"]=>
    NULL
  }
  ["_changed":protected]=>
  array(0) {
  }
  ["_original_values":protected]=>
  array(9) {
    ["id"]=>
    string(3) "214"
    ["person_id"]=>
    string(5) "37807"
    ["username"]=>
    string(8) "sandwyrm"
    ["passwd"]=>
    string(15) "7895123immerman"
    ["facebook_access_token"]=>
    string(144) "BAAB27AxG43UBAPDQH8JMZBSu4oPbz4Jn9fj8Ls3ZAVcF8sq0ZCLvMvYjsTpjAdBvjos53wFecInCO5TmOnA6NZAhAZB9E9rM2PdPpHX4oUgr7cDWpCTP0qq79ElNyk9fzJMwYVeHahwZDZD"
    ["twitter_auth_token"]=>
    string(0) ""
    ["create_date"]=>
    string(19) "2012-04-16 10:36:45"
    ["update_date"]=>
    string(19) "2012-06-04 02:01:36"
    ["delete_date"]=>
    NULL
  }
  ["_related":protected]=>
  array(0) {
  }
  ["_valid":protected]=>
  bool(true)
  ["_loaded":protected]=>
  bool(true)
  ["_saved":protected]=>
  bool(false)
  ["_sorting":protected]=>
  NULL
  ["_foreign_key_suffix":protected]=>
  string(3) "_id"
  ["_object_name":protected]=>
  string(4) "user"
  ["_object_plural":protected]=>
  string(5) "users"
  ["_table_columns":protected]=>
  array(9) {
    ["id"]=>
    array(13) {
      ["type"]=>
      string(3) "int"
      ["min"]=>
      string(1) "0"
      ["max"]=>
      string(10) "4294967295"
      ["column_name"]=>
      string(2) "id"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(12) "int unsigned"
      ["is_nullable"]=>
      bool(false)
      ["ordinal_position"]=>
      int(1)
      ["display"]=>
      string(2) "10"
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(14) "auto_increment"
      ["key"]=>
      string(3) "PRI"
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["person_id"]=>
    array(13) {
      ["type"]=>
      string(3) "int"
      ["min"]=>
      string(1) "0"
      ["max"]=>
      string(10) "4294967295"
      ["column_name"]=>
      string(9) "person_id"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(12) "int unsigned"
      ["is_nullable"]=>
      bool(false)
      ["ordinal_position"]=>
      int(2)
      ["display"]=>
      string(2) "10"
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(3) "MUL"
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["username"]=>
    array(12) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(8) "username"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(7) "varchar"
      ["is_nullable"]=>
      bool(false)
      ["ordinal_position"]=>
      int(3)
      ["character_maximum_length"]=>
      string(3) "255"
      ["collation_name"]=>
      string(15) "utf8_general_ci"
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["passwd"]=>
    array(12) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(6) "passwd"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(7) "varchar"
      ["is_nullable"]=>
      bool(false)
      ["ordinal_position"]=>
      int(4)
      ["character_maximum_length"]=>
      string(3) "255"
      ["collation_name"]=>
      string(15) "utf8_general_ci"
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["facebook_access_token"]=>
    array(12) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(21) "facebook_access_token"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(7) "varchar"
      ["is_nullable"]=>
      bool(true)
      ["ordinal_position"]=>
      int(5)
      ["character_maximum_length"]=>
      string(3) "255"
      ["collation_name"]=>
      string(15) "utf8_general_ci"
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["twitter_auth_token"]=>
    array(12) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(18) "twitter_auth_token"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(7) "varchar"
      ["is_nullable"]=>
      bool(true)
      ["ordinal_position"]=>
      int(6)
      ["character_maximum_length"]=>
      string(3) "255"
      ["collation_name"]=>
      string(15) "utf8_general_ci"
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["create_date"]=>
    array(10) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(11) "create_date"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(8) "datetime"
      ["is_nullable"]=>
      bool(false)
      ["ordinal_position"]=>
      int(7)
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["update_date"]=>
    array(10) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(11) "update_date"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(8) "datetime"
      ["is_nullable"]=>
      bool(false)
      ["ordinal_position"]=>
      int(8)
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["delete_date"]=>
    array(10) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(11) "delete_date"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(8) "datetime"
      ["is_nullable"]=>
      bool(true)
      ["ordinal_position"]=>
      int(9)
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
  }
  ["_serialize_columns":protected]=>
  array(0) {
  }
  ["_primary_key":protected]=>
  string(2) "id"
  ["_primary_key_value":protected]=>
  string(3) "214"
  ["_table_names_plural":protected]=>
  bool(true)
  ["_reload_on_wakeup":protected]=>
  bool(true)
  ["_db":protected]=>
  object(Database_MySQL)#29 (6) {
    ["_connection_id":protected]=>
    string(40) "e98693e293defee7604421beb1e2aed03a0fa182"
    ["_identifier":protected]=>
    string(1) "`"
    ["last_query"]=>
    string(140) "SELECT `user`.* FROM `users` AS `user` JOIN `people` ON (`user`.`person_id` = `people`.`id`) WHERE `facebook_id` = '100000055262216' LIMIT 1"
    ["_instance":protected]=>
    string(7) "default"
    ["_connection":protected]=>
    resource(92) of type (mysql link)
    ["_config":protected]=>
    array(6) {
      ["type"]=>
      string(5) "mysql"
      ["connection"]=>
      array(3) {
        ["hostname"]=>
        string(9) "localhost"
        ["database"]=>
        string(16) "tongue_tango_dev"
        ["persistent"]=>
        bool(false)
      }
      ["table_prefix"]=>
      string(0) ""
      ["charset"]=>
      string(4) "utf8"
      ["caching"]=>
      bool(false)
      ["profiling"]=>
      bool(true)
    }
  }
  ["_db_group":protected]=>
  NULL
  ["_db_applied":protected]=>
  array(0) {
  }
  ["_db_pending":protected]=>
  array(0) {
  }
  ["_db_reset":protected]=>
  bool(true)
  ["_db_builder":protected]=>
  NULL
  ["_with_applied":protected]=>
  array(0) {
  }
  ["_cast_data":protected]=>
  array(0) {
  }
  ["_errors_filename":protected]=>
  string(4) "user"
}












///////////////////////////////////////////////////////////
object(Model_User)#30 (34) {
  ["_table_name":protected]=>
  string(5) "users"
  ["_created_column":protected]=>
  array(2) {
    ["column"]=>
    string(11) "create_date"
    ["format"]=>
    string(11) "Y-m-d H:i:s"
  }
  ["_updated_column":protected]=>
  array(2) {
    ["column"]=>
    string(11) "update_date"
    ["format"]=>
    string(11) "Y-m-d H:i:s"
  }
  ["_belongs_to":protected]=>
  array(1) {
    ["person"]=>
    array(2) {
      ["model"]=>
      string(6) "person"
      ["foreign_key"]=>
      string(9) "person_id"
    }
  }
  ["_has_one":protected]=>
  array(1) {
    ["person"]=>
    array(2) {
      ["model"]=>
      string(6) "person"
      ["foreign_key"]=>
      string(7) "user_id"
    }
  }
  ["_has_many":protected]=>
  array(10) {
    ["devices"]=>
    array(4) {
      ["model"]=>
      string(6) "device"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      NULL
      ["far_key"]=>
      string(9) "device_id"
    }
    ["contacts"]=>
    array(4) {
      ["model"]=>
      string(7) "contact"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      NULL
      ["far_key"]=>
      string(10) "contact_id"
    }
    ["groups"]=>
    array(4) {
      ["model"]=>
      string(5) "group"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      NULL
      ["far_key"]=>
      string(8) "group_id"
    }
    ["memberships"]=>
    array(4) {
      ["model"]=>
      string(5) "group"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      string(13) "group_members"
      ["far_key"]=>
      string(8) "group_id"
    }
    ["messages"]=>
    array(4) {
      ["model"]=>
      string(7) "message"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      NULL
      ["far_key"]=>
      string(10) "message_id"
    }
    ["received_messages"]=>
    array(4) {
      ["model"]=>
      string(7) "message"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      string(18) "message_recipients"
      ["far_key"]=>
      string(10) "message_id"
    }
    ["favorites"]=>
    array(4) {
      ["model"]=>
      string(7) "message"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      string(17) "message_favorites"
      ["far_key"]=>
      string(10) "message_id"
    }
    ["iosreceipts"]=>
    array(4) {
      ["model"]=>
      string(10) "iosreceipt"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      NULL
      ["far_key"]=>
      string(13) "iosreceipt_id"
    }
    ["preferences"]=>
    array(4) {
      ["model"]=>
      string(15) "user_preference"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      NULL
      ["far_key"]=>
      string(13) "preference_id"
    }
    ["products"]=>
    array(4) {
      ["model"]=>
      string(7) "product"
      ["foreign_key"]=>
      string(7) "user_id"
      ["through"]=>
      string(14) "products_users"
      ["far_key"]=>
      string(10) "product_id"
    }
  }
  ["_load_with":protected]=>
  array(0) {
  }
  ["_validation":protected]=>
  NULL
  ["_object":protected]=>
  array(9) {
    ["id"]=>
    string(3) "214"
    ["person_id"]=>
    string(5) "37807"
    ["username"]=>
    string(8) "sandwyrm"
    ["passwd"]=>
    string(15) "7895123immerman"
    ["facebook_access_token"]=>
    string(144) "BAAB27AxG43UBAPDQH8JMZBSu4oPbz4Jn9fj8Ls3ZAVcF8sq0ZCLvMvYjsTpjAdBvjos53wFecInCO5TmOnA6NZAhAZB9E9rM2PdPpHX4oUgr7cDWpCTP0qq79ElNyk9fzJMwYVeHahwZDZD"
    ["twitter_auth_token"]=>
    string(0) ""
    ["create_date"]=>
    string(19) "2012-04-16 10:36:45"
    ["update_date"]=>
    string(19) "2012-06-04 02:01:36"
    ["delete_date"]=>
    NULL
  }
  ["_changed":protected]=>
  array(0) {
  }
  ["_original_values":protected]=>
  array(9) {
    ["id"]=>
    string(3) "214"
    ["person_id"]=>
    string(5) "37807"
    ["username"]=>
    string(8) "sandwyrm"
    ["passwd"]=>
    string(15) "7895123immerman"
    ["facebook_access_token"]=>
    string(144) "BAAB27AxG43UBAPDQH8JMZBSu4oPbz4Jn9fj8Ls3ZAVcF8sq0ZCLvMvYjsTpjAdBvjos53wFecInCO5TmOnA6NZAhAZB9E9rM2PdPpHX4oUgr7cDWpCTP0qq79ElNyk9fzJMwYVeHahwZDZD"
    ["twitter_auth_token"]=>
    string(0) ""
    ["create_date"]=>
    string(19) "2012-04-16 10:36:45"
    ["update_date"]=>
    string(19) "2012-06-04 02:01:36"
    ["delete_date"]=>
    NULL
  }
  ["_related":protected]=>
  array(0) {
  }
  ["_valid":protected]=>
  bool(true)
  ["_loaded":protected]=>
  bool(true)
  ["_saved":protected]=>
  bool(false)
  ["_sorting":protected]=>
  NULL
  ["_foreign_key_suffix":protected]=>
  string(3) "_id"
  ["_object_name":protected]=>
  string(4) "user"
  ["_object_plural":protected]=>
  string(5) "users"
  ["_table_columns":protected]=>
  array(9) {
    ["id"]=>
    array(13) {
      ["type"]=>
      string(3) "int"
      ["min"]=>
      string(1) "0"
      ["max"]=>
      string(10) "4294967295"
      ["column_name"]=>
      string(2) "id"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(12) "int unsigned"
      ["is_nullable"]=>
      bool(false)
      ["ordinal_position"]=>
      int(1)
      ["display"]=>
      string(2) "10"
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(14) "auto_increment"
      ["key"]=>
      string(3) "PRI"
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["person_id"]=>
    array(13) {
      ["type"]=>
      string(3) "int"
      ["min"]=>
      string(1) "0"
      ["max"]=>
      string(10) "4294967295"
      ["column_name"]=>
      string(9) "person_id"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(12) "int unsigned"
      ["is_nullable"]=>
      bool(false)
      ["ordinal_position"]=>
      int(2)
      ["display"]=>
      string(2) "10"
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(3) "MUL"
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["username"]=>
    array(12) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(8) "username"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(7) "varchar"
      ["is_nullable"]=>
      bool(false)
      ["ordinal_position"]=>
      int(3)
      ["character_maximum_length"]=>
      string(3) "255"
      ["collation_name"]=>
      string(15) "utf8_general_ci"
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["passwd"]=>
    array(12) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(6) "passwd"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(7) "varchar"
      ["is_nullable"]=>
      bool(false)
      ["ordinal_position"]=>
      int(4)
      ["character_maximum_length"]=>
      string(3) "255"
      ["collation_name"]=>
      string(15) "utf8_general_ci"
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["facebook_access_token"]=>
    array(12) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(21) "facebook_access_token"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(7) "varchar"
      ["is_nullable"]=>
      bool(true)
      ["ordinal_position"]=>
      int(5)
      ["character_maximum_length"]=>
      string(3) "255"
      ["collation_name"]=>
      string(15) "utf8_general_ci"
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["twitter_auth_token"]=>
    array(12) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(18) "twitter_auth_token"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(7) "varchar"
      ["is_nullable"]=>
      bool(true)
      ["ordinal_position"]=>
      int(6)
      ["character_maximum_length"]=>
      string(3) "255"
      ["collation_name"]=>
      string(15) "utf8_general_ci"
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["create_date"]=>
    array(10) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(11) "create_date"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(8) "datetime"
      ["is_nullable"]=>
      bool(false)
      ["ordinal_position"]=>
      int(7)
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["update_date"]=>
    array(10) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(11) "update_date"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(8) "datetime"
      ["is_nullable"]=>
      bool(false)
      ["ordinal_position"]=>
      int(8)
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
    ["delete_date"]=>
    array(10) {
      ["type"]=>
      string(6) "string"
      ["column_name"]=>
      string(11) "delete_date"
      ["column_default"]=>
      NULL
      ["data_type"]=>
      string(8) "datetime"
      ["is_nullable"]=>
      bool(true)
      ["ordinal_position"]=>
      int(9)
      ["comment"]=>
      string(0) ""
      ["extra"]=>
      string(0) ""
      ["key"]=>
      string(0) ""
      ["privileges"]=>
      string(31) "select,insert,update,references"
    }
  }
  ["_serialize_columns":protected]=>
  array(0) {
  }
  ["_primary_key":protected]=>
  string(2) "id"
  ["_primary_key_value":protected]=>
  string(3) "214"
  ["_table_names_plural":protected]=>
  bool(true)
  ["_reload_on_wakeup":protected]=>
  bool(true)
  ["_db":protected]=>
  object(Database_MySQL)#29 (6) {
    ["_connection_id":protected]=>
    string(40) "e98693e293defee7604421beb1e2aed03a0fa182"
    ["_identifier":protected]=>
    string(1) "`"
    ["last_query"]=>
    string(72) "SELECT `user`.* FROM `users` AS `user` WHERE `user`.`id` = '214' LIMIT 1"
    ["_instance":protected]=>
    string(7) "default"
    ["_connection":protected]=>
    resource(92) of type (mysql link)
    ["_config":protected]=>
    array(6) {
      ["type"]=>
      string(5) "mysql"
      ["connection"]=>
      array(3) {
        ["hostname"]=>
        string(9) "localhost"
        ["database"]=>
        string(16) "tongue_tango_dev"
        ["persistent"]=>
        bool(false)
      }
      ["table_prefix"]=>
      string(0) ""
      ["charset"]=>
      string(4) "utf8"
      ["caching"]=>
      bool(false)
      ["profiling"]=>
      bool(true)
    }
  }
  ["_db_group":protected]=>
  NULL
  ["_db_applied":protected]=>
  array(0) {
  }
  ["_db_pending":protected]=>
  array(0) {
  }
  ["_db_reset":protected]=>
  bool(true)
  ["_db_builder":protected]=>
  NULL
  ["_with_applied":protected]=>
  array(0) {
  }
  ["_cast_data":protected]=>
  array(0) {
  }
  ["_errors_filename":protected]=>
  string(4) "user"
}
