<?php

function print_chart($filename, $language, $letters)
{
	$lookup=file("tables/".$filename);
	for ($x=0; $x<count($lookup); $x++) {$lookup[$x]=explode(',', $lookup[$x]);}
	$x = $lookup[0][0]; $y = $lookup[0][1]; $k=1;
	$name = ucfirst(str_replace(".txt", "", $filename));
	print('<table id="'.$name.'" title="'.$name.'">');
	print('<tr>'); $k+=2;
	print('<th></th>');
	for ($i=0; $i<(($x/2)); $i++){
		$caption=str_replace("http://en.wikipedia.org/wiki/", "", $lookup[$k][2]); $caption=str_replace("_", " ", $caption); $caption=ucwords($caption);
		print('<th colspan="2"><input type="checkbox" checked="checked" style="display: none;" name="place" value="'.$i.'" onchange="toggle(\''.$name.'\', this, 1)"><a title="'.$caption.'" onclick="totoggle(this)" >'.$lookup[$k][1].'</a></input></th>'); $k++;}
	print('</tr>');
	for ($j=0; $j<$y; $j++){
		print('<tr>');
		$caption=str_replace("http://en.wikipedia.org/wiki/", "", $lookup[$k][2]); $caption=str_replace("_", " ", $caption); $caption=ucwords($caption);
		$lookup[$k][3]=substr($lookup[$k][3], 0, strlen($lookup[$k][3])-1);
		print("<th title='".$caption."'  class='side' id='".$lookup[$k][1]."'><input type='checkbox' checked='checked' style='display: none;' name='manner' value=".($j+2)." onchange='toggle(\"".$name."\", this, 2)'><a title='".$caption."' onclick='totoggle(this)'>".$lookup[$k][1]."</a></input></th>"); $k++;
		for ($i=1; $i<$x+1; $i++){
			if ($lookup[$k][1] != ''){
				if ($letters){
					if (array_search($lookup[$k][1], $letters)){
						$caption=str_replace("http://en.wikipedia.org/wiki/", "", $lookup[$k][2]);
						$caption=str_replace("_", " ", $caption);
						$caption=ucwords($caption);
						if ($lookup[$k][4] != '') {$caption .= " (".$lookup[$k][4].")";}
						$lookup[$k][5]=substr($lookup[$k][5], 0, strlen($lookup[$k][5])-1);
						print("<td title='".$caption."' id='".$lookup[$k][1]."'><a title='".$caption."' target='_blank' onmouseover='display(".$lookup[$k][1].")' onmouseout='display(\"\")' class=sound ondblclick='ipaappend(".$lookup[$k][1].")'>".$lookup[$k][1]."</a>");
						if ($lookup[$k][3] != "") {print('<audio id="'.$lookup[$k][3].'" src="'.$lookup[$k][3].'" preload=none></audio>');}
						print("</td>");}
					else {print("<td></td>");}}
				else if ($language = "all"){
					$caption=str_replace("http://en.wikipedia.org/wiki/", "", $lookup[$k][2]);
					$caption=str_replace("_", " ", $caption);
					$caption=ucwords($caption);
					if ($lookup[$k][4] != '') {$caption .= " (".$lookup[$k][4].")";}
					$lookup[$k][5]=substr($lookup[$k][5], 0, strlen($lookup[$k][5])-1);
					print("<td title='".$caption."' id='".$lookup[$k][1]."'><a title='".$caption."' target='_blank' onmouseover='display(".$lookup[$k][1].")' onmouseout='display(\"\")' ondblclick='ipaappend(".$lookup[$k][1].")'>".$lookup[$k][1]."</a>");
					if ($lookup[$k][3] != "") {print('<audio id="'.$lookup[$k][3].'" src="'.$lookup[$k][3].'" preload=none></audio>');}
					print("</td>");}
			}else {print("<td></td>");}$k++;
		}print('</tr>');
	}print("</table>");
	print("<table id='".$lookup[1][0]."' class=sub><tr><th><input type='checkbox' checked='checked' style='display: none;' name='".$lookup[1][0]."' value='1' onchange='toggle(\"".$name."\", this, 3)'><a title='".$lookup[1][1]."' onclick='totoggle(this)'>".$lookup[1][1]."</a></input></th><th><input type='checkbox' checked='checked' style='display: none;' name='voice' value='2' onchange='toggle(\"".$name."\", this, 3)'><a title='".$lookup[1][2]."' onclick='totoggle(this)'>".$lookup[1][2]."</a></input></th></tr></table>");
}

function language_select($file, $language)
{
	print("<form method='get' action=''>");
	print("<select name='language' id='language' onchange='clicksubmit()'>"); 
	print("<option value='all'"); if ($language != $file) {print(" selected='true'");} else {print("");} print(">All</option>");
	$dir = "languages"; $number = 0;
	if (is_dir($dir)) {if ($dh = opendir($dir)) 
		{while (($file = readdir($dh)) !== false) 
			{if ($file == "." || $file == ".." || substr($file, 0, 1) == ".") {continue;}
			$name = str_replace(".txt", "", $file);
			print("<option value='".$name."'"); if ($language == $name) {print(" selected='true'");} else {print("");} print(">".ucfirst($name)."</option>");}}}
	print("</select>");
	print("<input id='changelanguage' style='display: none;' type='submit' />");
	print("</form>");
}

if ($_POST["mode"] == 1)
{

}
if ($_POST["mode"] == 2)
{

}

?>