<? $this -> load -> helper ("url"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Administracion</title>
<link href="<?=base_url()?>css/admin.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script language="javascript" src="<?=base_url()?>js/highcharts.js"></script>
<script>

$(document).ready(function() {
	var tarta_totales = new Highcharts.Chart({
         chart: {
            renderTo: "grafico_generales",
            type: "pie",
			name: "Usuarios UVa vs IPA"
         },
         title: {
            text: "Pisos Usuarios UVa vs IPA desde el inicio"
         },
		 tooltip: {
                formatter: function() {
                    return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                }
            },
		 plotOptions: {
		 	pie: {
					allowPointSelect: true,
					cursor: "pointer",
					dataLabels: {
									enabled: false
					},
					showInLegend: true
			}
		 },
         series: [{
			type: "pie",
            data: [
					["Usuarios UVa", <?=$totales_pisos_uva_siempre?>],
					["Ususarios IPA", <?=$totales_pisos_nouva_siempre?>]
				  ]
		 }]
      });

	var pisos_mes = new Highcharts.Chart({
						chart: {
							renderTo: "pisos_ano",
							type: "line",
							marginRight: 130,
							marginBottom: 25
						},
						title: {
								text: "Pisos por mes en el año <?=date("Y")?>"
						},
						xAxis: {
							categories: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",	"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
						},
						yAxis: {
							title: {
								text: "Numero de pisos"
							},
							plotLines: [{
								value: 0,
								width: 1,
								color: "#808080"
								}]
						},
						legend: {
							layout: "vertical",
							align: "left",
							verticalAlign: "top",
							x: -10,
							y: 100,
							borderWidth: 0
						},
						series: [{
							name: "Totales",
							data: [<? for ($i=0;$i<count($pisos_mes_actual);$i++) {?><?=$pisos_mes_actual[$i][1]?>,<? } ?>]
						}, {
							name: "Pisos por usuarios UVa",
							data: [<? for ($i=0;$i<count($pisos_mes_actual_uva);$i++) {?><?=$pisos_mes_actual_uva[$i][1]?>,<? } ?>]
						},{
							name: "Pisos por usuarios IPA",
							data: [<? for ($i=0;$i<count($pisos_mes_actual_nouva);$i++) {?><?=$pisos_mes_actual_nouva[$i][1]?>,<? } ?>]
						}]
	});
	  
});

function formatea() {
	var fechainicio = $("#anoi").val()+"-"+$("#mesi").val()+"-"+$("#diai").val();
	var fechafin = $("#anof").val()+"-"+$("#mesf").val()+"-"+$("#diaf").val();
		
	$("#fechainicio").attr("value", fechainicio);
	
	$("#fechafin").attr("value=",fechafin);
	document.submit();
}
</script>
</head>

<body>
<div id="menu_sup">
	<p>Usuario <strong><?=$usuario?></strong> | <a href="<?=base_url()?>index.php/principal/logout">Salir</a> | <a href="<?=base_url()?>">Principal</a> | <a href="<?=base_url()?>index.php/doc/comentarios">Comentarios</a> | <a href="<?=base_url()?>index.php/doc/usuarios">Usuarios</a> | <a href="<?=base_url()?>index.php/doc/estadisticas">Estadisticas</a> | <a href="<?=base_url()?>index.php/doc/buscar">Buscar</a> | <a href="<?=base_url()?>index.php/doc/correomasivo">Correos Masivos</a> | <a href="<?=base_url()?>index.php/doc/cambiartipo">Cambiar tipo</a></p>
</div>
<div id="contenido">
	<h1>Estadisticas</h1>
    <h2>Generales</h2>
    <div id="datos_generales">
    <table align="center" width="350">
    	<tr>
        	<td align="left"><strong>Usuarios nuevos hoy</strong></td>
            <td align="right"><?=$totales_usuarios_hoy?></td>
        </tr>
        <tr>
        	<td align="left"><strong>Pisos nuevos hoy</strong></td>
            <td align="right"><?=$totales_pisos_hoy?></td>
        </tr>
    </table>
    
    <table align="center" width="350">
    	<tr>
        	<td align="left"><strong>Pisos totales por usuarios UVa hoy</strong></td>
            <td align="right"><?=$totales_pisos_uva_hoy?></td>
        </tr>
        <tr>
        	<td align="left"><strong>Pisos totales por usuarios UVa desde el comienzo</strong></td>
            <td align="right"><?=$totales_pisos_uva_siempre?></td>
        </tr>
    </table>
    
    <table align="center" width="350">
    	<tr>
        	<td align="left"><strong>Pisos totales por usuarios IPA hoy</strong></td>
            <td align="right"><?=$totales_pisos_nouva_hoy?></td>
        </tr>
        <tr>
        	<td align="left"><strong>Pisos totales por usuarios IPA desde el comienzo</strong></td>
            <td align="right"><?=$totales_pisos_nouva_siempre?></td>
        </tr>
    </table>
    
    <table align="center" width="350">
    	<tr>
        	<td align="left"><strong>Usuarios totales en la plataforma</strong></td>
            <td align="right"><?=$totales_usuarios_siempre?></td>
        </tr>
        <tr>
        	<td align="left"><strong>Pisos totales en la plataforma</strong></td>
            <td align="right"><?=$totales_pisos_siempre?></td>
        </tr>
    </table>
    
    </div>
    <div id="grafico_generales">
    </div>
    <div id="clear"></div>
    <h2>Pisos por meses en el año <?=date("Y")?></h2>
    <br />
    <div id="pisos_ano">
    </div>
    <h1>Consultar por fechas</h1>
    <br />
    <center>
    	<table align="center" width="800">
        <form action="<?=base_url()?>index.php/doc/estadisticas" method="post" onsubmit="formatea();return false;">
        <input type="hidden" name="fechainicio" id="fechainicio" value="ssss"/>
        <input type="hidden" name="fechafin" id="fechafin" value=""/>
        	<tr>
            	<td>Fecha de inicio</td>
                <td>
                	<select name="diai" id="diai">
                    	<? for ($i=1; $i<=31; $i++) { ?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <? } ?>
                    </select>
                    /
                    <select name="mesi" id="mesi">
                    	<? for ($i=1; $i<=12; $i++) { ?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <? } ?>
                    </select>
                    /
                    <select name="anoi" id="anoi">
                    	<? for ($i=2012; $i<=date("Y"); $i++) { ?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <? } ?>
                    </select>
                </td>
                <td>Fecha de fin</td>
                <td>
                	<select name="diaf" id="diaf">
                    	<? for ($i=1; $i<=31; $i++) { ?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <? } ?>
                    </select>
                    /
                    <select name="mesf" id="mesf">
                    	<? for ($i=1; $i<=12; $i++) { ?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <? } ?>
                    </select>
                    /
                    <select name="anof" id="anof">
                    	<? for ($i=2012; $i<=date("Y"); $i++) { ?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <? } ?>
                    </select>
                </td>
                <td>
                	<input type="submit" value="realizar estadistica" class="boton"/>
                </td>
            </tr>
            </form>
        </table>
    </center>
</div>
</body>
</html>
