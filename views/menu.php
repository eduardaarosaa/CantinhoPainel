<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
            <span class="id_logo"><style="color:orange; font-size:18pt;">Cantinho BR</style></span>
          <div class="demo-avatar-dropdown">
              <span>
                <?php
               echo $this->session->userdata('nome');
               
                ?>
                
              </span>
 
            <div class="mdl-layout-spacer"></div>
<!--            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
              <span class="visuallyhidden">Accounts</span>
            </button>-->
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
              <li class="mdl-menu__item">hello@example.com</li>
              <li class="mdl-menu__item">info@example.com</li>
              <li class="mdl-menu__item"><i class="material-icons">add</i>Add another account...</li>
            </ul>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href="painel"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
          <a class="mdl-navigation__link" href="admin_publicacoes"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Publicações</a>
          <a class="mdl-navigation__link" href="admin_comentarios"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>Comentários</a>
          <a class="mdl-navigation__link" href="admin_usuarios"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Usuários</a>
          <a class="mdl-navigation__link" href="logout"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Sair</a>

          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
        </nav>
      </div>