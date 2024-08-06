<?php
    require_once("models/User.php");
    require_once("models/Message.php");

    class UserDAO implements UserDAOInterface{
        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url){
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }
        public function buildUser($data){
            $user = new User;
            
            $user->id = $data["u_id"];
            $user->name = $data["u_name"];
            $user->lastname = $data["u_lastname"];
            $user->email = $data["u_email"] ;
            $user->password = $data["u_password"];
            $user->funcao = $data["u_funcao"];
            $user->token = $data["u_token"];
            $user->nivel = $data["u_nivel"];

            return $user;

        }
        public function create(User $user, $authUser = false){
                
             
            $stmt = $this->conn->prepare("INSERT INTO users(
                u_name,u_lastname,u_email,u_password,u_funcao,u_token,u_nivel
            ) VALUES (
                :name,:lastname,:email,:password,:funcao,:token,:nivel
            )");
            $stmt->bindParam(":name",$user->name);
            $stmt->bindParam(":lastname",$user->lastname);
            $stmt->bindParam(":email",$user->email);
            $stmt->bindParam(":password",$user->password);
            $stmt->bindParam(":funcao",$user->funcao);
            $stmt->bindParam(":token",$user->token);
            $stmt->bindParam(":nivel",$user->nivel);
            $stmt->execute();

            if($authUser){
                $this->setTokenToSession($user->token);
            }



        }
        public function update(User $user, $redirect = true) {
            $stmt = $this->conn->prepare("UPDATE users SET
               u_name = :name,
                u_lastname = :lastname,
                u_email = :email,                
                u_funcao = :funcao,
                u_token = :token,
                u_nivel = :nivel

                WHERE u_id = :id
            ");

            $stmt->bindParam(":name", $user->name);
            $stmt->bindParam(":lastname", $user->lastname);
            $stmt->bindParam(":email", $user->email);
            $stmt->bindParam(":funcao", $user->funcao);
            $stmt->bindParam(":token", $user->token);
            $stmt->bindParam(":nivel", $user->nivel);
            $stmt->bindParam(":id", $user->id);

            $stmt->execute();

            if($redirect) {

                // Redireciona para o perfil do usuario
                $this->message->setMessage("Dados atualizados com sucesso!", "success", "editprofile.php");

            }
        }      
        public function verifyToken($protected=false){
            if(!empty($_SESSION["token"])){

                // Pega o token da session
                $token = $_SESSION["token"];

                $user = $this->findByToken($token);

                if($user) {
                    return $user;
                } else if($protected) {
                // Redireciona usuário não autenticado
                $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "auth.php");

                }

            } else if($protected) {

                // Redireciona usuário não autenticado
                $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "auth.php");

            }


           
        }
        public function setTokenToSession($token, $redirect = true){
            $_SESSION["token"]= $token;
            if($redirect){
                $this->message->setMessage("Seja Bem vindo","success","index.php");
            }
        }
        public function authenticateUser($email,$password){
            
            $user = $this->findByEmail($email);

            if($user) {

                // Checar se as senhas batem
                if(password_verify($password, $user->password)) {
                     
                    // Gerar um token e inserir na session
                    $token = $user->generateToken();

                    $this->setTokenToSession($token, false);

                    // Atualizar token no usuário
                    $user->token = $token;

                    $this->update($user, false);

                    return true;

                } else {
                    return false;
                }

            } else {

                return false;

            }
            
        }
        public function findByEmail($email){
            if($email != ""){
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE u_email = :email");
                $stmt->bindParam(":email",$email);
                $stmt->execute();

                if($stmt->rowCount()> 0){
                    $data = $stmt->fetch();
                    $user = $this->buildUser($data);
                    if($user){
                        return $user;
                    }else{
                        return false;
                    }
                    
                }else{
                    return false;
                }

            }else{
                return false;
            }
        }
        public function findById($id){
            
        }
        public function findByToken($token){
            if($token != ""){
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE u_token = :token");
                $stmt->bindParam(":token",$token);
                $stmt->execute();

                if($stmt->rowCount()> 0){
                    $data = $stmt->fetch();
                    $user = $this->buildUser($data);
                    return $user;
                }else{
                    return false;
                }

            }else{
                return false;
            }
            
        }
        public function destroyToken(){
            // remove o token da session
            $_SESSION["token"]="";
            // Redirecionar e apresentar a mensagem de sucesso
            $this->message->setMessage("Você fez o logout com sucesso!", "success", "auth.php");
        }
        public function chancePassword(User $user){
            
        }
    }