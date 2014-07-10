<?php
function GetTable($objGen) {
	switch($_SESSION["sys_glv"]){
		case "primaria": ?>
				<table  id="table1" class="gtable ">
					<thead>
						<tr>
							<td style="width:50px;">Codigo</td>
							<td style="width:300px;">Nombre</td>
							<td style="width:10px;">Act1</td>
							<td style="width:10px;">Act2</td>
							<td style="width:10px;">Act3</td>
							<td style="width:10px;"><b>50%</b></td>
							<td style="width:10px;">Exam.</td>
							<td style="width:10px;"><b>50%</b></td>
							<td style="width:10px;"><b>NF</b></td>
                                                        <td style="width:150px;"><b>Observaci&oacute;n</b></td>	
						</tr>
					</thead>
					 <tbody>
						<?php
						$alum = $objGen->getAlumxGra();
                                            if(count($alum)> 0) {
                                                for ($i = 0; $i < count($alum); $i++):
						    ?>
						    <tr>
						        <td><?php echo $alum[$i]['code']; ?><input type="hidden" name="ida[]" value="<?php echo $alum[$i]['id']; ?>" /></td>
						        <td><?php echo $alum[$i]['nombre'] . ' ' . $alum[$i]['apellido']; ?></td>
						        <!--<td><input type="text" name="act1[]" size="1" value="<?php echo $alum[$i]['ac1'];?>" maxlength="4" onkeypress="javascript:_calculate_('#act1-'+<?php echo $alum[$i]['code'];?>);" id="#act1-+<?php echo $alum[$i]['code'];?>"/></td>-->
						        <td><input type="text" name="act1[]" size="1" value="<?php echo $alum[$i]['ac1'];?>" maxlength="4" /></td>
                                                        <td><input type="text" name="act2[]" size="1" value="<?php echo $alum[$i]['ac2'];?>" maxlength="4"/></td>
						        <td><input type="text" name="act3[]" size="1" value="<?php echo $alum[$i]['ac3'];?>" maxlength="4"/></td>
						        <td><b><?php echo $alum[$i]['acPr'];?></b></td>
						        <td><input type="text" name="exam[]" size="1" value="<?php echo $alum[$i]['exam'];?>" maxlength="4"'/></td>
						        <td><b><?php echo $alum[$i]['exampro'];?></b></td>
						        <td><b><?php echo $alum[$i]['promedio'];?></b><input type="hidden" name="opt" value="update"/> </td>
                                                        <td><b><input type="text" name="obser[]" value="<?php echo $alum[$i]['observacion'];?>"/></td>
						    </tr>
                                             <?php 
                                                endfor; 
                                            }else{ 
                                                $alum2 = $objGen->getAlumxGraxNotas();
                                                for ($i = 0; $i < count($alum2); $i++): ?>
                                                    <tr>
                                                        <td><?php echo $alum2[$i]['code']; ?><input type="hidden" name="ida[]" value="<?php echo $alum2[$i]['id']; ?>" /></td>
                                                        <td><?php echo $alum2[$i]['nombre'] . ' ' . $alum2[$i]['apellido']; ?></td>
                                                        <td><input type="text" name="act1[]" size="1" maxlength="4"/></td>
						        <td><input type="text" name="act2[]" size="1" maxlength="4"/></td>
						        <td><input type="text" name="act3[]" size="1" maxlength="4"/></td>
						        <td><b>0</b></td>
						        <td><input type="text" name="exam[]" size="1" maxlength="4"'/></td>
						        <td><b>0</b></td>
                                                        <td><b>0</b></td>
                                                        <td><b><input type="text" name="obser[]" value=""/></td>
                                                    </tr>
                                  <?php     
                                                endfor;
                                            }
                                       ?>
				    	</tbody>        			
        			</table>
		<?php break;
		case "secundaria": case "Bachillerato": ?>
				<table  id="table1" class="gtable " style="width: 1150px;">
					<thead style="">
						<tr>
							<td style="width:50px;">Codigo</td>
							<td style="width:300px;">Nombre</td>
							<td style="width:10px;">Act1</td>
							<td style="width:10px;">Act2</td>
							<td style="width:10px;">Act3</td>
							<td style="width:10px;"><b>50%</b></td>
							<td style="width:10px;">Auto.</td>
							<td style="width:10px;">Hete.</td>
							<td style="width:10px;"><b>20%</b></td>
							<td style="width:10px;">P.O</td>
							<td style="width:10px;"><b>30%</b></td>
							<td style="width:10px;"><b>NF</b></td>		
							<td style="width:150px;"><b>Observaci&oacute;n</b></td>		
						</tr>
					</thead>
					 <tbody>
						<?php
						$alum = $objGen->getAlumxGra();
                                                if(count($alum)> 0) {
                                                    for ($i = 0; $i < count($alum); $i++):
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $alum[$i]['code']; ?><input type="hidden" name="ida[]" value="<?php echo $alum[$i]['id']; ?>" /></td>
                                                            <td><?php echo $alum[$i]['nombre'] . ' ' . $alum[$i]['apellido']; ?></td>
                                                            <td><input type="text" name="act1[]" size="1" maxlength="4" value="<?php echo $alum[$i]['ac1'];?>"/></td>
                                                            <td><input type="text" name="act2[]" size="1" maxlength="4" value="<?php echo $alum[$i]['ac2'];?>"/></td>
                                                            <td><input type="text" name="act3[]" size="1" maxlength="4" value="<?php echo $alum[$i]['ac3'];?>"/></td>
                                                            <td><b><?php echo $alum[$i]['acPr'];?></b></td>
                                                            <td><input type="text" name="auto[]" size="1" maxlength="4"' value="<?php echo $alum[$i]['auto'];?>"/></td>
                                                            <td><input type="text" name="hete[]" size="1" maxlength="4" value="<?php echo $alum[$i]['hetero'];?>"/></td>
                                                            <td><b><?php echo $alum[$i]['eval'];?></b></td>
                                                            <td><input type="text" name="pobj[]" size="1" maxlength="4" value="<?php echo $alum[$i]['probj'];?>"/></td>
                                                            <td><b><?php echo $alum[$i]['probjp'];?></b></td>
                                                            <td><b><?php echo $alum[$i]['promedio'];?></b> <input type="hidden" name="opt" value="update"/></td>			                
                                                            <td><b><input type="text" name="obser[]" value="<?php echo $alum[$i]['observacion'];?>"/></td>			                
                                                        </tr>
                                           <?php 
                                                    endfor; 
                                                }else{ 
                                                    $alum2 = $objGen->getAlumxGraxNotas();
                                                    for ($i = 0; $i < count($alum2); $i++): ?>
                                                        <tr>
                                                            <td><?php echo $alum2[$i]['code']; ?><input type="hidden" name="ida[]" value="<?php echo $alum2[$i]['id']; ?>" /></td>
                                                            <td><?php echo $alum2[$i]['nombre'] . ' ' . $alum2[$i]['apellido']; ?></td>
                                                            <td><input type="text" name="act1[]" size="1" maxlength="4" /></td>
                                                            <td><input type="text" name="act2[]" size="1" maxlength="4" /></td>
                                                            <td><input type="text" name="act3[]" size="1" maxlength="4" /></td>
                                                            <td><b>0</b></td>
                                                            <td><input type="text" name="auto[]" size="1" maxlength="4" /></td>
                                                            <td><input type="text" name="hete[]" size="1" maxlength="4"/></td>
                                                            <td><b>0</b></td>
                                                            <td><input type="text" name="pobj[]" size="1" maxlength="4" /></td>
                                                            <td><b>0</b></td>
                                                            <td><b>0</b><input type="hidden" name="opt" value="insert"/></td>
                                                            <td><b><input type="text" name="obser[]" value=""/></td>
                                                        </tr>
                                      <?php     
                                                    endfor;
                                                }
                                           ?>
				    	</tbody>        			
				</table>
		<?php break; ?>
<?php 
	} 
} 
?>
        	
