		
		<div class="mp-eventarea">
			<h3> Eventos en <?php echo"$Loc";?> </h3>
			
			<div class="mp-event-results" >
			
			<table> <tr>
			<?php
				setlocale(LC_ALL,"es_ES");
				$hoy = strftime("%u");
				echo"";
				$result = mysql_query("SELECT id_evento, costo, Evento.categoria, poster_url, Establecimiento.id_establecimiento, Evento.nombre, DATE_FORMAT(fecha,'%b %e') as fecha_i, DATE_FORMAT(hora_inicio,'%H:%i') as hora_inicio_i, DATE_FORMAT(hora_termina,'%H:%i') as hora_termina, Establecimiento.nombre as nombre_lugar FROM Evento, Establecimiento WHERE Establecimiento.id_establecimiento = Evento.id_establecimiento AND fecha >= CURDATE() AND (Evento.zona='$Loc' OR Evento.ciudad='$Loc')   ORDER BY fecha ASC, hora_inicio ASC limit 20");
				while($row = mysql_fetch_array($result)) 
				{echo " <td> 
				<a href='../evento/?id=".$row{'id_evento'}."&loc=$Loc'> 
					<div class='mp-event-results-logo' style='background:  white url(".$row{'poster_url'}.") no-repeat center; background-size: auto 14vw;'>
					</div> 
				</a>
				<br>
				<div class='mp-event-results-title'>
					<b> <a href='../evento/?id=".$row{'id_evento'}."&loc=$Loc'>".$row{'nombre'}."  </a> </b>
					<i> <a href='../evento/?id=".$row{'id_evento'}."&loc=$Loc'>".$row{'categoria'}."</a> </i>
					<br>					
					
					<a href='../evento/?id=".$row{'id_evento'}."&loc=$Loc'>".$row{'fecha_i'}." ".$row{'hora_inicio_i'}."</a> &middot; <a href='../evento/?id=".$row{'id_evento'}."'>".$row{'costo'}."</a>
					<br>
					<a href='../biz/?id=".$row{'id_establecimiento'}."&loc=$Loc'>".$row{'nombre_lugar'}."</a>
				</div>
				</td>";}
					?> 


			</tr></table>

        </div>
       </div>