<html>
<head>
	
	<script type="text/javascript">	
	function load(){

    	for (var i =1; i<=8; i++){    		
    		for(var j=1; j<=8; j++){
    			//document.getElementById("cell-"+i+"x"+j).innerHTML = data[i-1][j-1];
    		}
    	}
	}

	function play(row, cell){
		cell = 'cell-'+row+'x'+cell;
		value = document.getElementById(cell).innerHTML;
			console.log(value.trim());
		
		if(document.getElementById(cell).innerHTML.trim() == 'bomb'){
			document.getElementById(cell).className = 'lost';		
		}else{
			console.log('Gak ada');
		}

		 if (document.getElementById(cell).getAttribute('data-bomb') == 'bomb') {
                document.getElementById(cell).className = 'lost';
            } else {
                //document.getElementById('cell-'+x+'x'+y).className = 'safe';
                //numBomb = checkSurroundings(x,y);
                //document.getElementById('cell-'+x+'x'+y).innerHTML = numBomb;
            }

	}
	</script>
</head>
<body>
<label id="title">Minesweeper</label>
<table border="1" class="grid">
<?php for($i = 1; $i<=8; $i++) :?>	
	<tr>
	<?php for($j = 1; $j<=8; $j++) :?>
		<td onclick="play(<?php echo $i ?>, <?php echo $j ?>)"  id="cell-<?php echo $i ?>x<?php echo $j?>" class="">
		</td>
	<?php endfor ?>
	</tr>
<?php endfor ?>
</table>

<script type="text/javascript">
//		load();
</script>
</body>
</html>