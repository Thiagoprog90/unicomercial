<?php
    require_once("models/Subgrupo.php");
    require_once("models/Message.php");

    class SubgrupoDAO implements SubgrupoDAOInterface{
        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url){
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildSubGrupo($data){
            $subgrupo = new Subgrupo;
            
            $subgrupo->id = $data["sc_id"];
            $subgrupo->idgrupo = $data["gc_id"];
            $subgrupo->descricao = $data["sc_descricao"];
            $subgrupo->descricaoGrupo = $data["gc_descricao"];
           

            return $subgrupo;
        }
        public function create(Subgrupo $subgrupo){
           $stmt = $this->conn->prepare("INSERT INTO subgrupo_cadastro(
                gc_id,sc_descricao
            ) VALUES (
                :idgrupo,:descricao
            )");
            $stmt->bindParam(":idgrupo",$subgrupo->idgrupo);
            $stmt->bindParam(":descricao",$subgrupo->descricao);

            $stmt->execute();
            

            $this->message->setMessage("Subgrupo gravado com sucesso","success","subgrupo_cadastro.php");

        }
        public function update(Subgrupo $subgrupo){
            $stmt = $this->conn->prepare("UPDATE subgrupo_cadastro SET
                sc_descricao = '$subgrupo->descricao'
                WHERE sc_id = '$subgrupo->id'      
            ");
            

            $stmt->execute();

            // Mensagem de sucesso por editar filme
            $this->message->setMessage("Subgrupo atualizado com sucesso!", "success", "subgrupo_cadastro.php");
            
        }
        public function findByDescricao($search){
            $subgrupos = [];

            $stmt = $this->conn->prepare("SELECT subgrupo_cadastro.sc_id, subgrupo_cadastro.sc_descricao,subgrupo_cadastro.gc_id, grupo_cadastro.gc_descricao FROM subgrupo_cadastro  
                                          LEFT JOIN grupo_cadastro ON subgrupo_cadastro.gc_id = grupo_cadastro.gc_id
                                          WHERE sc_id LIKE '%$search%' OR sc_descricao LIKE '%$search%'OR grupo_cadastro.gc_descricao LIKE '%$search%'");

            $stmt->execute();

            if($stmt->rowCount() > 0) {

                $subgruposArray = $stmt->fetchAll();

                foreach($subgruposArray as $subgrupo) {
                    $subgrupos[] = $this->buildSubGrupo($subgrupo);
                }

            }

            return $subgrupos;
            
        }
        public function findById($id){
            if($id != ""){
                $stmt = $this->conn->prepare("SELECT subgrupo_cadastro.sc_id, subgrupo_cadastro.sc_descricao,subgrupo_cadastro.gc_id, grupo_cadastro.gc_descricao FROM subgrupo_cadastro 
                                            LEFT JOIN grupo_cadastro ON subgrupo_cadastro.gc_id = grupo_cadastro.gc_id
                                            WHERE sc_id = :id");
                $stmt->bindParam(":id",$id);
                $stmt->execute();

                if($stmt->rowCount()> 0){
                    $data = $stmt->fetch();
                    $subgrupo = $this->buildSubGrupo($data);
                    if($subgrupo){
                        return $subgrupo;
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
       
        public function deleteSubGrupo($id){
            $stmt = $this->conn->prepare("DELETE FROM subgrupo_cadastro WHERE sc_id LIKE '$id'");            

            $stmt->execute();

            // Mensagem de sucesso por remover grupo
            $this->message->setMessage("Grupo removido com sucesso!", "success", "subgrupo_cadastro.php");
            
        }
        public function findAll(){
            $grupos = [];
            $stmt = $this->conn->prepare("SELECT subgrupo_cadastro.sc_id,subgrupo_cadastro.gc_id, subgrupo_cadastro.sc_descricao, grupo_cadastro.gc_descricao, grupo_cadastro.gc_id  
                                          FROM subgrupo_cadastro, grupo_cadastro
                                          WHERE grupo_cadastro.gc_id = subgrupo_cadastro.gc_id");            
            $stmt->execute();  
            if($stmt->rowCount()> 0){
                $grupoarray = $stmt->fetchAll();
                foreach($grupoarray as $grupo) {
                    $grupos[] = $this->buildSubGrupo($grupo);
                }                  
                    
            }  
            return $grupos;      
            
            
        }
    }