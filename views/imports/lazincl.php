<?php
	foreach ($GLOBALS["views"]["styles"] as $file)
	{
		echo "<script type=\"text/javascript\">incl_style(\"$file\");</script>";
	}

	foreach ($GLOBALS["views"]["scripts"] as $file)
	{
		echo "<script type=\"text/javascript\" src=\"$file\"></script>";
	}
?>