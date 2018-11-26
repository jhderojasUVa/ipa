<? $this -> load -> helper ("url"); ?>

<div class="busqueda">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="small-12 cell">
				<div class="buscador align-middle">
		      <form action="<?=base_url()?>index.php/buscar/busquedas" method="post">
		        <div class="grid-container">
		          <div class="grid-x">
		            <div class="medium-12 cell">
		              <div class="input-group">
		                <input class="input-group-field" name="q" value="<?=$q?>" type="search" placeholder="Buscar en IPA">
		                  <div class="input-group-button">
		                  <input type="submit" class="button" value="Buscar">
		                  </div>
		                </div>
		            </div>
		          </div>
		        </div>
		      </form>
		    </div>
			</div>
		</div>
	</div>

  <div class="grid-container">
		<div id="busquedas"></div>
		<script type="text/babel" src="<?=base_url()?>js/components/busquedasComponent.js"></script>
	</div>
</div>
