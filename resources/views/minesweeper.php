<html>
<head>
	
	<script type="text/javascript">	
	function load(){
    	
    	for(var i=0; i<= 7; i++){
    		for(var j=0; j<= 7; j++){
    			cell = 'cell-'+(i+1)+'x'+(j+1);
                    document.getElementById(cell).setAttribute('data-bomb', document.grid[i][j]);
    		}
    	}
	}

	function play(r, c){
		cell = 'cell-'+r+'x'+c;
		value = document.getElementById(cell).innerHTML;

		if (checkBomb(cell)){
			document.getElementById(cell).className = 'lost';
		}else{
		    document.getElementById(cell).className = 'safe';                         
            document.getElementById(cell).innerHTML = checkBombAround(r, c);
		}		 
    }

    function checkBomb(cell){
		//cell = 'cell-'+row+'x'+cell;
		if(document.getElementById(cell).className == 'bomb' || 
			document.getElementById(cell).innerHTML.trim() == 'bomb' || 
			document.getElementById(cell).getAttribute('data-bomb') == 'bomb'){
			return true;
		}else{
			return false;
		}
    }
    
    function checkBombAround(row, cell){
    	var bombs = 0;
    	for(var i=row-1; i<= row+1; i++){
    		for (var j=cell-1; j<= cell+1; j++){
    			if(checkBomb(i, j)){
    				bombs++;
    			}
    		}
    	}
    	return 3;
    	return bombs;
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
</body>
</html>