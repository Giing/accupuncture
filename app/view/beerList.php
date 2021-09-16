
<h1>Toutes les bières</h1>

<?php
echo "<table>";
foreach($data as $beer) {
	echo "<tr>";
	echo "<td><a href='?route=onebeer&idbeer=" . $beer->idbeer. "'>" . $beer->name . "</a></td>";
	echo "<td><a href='?route=delete'>X</a></td>";
	echo "</tr>";
}
echo "</table>";


