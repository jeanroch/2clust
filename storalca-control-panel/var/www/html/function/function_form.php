<?php

/* -----------------------------------
function to display the html menu volume disk
------------------------------------*/
function display_htmlmenu_lv()
{
	// first line empty
	echo '<option value="">- - - - - - -';

        $command = "/usr/bin/sudo /usr/local/bin/alca_disk_lvsize";
        unset($values);
        exec($command, $values, $return_code);
        for ($i = 0; $i < count($values); $i++)
        {
		$ligne = explode(" ", $values[$i]);
		// $ligne[0] = name of the volume
		// $ligne[1] = size of the volume
		echo "<option value=$ligne[0]>$ligne[0] | $ligne[1]";
	}
}


/* -----------------------------------
function to display the html menu VM template
------------------------------------*/
function display_htmlmenu_template()
{
	// first line empty
	echo '<option value="">- - - - - - -';

	$command = "/usr/bin/sudo /usr/local/bin/alca_server_vm_list_template";
	unset($values);
	exec($command, $values, $return_code);
	foreach ($values as &$result)
	{
		echo "<option value="."$result".">"."$result";
	}
}

/* -----------------------------------
function to display the html menu VM list
------------------------------------*/
function display_htmlmenu_vm()
{
	// first line empty
	echo '<option value="">- - - - - - -';

        $command = "/usr/bin/sudo /usr/local/bin/alca_server_vm_list";
        unset($values);
        exec($command, $values, $return_code);
        for ($i = 0; $i < count($values); $i++)
        {
		$ligne = explode(" ", $values[$i]);
		if ($ligne[5] != "")
		{
			// $ligne[0] = host server number
			// $ligne[2] = vm name
			echo "<option value=\"$ligne[0]§$ligne[2]§$ligne[3]§$ligne[5]\">$ligne[2] & $ligne[5]";
		}
		else
		{
			echo "<option value=\"$ligne[0]§$ligne[2]\">$ligne[2]";
		}
	}
}
