<?php 
/**
 * Categorias Class
 */
class Categorias {

    public $id_categ;
    public $order;
    public $title;
    public $icon;
    public $color;
    public $link;
    protected $obj;

    public function __construct($id=0) {
        if ($id != 0) {
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM categorias WHERE id_categ = '$id'");
            $row = mysqli_fetch_assoc($result);
            $this->id_categ = $row['id_categ'];
            $this->title = $row['title'];
            $this->order = $row['orden'];
            $this->color = $row['color'];
            $this->icon = $row['icon'];
            $this->link = $row['link'];
        }
    }

    public function getCategories() {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM categorias ORDER BY orden");
        return $result;
    }

    public function insert() {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("INSERT INTO categorias (title, orden, color, icon, link) VALUES ('$this->title','$this->order','$this->color','$this->icon','$this->link')");
        return $result;
    }

    public function update() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("UPDATE categorias SET title='$this->title', orden='$this->order', color='$this->color', icon='$this->icon', link='$this->link' WHERE id_categ='$this->id_categ'");
    }

    public function delete() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("DELETE FROM categorias WHERE id_categ='$this->id_categ'");
    }

    public function closeConnection() {
        @$this->obj->Clean();
        $this->obj->Close();
    }
}