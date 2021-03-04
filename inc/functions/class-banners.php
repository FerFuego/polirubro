<?php
/**
 * Banners class
 */
class Banners {

    public $Id_banner;
    public $orden;
    public $image;
    public $title;
    public $text;
    public $link;
    protected $obj;

    public function __construct($id=0) {

        if ($id != 0) {

            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM banners WHERE Id_banner = '$id' ORDER BY Id_banner");
            $row = mysqli_fetch_assoc($result);

            $this->Id_banner = $row['Id_banner'];
            $this->orden = $row['orden'];
            $this->image = $row['image'];
            $this->title = $row['title'];
            $this->text = $row['text'];
            $this->link = $row['link'];
        }
    }

    public function getID(){ return $this->Id_banner; }
    public function getImage(){ return $this->image; }
    public function getOrden(){ return $this->orden; }
    public function getTitle(){ return $this->title; }
    public function getText(){ return $this->text; }
    public function getLink(){ return $this->link; }

    public function getBanners() {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM banners ORDER BY Id_banner");
        return $result;
    }

    public function insert() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("INSERT INTO banners (orden, image, title, text, link) VALUES ('$this->orden', '$this->image', '$this->title', '$this->text', '$this->link')");
    }

    public function update() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("UPDATE banners SET order = '$this->order', image = '$this->image', title = '$this->title', text = '$this->text', link = '$this->link' WHERE (Id_banner = '$this->Id_banner')");
    }

    public function delete() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("DELETE FROM banners WHERE (Id_banner = '$this->Id_banner')");
    }

    public function closeConnection() {
        @$this->obj->Clean();
        $this->obj->Close();
    }
}