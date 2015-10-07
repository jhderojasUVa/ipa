<? $this -> load -> helper ("url"); ?>
<? echo "<?xml version='1.0' encoding='utf8'?>\n\t" ?>
<rss version="2.0">
<channel> 
    <title>Compra - Venta - Cambio - UVa</title>     
    <link><?=base_url()?></link> 
    <description>Compra - Venta - Cambio - UVa</description>  
	<? foreach ($pisos as $row) { ?>
    <item>
        <title><?=$row["direccion"]?></title>         
        <link><?=base_url()?>index.php/pisos/producto_piso?id=<?=$row["idpiso"]?></link>
        <description><![CDATA[<?=$row["descripcion"]?>\n\t<?=$row["direccion"]?>]]></description>
        <guid><?=base_url()?>index.php/pisos/producto_piso?id=<?=$row["idpiso"]?></guid>
    </item> 
    <? } ?>
</channel>
</rss>
