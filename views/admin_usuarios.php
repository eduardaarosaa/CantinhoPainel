
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>

html, body {
  font-family: 'Roboto', 'Helvetica', sans-serif;
}
.demo-avatar {
  width: 48px;
  height: 48px;
  border-radius: 24px;
}
.demo-layout .mdl-layout__header .mdl-layout__drawer-button {
  color: rgba(0, 0, 0, 0.54);
}
.mdl-layout__drawer .avatar {
  margin-bottom: 16px;
}
.demo-drawer {
  border: none;
}
/* iOS Safari specific workaround */
.demo-drawer .mdl-menu__container {
  z-index: -1;
}
.demo-drawer .demo-navigation {
  z-index: -2;
}
/* END iOS Safari specific workaround */
.demo-drawer .mdl-menu .mdl-menu__item {
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
}
.demo-drawer-header {
  box-sizing: border-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column;
  -webkit-justify-content: flex-end;
      -ms-flex-pack: end;
          justify-content: flex-end;
  padding: 16px;

}
.demo-avatar-dropdown {
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  position: relative;
  -webkit-flex-direction: row;
      -ms-flex-direction: row;
          flex-direction: row;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
  width: 100%;
}

.demo-navigation {
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1;
}
.demo-layout .demo-navigation .mdl-navigation__link {
  display: -webkit-flex !important;
  display: -ms-flexbox !important;
  display: flex !important;
  -webkit-flex-direction: row;
      -ms-flex-direction: row;
          flex-direction: row;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
  color: rgba(255, 255, 255, 0.56);
  font-weight: 500;
}
.demo-layout .demo-navigation .mdl-navigation__link:hover {
  background-color:#0062cc /*#00BCD4*/;
  color: #37474F;
}
.demo-navigation .mdl-navigation__link .material-icons {
  font-size: 24px;
  color: rgba(255, 255, 255, 0.56);
  margin-right: 32px;
}

.demo-content {
  max-width: 1080px;
}

.demo-charts {
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
}
.demo-chart:nth-child(1) {
  color: #ACEC00;
}
.demo-chart:nth-child(2) {
  color: #00BBD6;
}
.demo-chart:nth-child(3) {
  color: #BA65C9;
}
.demo-chart:nth-child(4) {
  color: #EF3C79;
}
.demo-graphs {
  padding: 16px 32px;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column;
  -webkit-align-items: stretch;
      -ms-flex-align: stretch;
          align-items: stretch;
}
/* TODO: Find a proper solution to have the graphs
 * not float around outside their container in IE10/11.
 * Using a browserhacks.com solution for now.
 */
_:-ms-input-placeholder, :root .demo-graphs {
  min-height: 664px;
}
_:-ms-input-placeholder, :root .demo-graph {
  max-height: 300px;
}
/* TODO end */
.demo-graph:nth-child(1) {
  color: #00b9d8;
}
.demo-graph:nth-child(2) {
  color: #d9006e;
}

.demo-cards {
  -webkit-align-items: flex-start;
      -ms-flex-align: start;
          align-items: flex-start;
  -webkit-align-content: flex-start;
      -ms-flex-line-pack: start;
          align-content: flex-start;
}
.demo-cards .demo-separator {
  height: 32px;
}
.demo-cards .mdl-card__title.mdl-card__title {
  color: white;
  font-size: 24px;
  font-weight: 400;
}
.demo-cards ul {
  padding: 0;
}
.demo-cards h3 {
  font-size: 1em;
}
.demo-updates .mdl-card__title {
  min-height: 200px;
  background-image: url('images/dog.png');
  background-position: 90% 100%;
  background-repeat: no-repeat;
}
.demo-cards .mdl-card__actions a {
  color: #00BCD4;
  text-decoration: none;
}

.demo-options h3 {
  margin: 0;
}
.demo-options .mdl-checkbox__box-outline {
  border-color: rgba(255, 255, 255, 0.89);
}
.demo-options ul {
  margin: 0;
  list-style-type: none;
}
.demo-options li {
  margin: 4px 0;
}
.demo-options .material-icons {
  color: rgba(255, 255, 255, 0.89);
}
.demo-options .mdl-card__actions {
  height: 64px;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  box-sizing: border-box;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
}

</style>

</head>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Usuários</title>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          
          <span class="mdl-layout-title">Usuários</span>
          <div class="mdl-layout-spacer"></div>
<!--          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="search">
              <label class="mdl-textfield__label" for="search">Enter your query...</label>
            </div>
          </div>-->
<!--          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
            <i class="material-icons">more_vert</i>
          </button>-->
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
            <li class="mdl-menu__item">About</li>
            <li class="mdl-menu__item">Contact</li>
            <li class="mdl-menu__item">Legal information</li>
          </ul>
        </div>
      </header>
      <?php 
        include 'menu.php';
        
        ?>
      <!-- tabela -->
 <main class="mdl-layout__content mdl-color--grey-100">
  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Usuários</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
         <?php 
      foreach ($usuarios as $p){
         
          echo '  <tr>
      <th scope="row">'. $p->id .'</th>
      <td>'. $p->nome.'</td>
    <td><div class="dropdown">
  ';
          
      if($p->ativacao == 1){
          echo '<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Ativado
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <a class="dropdown-item" href="desativar_usuarios?id='.$p->id.'">Desativar</a>';
      }else{
          echo'<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Desativado
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  
<a class="dropdown-item" href="ativar_usuarios?id='.$p->id.'">Ativar</a>';
      }
      echo '
  </div>
</div></td>
    </tr>';
          
      }
      ?>
  </tbody>
</table>




            
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>

  <script>
  //var button = document.createElement('button');
  //var textNode = document.createTextNode('Click Me!');
  button.appendChild(textNode);
  button.className = 'mdl-button mdl-js-button mdl-js-ripple-effect';
  componentHandler.upgradeElement(button);
  document.getElementById('container').appendChild(button);
</script>
  </body>
</html>
