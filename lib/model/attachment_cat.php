<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of attachment_cat
 *
 * @author ahmed
 */
class attachment_cat {

    private $seq_id = null;
    private $Cat_name = null;
    private $Notes = null;

    public function getSeq_id() {
        return $this->seq_id;
    }

    public function getCat_name() {
        return $this->Cat_name;
    }

    public function getNotes() {
        return $this->Notes;
    }

    public function setSeq_id($seq_id) {
        $this->seq_id = $seq_id;
    }

    public function setCat_name($Cat_name) {
        $this->Cat_name = $Cat_name;
    }

    public function setNotes($Notes) {
        $this->Notes = $Notes;
    }

    //
    public function __construct($CatName, $Notes) {
        $this->Cat_name = $CatName;
        $this->Notes = $Notes;
    }

    public static function createObject() {
        return new attachment_cat(null, null, null);
    }

    public function IsValid() {
        $isValid = TRUE;
        $error = array();
        if (strlen($this->Cat_name) > 255) {
            $isValid = FALSE;
            array_push($error, 'Cat_Name excced len:' . strlen($this->getCat_name()));
        }
        return $error;
    }

}
