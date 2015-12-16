<html>
<head>
	
	<script type="text/javascript">	
	function load(){
	  data = [
	        ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
	        ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
	        ['empty', 'empty', 'empty', 'empty', 'empty', 'bomb' , 'empty', 'empty'],
	        ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
	        ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
	        ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
	        ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
	        ['empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty', 'empty'],
	    ];
    	
    	for(var i=0; i<= 7; i++){
    		for(var j=0; j<= 7; j++){
    			cell = 'cell-'+(i+1)+'x'+(j+1);
				document.getElementById(cell).className = data[i][j];      
    		}
    	}
	}

	function play(row, cell){
		cell = 'cell-'+row+'x'+cell;
		value = document.getElementById(cell).innerHTML;

		if(document.getElementById(cell).className == 'bomb' || 
			document.getElementById(cell).innerHTML.trim() == 'bomb' || 
			document.getElementById(cell).getAttribute('data-bomb') == 'bomb'){
			document.getElementById(cell).className = 'lost';		
		}  else {
                document.getElementById(cell).className = 'safe';         
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
		dsfsdsf
		</td>
	<?php endfor ?>
	</tr>
<?php endfor ?>
</table>
<script type="text/javascript">
	
//load();

</script>
</body>
</html>