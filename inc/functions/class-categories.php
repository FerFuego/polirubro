<?php 
/**
 * Categorias Class
 */
class Categories {

    protected $obj;
    public $id_categ;
    public $order;
    public $title;
    public $icon;
    public $color;
    public $link;

    public function __construct($id=0) {
        if ($id != 0) {
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM categorias WHERE id_categ = '$id'");
            $row = mysqli_fetch_assoc($result);
            $this->id_categ = $row['id_categ'];
            $this->title = $row['title'];
            $this->order = $row['order'];
            $this->color = $row['color'];
            $this->icon = $row['icon'];
            $this->link = $row['link'];
        }
    }

    public function getCategories() {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM categorias ORDER BY id_order");
        return $result;
    }

    public function insertCategory() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("INSERT INTO categorias ( title, order, color, icon, link ) VALUES ('$this->title','$this->order','$this->color'.'$this->icon','$this->link')");
    }

    public function updateCategories() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("UPDATE categorias SET title='$this->title', order='$this->order', color='$this->color', icon='$this->icon', link='$this->link' WHERE id_categ='$this->id_categ'");
    }

    public function deleteCategories() {
        $this->obj = new sQuery();
        $this->obj->executeQuery("DELETE FROM categorias WHERE id_categ='$this->id_categ'");
    }

    public function closeConnection() {
        @$this->obj->Clean();
        $this->obj->Close();
    }
}