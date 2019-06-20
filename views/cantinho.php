
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    .login-container{
    margin-top: 5%;
    margin-bottom: 5%;
}
.login-form-1{
    padding: 5%;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-1 h3{
    text-align: center;
    color: #333;
}
.login-form-2{
    padding: 5%;
    background: #0062cc;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-2 h3{
    text-align: center;
    color: #fff;
}
.login-container form{
    padding: 10%;
}
.btnSubmit
{
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    border: none;
    cursor: pointer;
}
.login-form-1 .btnSubmit{
    font-weight: 600;
    color: #fff;
    background-color: #0062cc;
}
.login-form-2 .btnSubmit{
    font-weight: 600;
    color: #0062cc;
    background-color: #fff;
}
.login-form-2 .ForgetPwd{
    color: #fff;
    font-weight: 600;
    text-decoration: none;
}
.login-form-1 .ForgetPwd{
    color: #0062cc;
    font-weight: 600;
    text-decoration: none;
}

    </style>
</head>

<!------ Include the above in your HEAD tag ---------->

<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Login</h3>
                      <?php echo form_open_multipart('Cantinho/login_comum'); ?>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id="email" placeholder=" Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha *" value="" />
                        </div>
              
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">
                            <a href="#" class="ForgetPwd">Esqueceu a senha?</a>
                        </div>
                      <?php echo form_close(); ?>
                </div>
                <div class="col-md-6 login-form-2">
                    <h3>Cadastro</h3>
                    
                <?php echo form_open_multipart('Cantinho/cadastro'); ?>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nome *" value=""  name="nome" id="nome"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email *" value="" name="email" id="email" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Senha*" value="" name="senha" id="senha" />
                        </div>
                         <div class="form-group">
                            <input type="text" class="form-control" name="codigo" placeholder="Código *" value="" name="codigo" id="codigo" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Cadastrar" />
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="nivel_acesso">

                          
                        </div>
                   <?php echo form_close(); ?>

                </div>
            </div>
        </div>