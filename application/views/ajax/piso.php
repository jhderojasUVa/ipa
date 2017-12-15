<a href="#" onclick="javascript:cambia_estado(<?=$idpiso?>)">
  <? if ($respuesta==0) { ?>
  <span class="rojo">Ocupado</span>
<? } else { ?>
  <span class="verde">Libre</span>
<? } ?>
</a>
