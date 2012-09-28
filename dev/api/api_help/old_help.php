<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <title>Tongue Tango - Api</title>

        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed|Ubuntu' rel='stylesheet' type='text/css'>   
            <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>

                <!-- CSS: implied media=all -->
                <link rel="stylesheet" href="css/table.css"> 
                    <link rel="stylesheet" href="css/style.css">
                        <link rel="stylesheet" href="css/v2.css">



                            <!-- end CSS-->

                            <!-- CSS Media Queries for Standard Devices -->
                            <!--[if !IE]><!-->
                            <link rel="stylesheet" href="css/devices/smartphone.css" media="only screen and (min-width : 320px) and (max-width : 767px)">
                                <link rel="stylesheet" href="css/devices/ipad.css" media="only screen and (min-width : 768px) and (max-width : 1024px)"> 
                                    <!--<![endif]-->



                                    </head>

                                    <body>
                                        <div class="left_menu box-element" style="float: left;width: 12%;height:auto;background-color: white;margin: 10px">
                                            <div class="box-head-light">
                                                <h3 style='cursor:pointer;'> Methods  </h3>
                                                 </div>
                                                <ul>
                                                    <li>
                                                           <a href ="#Login_div" >Login </a> 
                                                    </li>
                                                    <li>
                                                          <a href ="#Pending_div">Pending Conversation/Messages </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#send_mess">Send Message </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#send_audio">Send Audio Message </a> 
                                                    </li>
                                                     <li>
                                                           <a href ="#reload">Reload Friend Messages </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#accept">Accept Invitation </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#request">requestContacts </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#add_friend">Add Friend </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#list_friends">List Friends </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#change_password">Change Password </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#create_group">Create Group </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#delete_group">Delete Group </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#update_group">Update Group </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#list_group">List Groups </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#update_user">Update User </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#register">Registration</a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#user_photo">Update user photo </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#get_products">Get products </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#get_product">Get product </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#delete_friend">Delete friend </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#block_user">Block user</a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#unblock_user">Unblock user </a> 
                                                    </li>
                                                    <li>
                                                           <a href ="#block_list">Block list </a> 
                                                    </li>

                                                    <li>
                                                           <a href ="#deleted_list"> Deleted friend list </a> 
                                                    </li>

                                                    <li>
                                                           <a href ="#undelete_friend">Undelete friend </a> 
                                                    </li>

                                                    <li>
                                                           <a href ="#block_group">Block group</a> 
                                                    </li>
                                                </ul>
                                           
                                        </div> 
                                        <div id="body-container" style="padding: 10px;float: left;width: 83%;margin-left: 5px">
                                               
                                            <div id="content" >
                                                <!--- Begin class=box-element --->
                                                <div class="box-element">	    
                                                    <div class="box-head-light"  >
                                                        <h3 style='cursor:pointer;' id="Login_div"> Login  </h3></div>
                                                    <div class="box-content">

                                                        API URL: <br />

                                                        http://apiv2.tonguetango.com/api/login    <br />
                                                        <br />
                                                        Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'> 	    
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>	
<!--                                                                <tr>
                                                                    <td width=140>  id</td>
                                                                    <td> track id of mp3  </td>
                                                                    <td width='80'>  </td>
                                                                </tr>-->
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'> 	    
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>	
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'> 	    
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Description </td></tr>
                                                            </thead>
                                                            <tbody>	
                                                                <tr>
                                                                    <td> No usable account identification available, please pass facebook token or username and password!  </td>         
                                                                </tr>
                                                                <tr>
                                                                    <td> Incorrect username / password combination </td>         
                                                                </tr>
                                                                <tr>
                                                                    <td> Device unique_id is required. </td>         
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                        Example: A valid login request <br/>
                                                        <br />
                                                        <br/>
                                                        request data JSON: <br />
                                                        <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                           {"model":"iPhone Simulator","push_token":"","passwd":"ashwin101","unique_id":"4EA8B03F-F243-43DC-A6AB-0B0D2E72A075","device_type":"iOS","version":"5.1","username":"ashwin101"}
                                                        </div>	
                                                        <br/>
                                                        <br/>
                                                        Output Formatted: <br/>
                                                        <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                            <pre>
                                                            {
                                                                "token": "5510fbc73a7bc77a46615aebb33211b043e1bce318bce6f3c02c5dcce2dbc0c4",
                                                                "user_id": "1266",
                                                                "photo": "http://667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com/1346830164.4674-userimage.png",
                                                                "id": "1266",
                                                                "person_id": "3343492",
                                                                "username": "ashwin",
                                                                "passwd": "sanskaar",
                                                                "facebook_access_token": "BAAB27AxG43UBAMwshE2XYd0tMPDAerbbUb9oily8C56YYeyVVTeLjRFZBOBKy00qf0uZB1nrV7uggHyfuYLfHg7sg9KjrgGgs0bpKXvPrSUjIZAmTMO9mb8FPK7hKEZD",
                                                                "twitter_auth_token": "",
                                                                "create_date": "2012-09-04 04:38:36",
                                                                "update_date": "2012-09-05 04:29:33",
                                                                "delete_date": null,
                                                                "first_name": "Ashwin",
                                                                "middle_name": null,
                                                                "last_name": "Jumani",
                                                                "aliases": null,
                                                                "birth_date": null,
                                                                "gender": "",
                                                                "notes": null,
                                                                "twitter_handle": null,
                                                                "facebook_id": "659921630",
                                                                "fb_friends": [],
                                                                "tt_friends": [
                                                                    {
                                                                        "person_id": 3393975,
                                                                        "facebook_id": null,
                                                                        "first_name": "Ashwin",
                                                                        "last_name": "J",
                                                                        "photo": null,
                                                                        "user_id": 1271,
                                                                        "on_tt": 1,
                                                                        "accepted": 1,
                                                                        "initiator_id": 1271
                                                                    }
                                                                ],
                                                                "pending_friends": [
                                                                    {
                                                                        "person_id": 3324345,
                                                                        "facebook_id": null,
                                                                        "first_name": "VPrex",
                                                                        "last_name": "Stars",
                                                                        "photo": "http://667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com/1346756882.0982-userimage.png",
                                                                        "user_id": 1264,
                                                                        "on_tt": 1,
                                                                        "accepted": 0,
                                                                        "initiator_id": 1266
                                                                    },
                                                                    {
                                                                        "person_id": 3324346,
                                                                        "facebook_id": null,
                                                                        "first_name": "VPrex",
                                                                        "last_name": "Champs",
                                                                        "photo": "http://667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com/1346757207.1954-userimage.png",
                                                                        "user_id": 1265,
                                                                        "on_tt": 1,
                                                                        "accepted": 0,
                                                                        "initiator_id": 1266
                                                                    },
                                                                    {
                                                                        "person_id": 3409676,
                                                                        "facebook_id": null,
                                                                        "first_name": "ashwin2",
                                                                        "last_name": "j",
                                                                        "photo": null,
                                                                        "user_id": 1273,
                                                                        "on_tt": 1,
                                                                        "accepted": 0,
                                                                        "initiator_id": 1273
                                                                    }
                                                                ],
                                                                "email_type": "home",
                                                                "email_address": "ash@vprex.com",
                                                                "phone_type": "home",
                                                                "phone_number": "332323"
                                                            }
               
                                                            </pre>
                                                        </div>	

                                                    </div>
                                                </div>
                                                <!--- End class=box-element --->


                                                <div class="clear"></div>

                                            </div>

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light" >
                                                    <h3 style='cursor:pointer;' id="Pending_div"> Pending Conversation/Messages  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/message/conversations   <br />
                                                    <br />

                                                    Method: GET<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid conversations request <br/>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                        {"pending_friends":[{"person_id":3324345,"facebook_id":null,"first_name":"VPrex","last_name":"Stars","photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346756882.0982-userimage.png","user_id":1264,"on_tt":1,"accepted":0,"initiator_id":1266},{"person_id":3324346,"facebook_id":null,"first_name":"VPrex","last_name":"Champs","photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346757207.1954-userimage.png","user_id":1265,"on_tt":1,"accepted":0,"initiator_id":1266},{"person_id":3409676,"facebook_id":null,"first_name":"ashwin2","last_name":"j","photo":null,"user_id":1273,"on_tt":1,"accepted":0,"initiator_id":1273},{"person_id":3604234,"facebook_id":null,"first_name":"Ashwin1","last_name":"Jumani","photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1347445770.569-userimage.png","user_id":1316,"on_tt":1,"accepted":0,"initiator_id":1316}],"threads":[{"thread_id":"1266-1271","friend_id":1271,"group_id":"0","create_date":"2012-09-05 05:17:19","unread":"0"},{"thread_id":"1266-264","friend_id":0,"group_id":"264","create_date":"2012-09-05 03:40:41","unread":"0"},{"thread_id":"1266-261","friend_id":0,"group_id":"261","create_date":"2012-09-05 03:38:19","unread":"0"}]}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "pending_friends":
    [
        {
            "person_id":3324345,
            "facebook_id":null,
            "first_name":"VPrex",
            "last_name":"Stars",
            "photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346756882.0982-userimage.png",
            "user_id":1264,
            "on_tt":1,
            "accepted":0,
            "initiator_id":1266
        },

        {
            "person_id":3324346,
            "facebook_id":null,
            "first_name":"VPrex",
            "last_name":"Champs",
            "photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346757207.1954-userimage.png",
            "user_id":1265,
            "on_tt":1,
            "accepted":0,
            "initiator_id":1266
        },

        {
            "person_id":3409676,
            "facebook_id":null,
            "first_name":"ashwin2",
            "last_name":"j",
            "photo":null,
            "user_id":1273,
            "on_tt":1,
            "accepted":0,
            "initiator_id":1273
        },

        {
            "person_id":3604234,
            "facebook_id":null,
            "first_name":"Ashwin1",
            "last_name":"Jumani",
            "photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1347445770.569-userimage.png",
            "user_id":1316,
            "on_tt":1,
            "accepted":0,
            "initiator_id":1316
        }
    ],

    "threads":
    [
        {
            "thread_id":"1266-1271",
            "friend_id":1271,
            "group_id":"0",
            "create_date":"2012-09-05 05:17:19",
            "unread":"0"
        },

        {   
            "thread_id":"1266-264",
            "friend_id":0,
            "group_id":"264",
            "create_date":"2012-09-05 03:40:41",
            "unread":"0"
        },

        {
            "thread_id":"1266-261",
            "friend_id":0,
            "group_id":"261",
            "create_date":"2012-09-05 03:38:19",
            "unread":"0"
        }
    ]
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="send_mess"> Send Message  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/message/create   <br />
                                                    <br />

                                                    Method: POST<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140>  message_type_id</td>
                                                                    <td> Type of message  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>

                                                                <tr>
                                                                    <td width=140>  message_header</td>
                                                                    <td> Header of message  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>

                                                                <tr>
                                                                    <td width=140>  message_body</td>
                                                                    <td> Text of message  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>

                                                                <tr>
                                                                    <td width=140>  recipients</td>
                                                                    <td> Contains array of recipients ( group_id or list of user_id )  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> - </td>
                                                                    <td> No recipients specified! </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> - </td>
                                                                    <td> You cannot post to a deleted group! </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid create message request <br/>
                                                    <br/>
                                                    <br/>
                                                    request data JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                       {"message_type_id":1,"message_body":"TEst","recipients":[{"user_id":1316}],"message_header":"Text Message"}
                                                    </div>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"message":{"message_type_id":1,"message_body":"TEst","message_header":"Text Message","user_id":"204","create_date":"2012-09-14 12:41:34","message_path":null,"delete_date":null,"id":"6868","update_date":null}}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "message":
    {
        "message_type_id":1,
        "message_body":"TEst",
        "message_header":"Text Message",
        "user_id":"204",
        "create_date":"2012-09-14 12:41:34",
        "message_path":null,
        "delete_date":null,
        "id":"6868",
        "update_date":null
    }
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="send_audio"> Send Audio Message  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/message/create   <br />
                                                    <br />

                                                    Method: POST<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140>  message_type_id = 2</td>
                                                                    <td> Type of message  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>

                                                                <tr>
                                                                    <td width=140>  message_header</td>
                                                                    <td> Header of message  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>

                                                                <tr>
                                                                    <td width=140>  message_body</td>
                                                                    <td> Text of message  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>

                                                                <tr>
                                                                    <td width=140>  recipients</td>
                                                                    <td> Contains array of recipients ( group_id or list of user_id )  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>

                                                                <tr>
                                                                    <td width=140>  - </td>
                                                                    <td> Audio file ( ex.: recording.mp4 )  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> - </td>
                                                                    <td> No recipients specified! </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> - </td>
                                                                    <td> You cannot post to a deleted group! </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid create message request <br/>
                                                    <br/>
                                                    <br/>
                                                    request data JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                       {"message_type_id":1,"message_body":"TEst","recipients":[{"user_id":1316}],"message_header":"Text Message"}
                                                    </div>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"message":{"message_type_id":1,"message_body":"TEst","message_header":"Text Message","user_id":"204","create_date":"2012-09-14 12:41:34","message_path":"Text Message","delete_date":null,"id":"6868","update_date":null}}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "message":
    {
        "message_type_id":1,
        "message_body":"TEst",
        "message_header":"Text Message",
        "user_id":"204",
        "create_date":"2012-09-14 12:41:34",
        "message_path":"http:\/\/bit.ly\/QIvN6s",
        "delete_date":null,
        "id":"6868",
        "update_date":null
    }
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="reload"> Reload Friend Messages  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/message/user?user_id=1316   <br />
                                                    <br />

                                                    Method: GET<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140>  user_id</td>
                                                                    <td> ID of required user  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid reload friend messages request <br/>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"messages":[{"id":6858,"sender_id":204,"recipient_id":1316,"message_header":"Audio Message","message_body":"1347447388","message_path":null,"create_date":"2012-09-13 02:29:52","is_favorite":"0"},{"id":6867,"sender_id":204,"recipient_id":1316,"message_header":"Text Message","message_body":"TEst","message_path":null,"create_date":"2012-09-14 12:24:35","is_favorite":"0"},{"id":6868,"sender_id":204,"recipient_id":1316,"message_header":"Text Message","message_body":"TEst","message_path":null,"create_date":"2012-09-14 12:41:34","is_favorite":"0"}]}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "messages":
    [
        {
            "id":6858,
            "sender_id":204,
            "recipient_id":1316,
            "message_header":"Audio Message",
            "message_body":"1347447388",
            "message_path":null,
            "create_date":"2012-09-13 02:29:52",
            "is_favorite":"0"
        },

        {
            "id":6867,
            "sender_id":204,
            "recipient_id":1316,
            "message_header":"Text Message",
            "message_body":"TEst",
            "message_path":null,
            "create_date":"2012-09-14 12:24:35",
            "is_favorite":"0"
        },

        {
            "id":6868,
            "sender_id":204,
            "recipient_id":1316,
            "message_header":"Text Message",
            "message_body":"TEst",
            "message_path":null,
            "create_date":"2012-09-14 12:41:34",
            "is_favorite":"0"
        }
    ]
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="accept"> Accept Invitation  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/contact/create   <br />
                                                    <br />

                                                    Method: POST<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140>  person_id</td>
                                                                    <td> ID of invite sender  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td width=140> - </td>
                                                                    <td> You, adding you, who's adding you. You can't add yourself sillygoose. </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> - </td>
                                                                    <td> Please select a person to add or invite. </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> - </td>
                                                                    <td> You are already contacts with this person. </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> - </td>
                                                                    <td> You've already requested to add this person. </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid accept invitation request <br/>
                                                    <br/>
                                                    <br/>
                                                    request data JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                       {"person_id":"3604234"}
                                                    </div>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"status":"confirmed"}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "status":"confirmed"
}                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id="list_friends"> List friends  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://apiv2.tonguetango.com/api/contact   <br />
                                                    <br />

                                                    Method: GET<br />
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid list friends request <br/>
                                                    <br/>
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"fb_friends":[{"person_id":4379,"facebook_id":"500048456","first_name":"Aaron","last_name":"Rogers","photo":"http:\/\/graph.facebook.com\/500048456\/picture","user_id":0,"on_tt":0,"accepted":0,"initiator_id":null},{"person_id":4587,"facebook_id":"100000078406815","first_name":"Adam","last_name":"Pallija","photo":"http:\/\/graph.acebook.com\/100000078406815\/picture","user_id":0,"on_tt":0,"accepted":0,"initiator_id":null},{"person_id":4636,"facebook_id":"100001074775893","first_name":"Adam","last_name":"Wagner","photo":"http\/\/graph.facebook.com\/100001074775893\/picture","user_id":0,"on_tt":0,"accepted":0,"initiator_id":null}],"tt_friends":[{"person_id":4548,"facebook_id":"1499481467","first_name":"Adam","last_name":"Aossey","photo":"http:\/\/c11469316.r16.cf2.rackcdn.com\/1339668370.8685-userimage.png","user_id":650,"on_tt":1,"accepted":1,"initiator_id":204},{"person_id":4553,"facebook_id":"1543370287","first_name":"Adam","last_name":"Ward","photo":"http:\/\/c11469316.r16.cf2.rackcdn.om\/1339415037.2028-userimage.png","user_id":598,"on_tt":1,"accepted":1,"initiator_id":598},{"person_id":4623,"facebook_id":"100000692827537","first_name":"Brian","last_name":"Penland","photo":"http:\/\/c11469316.r16.cf2.rackcdn.om\/1336281814.9345-userimage.png","user_id":374,"on_tt":1,"accepted":1,"initiator_id":204},{"person_id":4492,"facebook_id":"1283381100","first_name":"Bruce","last_name":"Fisher","photo":"http:\/\/667b1378df93206c9f44-979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346276594.0202-userimage.png","user_id":268,"on_tt":1,"accepted":1,"initiator_id":204}],"pending_friends":[{"person_id":129673,"facebook_id":null,"first_name":"Jason","last_name":"Gregory","photo":"http:\/\/c11469316.r16.cf2.rackcdn.com\/1336064412.611-userimage.png","user_id":238,"on_tt":1,"accepted":0,"initiator_id":204},{"person_id":302797,"facebook_id":null,"first_name":"Nick","last_name":"Bratskeir","photo":"http:\/\/c11469316.r16.cf2.rackcdn.om\/1336071262.2485-userimage.png","user_id":249,"on_tt":1,"accepted":0,"initiator_id":204},{"person_id":374519,"facebook_id":null,"first_name":"Kevin","last_name":"Owens","photo":"http:\/\/c11469316.r16.cf2.rackcdn.com\/1336091697.3009-userimage.png","user_id":286,"on_tt":1,"accepted":0,"initiator_id":204}]}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "fb_friends":
    [
        {
            "person_id":4379,
            "facebook_id":"500048456",
            "first_name":"Aaron",
            "last_name":"Rogers",
            "photo":"http:\/\/graph.facebook.com\/500048456\/picture",
            "user_id":0,
            "on_tt":0,
            "accepted":0,
            "initiator_id":null
        },

        {
            "person_id":4587,
            "facebook_id":"100000078406815",
            "first_name":"Adam",
            "last_name":"Pallija",
            "photo":"http:\/\/graph.facebook.com\/100000078406815\/picture",
            "user_id":0,
            "on_tt":0,
            "accepted":0,
            "initiator_id":null
        },

        {
            "person_id":4636,
            "facebook_id":"100001074775893",
            "first_name":"Adam",
            "last_name":"Wagner",
            "photo":"http:\/\/graph.facebook.com\/100001074775893\/picture",
            "user_id":0,
            "on_tt":0,
            "accepted":0,
            "initiator_id":null
        }
    ],

    "tt_friends":
    [
        {
            "person_id":4548,
            "facebook_id":"1499481467",
            "first_name":"Adam",
            "last_name":"Aossey",
            "photo":"http:\/\/c11469316.r16.cf2.rackcdn.com\/1339668370.8685-userimage.png",
            "user_id":650,
            "on_tt":1,
            "accepted":1,
            "initiator_id":204
        },

        {
            "person_id":4553,
            "facebook_id":"1543370287",
            "first_name":"Adam",
            "last_name":"Ward",
            "photo":"http:\/\/c11469316.r16.cf2.rackcdn.com\/1339415037.2028-userimage.png",
            "user_id":598,
            "on_tt":1,
            "accepted":1,
            "initiator_id":598
        },

        {
            "person_id":4623,
            "facebook_id":"100000692827537",
            "first_name":"Brian",
            "last_name":"Penland",
            "photo":"http:\/\/c11469316.r16.cf2.rackcdn.com\/1336281814.9345-userimage.png",
            "user_id":374,
            "on_tt":1,
            "accepted":1,
            "initiator_id":204
        },

        {
            "person_id":4492,
            "facebook_id":"1283381100",
            "first_name":"Bruce",
            "last_name":"Fisher",
            "photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346276594.0202-userimage.png",
            "user_id":268,
            "on_tt":1,
            "accepted":1,
            "initiator_id":204
        }

    ],
    
    "pending_friends":
    [
        {
            "person_id":129673,
            "facebook_id":null,
            "first_name":"Jason",
            "last_name":"Gregory",
            "photo":"http:\/\/c11469316.r16.cf2.rackcdn.com\/1336064412.611-userimage.png",
            "user_id":238,
            "on_tt":1,
            "accepted":0,
            "initiator_id":204
        },

        {
            "person_id":302797,
            "facebook_id":null,
            "first_name":"Nick",
            "last_name":"Bratskeir",
            "photo":"http:\/\/c11469316.r16.cf2.rackcdn.com\/1336071262.2485-userimage.png",
            "user_id":249,
            "on_tt":1,
            "accepted":0,
            "initiator_id":204
        },

        {
            "person_id":374519,
            "facebook_id":null,
            "first_name":"Kevin",
            "last_name":"Owens",
            "photo":"http:\/\/c11469316.r16.cf2.rackcdn.com\/1336091697.3009-userimage.png",
            "user_id":286,
            "on_tt":1,
            "accepted":0,
            "initiator_id":204
        }
    ]
}                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="request"> requestContacts  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/contact/search   <br />
                                                    <br />

                                                    Method: POST<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140>  contacts</td>
                                                                    <td>
                                                                        Contains array of contacts<br />
                                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                                            <thead>
                                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width=140>  unique_id</td>
                                                                                    <td> ---  </td>
                                                                                    <td width='80'>NO  </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td width=140>  emails</td>
                                                                                    <td> ---  </td>
                                                                                    <td width='80'>NO  </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td width=140>  phones</td>
                                                                                    <td> ---  </td>
                                                                                    <td width='80'>NO  </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> - </td>
                                                                    <td> Contact data could not be processed! </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid requestContacts request <br/>
                                                    <br/>
                                                    <br/>
                                                    request data JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                       {"contacts":[{"unique_id":1,"emails":["ash@vprex.com"],"phones":[]},{"unique_id":2,"emails":["ashwin@complitech.net"],"phones":[]}]}
                                                    </div>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"friends":[],"tt_friends":[{"unique_id":1,"person_id":3343492,"user_id":1266},{"unique_id":2,"person_id":3393975,"user_id":1271}]}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "friends":[],
    "tt_friends":
    [
        {
            "unique_id":1,
            "person_id":3343492,
            "user_id":1266
        },

        {
            "unique_id":2,
            "person_id":3393975,
            "user_id":1271
        }
    ]
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="add_friend"> Add Friend  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/contact/create   <br />
                                                    <br />

                                                    Method: POST<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140>  person_id</td>
                                                                    <td>
                                                                        ---
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> - </td>
                                                                    <td> You, adding you, who's adding you. You can't add yourself sillygoose. </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> - </td>
                                                                    <td> Please select a person to add or invite. </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> - </td>
                                                                    <td> You are already contacts with this person. </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid add friend request <br/>
                                                    <br/>
                                                    <br/>
                                                    request data JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                       {"person_id":"3343492"}
                                                    </div>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"status":"requested"}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "status":"requested"
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="change_password"> Change Password  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/user/update   <br />
                                                    <br />

                                                    Method: PUT<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140>  passwd</td>
                                                                    <td>
                                                                        new password
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid change password request <br/>
                                                    <br/>
                                                    <br/>
                                                    request data JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                       {"passwd":"testing"}
                                                    </div>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"username":"Vasya","facebook_access_token":"BAAB27AxG43UBAON4aW8bux0R17tUnTZC26HmuUFSTDDVw1IPPHTFMxuLVrDt0cHIdMgqMGscciY09xdwto420HqVojxiIDxws8lfeteOUY8JGlwSkM98mGQb7Y0QZD","twitter_auth_token":"oauth_token=245647150-72UktBXgPvnkJticHj6OeNzsUOOkvu4CHksdS2JT&oauth_token_secret=moxv02JlwG5DbXzJR28O0OpfUTb4RhGKcnHqMQ&user_id=245647150&screen_name=TongueTango","create_date":"2012-04-12 20:08:53","update_date":"2012-09-05 20:01:47","delete_date":null,"first_name":"Eddy","middle_name":null,"last_name":"Roach","aliases":null,"photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346900506.6056-userimage.png","birth_date":null,"gender":"","notes":null,"twitter_handle":null,"facebook_id":"100000186680597","email_type":"home","email_address":"eddy.roach@gmail.com","phone_type":"home","phone_number":"4803997652","user_id":"204"}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
                                                            {
                                                                "username":"Vasya",
                                                                "facebook_access_token":"BAAB27AxG43UBAON4aW8bux0R17tUnTZC26HmuUFSTDDVw1IPPHTFMxuLVrDt0cHIdMgqMGscciY09xdwto420HqVojxiIDxws8lfeteOUY8JGlwSkM98mGQb7Y0QZD",
                                                                "twitter_auth_token":"oauth_token=245647150-72UktBXgPvnkJticHj6OeNzsUOOkvu4CHksdS2JT&oauth_token_secret=moxv02JlwG5DbXzJR28O0OpfUTb4RhGKcnHqMQ&user_id=245647150&screen_name=TongueTango",
                                                                "create_date":"2012-04-12 20:08:53",
                                                                "update_date":"2012-09-05 20:01:47",
                                                                "delete_date":null,
                                                                "first_name":"Eddy",
                                                                "middle_name":null,
                                                                "last_name":"Roach",
                                                                "aliases":null,
                                                                "photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346900506.6056-userimage.png",
                                                                "birth_date":null,
                                                                "gender":"",
                                                                "notes":null,
                                                                "twitter_handle":null,
                                                                "facebook_id":"100000186680597",
                                                                "email_type":"home",
                                                                "email_address":"eddy.roach@gmail.com",
                                                                "phone_type":"home",
                                                                "phone_number":"4803997652",
                                                                "user_id":"204"
                                                            }
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;'id ="create_group"> Create Group  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://apiv2.tonguetango.com/api/group   <br />
                                                    <br />

                                                    Method: POST<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140>  name</td>
                                                                    <td>
                                                                        new group name
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Name cannot be blank. </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid create group request <br/>
                                                    <br/>
                                                    <br/>
                                                    request data JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                       {"members":"","name":"Testtxxxxxxxx"}
                                                    </div>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"group":{"user_id":"202","name":"Testtxxxxxxxx","photo":null,"delete_date":null,"create_date":"2012-09-15 10:06:14","update_date":"2012-09-15 10:06:14","id":"320"}}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
                                                            {
                                                                "group": {
                                                                    "user_id": "202",
                                                                    "name": "Testtxxxxxxxx",
                                                                    "photo": null,
                                                                    "delete_date": null,
                                                                    "create_date": "2012-09-15 10:06:14",
                                                                    "update_date": "2012-09-15 10:06:14",
                                                                    "id": "320"
                                                                }
                                                            }
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="delete_group"> Delete Group  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://apiv2.tonguetango.com/api/group/{id}   <br />
                                                    <br />

                                                    Method: DELETE<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140> id</td>
                                                                    <td>
                                                                        group primary key id
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Invalid group specified</td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid create group request <br/>
                                                    <br/>
                                                    <br/>
                                                    request data JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                       empty (group id goes to url)
                                                    </div>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"deleted":1}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
                                                            {"deleted":1}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;'id ="update_group"> Update Group  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/group/update/{id}   <br />
                                                    <br />

                                                    Method: PUT<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140> id</td>
                                                                    <td>
                                                                        group primary key id
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width=140> members </td>
                                                                    <td>
                                                                        (comma separated list of user ids)
                                                                    </td>
                                                                    <td width='80'>YES  </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width=140> name</td>
                                                                    <td>
                                                                        group new name
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Invalid group specified</td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid create group request <br/>
                                                    <br/>
                                                    <br/>
                                                    request data JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                       {"members":"1265","name":"Testt"}  (members user_ids with comma separated list)
                                                    </div>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"group":{"id":"321","user_id":"202","name":"Testt","photo":null,"create_date":"2012-09-15 01:13:13","update_date":"2012-09-15 15:44:38","delete_date":null,"members":[{"user_id":"709","photo":"http:\/\/c11469316.r16.cf2.rackcdn.com\/1334283378.7495-userimage.png"},{"user_id":"716","photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346757207.1954-userimage.png"},{"user_id":"717","photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346757207.1954-userimage.png"},{"user_id":"718","photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346757207.1954-userimage.png"},{"user_id":"719","photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346757207.1954-userimage.png"},{"user_id":"720","photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346757207.1954-userimage.png"},{"user_id":"721","photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346757207.1954-userimage.png"},{"user_id":"722","photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346757207.1954-userimage.png"},{"user_id":"723","photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346757207.1954-userimage.png"},{"user_id":"724","photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346757207.1954-userimage.png"},{"user_id":"725","photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346757207.1954-userimage.png"}]}}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
                                                            {
                                                                "group": {
                                                                    "id": "321",
                                                                    "user_id": "202",
                                                                    "name": "Testt",
                                                                    "photo": null,
                                                                    "create_date": "2012-09-15 01:13:13",
                                                                    "update_date": "2012-09-15 15:44:38",
                                                                    "delete_date": null,
                                                                    "members": [
                                                                        {
                                                                            "user_id": "709",
                                                                            "photo": "http://c11469316.r16.cf2.rackcdn.com/1334283378.7495-userimage.png"
                                                                        },
                                                                        {
                                                                            "user_id": "716",
                                                                            "photo": "http://667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com/1346757207.1954-userimage.png"
                                                                        },
                                                                        {
                                                                            "user_id": "717",
                                                                            "photo": "http://667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com/1346757207.1954-userimage.png"
                                                                        },
                                                                        {
                                                                            "user_id": "718",
                                                                            "photo": "http://667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com/1346757207.1954-userimage.png"
                                                                        },
                                                                        {
                                                                            "user_id": "719",
                                                                            "photo": "http://667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com/1346757207.1954-userimage.png"
                                                                        },
                                                                        {
                                                                            "user_id": "720",
                                                                            "photo": "http://667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com/1346757207.1954-userimage.png"
                                                                        },
                                                                        {
                                                                            "user_id": "721",
                                                                            "photo": "http://667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com/1346757207.1954-userimage.png"
                                                                        },
                                                                        {
                                                                            "user_id": "722",
                                                                            "photo": "http://667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com/1346757207.1954-userimage.png"
                                                                        },
                                                                        {
                                                                            "user_id": "723",
                                                                            "photo": "http://667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com/1346757207.1954-userimage.png"
                                                                        },
                                                                        {
                                                                            "user_id": "724",
                                                                            "photo": "http://667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com/1346757207.1954-userimage.png"
                                                                        },
                                                                        {
                                                                            "user_id": "725",
                                                                            "photo": "http://667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com/1346757207.1954-userimage.png"
                                                                        }
                                                                    ]
                                                                }
                                                             }
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->
                                            
                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id="list_group"> List Groups  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://apiv2.tonguetango.com/api/group/   <br />
                                                    <br />

                                                    Method: GET<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140> id</td>
                                                                    <td>
                                                                        group primary key id
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid create group request <br/>
                                                    <br/>
                                                    <br/>
                                                    request data JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                       empty (method is working with get)
                                                    </div>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"groups":[{"id":"290","user_id":"1316","name":"Bbbb","photo":null,"create_date":"2012-09-12 02:15:04","update_date":"2012-09-12 02:19:11","delete_date":null,"members":[{"user":"1316","photo":null}]}]}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
                                                            {
                                                                "groups": [
                                                                    {
                                                                        "id": "290",
                                                                        "user_id": "1316",
                                                                        "name": "Bbbb",
                                                                        "photo": null,
                                                                        "create_date": "2012-09-12 02:15:04",
                                                                        "update_date": "2012-09-12 02:19:11",
                                                                        "delete_date": null,
                                                                        "members": [
                                                                            {
                                                                                "user": "1316",
                                                                                "photo": null
                                                                            }
                                                                        ]
                                                                    }
                                                                ]
                                                            }
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="update_user"> Update User  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/user/update   <br />
                                                    <br />

                                                    Method: PUT<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        All user fields<br /> <br />
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid user update request <br/>
                                                    <br/>
                                                    <br/>
                                                    request data JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                       {"email_address":"ashwin101@testing.com", "first_name":"Ashwin1","last_name":"Jumani"}
                                                    </div>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"username":"test","facebook_access_token":"BAAB27AxG43UBAON4aW8bux0R17tUnTZC26HmuUFSTDDVw1IPPHTFMxuLVrDt0cHIdMgqMGscciY09xdwto420HqVojxiIDxws8lfeteOUY8JGlwSkM98mGQb7Y0QZD","twitter_auth_token":"oauth_token=245647150-72UktBXgPvnkJticHj6OeNzsUOOkvu4CHksdS2JT&oauth_token_secret=moxv02JlwG5DbXzJR28O0OpfUTb4RhGKcnHqMQ&user_id=245647150&screen_name=TongueTango","create_date":"2012-04-12 20:08:53","update_date":"2012-09-17 11:51:46","delete_date":null,"first_name":"Ashwin1","middle_name":null,"last_name":"Jumani","aliases":null,"photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346900506.6056-userimage.png","birth_date":null,"gender":"","notes":null,"twitter_handle":null,"facebook_id":"100000186680597","email_type":"home","email_address":"ashwin101@testing.com","phone_type":"home","phone_number":"4803997652","user_id":"204"}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "username":"test",
    "facebook_access_token":"BAAB27AxG43UBAON4aW8bux0R17tUnTZC26HmuUFSTDDVw1IPPHTFMxuLVrDt0cHIdMgqMGscciY09xdwto420HqVojxiIDxws8lfeteOUY8JGlwSkM98mGQb7Y0QZD",
    "twitter_auth_token":"oauth_token=245647150-72UktBXgPvnkJticHj6OeNzsUOOkvu4CHksdS2JT&oauth_token_secret=moxv02JlwG5DbXzJR28O0OpfUTb4RhGKcnHqMQ&user_id=245647150&screen_name=TongueTango",
    "create_date":"2012-04-12 20:08:53",
    "update_date":"2012-09-17 11:51:46",
    "delete_date":null,
    "first_name":"Ashwin1",
    "middle_name":null,
    "last_name":"Jumani",
    "aliases":null,
    "photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1346900506.6056-userimage.png",
    "birth_date":null,
    "gender":"",
    "notes":null,
    "twitter_handle":null,
    "facebook_id":"100000186680597",
    "email_type":"home",
    "email_address":"ashwin101@testing.com",
    "phone_type":"home",
    "phone_number":"4803997652",
    "user_id":"204"
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="register"> Registration  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://apiv2.tonguetango.com/api/user   <br />
                                                    <br />

                                                    Method: POST<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        All user fields<br /> <br />
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Username already taken. Please select another one. </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Email already taken. Please select another one </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Example: A valid registration request <br/>
                                                    <br/>
                                                    <br/>
                                                    request data JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">

                                                       {"passwd":"123123","device_type":"iOS","username":"tes111t","facebook_id":"","push_token":"","email_type":"home","facebook_access_token":"","last_name":"J","version":"5.1","email_address":"ashwin21@testing.com","twitter_auth_token":"","model":"iPhone Simulator","gender":"","phone":"","unique_id":"4EA8B03F-F243-43DC-A6AB-0B0D2E72A075","first_name":"Ashwin1"}
                                                    </div>
                                                    <br />
                                                    <br/>
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"user_id":"1280","photo":null,"id":"1280","person_id":"3447487","username":"tes111t","passwd":"123123","facebook_access_token":null,"twitter_auth_token":null,"create_date":"2012-09-17 17:38:22","update_date":"2012-09-17 17:38:22","delete_date":null,"first_name":"Ashwin1","middle_name":null,"last_name":"J","aliases":null,"birth_date":null,"gender":"","notes":null,"twitter_handle":null,"facebook_id":null,"fb_friends":[],"tt_friends":[],"pending_friends":[],"email_type":"home","email_address":"ashwin21@testing.com"}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "user_id":"1280",
    "photo":null,
    "id":"1280",
    "person_id":"3447487",
    "username":"tes111t"
    ,"passwd":"123123",
    "facebook_access_token":null,
    "twitter_auth_token":null,
    "create_date":"2012-09-17 17:38:22",
    "update_date":"2012-09-17 17:38:22",
    "delete_date":null,
    "first_name":"Ashwin1",
    "middle_name":null,
    "last_name":"J",
    "aliases":null,
    "birth_date":null,
    "gender":"",
    "notes":null,
    "twitter_handle":null,
    "facebook_id":null,
    "fb_friends":[],
    "tt_friends":[],
    "pending_friends":[],
    "email_type":"home",
    "email_address":"ashwin21@testing.com"
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="user_photo"> Update user photo  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/user/update   <br />
                                                    <br />

                                                    Method: POST<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> - </td>
                                                                    <td> Pass Image data  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"username":"ashwin101","facebook_access_token":"","twitter_auth_token":"","create_date":"2012-09-12 01:59:55","update_date":"2012-09-12 03:29:34","delete_date":null,"first_name":"Ashwin1","middle_name":null,"last_name":"J","aliases":null,"photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1347445770.569-userimage.png","birth_date":null,"gender":"","notes":null,"twitter_handle":null,"facebook_id":null,"email_type":"home","email_address":"ashwin101@testing.com","user_id":"1316"}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "username":"ashwin101",
    "facebook_access_token":"",
    "twitter_auth_token":"",
    "create_date":"2012-09-12 01:59:55",
    "update_date":"2012-09-12 03:29:34",
    "delete_date":null,
    "first_name":"Ashwin1",
    "middle_name":null,
    "last_name":"J",
    "aliases":null,
    "photo":"http:\/\/667b1378df93206c9f44-5979481b6de8f660b84daf2646f8d8d1.r29.cf2.rackcdn.com\/1347445770.569-userimage.png",
    "birth_date":null,
    "gender":"",
    "notes":null,
    "twitter_handle":null,
    "facebook_id":null,
    "email_type":"home",
    "email_address":"ashwin101@testing.com",
    "user_id":"1316"
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id="get_products"> Get Products  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/product   <br />
                                                    <br />

                                                    Method: GET<br />
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"products":[{"id":"2","name":"Microphone Pack","description":"Get a pack of cool Microphones","ios_product_id":"ios.microphones","android_product_id":"com.tonguetango.android.messenger.microphones","create_date":"2012-03-14 19:19:35","update_date":"2012-03-14 19:19:35","delete_date":null,"purchased":"1","content":[{"id":"2","content_type_id":"6","product_id":"2","name":"Microphone 2 Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/microphones\/mock_4a_mic2.png","create_date":"2012-03-14 20:08:27","update_date":"2012-03-14 20:08:27","delete_date":null},{"id":"3","content_type_id":"6","product_id":"2","name":"Microphone 3 Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/microphones\/mock_4a_mic3.png","create_date":"2012-03-14 20:08:52","update_date":"2012-03-14 20:08:52","delete_date":null},{"id":"4","content_type_id":"6","product_id":"2","name":"Microphone 4 Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/microphones\/mock_4a_mic4.png","create_date":"2012-03-14 20:09:20","update_date":"2012-03-14 20:09:20","delete_date":null},{"id":"5","content_type_id":"6","product_id":"2","name":"Microphone 5 Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/microphones\/mock_4a_mic5.png","create_date":"2012-03-14 20:11:45","update_date":"2012-03-14 20:11:45","delete_date":null},{"id":"6","content_type_id":"6","product_id":"2","name":"Microphone 6 Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/microphones\/mock_4a_mic6.png","create_date":"2012-03-14 20:12:12","update_date":"2012-03-14 20:12:12","delete_date":null},{"id":"53","content_type_id":"4","product_id":"2","name":"On the Air","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/microphones\/mic2%402x.png","create_date":"2012-03-20 16:53:23","update_date":"2012-03-20 16:53:23","delete_date":null},{"id":"54","content_type_id":"4","product_id":"2","name":"Area 51","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/microphones\/mic3%402x.png","create_date":"2012-03-20 16:54:06","update_date":"2012-03-20 16:54:06","delete_date":null},{"id":"55","content_type_id":"4","product_id":"2","name":"Classic","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/microphones\/mic4%402x.png","create_date":"2012-03-20 16:54:35","update_date":"2012-03-20 16:54:35","delete_date":null},{"id":"56","content_type_id":"4","product_id":"2","name":"Bullet","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/microphones\/mic5%402x.png","create_date":"2012-03-20 16:55:05","update_date":"2012-03-20 16:55:05","delete_date":null},{"id":"57","content_type_id":"4","product_id":"2","name":"Old School","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/microphones\/mic6%402x.png","create_date":"2012-03-20 16:55:25","update_date":"2012-03-20 16:55:25","delete_date":null}]},{"id":"7","name":"Baseball","description":"Baseball","ios_product_id":"ios.skin.baseball","android_product_id":"com.tonguetango.android.messenger.theme.baseball","create_date":"2012-03-14 21:01:55","update_date":"2012-03-14 21:01:55","delete_date":null,"purchased":"1","content":[{"id":"7","content_type_id":"5","product_id":"7","name":"Baseball Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_baseball.png","create_date":"2012-03-14 21:02:57","update_date":"2012-03-14 21:02:57","delete_date":null},{"id":"8","content_type_id":"3","product_id":"7","name":"Baseball Skin Color","data":"6,129,190","create_date":"2012-03-14 21:04:32","update_date":"2012-03-14 21:04:32","delete_date":null},{"id":"9","content_type_id":"2","product_id":"7","name":"Baseball Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/baseball@2x.png","create_date":"2012-03-14 21:05:34","update_date":"2012-03-14 21:05:34","delete_date":null}]},{"id":"8","name":"Cheetah","description":"Cheetah Theme","ios_product_id":"ios.skin.cheetah","android_product_id":"com.tonguetango.android.messenger.theme.cheetah","create_date":"2012-03-14 21:06:09","update_date":"2012-03-14 21:06:09","delete_date":null,"purchased":"1","content":[{"id":"10","content_type_id":"5","product_id":"8","name":"cheetah Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_cheetah.png","create_date":"2012-03-14 21:16:14","update_date":"2012-03-14 21:16:14","delete_date":null},{"id":"11","content_type_id":"3","product_id":"8","name":"cheetah Skin Color","data":"109,74,43","create_date":"2012-03-14 21:16:14","update_date":"2012-03-14 21:16:14","delete_date":null},{"id":"12","content_type_id":"2","product_id":"8","name":"cheetah Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/cheetah@2x.png","create_date":"2012-03-14 21:19:05","update_date":"2012-03-14 21:19:05","delete_date":null}]},{"id":"9","name":"Country","description":"Country Theme","ios_product_id":"ios.skin.country","android_product_id":"com.tonguetango.android.messenger.theme.country","create_date":"2012-03-14 21:20:14","update_date":"2012-03-14 21:20:14","delete_date":null,"purchased":"1","content":[{"id":"13","content_type_id":"5","product_id":"9","name":"country Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_country.png","create_date":"2012-03-14 21:20:26","update_date":"2012-03-14 21:20:26","delete_date":null},{"id":"14","content_type_id":"2","product_id":"9","name":"country Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/country@2x.png","create_date":"2012-03-14 21:20:26","update_date":"2012-03-14 21:20:26","delete_date":null},{"id":"15","content_type_id":"3","product_id":"9","name":"country Skin Color","data":"60,45,14","create_date":"2012-03-14 21:20:26","update_date":"2012-03-14 21:20:26","delete_date":null}]},{"id":"10","name":"Las Vegas","description":"Las Vegas Theme","ios_product_id":"ios.skin.lasvegas","android_product_id":"com.tonguetango.android.messenger.theme.easter","create_date":"2012-03-14 21:20:51","update_date":"2012-03-14 21:21:43","delete_date":null,"purchased":"1","content":[{"id":"16","content_type_id":"5","product_id":"10","name":"vegas Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_lasvegas.png","create_date":"2012-03-14 21:21:04","update_date":"2012-03-14 21:21:04","delete_date":null},{"id":"17","content_type_id":"2","product_id":"10","name":"vegas Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/lasvegas@2x.png","create_date":"2012-03-14 21:21:04","update_date":"2012-03-14 21:21:04","delete_date":null},{"id":"18","content_type_id":"3","product_id":"10","name":"vegas Skin Color","data":"20,68,135","create_date":"2012-03-14 21:21:04","update_date":"2012-03-14 21:21:04","delete_date":null}]},{"id":"11","name":"Global","description":"Global Theme","ios_product_id":"ios.skin.global","android_product_id":"com.tonguetango.android.messenger.theme.global","create_date":"2012-03-14 21:21:39","update_date":"2012-03-14 21:21:39","delete_date":null,"purchased":"1","content":[{"id":"19","content_type_id":"5","product_id":"11","name":"global Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_global.png","create_date":"2012-03-14 21:21:56","update_date":"2012-03-14 21:21:56","delete_date":null},{"id":"20","content_type_id":"2","product_id":"11","name":"global Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/global@2x.png","create_date":"2012-03-14 21:21:56","update_date":"2012-03-14 21:21:56","delete_date":null},{"id":"21","content_type_id":"3","product_id":"11","name":"global Skin Color","data":"75,123,183","create_date":"2012-03-14 21:21:57","update_date":"2012-03-14 21:21:57","delete_date":null}]},{"id":"12","name":"Golf","description":"Golf Theme","ios_product_id":"ios.skin.golf","android_product_id":"com.tonguetango.android.messenger.theme.golf","create_date":"2012-03-14 21:23:35","update_date":"2012-03-14 21:23:35","delete_date":null,"purchased":"1","content":[{"id":"22","content_type_id":"5","product_id":"12","name":"golf Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_golf.png","create_date":"2012-03-14 21:23:38","update_date":"2012-03-14 21:23:38","delete_date":null},{"id":"23","content_type_id":"2","product_id":"12","name":"golf Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/golf@2x.png","create_date":"2012-03-14 21:23:38","update_date":"2012-03-14 21:23:38","delete_date":null},{"id":"24","content_type_id":"3","product_id":"12","name":"golf Skin Color","data":"85,118,54","create_date":"2012-03-14 21:23:38","update_date":"2012-03-14 21:23:38","delete_date":null}]},{"id":"13","name":"Goth","description":"Goth Theme","ios_product_id":"ios.skin.goth","android_product_id":"com.tonguetango.android.messenger.theme.goth","create_date":"2012-03-14 21:24:01","update_date":"2012-03-14 21:24:01","delete_date":null,"purchased":"1","content":[{"id":"25","content_type_id":"5","product_id":"13","name":"goth Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_goth.png","create_date":"2012-03-14 21:28:16","update_date":"2012-03-14 21:28:16","delete_date":null},{"id":"26","content_type_id":"2","product_id":"13","name":"goth Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/goth@2x.png","create_date":"2012-03-14 21:28:16","update_date":"2012-03-14 21:28:16","delete_date":null},{"id":"27","content_type_id":"3","product_id":"13","name":"goth Skin Color","data":"106,129,149","create_date":"2012-03-14 21:28:16","update_date":"2012-03-14 21:28:16","delete_date":null}]},{"id":"14","name":"Basketball","description":"Basketball Theme","ios_product_id":"ios.skin.lightwood","android_product_id":"com.tonguetango.android.messenger.theme.lightwood","create_date":"2012-03-14 21:24:25","update_date":"2012-03-14 21:24:25","delete_date":null,"purchased":"1","content":[{"id":"28","content_type_id":"5","product_id":"14","name":"basketball Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_lightwood.png","create_date":"2012-03-14 21:28:31","update_date":"2012-03-14 21:28:31","delete_date":null},{"id":"29","content_type_id":"2","product_id":"14","name":"lightwood Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/basketball@2x.png","create_date":"2012-03-14 21:28:31","update_date":"2012-03-14 21:28:31","delete_date":null},{"id":"30","content_type_id":"3","product_id":"14","name":"basketball Skin Color","data":"202,153,92","create_date":"2012-03-14 21:28:31","update_date":"2012-03-14 21:28:31","delete_date":null}]},{"id":"15","name":"Military","description":"Military Theme","ios_product_id":"ios.skin.military","android_product_id":"com.tonguetango.android.messenger.theme.military","create_date":"2012-03-14 21:24:45","update_date":"2012-03-14 21:24:45","delete_date":null,"purchased":"1","content":[{"id":"31","content_type_id":"5","product_id":"15","name":"military Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_military.png","create_date":"2012-03-14 21:28:43","update_date":"2012-03-14 21:28:43","delete_date":null},{"id":"32","content_type_id":"2","product_id":"15","name":"military Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/military@2x.png","create_date":"2012-03-14 21:28:43","update_date":"2012-03-14 21:28:43","delete_date":null},{"id":"33","content_type_id":"3","product_id":"15","name":"military Skin Color","data":"97,116,74","create_date":"2012-03-14 21:28:43","update_date":"2012-03-14 21:28:43","delete_date":null}]},{"id":"16","name":"Pink Art","description":"Pink Art Theme","ios_product_id":"ios.skin.pink","android_product_id":"com.tonguetango.android.messenger.theme.pink","create_date":"2012-03-14 21:24:59","update_date":"2012-03-14 21:24:59","delete_date":null,"purchased":"1","content":[{"id":"34","content_type_id":"5","product_id":"16","name":"pinkstars Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_pinkstars.png","create_date":"2012-03-14 21:28:58","update_date":"2012-03-14 21:28:58","delete_date":null},{"id":"35","content_type_id":"2","product_id":"16","name":"pinkstars Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/pinkstars@2x.png","create_date":"2012-03-14 21:28:58","update_date":"2012-03-14 21:28:58","delete_date":null},{"id":"36","content_type_id":"3","product_id":"16","name":"pinkstars Skin Color","data":"172,30,94","create_date":"2012-03-14 21:28:58","update_date":"2012-03-14 21:28:58","delete_date":null}]},{"id":"17","name":"Wallpaper","description":"Wallpaper Theme","ios_product_id":"ios.skin.pinkwall","android_product_id":"com.tonguetango.android.messenger.theme.pinkwall","create_date":"2012-03-14 21:26:04","update_date":"2012-03-14 21:26:04","delete_date":null,"purchased":"1","content":[{"id":"37","content_type_id":"5","product_id":"17","name":"pinkwallpaper Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_pinkwallpaper.png","create_date":"2012-03-14 21:29:20","update_date":"2012-03-14 21:29:20","delete_date":null},{"id":"38","content_type_id":"2","product_id":"17","name":"pinkwallpaper Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/pinkstripes@2x.png","create_date":"2012-03-14 21:29:20","update_date":"2012-03-14 21:29:20","delete_date":null},{"id":"39","content_type_id":"3","product_id":"17","name":"pinkwallpaper Skin Color","data":"162,67,112","create_date":"2012-03-14 21:29:20","update_date":"2012-03-14 21:29:20","delete_date":null}]},{"id":"18","name":"Happiness","description":"Happiness Theme","ios_product_id":"ios.skin.sky","android_product_id":"com.tonguetango.android.messenger.theme.sky","create_date":"2012-03-14 21:26:28","update_date":"2012-03-14 21:26:28","delete_date":null,"purchased":"1","content":[{"id":"40","content_type_id":"5","product_id":"18","name":"sky Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_sky.png","create_date":"2012-03-14 21:29:28","update_date":"2012-03-14 21:29:28","delete_date":null},{"id":"41","content_type_id":"2","product_id":"18","name":"sky Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/sky@2x.png","create_date":"2012-03-14 21:29:28","update_date":"2012-03-14 21:29:28","delete_date":null},{"id":"42","content_type_id":"3","product_id":"18","name":"happiness Skin Color","data":"61,111,180","create_date":"2012-03-14 21:29:28","update_date":"2012-03-14 21:29:28","delete_date":null}]},{"id":"19","name":"Summer Time","description":"Summer Time Theme","ios_product_id":"ios.skin.skygrass","android_product_id":"com.tonguetango.android.messenger.theme.skygrass","create_date":"2012-03-14 21:26:48","update_date":"2012-03-14 21:26:48","delete_date":null,"purchased":"1","content":[{"id":"43","content_type_id":"5","product_id":"19","name":"skygrass Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_skygrass.png","create_date":"2012-03-14 21:29:37","update_date":"2012-03-14 21:29:37","delete_date":null},{"id":"44","content_type_id":"2","product_id":"19","name":"skygrass Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/skygrass@2x.png","create_date":"2012-03-14 21:29:37","update_date":"2012-03-14 21:29:37","delete_date":null},{"id":"45","content_type_id":"3","product_id":"19","name":"skygrass Skin Color","data":"47,138,219","create_date":"2012-03-14 21:29:37","update_date":"2012-03-14 21:29:37","delete_date":null}]},{"id":"20","name":"Smokey","description":"Smokey Theme","ios_product_id":"ios.skin.smokey","android_product_id":"com.tonguetango.android.messenger.theme.smokey","create_date":"2012-03-14 21:27:05","update_date":"2012-03-14 21:27:05","delete_date":null,"purchased":"1","content":[{"id":"46","content_type_id":"5","product_id":"20","name":"smokey Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_smokey.png","create_date":"2012-03-14 21:29:45","update_date":"2012-03-14 21:29:45","delete_date":null},{"id":"47","content_type_id":"2","product_id":"20","name":"smokey Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/smokey@2x.png","create_date":"2012-03-14 21:29:45","update_date":"2012-03-14 21:29:45","delete_date":null},{"id":"48","content_type_id":"3","product_id":"20","name":"smokey Skin Color","data":"59,55,56","create_date":"2012-03-14 21:29:45","update_date":"2012-03-14 21:29:45","delete_date":null}]},{"id":"21","name":"Ogden Rooftop","description":"Ogden Rooftop Theme","ios_product_id":"ios.skin.vegas","android_product_id":"com.tonguetango.android.messenger.theme.vegas","create_date":"2012-03-14 21:27:25","update_date":"2012-03-14 21:27:25","delete_date":null,"purchased":"1","content":[{"id":"49","content_type_id":"5","product_id":"21","name":"ogden Skin Preview","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_vegas.png","create_date":"2012-03-14 21:29:53","update_date":"2012-03-14 21:29:53","delete_date":null},{"id":"50","content_type_id":"2","product_id":"21","name":"vegas Skin BG","data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/vegas@2x.png","create_date":"2012-03-14 21:29:53","update_date":"2012-03-14 21:29:53","delete_date":null},{"id":"51","content_type_id":"3","product_id":"21","name":"ogden Skin Color","data":"5,66,118","create_date":"2012-03-14 21:29:53","update_date":"2012-03-14 21:29:53","delete_date":null}]}]}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "products":
    [
        {
            "id":"2",
            "name":"Microphone Pack",
            "description":"Get a pack of cool Microphones",
            "ios_product_id":"ios.microphones",
            "android_product_id":"com.tonguetango.android.messenger.microphones",
            "create_date":"2012-03-14 19:19:35",
            "update_date":"2012-03-14 19:19:35",
            "delete_date":null,
            "purchased":"1",
            "content":
            [
                {
                    "id":"2",
                    "content_type_id":"6",
                    "product_id":"2",
                    "name":"Microphone 2 Preview",
                    "data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/microphones\/mock_4a_mic2.png",
                    "create_date":"2012-03-14 20:08:27",
                    "update_date":"2012-03-14 20:08:27",
                    "delete_date":null
                },

                {
                    "id":"3",
                    "content_type_id":"6",
                    "product_id":"2",
                    "name":"Microphone 3 Preview",
                    "data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/microphones\/mock_4a_mic3.png",
                    "create_date":"2012-03-14 20:08:52",
                    "update_date":"2012-03-14 20:08:52",
                    "delete_date":null
                },

                {
                    "id":"4",
                    "content_type_id":"6",
                    "product_id":"2",
                    "name":"Microphone 4 Preview",
                    "data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/microphones\/mock_4a_mic4.png",
                    "create_date":"2012-03-14 20:09:20",
                    "update_date":"2012-03-14 20:09:20",
                    "delete_date":null
                },
            ]
        },

        {
            "id":"7",
            "name":"Baseball",
            "description":"Baseball",
            "ios_product_id":"ios.skin.baseball",
            "android_product_id":"com.tonguetango.android.messenger.theme.baseball",
            "create_date":"2012-03-14 21:01:55",
            "update_date":"2012-03-14 21:01:55",
            "delete_date":null,
            "purchased":"1",
            "content":
            [
                {
                    "id":"7",
                    "content_type_id":"5",
                    "product_id":"7",
                    "name":"Baseball Skin Preview",
                    "data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_baseball.png",
                    "create_date":"2012-03-14 21:02:57",
                    "update_date":"2012-03-14 21:02:57",
                    "delete_date":null},{"id":"8",
                    "content_type_id":"3",
                    "product_id":"7",
                    "name":"Baseball Skin Color",
                    "data":"6,129,190",
                    "create_date":"2012-03-14 21:04:32",
                    "update_date":"2012-03-14 21:04:32",
                    "delete_date":null
                },

                {
                    "id":"9",
                    "content_type_id":"2",
                    "product_id":"7",
                    "name":"Baseball Skin BG",
                    "data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/baseball@2x.png",
                    "create_date":"2012-03-14 21:05:34",
                    "update_date":"2012-03-14 21:05:34",
                    "delete_date":null
                }
            ]
        },
        
        {
            "id":"8",
            "name":"Cheetah",
            "description":"Cheetah Theme",
            "ios_product_id":"ios.skin.cheetah",
            "android_product_id":"com.tonguetango.android.messenger.theme.cheetah",
            "create_date":"2012-03-14 21:06:09","update_date":"2012-03-14 21:06:09",
            "delete_date":null,
            "purchased":"1",
            "content":
            [
                {
                    "id":"10",
                    "content_type_id":"5",
                    "product_id":"8",
                    "name":"cheetah Skin Preview",
                    "data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/mock_main_cheetah.png",
                    "create_date":"2012-03-14 21:16:14",
                    "update_date":"2012-03-14 21:16:14",
                    "delete_date":null
                },

                {
                    "id":"11",
                    "content_type_id":"3",
                    "product_id":"8",
                    "name":"cheetah Skin Color",
                    "data":"109,74,43",
                    "create_date":"2012-03-14 21:16:14",
                    "update_date":"2012-03-14 21:16:14",
                    "delete_date":null
                },

                {
                    "id":"12",
                    "content_type_id":"2",
                    "product_id":"8",
                    "name":"cheetah Skin BG",
                    "data":"http:\/\/c10675695.r95.cf2.rackcdn.com\/skins\/cheetah@2x.png",
                    "create_date":"2012-03-14 21:19:05",
                    "update_date":"2012-03-14 21:19:05",
                    "delete_date":null
                }
            ]
        },

        etc...

    ]
}
                                                       </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="get_product"> Get Product  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/product/?id={id}   <br />
                                                    <br />

                                                    Method: GET<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140> id</td>
                                                                    <td>
                                                                        product primary key id
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"product":{"id":"2","name":"Microphone Pack","description":"Get a pack of cool Microphones","ios_product_id":"ios.microphones","android_product_id":"com.tonguetango.android.messenger.microphones","create_date":"2012-03-14 19:19:35","update_date":"2012-03-14 19:19:35","delete_date":null,"purchased":"1"}}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "product":
    {
        "id":"2",
        "name":"Microphone Pack",
        "description":"Get a pack of cool Microphones",
        "ios_product_id":"ios.microphones",
        "android_product_id":"com.tonguetango.android.messenger.microphones",
        "create_date":"2012-03-14 19:19:35",
        "update_date":"2012-03-14 19:19:35",
        "delete_date":null,
        "purchased":"1"
    }
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="delete_friend"> Delete friend  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/contact/delete?id={id}   <br />
                                                    <br />

                                                    Method: GET<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140> id</td>
                                                                    <td>
                                                                        user primary key id
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Please select a user to delete. </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Friendship not found </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Already removed from friends </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Database error, please try it later </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"status":"deleted"}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "status":"deleted"
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="block_user"> Block user  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/contact/block?id={id}   <br />
                                                    <br />

                                                    Method: GET<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140> id</td>
                                                                    <td>
                                                                        user primary key id
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Already blocked </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Database error, please try it later </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"status":"blocked"}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "status":"blocked"
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="unblock_user"> Unblock user  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/contact/unblock?id={id}   <br />
                                                    <br />

                                                    Method: GET<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140> id</td>
                                                                    <td>
                                                                        user primary key id
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> This user not blocked for you </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Already unblocked </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Database error, please try it later </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"status":"unblocked"}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "status":"unblocked"
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="block_list"> Block list  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/contact/block   <br />
                                                    <br />

                                                    Method: GET<br />
                                                    <br />
                                                       Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"block_list":[{"id":"1","user_id":"204","blocked_user_id":"1303","blocked":"1","create_date":"2012-09-24 11:56:55","update_date":"0000-00-00 00:00:00","delete_date":null},{"id":"3","user_id":"204","blocked_user_id":"1305","blocked":"1","create_date":"2012-09-24 11:57:05","update_date":"0000-00-00 00:00:00","delete_date":null},{"id":"4","user_id":"204","blocked_user_id":"1306","blocked":"1","create_date":"2012-09-24 11:57:09","update_date":"0000-00-00 00:00:00","delete_date":null}]}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "block_list":
    [
        {
            "id":"1",
            "user_id":"204",
            "blocked_user_id":"1303",
            "blocked":"1",
            "create_date":"2012-09-24 11:56:55",
            "update_date":"0000-00-00 00:00:00",
            "delete_date":null
        },

        {
            "id":"3",
            "user_id":"204",
            "blocked_user_id":"1305",
            "blocked":"1",
            "create_date":"2012-09-24 11:57:05",
            "update_date":"0000-00-00 00:00:00",
            "delete_date":null
        },

        {
            "id":"4",
            "user_id":"204",
            "blocked_user_id":"1306",
            "blocked":"1",
            "create_date":"2012-09-24 11:57:09",
            "update_date":"0000-00-00 00:00:00",
            "delete_date":null
        }
    ]
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="deleted_list"> Deleted friend list  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/contact/delete   <br />
                                                    <br />

                                                    Method: GET<br />
                                                    <br />
                                                       Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Deleted friends not found </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"deleted_friend_list":[{"id":"1380","user_id":"204","contact_user_id":"1319","accepted":"1","create_date":"2012-09-24 15:09:48","update_date":"2012-09-24 15:27:15","delete_date":"2012-09-24 15:27:15"}]}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "deleted_friend_list":
    [
        {
            "id":"1380",
            "user_id":"204",
            "contact_user_id":"1319",
            "accepted":"1",
            "create_date":"2012-09-24 15:09:48",
            "update_date":"2012-09-24 15:27:15",
            "delete_date":"2012-09-24 15:27:15"
        }
    ]
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="undelete_friend"> Undelete friend  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/contact/undelete?id={id}   <br />
                                                    <br />

                                                    Method: GET<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140> id</td>
                                                                    <td>
                                                                        user primary key id
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Please set variable ID </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Database error, please try it later </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"status":"success"}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "status":"success"
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="block_group"> Block group  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/group/block?id={id}   <br />
                                                    <br />

                                                    Method: GET<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140> id</td>
                                                                    <td>
                                                                        group primary key id
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Request Header Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140>  token</td>
                                                                    <td> device token  </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        Errors:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Code </td> <td> Description </td></tr>
                                                            </thead>
                                                            <tbody> 
                                                                <tr>
                                                                    <td width=140> 401 </td>
                                                                    <td> Invalid Auth Token! </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> Please enter group id </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> You not joined to group </td>         
                                                                </tr>

                                                                <tr>
                                                                    <td width=140> 0 </td>
                                                                    <td> You have already blocked group </td>         
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br />
                                                        <br />
                                                    
                                                    Output as JSON: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        {"status":"success"}
                                                    </div>  
                                                    <br/>
                                                    <br/>
                                                    Output Formatted: <br/>
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        <pre>
{
    "status":"success"
}
                                                        </pre>
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                            <!--- Begin class=box-element --->
                                            <div class="box-element">       
                                                <div class="box-head-light">
                                                    <h3 style='cursor:pointer;' id ="forgot_passwd"> Forgot Password  </h3></div>
                                                <div class="box-content">

                                                    API URL: <br />

                                                    http://playground.brians.com/tango/forgot   <br />
                                                    <br />

                                                    Method: POST<br />
                                                    <br />
                                                    Parameters:
                                                        <br />

                                                        <table cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'>        
                                                            <thead>
                                                                <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Optional</td></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width=140> email</td>
                                                                    <td>
                                                                        email address to forgot password
                                                                    </td>
                                                                    <td width='80'>NO  </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                    
                                                    Output as HTML: <br />
                                                    <div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
                                                        Okay.  You're good to go, and will receive an email presently. Go check it!
                                                    </div>  

                                                </div>
                                            </div>
                                            <!--- End class=box-element --->

                                        </div>	


                                    </body>
                                    </html>
