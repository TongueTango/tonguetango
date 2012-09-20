<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forgot Password</title>
</head>

<body style="background-color:#393939;">

<table align="center" width="100%" cellpadding="20" cellspacing="0" border="0">
	<tr>
		<td style="background:#393939;">
			<table align="center" width="600" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td><img src="http://prod.tonguetango.com/assets/images/tt_email_banner.jpg" width="600" height="90"  /></td>
				</tr>
				<tr>
					<td style="background:#ffffff;padding:15px;font-family:Arial, Helvetica, sans-serif;color:#666;font-size:13px;line-height:21px;">
						<h1>Password Reset</h1>
						
						<p>
							This email is in response to your password reset request.  Ask and you shall receive.  Here it is...
 						</p>
 						<p>
 							<?=$password;?>
 						</p>
 						<p>
 							A bit cryptic isn't it?  We suggest you change it to something more memorable once you successfully log in.
 						</p>
						<p>
							Visit us online at www.TongueTango.com to learn about all our epic features, upgrades, themes, opportunities and more.
						</p>
						<p>
							Please email us if you’ve got any comments, concerns, questions, quandaries, hassles or dilemmas. 
							On <a href='mailto:tongue@tonguetango.com'>tongue@tonguetango.com</a>
						</p>
						<p>
							Have fun with your Tongue.
						</p>
						<p>
							<a style="color:#df3f38;" href="http://www.tonguetango.com">TONGUE TANGO</a>
						</p>
					</td>
				</tr>
				<tr>
					<td style="background:#ffffff;padding:15px;font-family:Arial, Helvetica, sans-serif;color:#666;font-size:13px;line-height:21px;">
						Find us on Facebook & Twitter.
						<a href='https://www.facebook.com/TongueTango'><img src='http://prod.tonguetango.com/assets/images/facebook_16.png' /></a>
						&nbsp; &nbsp;
						<a href='https://twitter.com/#!/tonguetango'><img src='http://prod.tonguetango.com/assets/images/twitter_16.png' /></a>
					</td>
				</tr>
				<tr>
					<td style="padding-top:15px;padding-bottom:15px;font-family:Arial, Helvetica, sans-serif;color:#7e7e7e;font-size:11px;line-height:21px;">
						<p>This message was intended for: <a style="color:#df3f38;" href=""><?=$email;?></a>. 
							You are receiving this message because you are a member of Tongue Tango. 
							<!-- Adjust your email notifications <a style="color:#df3f38;" href="">here</a> 
							or <a style="color:#df3f38;" href="">unsubscribe</a> from all notifications. -->
							<br />
						Copyright &copy; 2012 Tongue Tango &trade;. All rights reserved.</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
