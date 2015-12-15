<!DOCTYPE html>
<html>
<head>
	<title>Lollipop - Astroport</title>
</head>
<body>
	<div id="astroport-name">

		<h1>Lollipop</h1>

		<h3>Ship</h3>
		<p id="gate-1" class="free">
			<a href="/astroport/ship-1" id="ship-1">An element that will display the name of the ship docked at gate 1</a>
		</p>
		<p id="gate-2" class="free">
			<a href="/astroport/ship-2" id="ship-2">An element that will display the name of the ship docked at gate 2</a>
		</p>
		<p id="gate-3" class="free">
			<a href="/astroport/ship-3" id="ship-3">An element that will display the name of the ship docked at gate 3</a>
		</p>

	</div>


	<form method="post" action="" onsubmit="setName();return false;">
		<label for="shipname">Ship</label>
		<input type="text" name="ship" id="ship" onkeypress="setInput()" onfocus="setInput()">
		<button id="dock">Dock</button>
	</form>

	<a id="info" class="hidden"></a>

	<script type="text/javascript">
	function setName() {
		var name = document.getElementById('ship').value;

		document.getElementById('ship-1').innerHTML = name;

		document.getElementById('info').innerHTML = "";

		if (document.getElementById('gate-1').className == 'free') {
			document.getElementById('gate-1').className = "occupied";
			document.getElementById('info').innerHTML = "The Ship has been docked at gate 1";
			document.getElementById('info').className = "";
			document.getElementById('ship').value = "";
		} else if (document.getElementById('gate-1').className == 'occupied') {
			document.getElementById('info').className = "";
			document.getElementById('info').className = "hidden";
		}
	}
	function setInput()
	{
		document.getElementById('info').innerHTML = "";
		document.getElementById('info').className = "";
		document.getElementById('info').className = "hidden";
	}
	</script>
</body>
</html>