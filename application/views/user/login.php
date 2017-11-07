<? $this -> load -> helper ("url"); ?>

<div class="grid-container login" style="margin-top: 20px; margin-bottom: 20px;">
      <div class="grid-x grid-margin-x">
        <div class="small-12 cell">
          <p>Acceda a IPA (<em>Información de Pisos en Alquiler</em>) ya sea miembro de la comunidad universitaria perteneciente a la <a href="http://www.uva.es" role="link" target="_blank">UVa</a> o no. Para ello utilice el formulario necesario (izquierda para usuarios UVa o derecha para usuario IPA).</p>
        </div>
      </div>

      <div class="grid-x grid-margin-x">
        <div class="small-12 medium-6 cell">
          <h2 class="headline">Entrada usuarios UVa</h2>
          <p>Si usted dispone de cuenta en <a href="https://miportal.uva.es" role="link" target="_blank">Mi Portal UVa</a>.</p>
          <p>Destinado a <strong>estudiantes</strong>, <strong>PDI</strong> y <strong>PAS</strong> de la Universidad de Valladolid.</p>
          <p><center>
            <form action="<?=base_url()?>index.php/principal/login" method="post" style="margin-top: 20px;">
              <input type="hidden" name="uva" value="1" />
              <input type="submit" class="button" value="Pulse aqu&iacute; para entrar a traves de UVa" />
            </form>
          </center></p>
        </div>
        <div class="small-12 medium-6 cell">
          <h2 class="headline">Entrada usuarios <strong>NO</strong> UVa</h2>
          <p>Si <strong>no perteneces a la UVa y quieres ofertar tu inmueble</strong>, entra a traves de este formulario.</p>
          <form action="<?=base_url()?>index.php/principal/login" method="post">
            <input type="hidden" name="uva" value="0" />

            <label>usuario</label>
            <input type="text" name="login" placeholder="usuario" maxlength="20" />

            <label>contrase&ntilde;a</label>
            <input type="password" name="password" placeholder="password" maxlength="20" />

            <center><input type="submit" class="button" value="Entrar" /></center>

            <p>Si no recuerda su usuario <a href="<?=base_url()?>index.php/principal/recordar_password">pulse aqu&iacute;</a>.</p>
            <p>Si no dispone de usuario o contrase&ntilde;a puede darse de alta <a href="<?=base_url()?>index.php/principal/alta_nueva">pulsando aqu&iacute;</a>.</p>

          </form>
        </div>
      </div>

      <div class="grid-x grid-margin-x">
        <div class="small-12 cell">
          <h2 class="headline">Atenci&oacute;n</h2>
          <p>Para los alumnos de nueva matriculaci&oacute;n deberan entrar por <strong>Mi Portal UVa</strong> para poder consultar la oferta de pisos.</p>
          <p>Los <strong>usuarios IPA</strong> no pueden ver las ofertas de pisos.</p>
        </div>
        <div class="small-12 cell">
          <p><strong>Deberá estar identificado para poder ver los inmuebles</strong>: Solo los usuarios identificados (IPA o UVa) pueden ver los inmuebles. Los usuarios IPA solo podr&aacute;n ver su propio inmueble.</p>
        </div>
      </div>

    </div>
