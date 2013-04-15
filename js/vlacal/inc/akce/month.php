<?php
	include('vars.php');
    
    MySQL_Connect("mysql.ic.cz", "ic_airsoft_mnise", "q)<p[1hxU5kB-KC-ai");
    MySQL_select_DB("ic_airsoft_mnisek");
    Mysql_Query("SET CHARACTER SET utf8");
    
    $global_page_calendary = array();
    $sql_sel = mysql_query("SELECT nazev, datum FROM diary ORDER BY time ASC");
    while($sel = mysql_fetch_array($sql_sel)){
        $key = mktime(1,1,1, Date('m', $sel['datum']), Date('d', $sel['datum']), Date('Y', $sel['datum']));
        $global_page_calendary[$key] = (array_key_exists($key, $global_page_calendary)) ? "Akce: ".$global_page_calendary[$key].", ".$sel['nazev'] : "Akce: ".$sel['nazev'];
    }
	
	$start_monday	= $_POST['startMonday'] ? true : false;
	$picker			= $_POST['picker'] ? true : false;	
	
	if($_POST['pickedDate'] && $_POST['pickedDate'] != 'null') {
		$pickedDateAr = explode('/', $_POST['pickedDate']);
		$pickedDate	  = @mktime(1, 1, 1, $pickedDateAr[1], $pickedDateAr[0], $pickedDateAr[2]);
	} else {
		$pickedDate   = mktime(1, 1, 1, date('n'), date('j'), date('Y'));
	}
	
	if($_POST['gotoPickedDate']) $ts = $_POST['ts'] ? $_POST['ts'] : mktime(1, 1, 1, date('n', $pickedDate), 1, date('Y', $pickedDate));
	else $ts = $_POST['ts'] ? $_POST['ts'] : mktime(1, 1, 1, date('n'), 1, date('Y'));
	
	$ts_year_full	= date('Y', $ts);
	$ts_year		= date('Y', $ts);
	$ts_month_nr	= date('n', $ts);
	$ts_month		= $month_labels[date('n', $ts)-1];
	$ts_nrodays		= date('t', $ts);
	
	$pr_ts			= mktime(1, 1, 1, $ts_month_nr-1, 1, $ts_year);
	$nx_ts			= mktime(1, 1, 1, $ts_month_nr+1, 1, $ts_year);
	
	$wdays_counter 	= date('w', $ts) - ($start_monday ? 1 : 0);
	if($wdays_counter == -1) $wdays_counter = 6;
	
	echo "<!--";
	print_r($_POST);
	echo "-->\n";
?>
<table class="month<?=($picker ? ' picker' : '')?>" cellpadding="0" summary="{'ts': '<?=$ts?>', 'pr_ts': '<?=$pr_ts?>', 'nx_ts': '<?=$nx_ts;?>', 'label': '<?=$ts_month.', '.$ts_year_full?>', 'current': 'month', 'parent': 'year'<?=($ts_year == 1979 && date('n', $ts) == 1 ? ", 'hide_left_arrow': '1'" : '').($ts_year == 2030 && date('n', $ts) == 12 ? ", 'hide_right_arrow': '1'" : '')?>}">
	<tr>
		<?php if(!$start_monday) echo '<th>'.$wdays_labels[6]."</th>\n"; ?>
		<th><?=$wdays_labels[0]?></th>
		<th><?=$wdays_labels[1]?></th>
		<th><?=$wdays_labels[2]?></th>
		<th><?=$wdays_labels[3]?></th>
		<th><?=$wdays_labels[4]?></th>
		<th><?=$wdays_labels[5]?></th>
		<?php if($start_monday) echo '<th>'.$wdays_labels[6]."</th>\n"; ?>
	</tr>
	<tr class="firstRow"><?php

	//Add days for the beginning non-month days
	for($i = 0; $i < $wdays_counter; $i++) {
		echo "<td></td>";
	}

	//Add month days
	for($i = 1; $i <= $ts_nrodays; $i++) {
		$i_ts = mktime(1, 1, 1, $ts_month_nr, $i, $ts_year);
		if(array_key_exists($i_ts, $global_page_calendary)){
            echo '<td '."date=\"{'day': '".$i."', 'month': '".$ts_month_nr."', 'year': '".$ts_year."'}\" class='tipz' title='".$global_page_calendary[$i_ts]."'><a href='./akce'>".$i.'</a></td>';
        }else{
            echo '<td '."date=\"{'day': '".$i."', 'month': '".$ts_month_nr."', 'year': '".$ts_year."'}\">".$i.'</td>';
        }
		
		if($wdays_counter == 6 && ($i - 1) != $ts_nrodays) {
			$week_num = date("W", $i_ts) + 1;
			echo "</tr>\n\t<tr>";
			$wdays_counter = -1;
			$row++;
		}
		$wdays_counter++;
	}

	//Add outside days
	$a = 1;
	if($wdays_counter != 0) {
		for($i = $wdays_counter; $i < 7; $i++) {
			echo "<td></td>";
		}
		$row++;
	}

	//Always have 6 rows
	if($row == 4 || $row == 5) {
		if($wdays_counter != 0) echo "</tr>\n\t<tr>";
		for($i = 0; $i < ($row == 5 ? 7 : 14); $i++) {
			echo "<td></td>";
			if($i == 6) echo "</tr>\n\t<tr>";
		}
	}	

?></tr>
</table>