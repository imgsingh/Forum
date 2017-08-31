<?php
//This page let users sign up
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Sign Up</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/logo.png" alt="Espace Membre" /></a>
	    </div>
<?php
if(isset($_POST['username'], $_POST['rollno'], $_POST['finalyear'] , $_POST['password'] , $_POST['passverif'], $_POST['email'], $_POST['avatar']) and $_POST['username']!='')
{
	if(get_magic_quotes_gpc())
	{
		$_POST['username'] = stripslashes($_POST['username']);
		$_POST['rollno'] = stripslashes($_POST['rollno']);
		$_POST['finalyear'] = stripslashes($_POST['finalyear']);
		$_POST['password'] = stripslashes($_POST['password']);
		$_POST['passverif'] = stripslashes($_POST['passverif']);
		$_POST['email'] = stripslashes($_POST['email']);
		$_POST['avatar'] = stripslashes($_POST['avatar']);
	}
	if($_POST['password']==$_POST['passverif'])
	{
		if(strlen($_POST['password'])>=6)
		{
			if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
			{
				if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['rollno']))
				{
				$username = mysql_real_escape_string($_POST['username']);
				$rollno = mysql_real_escape_string($_POST['rollno']);
				$finalyear = mysql_real_escape_string($_POST['finalyear']);
				$password = mysql_real_escape_string(sha1($_POST['password']));
				$email = mysql_real_escape_string($_POST['email']);
				$avatar = mysql_real_escape_string($_POST['avatar']);
				$dn = mysql_num_rows(mysql_query('select id from users where username="'.$username.'"'));
				if($dn==0)
				{
					$dn2 = mysql_num_rows(mysql_query('select id from users'));
					$id = $dn2+1;
					if(mysql_query('insert into users(id, username, rollno, finalyear, password, email, avatar, signup_date) values ('.$id.', "'.$username.'", "'.$rollno.'","'.$finalyear.'" , "'.$password.'", "'.$email.'", "'.$avatar.'", "'.time().'")'))
					{
						$form = false;
?>
<div class="message">You have successfully been signed up. You can now log in.<br />
<a href="login.php">Log in</a></div>
<?php
					}
					else
					{
						$form = true;
						$message = 'An error occurred while signing you up.';
					}
				}
				else
				{
					$form = true;
					$message = 'Another user already use this username.';
				}
			}
			else
				{
					$form = true;
					$message = 'Rollno already exists.';
				}
			}
			
			else
			{
				$form = true;
				$message = 'The email you typed is not valid.';
			}
		}
		else
		{
			$form = true;
			$message = 'Your password must have a minimum of 6 characters.';
		}
	}
	else
	{
		$form = true;
		$message = 'The passwords you entered are not identical.';
	}
}
else
{
	$form = true;
}
if($form)
{
	if(isset($message))
	{
		echo '<div class="message">'.$message.'</div>';
	}
?>
<div class="content">
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; Sign Up
    </div>
	<div class="box_right">
    	<a href="signup.php">Sign Up</a> - <a href="login.php">Login</a>
    </div>
    <div class="clean"></div>
</div>
    <form action="signup.php" method="post">
        Please fill this form to sign up:<br />
        <div class="center">
            <label for="username">Username</label><input type="text" name="username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <label for="rollno">Roll No<span class="small">(Uni Rollno)</span></label><input type="rollno" name="rollno" /><br />
            <label for="finalyear">Final year<span class="small">(finalyear)</span></label>
                <select id="finalyear" name="finalyear">
    	<option value="2019">2019</option>
    	<option value="2018">2018</option>
    	<option value="2017">2017</option>
    	<option value="2016">2016</option>
    	<option value="2015">2015</option>
    	<option value="2014">2014</option>
    	<option value="2013">2013</option>
    	<option value="2012">2012</option>
    	<option value="2011">2011</option>
    	<option value="2010">2010</option>
    	<option value="2009">2009</option>
    	<option value="2008">2008</option>
    	<option value="2007">2007</option>
    	<option value="2006">2006</option>
    	<option value="2005">2005</option>
    	<option value="2004">2004</option>
    	<option value="2003">2003</option>
    	<option value="2002">2002</option>
    	<option value="2001">2001</option>
    	<option value="2000">2000</option>
    	<option value="1999">1999</option>
    	<option value="1998">1998</option>
    	<option value="1997">1997</option>
    	<option value="1996">1996</option>
    	<option value="1995">1995</option>
    	<option value="1993">1993</option>
    	<option value="1992">1992</option>
    	<option value="1991">1991</option>
       </select><br />
            <label for="password">Password<span class="small">(6 characters min.)</span></label><input type="password" name="password" /><br />
            <label for="passverif">Password<span class="small">(verification)</span></label><input type="password" name="passverif" /><br />
            <label for="email">Email</label><input type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <label for="avatar">Avatar<span class="small">(optional)</span></label><input type="text" name="avatar" value="<?php if(isset($_POST['avatar'])){echo htmlentities($_POST['avatar'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <input type="submit" value="Sign Up" />
		</div>
    </form>
</div>
<?php
}
?>
	</body>
</html>
