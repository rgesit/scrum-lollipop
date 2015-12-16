<html>
<div id="last-decomposition"><?= str_replace(['<div id="result">','</div'],"",file_get_contents("/data/project/lollipop/last.txt")) ?></div>
<form action="/primeFactors/ui" method="post" id="title" title="title">
	<div id="title">Title</div><br>
	<div id="invitation">invitation</div><br>
	Number : <input type="text" name="number" id="number">
	<button name="go" id="go" value="go">go</button>
</form>
</html>