<?php

    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");
    require_once("globals.php");
    require_once("db.php");

    $message = new Message($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);

    // Verifica Formulario

    $type = filter_input(INPUT_POST,"type");
    
    // Verifica qual formulario enviou

    if($type === "register"){
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");        
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");
        $funcao = filter_input(INPUT_POST, "funcao");        
        $nivel = filter_input(INPUT_POST, "nivel");
        // Verificação de dados Minimos

        if($name  && $lastname && $email && $password ){
            if($password === $confirmpassword){
              if((strlen($password)>=1) && (strlen($password) <=10)){
                // verifica se email esta cadastrado
                if($userDao->findByEmail($email) === false) {
                  $user = new User();

                  // Criação de token
                  $userToken = $user->generateToken();
                  $finalPassword = $user->generatePassword($password);

                  $user->name = $name;
                  $user->lastname = $lastname;
                  $user->funcao = $funcao;
                  $user->nivel = $nivel;
                  $user->email = $email;
                  $user->password = $finalPassword;
                  $user->token = $userToken;
                  $auth =true;

                  $userDao->create($user,$auth);


                }else{
                  //Enviar msg erro, Email ja Existe
                  $message->setMessage("Email já Cadastrado, use outro e-mail","error","back");
                }
              } else{
                 //Enviar msg erro, numero de caracteres
                $message->setMessage("Senha tem que ser entre 5 e 10 caracteres","error","back");
              }
            }else{
                 //Enviar msg erro, senha diferente 
                $message->setMessage("As senhas nao coincidem","error","back");
            }
        }else{
           //Enviar msg erro, de dados faltantes 
           $message->setMessage("Por favor preencha todos os campos","error","back");
        }

    }else if($type === "login"){
      
      $email = filter_input(INPUT_POST, "email");
      $password = filter_input(INPUT_POST, "password");

      // Tenta autenticar usuário
      if($userDao->authenticateUser($email, $password)) {

       $message->setMessage("Seja bem-vindo!", "success", "index.php");
      // Redireciona o usuário, caso não conseguir autenticar
      } else {
        $message->setMessage("Usuário e/ou senha incorretos.", "error", "back");
      }
    }
