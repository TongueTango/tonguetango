<?php
require_once("api_lib.php");

?>
<a href='old_help.php'> Click here for the old help file </a>
Example token: e149508f7b71872a27e7f0b6b95e17761c081eb046fcd6479215424c69915ff1 - Brian Pollack logged in 24 Sept <br />

<?php

StartHelp("Login", "user/login", "POST");
StartParams();

Parameter("facebook_access_token", "If this is sent and not empty it should be an existing facebook token", "", 0);
Parameter("twitter_auth_token", "If this is sent and not empty it should be an existing twitter token", "", 0);
Parameter("model", "The name of the device", "iPhone Simulator", 0);

Parameter("username", "The username to authenticate", "brianpollack", 1);
Parameter("passwd", "The password for login", "xxxx", 1);

Parameter("device_type", "The type of login device", "iOS", 1);
Parameter("version", "The OS Version", "5.1", 1);

Parameter("unique_id", "The unique id for this device", "4EA8B03F-F243-43DC-A6AB-0B0D2E72A075", 1);
EndParams();
EndHelp();

StartHelp("Get the pending messages", "message/conversations");
StartParams();
Parameter("id", "Can be 'facebook', 'twitter', or ''", "", 0);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
Parameter("unique_id", "The unique id for this device", "4EA8B03F-F243-43DC-A6AB-0B0D2E72A075", 1);
EndParams();
EndHelp();

StartHelp("Update Messages", "message/update/group/4545");
StartParams();
Parameter("type", "Can be 'group', 'message', or ''", "", 0);
Parameter("id", "Can be 'group' id or 'message' id ''", "", 0);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Delete Message", "message/delete/4545", "GET");
StartParams();
Parameter("id", 'message id' , "", 0);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Send a new text message", "message/create", "POST");
StartParams();
Parameter("message_type_id", "Type of message (Text message must be 1)", "1", 1);
Parameter("message_header",	 "Header of message", "EXAMPLE HEADER", 1);
Parameter("message_body", "Text of message", "This is the message text", 1);
Parameter("reciptients", "An array of recipients JSON Format Array", 
	json_encode(array( array("user_id" => 1316)) ), 1);
Parameter("-", "Audio file (MP4) - What format, Mime64?", "", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
Parameter("unique_id", "The unique id for this device", "4EA8B03F-F243-43DC-A6AB-0B0D2E72A075", 1);
EndParams();
EndHelp();

StartHelp("Send a new audio message", "message/create", "POST");
StartParams();
Parameter("message_type_id", "Type of message (Text message must be 2)", "2", 1);
Parameter("message_header",	 "Header of message", "EXAMPLE HEADER", 1);
Parameter("message_body", "Text of message", "This is the message text", 1);
Parameter("reciptients", "An array of recipients JSON Format Array", 
	json_encode(array( array("user_id" => 1316)) ), 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
Parameter("unique_id", "The unique id for this device", "4EA8B03F-F243-43DC-A6AB-0B0D2E72A075", 1);
EndParams(true); // true - set fileupload function for Execute button
EndHelp();

StartHelp("Reload Friend Messages", "message/user");
StartParams();
Parameter("user_id", "user primary key id", "1316", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Accept Invitation", "contact/create", "POST");
StartParams();
Parameter("person_id", "user primary key id", "1316", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("List friends", "contact/");
StartParams();
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Request Contacts", "contact/search", "POST");
StartParams();
Parameter(
	"contacts", "Contains array of contacts", 
	json_encode( array(
			array(
				"unique_id" => 1,
				"emails" => array( "ash@vprex.com" ),
				"phones" => array(),
			),
			array(
				"unique_id" => 2,
				"emails" => array( "ashwin@complitech.net" ),
				"phones" => array(),
			)
	)),
	1
);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
Parameter("auto_pair", "If set to 1, the friends will be paired", 1, 1);
EndParams();
EndHelp();

StartHelp("Add Friend", "contact/create", "POST");
StartParams();
Parameter("person_id", "", "331222", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Create group", "group/", "POST");
StartParams();
Parameter("name", "New group name", "Discovery", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Update group", "group/update", "PUT");
StartParams();
Parameter("id", "group primary key id", "290", 1);
Parameter("name", "group new name", "Discovery", 1);
Parameter("members", "(comma separated list of user ids)", json_encode(array("members" => "1313")), 0);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Delete group", "group/delete", "DELETE");
StartParams();
Parameter("id", "group primary key id", "290", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("List groups", "group/");
StartParams();
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();


StartHelp("Block group", "group/block");
StartParams();
Parameter("id", "group primary key id", "85", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Unblock group", "group/unblock");
StartParams();
Parameter("id", "group primary key id", "85", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();


StartHelp("Change Password", "user/update", "POST");
StartParams();
Parameter("passwd", "new password", "N3wP@ssW0rD", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Facebook Sync", "user/fbSync", "POST");
StartParams();
Parameter("facebook_access_token", "facebook access token", "BAAB27AxG43UBABeZBZA3VhYPYTzisUnRvgO5LPvnXTXmogcORSGhtCZCdTSy4jWu6dLfPUBT7JmIwb1VRNgyLPPSd1IKSwDGJ4E5f2y0wEdSQPbciaUNIqRZCqZBMoCIZD", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Update user", "user/update", "PUT");
StartParams();
Parameter("*", "ALL USER FIELDS", json_encode(array("email_address" => 'luke.skywalker@google.com', "first_name" => 'Luke', "last_name" => 'Skywalker')), 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Registration", "user/registration", "POST");
StartParams();
Parameter("*", "ALL USER FRIENDS", json_encode(
		array(
			"username" => 'LuSky',
			"passwd" => '123123',
			"first_name" => 'Luke',
			"last_name" => 'Skywalker',
			"email_type" => 'home',
			"email_address" => 'luke.skywalker@google.com',
			"device_type" => 'iOS',
			"model" => 'iPhone Simulator',
			"version" => '5.1',
			"push_token" => '',
			"unique_id" => '4EA8B03F-F243-43DC-A6AB-0B0D2E72A075',
			"gender" => '',
			"phone" => '',
			"facebook_access_token" => '',
			"facebook_id" => '',
			"twitter_auth_token" => '',
		)
	), 1);
EndParams();
EndHelp();

StartHelp("Update user photo", "user/update", "POST");
StartParams();
Parameter("-", "Pass image data", "", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Get Products", "product/");
StartParams();
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Get Product", "product/");
StartParams();
Parameter("id", "product primary key id", "2", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Block list", "contact/block");
StartParams();
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Block user", "contact/block");
StartParams();
Parameter("id", "user primary key id", "204", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Unblock user", "contact/unblock");
StartParams();
Parameter("id", "user primary key id", "204", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Delete friend", "contact/delete");
StartParams();
Parameter("id", "user primary key id", "204", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Undelete friend", "contact/undelete");
StartParams();
Parameter("id", "user primary key id", "204", 1);
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Deleted friend list", "contact/delete");
StartParams();
Parameter("token", "The token for the current login session", "EXAMPLE_TOKEN", 1);
EndParams();
EndHelp();

StartHelp("Forgot password", "forgot");
StartParams();
Parameter("email", "email address to forgot password", "test@test.com", 1);
EndParams();
EndHelp();

Finished();
?>
</div>
</body>
</html>