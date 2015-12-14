<!DOCTYPE html>
<html>
<head>
	<title>Lollipop - Astroport</title>
</head>
<body>
	<div id="astroport-name">

		<h1>Lollipop</h1>

		<h3>Ship</h3>
		<p id="gate-1">
			<a href="/astroport/ship-1" id="ship-1">An element that will display the name of the ship docked at gate 1</a>
		</p>
		<p id="gate-2">
			<a href="/astroport/ship-2" id="ship-2">An element that will display the name of the ship docked at gate 2</a>
		</p>
		<p id="gate-3">
			<a href="/astroport/ship-3" id="ship-3">An element that will display the name of the ship docked at gate 3</a>
		</p>

	</div>


	<br>
	<label for="shipname">Ship</label>
	<input type="text" name="ship" id="ship">
	<button id="dock" onclick="setName()">Dock</button>

	<script type="text/javascript">

	function setName() {
		var name = document.getElementById('ship').value;

		document.getElementById('ship-1').innerHTML = name;
	}

	</script>
</body>
</html>