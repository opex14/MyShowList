<?php
if (!empty($_GET['title'])) {
	$title = urlencode($_GET['title']);
	$banr = 'http://thetvdb.com/banners/';
	$url='http://thetvdb.com/api/GetSeries.php?seriesname='.$title;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents

	$data = curl_exec($ch); // execute curl request
	curl_close($ch);

	$xml = simplexml_load_string($data);
?>
<table class="table table-condensed table-hover">
<thead>
<tr>
<th>Название</th>
<th>Год</th>
<th>Описание</th>
</tr>
</thead>
<tbody>
<?php 
foreach ($xml->Series as $series) {
	$addurl = 'instruments/metamanager.php?service=tvdb&action=add&id='.$series->seriesid;
	echo '<tr> <td><a href="'.$addurl.'">'.$series->SeriesName.'</a></td> <td>'.substr($series->FirstAired, 0, 4).'</td> <td>'.$series->Overview.'</td> </tr>';
}
?>
</tbody>
</table>
<?php
}
?>
