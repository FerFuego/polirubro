<?php
 
class Paginator {

    private $limit;
    private $page;
    private $query;
    private $total;
    private $obj;

    public function __construct( $query, $total ) {
        $this->query = $query;         
        $this->total = $total;         
    }

    public function getData( $limit = 10, $page = 1 ) {
     
        $this->limit = $limit;
        $this->page = $page;
     
        if ( $this->limit == 'all' ) {
            $query = $this->query;
        } else {
            $query = $this->query . " LIMIT " . ( ( $this->page - 1 ) * $this->limit ) . ", $this->limit";
        }

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery($query);
          
        return $result;
    }

    public function createLinks( $links, $params, $list_class ) {

        if ( $this->limit == 'all' ) {
            return '';
        }
     
        $last = ceil( $this->total / $this->limit );
     
        $start = ( ( $this->page - $links ) > 0 ) ? $this->page - $links : 1;
        $end = ( ( $this->page + $links ) < $last ) ? $this->page + $links : $last;
     
        $html = '<div class="' . $list_class . '">';

        if ( $this->page == 1 ) {
            $html .= '<a>&laquo;</a>';
        } else {
            $html .= '<a href="?'.$params.'&page=' . ( $this->page - 1 ) . '">&laquo;</a>';
        }
     
        if ( $start > 1 ) {
            $html .= '<a href="?'.$params.'&page=1">1</a>';
            $html .= '<span>...</span>';
        }
     
        for ( $i = $start ; $i <= $end; $i++ ) {
            if ( $this->page == $i ) {
                $html .= '<a class="active">' . $i . '</a>';
            } else {
                $html .= '<a href="?'.$params.'&page=' . $i . '">' . $i . '</a>';
            }
        }
     
        if ( $end < $last ) {
            $html .= '<span class="disabled mr-3">...</span>';
            $html .= '<a href="?'.$params.'&page=' . $last . '">' . $last . '</a>';
        }
     
       if ( $this->page == $last ) {
           $html .= '<a>&raquo;</a>';
       } else {
           $html .= '<a href="?'.$params.'&page=' . ( $this->page + 1 ) . '">&raquo;</a>';
       }

        $html .= '</div>';
     
        return $html;

    }

    public function closeConnection(){
        $this->obj->Clean();
		$this->obj->Close();
	} 
 
}