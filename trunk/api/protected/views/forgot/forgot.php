<div class="branding">
	<img src="/images/logo.png" width="92" height="90" />
</div>

<div>
	<?php if (isset($sent)) : ?>
	<h2>Okay.  You're good to go, and will receive an email presently. Go check it!</h2>
	<?php else: ?>
	<h2>Forgot your password?  It happens to the best of us.  Let's reset it then, shall we?</h2>
	<br />
	<br />
	<p>
		<form action="/forgot" method="post">
			<label>Enter your email address: <input type='text' name="email" id='email' size="30" /></label>
			<br />
			<br />
			<input type="submit" name="forgot" value="Reset Password" />
		</form>
	</p>
	<?php endif; ?>
	
</div>
<style>
	*{
		padding:0;
		margin:0;
	}
	body { 
		text-align: center;
		background:#ffffff;
		padding:15px;
		font-family:Arial, Helvetica, sans-serif;
		color:#666;
		font-size:13px;
		line-height:21px;
	}
</style>