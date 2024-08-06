<?php
    class Grupo{
        public $id;
        public $descricao;
    }
    interface GrupoDAOInterface{
        public function buildGrupo($data);
        public function create(Grupo $grupo);
        public function update(Grupo $grupo);
        public function findByDescricao($descricao);
        public function findById($id);
        public function deleteGrupo($id);
        public function findAll();
    }