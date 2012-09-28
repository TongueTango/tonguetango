<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <title>Tongue Tango - Api</title>

        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <link rel="stylesheet" href="css/table.css"> 
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/v2.css">
        <script src="jquery-1.7.2.js"></script>
        <script src="prettyprint.js"></script>        
        
        <script>
        var currentTarget = "";
        var currentRaw	  = "";
        function example(name)
        {	    
        	currentTarget = $("#output_" + name);
        	currentRaw = $("#raw_" + name);
        	currentRaw.html("..loading..");
        	currentTarget.html("..loading..");
	        var link = $("#example_" + name).val();
	        $.ajax({
		       type:		"GET",
		       url:			"api_raw.php",
		       data:		{ raw : link }
	        }).done(function(output){
		        currentRaw.html(output);
	        });
	        
	        $.ajax({
		       type:		"GET",
		       url:			link,
		       processData: false,
	        }).done(function(output){
		        console.log("Output = ", output);
	        	if (typeof(output) == "object")
	        	{
		        	var txt = "Received JSON Object:\n<br/>";
		        	txt = prettyPrint( output );
		        	currentTarget.html(txt);		        	
	        	} else {
			       currentTarget.text("Raw output: " + output);
			    }
	        }).fail(function(obj, output)
	        {
		       currentTarget.text("FAILED: " + output); 
	        })
        }

        function exampleWithFile(name)
        {
        	currentTarget = $("#output_" + name);
        	currentRaw = $("#raw_" + name);
        	currentRaw.html("..loading..");
        	currentTarget.html("..loading..");
        	var link = $("#example_" + name).val();
        	var method = $("#method_" + name).text();
	        $.ajax({
		       type:		method,
		       url:			"api_raw.php",
		       data:		{ raw : link }
	        }).done(function(output){
		        currentRaw.html(output);
	        });
	        
	        $.ajax({
		       type:		method,
		       url:			link,
		       processData: false,
	        }).done(function(output){
		        console.log("Output = ", output);
	        	if (typeof(output) == "object")
	        	{
		        	var txt = "Received JSON Object:\n<br/>";
		        	txt = prettyPrint( output );
		        	currentTarget.html(txt);		        	
	        	} else {
			       currentTarget.text("Raw output: " + output);
			    }
	        }).fail(function(obj, output)
	        {
		       currentTarget.text("FAILED: " + output); 
	        })
        }
        
        function change(name)
        {
	        console.log("CHANGE", name);
        }
        </script>
        
    </head>
<body>

<a name='top'>

<div style="margin: 10px;">

	<div id='all_api_list' style="padding-top: 20px; padding-bottom: 20px; line-height: 18px;">
	</div>

<?php

$CurrentLink = "";
$InitialLink = "";
$CurrentName = "";
$Number		 = 0;
$PList = array();
$CompleteList = "";
	
function StartHelp($title, $url, $method='GET')
{
	global $CurrentLink, $CurrentName, $PList, $InitialLink, $Number, $CompleteList;
	
	$PList = array();
	$CurrentLink = "http://apiv2.tonguetango.com/" . $url . "?";
	$InitialLink = $CurrentLink;
	$CurrentName = preg_replace("/[^a-zA-Z0-9]/", "X", $url) . $Number++;
	
	$CompleteList .= "Jump to <a href='#" . $CurrentName . "'> $url </a> -- $title  <br />";
	
	?>
	<a name='<?=$CurrentName?>' />
	<div class="box-element">	    
    <div class="box-head-light">
    	<h3 style='cursor:pointer;'> <?=$title?> </h3></div>
	    <div class="box-content">
	    
	    API URL: <br />
	    http://apiv2.tonguetango.com/<?=$url?>
	    <br />
	    Method: <span id="method_<?= $CurrentName ?>"><?= $method ?></span>
	    <br />
	<?php
}

function StartParams()
{
	?>
	    <br />
	    Parameters:
	    <br />
	    
	    <table width='100%' cellpadding="4" cellspacing="0" border='1' bordercolor='#808080'> 	    
	    <thead>
	    <tr bgcolor="#eeeeee"><td> Field name </td><td> Description </td><td>Example</td>
	    <td>Req</td></tr>
	    </thead>
	    <tbody>	
	<?php
}

function EndParams($withFile = false)
{
	global $CurrentLink;
	
	?>
		    </tbody>
	    </table>
	<br />
	<?php
	
	ShowExample("Example call", $CurrentLink, $withFile);
}

function Parameter($name, $description, $example, $optional)
{
	global $CurrentLink, $CurrentName, $PList;
	$CurrentLink .= urlencode($name) . "=" . urlencode($example) . "&";
	$PList[] = $name;
	
	?>
	<tr>
	<td width=140> <?=$name ?></td>
	<td> <?=$description?> </td>
	<td width='210'> <input id='input_<?=$CurrentName?>_<?=$name?>' size='40' onkeyup='change_<?=$CurrentName?>();' value='<?=$example?>'> </td>
	<td width='30'> <?=($optional ? "" : "*")?> </td>
	</tr>
	<?php	
}

function EndHelp()
{
	global $CurrentLink, $CurrentName, $PList, $InitialLink;
	
	?>
		<a href='#top'>go to top</a>
		</div>
	</div>
	<br />	
	<script type="text/javascript">
	function change_<?=$CurrentName?>()
	{
		var link = '<?=$InitialLink?>';
		<?php
		foreach ($PList as $name)
		{
			?>
			link += "<?=$name?>=" + escape($("#input_<?=$CurrentName?>_<?=$name?>").val()) + "&";
			<?php
		}
		?>
		$("#example_<?=$CurrentName?>").val(link);
	}
	</script>
	
	<?php
}

function ShowExample($description, $url, $withFile = false)
{
	global $CurrentName;
	
	?>
	<br />
	<?=$description?> <br/>
	<textarea id='example_<?=$CurrentName?>' style='font-family: Courier New' rows=4 cols=90><?=$url?></textarea>
	<br/>
	<input type='button' id='button_<?=$CurrentName?>' onClick='<?= ($withFile) ? 'exampleWithFile' : 'example' ?>("<?=$CurrentName?>");' value='Execute'> <br/>
	<br/>
	<div id='raw_<?=$CurrentName?>' style='font-family: courier new; font-size: 10pt;'>
	</div>	
	<br/>	
	<div id='output_<?=$CurrentName?>' style='font-family: courier new; font-size: 10pt;'>
	</div>
	<br />
	<?php	
}

function ShowJson($link)
{
	$a = microtime(1);
	$output = file_get_contents($link);
	$b = microtime(1);	
	$c = $b - $a;
	$c = number_format($c*1000, 2);
	
	$format = print_r(json_decode($output), 1);
	$format = str_replace("stdClass Object", "", $format);
	?>
	<br/>
	Output as JSON (took <?=$c?> ms to collect from server): <br />
	<div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
	<?=$output?>
	</div>	
	<br/>
	<br/>
	Output Formatted: <br/>
	<div style="background-color: #ffffff; margin-top: 6px; padding: 10px; text-shadow: 0; font-family: courier new, courier; border: 1px solid #bbbbbb;">
		<pre><?=$format?></pre>
	</div>	
	<?php
}

function Finished()
{
	global $CompleteList;
	?>
	
	<script>
	$("#all_api_list").html("<?=($CompleteList)?>");
	</script>
	
	<?php
}