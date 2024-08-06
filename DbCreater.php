<?php
    require_once("models/User.php");
    require_once("dao/UserDAO.php");
    class DbCreater{
        private $url;
        private $conn;
        public function __construct($url,$conn) {
            $this->url = $url;
            $this->conn = $conn;
        }
        public function createDB(){
            $this->createUser();
            $this->createGrupoCadastro();
            $this->createSubgrupoCadastro();
        }
        public function createUser(){
            $stmt = $this->conn->prepare(
                "CREATE TABLE IF NOT EXISTS `users` (
                    `u_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `u_name` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `u_lastname` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `u_email` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `u_funcao` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `u_nivel` INT(11) NULL DEFAULT NULL,
                    `u_password` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `u_token` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    PRIMARY KEY (`u_id`) USING BTREE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB
                AUTO_INCREMENT=1
                ;"
            );           
            $stmt->execute();
            $password = "Uni123";
            $password = password_hash($password, PASSWORD_DEFAULT);
            if($this->verifyUser()){
                $stmt = $this->conn->prepare("INSERT INTO `unicomercial`.`users` 
                                                    (`u_name`, `u_lastname`, `u_email`, `u_funcao`,`u_nivel`,`u_password`
                                            ) VALUES(
                                                    'Admin', 'ADMINISTRADOR', 'unisystem@unisystemsistemas.com.br', 'admin','1',:password);");
                $stmt->bindParam(":password",$password);                                
                $stmt->execute();
            }
        }
        public function createGrupoCadastro(){
            $stmt = $this->conn->prepare(
                "CREATE TABLE IF NOT EXISTS `grupo_cadastro` (
                    `gc_id` INT(11) NOT NULL AUTO_INCREMENT,
                    `gc_descricao` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    PRIMARY KEY (`gc_id`) USING BTREE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB
                AUTO_INCREMENT=1
                ;"
            );
           
            $stmt->execute();
        }
        public function createSubgrupoCadastro(){
            $stmt = $this->conn->prepare(
                "CREATE TABLE IF NOT EXISTS `subgrupo_cadastro` (
                    `sc_id` INT(11) NOT NULL AUTO_INCREMENT,
                    `gc_id` INT(11) NOT NULL DEFAULT '0',
                    `sc_descricao` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    PRIMARY KEY (`sc_id`) USING BTREE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB
                ;"
            );
           
            $stmt->execute();
        }
        public function verifyUser(){
            $userDao = new UserDAO($this->conn, $this->url);
            $stmt = $this->conn->prepare("SELECT * FROM users");
            $stmt->execute();

            if($stmt->rowCount()> 0){               
                return false;
            }else{
                return true;
            }
        }
    }
