<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of research_attachment
 *
 * @author ahmed
 */
class research_attachment {

    private $seq_id = null;
    private $research_id = null;
    private $file_url = null;
    private $file_size = null;
    private $file_hash = null;
    private $Attachment_cat_id = null;
    private $notes = null;

    public function getSeq_id() {
        return $this->seq_id;
    }

    public function getResearch_id() {
        return $this->research_id;
    }

    public function getFile_url() {
        return $this->file_url;
    }

    public function getFile_size() {
        return $this->file_size;
    }

    public function getFile_hash() {
        return $this->file_hash;
    }

    public function getAttachment_cat_id() {
        return $this->Attachment_cat_id;
    }

    public function getNotes() {
        return $this->notes;
    }

    public function setSeq_id($seq_id) {
        $this->seq_id = $seq_id;
    }

    public function setResearch_id($research_id) {
        $this->research_id = $research_id;
    }

    public function setFile_url($file_url) {
        $this->file_url = $file_url;
    }

    public function setFile_size($file_size) {
        $this->file_size = $file_size;
    }

    public function setFile_hash($file_hash) {
        $this->file_hash = $file_hash;
    }

    public function setAttachment_cat_id($Attachment_cat_id) {
        $this->Attachment_cat_id = $Attachment_cat_id;
    }

    public function setNotes($notes) {
        $this->notes = $notes;
    }

    public function __construct($ResearchId, $URL, $Size, $Hash, $AttachmentCatId, $Notes) {
        $this->research_id = $ResearchId;
        $this->file_url = $URL;
        $this->file_size = $Size;
        $this->file_hash = $Hash;
        $this->Attachment_cat_id = $AttachmentCatId;
        $this->notes = $Notes;
    }

    public static function createObject() {
        return new attachment_cat(null, null, null, null, null, null);
    }

    public function IsValid() {
        $isValid = TRUE;
        $error = array();
        if (strlen($this->research_id) == 0) {
            $isValid = FALSE;
            array_push($error, 'Research_id Can not be null');
        }
        if (strlen($this->getFile_url()) == 0) {
            $isValid = FALSE;
            array_push($error, 'FileURL Can not be null');
        }
        if (strlen($this->getFile_size()) == 0) {
            $isValid = FALSE;
            array_push($error, 'File Can not be null');
        }
        if (strlen($this->getAttachment_cat_id()) == 0) {
            $isValid = FALSE;
            array_push($error, 'Attachment Cat Must be selected');
        }
        return $error;
    }

}
