<?php
    require_once("models/Grupo.php");
    require_once("models/Message.php");

    class GrupoDAO implements GrupoDAOInterface{
        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url){
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildGrupo($data){
            $grupo = new Grupo;            
            $grupo->id = $data["gc_id"];
            $grupo->descricao = $data["gc_descricao"];
            

            return $grupo;
        }
        public function create(Grupo $grupo){
            $stmt = $this->conn->prepare("INSERT INTO grupo_cadastro(
                gc_descricao
            ) VALUES (
                :descricao
            )");
            $stmt->bindParam(":descricao",$grupo->descricao);
            $stmt->execute();             
            
            $this->message->setMessage("Grupo gravado com sucesso","success","grupo_cadastro.php");
                    
        }
        
        public function update(Grupo $grupo){
            $stmt = $this->conn->prepare("UPDATE grupo_cadastro SET
                gc_descricao = '$grupo->descricao'
                WHERE gc_id = '$grupo->id'      
            ");
            

            $stmt->execute();

            // Mensagem de sucesso por editar filme
            $this->message->setMessage("Grupo atualizado com sucesso!", "success", "grupo_cadastro.php");
        }
        public function findByDescricao($search){
            $grupos = [];

            $stmt = $this->conn->prepare("SELECT * FROM grupo_cadastro WHERE gc_id LIKE '%$search%' OR gc_descricao LIKE '%$search%'");

            $stmt->execute();

            if($stmt->rowCount() > 0) {

                $gruposArray = $stmt->fetchAll();

                foreach($gruposArray as $grupo) {
                    $grupos[] = $this->buildGrupo($grupo);
                }

            }

            return $grupos;

            
        }
        public function findById($id){
            if($id != ""){
                $stmt = $this->conn->prepare("SELECT * FROM grupo_cadastro WHERE gc_id = :id");
                $stmt->bindParam(":id",$id);
                $stmt->execute();

                if($stmt->rowCount()> 0){
                    $data = $stmt->fetch();
                    $grupo = $this->buildGrupo($data);
                    if($grupo){
                        return $grupo;
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
        public function deleteGrupo($id){
             $stmt = $this->conn->prepare("DELETE FROM grupo_cadastro WHERE gc_id LIKE '$id'");            

            $stmt->execute();

            // Mensagem de sucesso por remover grupo
            $this->message->setMessage("Grupo removido com sucesso!", "success", "grupo_cadastro.php");
                    
        }
        public function findAll(){
            $grupos = [];
            $stmt = $this->conn->prepare("SELECT * FROM grupo_cadastro");            
            $stmt->execute();  
            if($stmt->rowCount()> 0){
                $grupoarray = $stmt->fetchAll();
                foreach($grupoarray as $grupo) {
                    $grupos[] = $this->buildGrupo($grupo);
                }                    
                    
            }  
            return $grupos;        
        }
        

    }