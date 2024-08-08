<?php

    class Unidade{
        public $id;
        public $descricao;
        public $sigla;
    }

    interface UnidadeDaoInterface{
        public function buildUnidade($data);
        public function create(Unidade $unidade);
        public function update(Unidade $unidade);
        public function findByDescricao($search);
        public function findById($id);
        public function deleteUnidade($id);
        public function findAll();
    }