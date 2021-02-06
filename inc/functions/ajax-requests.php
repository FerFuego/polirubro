<?php
/*-----------------------
    Ajax Requests
-----------------------*/
session_start();

require('class-polirubro.php');

/**
 * Request of Login
 */
if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'actionLogin') {

    $user = (isset($_POST['user']) ? filter_var($_POST['user'], FILTER_SANITIZE_STRING) : null);
    $pass = (isset($_POST['pass']) ? filter_var($_POST['pass'], FILTER_SANITIZE_STRING) : null);
    $recaptcha = (isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : null);
    $login = 'false';

   /*  $request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".Polirubro::GOOGLE_API."&response=".$recaptcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
    $response = json_decode($request);
    
    if ( $response->success === false ) {
        echo 'Captcha Incorrecto!';
        die();
    } */

    $access = new Login($user, $pass);
    $result = $access->loginProcess();

    if ( $result->num_rows > 0 ) :
        while ( $user = $result->fetch_object() ) {
            $_SESSION["id_user"]    = session_id();
            $_SESSION["Id_Cliente"] = $user->Id_Cliente;
            $_SESSION["user"]       = $user->Usuario;
            $login = 'true';
        }
    endif;

    echo $login;
    die();
}

/**
 * Request of Lists of SubCategories
 */
if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'getSubRubroByIdRubro') {

    $id_rubro = filter_var($_POST["id_rubro"], FILTER_VALIDATE_INT);

    $object = new Subrubros();
    $result = $object->getSubRubroByIdRubro($id_rubro);

    $html = '<div class="d-block">';

    while ( $row = $result->fetch_object() ) {
        $html .= '<div>';
        $html .= '<a href="productos.php?id_rubro='. $row->Id_Rubro.'&id_subrubro='.$row->Id_SubRubro.'" class="item sub-item lastlistCTA" data-subrubro="'. $row->Id_SubRubro .'">'. $row->Nombre .'<span></span></a>';
        $html .= '<div class="lastlist"></div>';
        $html .= '</div>';
    }

    $html .= '</div>';

    echo $html;
    die();
}

/**
 * Request of Lists of Groups
 */
if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'getGrupoByIdSubRubro') {

    $id_grupo = filter_var($_POST["id_grupo"], FILTER_VALIDATE_INT);

    $object = new Subrubros();
    $result = $object->getSubRubroByIdGrupo($id_grupo);

    $html = '<div>';

    while ( $row = $result->fetch_object() ) {
        $html .= '<a href="productos.php?id_rubro='. $row->Id_Rubro.'&id_subrubro='.$row->Id_SubRubro.'&id_grupo='.$row->Id_Grupo.'" class="item sub-item">'. $row->Nombre .'<span></span></a>';
    }

    $html .= '</div>';

    echo $html;
    die();
}

/**
 * Request of Insert Product into Cart
 */
if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'insertProductCart') {

    $id_product = (isset($_POST['id_product']) ? filter_var($_POST['id_product'], FILTER_VALIDATE_INT) : null);
    $note    = (isset($_POST['nota']) ? filter_var($_POST['nota'], FILTER_SANITIZE_STRING) : null);
    $cant    = (isset($_POST['cant']) ? filter_var($_POST['cant'], FILTER_VALIDATE_INT) : null);
    $cod_product = (isset($_POST['cod_product']) ? filter_var($_POST['cod_product'], FILTER_VALIDATE_INT) : null);
    $name_product = (isset($_POST['name_product']) ? filter_var($_POST['name_product'], FILTER_SANITIZE_STRING) : null);
    $price_product = (isset($_POST['price_product']) ? filter_var($_POST['price_product'], FILTER_SANITIZE_STRING) : null);

    $order = new Pedidos();
    $result = $order->getPedidoAbierto($_SESSION["Id_Cliente"]);
    $order->closeConnection(); 

    if ( $result['num_rows'] == 0 ) :

        $user = new Usuarios($_SESSION["Id_Cliente"]);

        if ( !$user ) die('false');

        $order = new Pedidos();
        $order->FechaIni = date("Y-m-d");
        $order->ip = $_SERVER['REMOTE_ADDR'];
        $result = $order->insertPedido($user);
        $order->closeConnection();
        $user->closeConnection();

    endif;

    if ( $result['Id_Pedido'] < 1 ) die('false');
    
    $detail = new Detalles();
    $detail->Id_Pedido = $result['Id_Pedido'];
    $detail->Id_Producto = $id_product;
    $detail->CodProducto = $cod_product;
    $detail->Nombre = $name_product;
    $detail->PreVtaFinal1 = $price_product;
    $detail->Cantidad = $cant;
    $detail->ImpTotal = $price_product * $cant;
    $detail->Notas = $note;
    $detail->insertDetalle();
    $detail->closeConnection();

    die('true');
}

/**
 * Request of Update Product into Cart
 */
if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'updateProductCart') {

    $note    = (isset($_POST['nota']) ? filter_var($_POST['nota'], FILTER_SANITIZE_STRING) : null);
    $cant    = (isset($_POST['cant']) ? filter_var($_POST['cant'], FILTER_VALIDATE_INT) : null);
    $CodProducto = (isset($_POST['codprod']) ? filter_var($_POST['codprod'], FILTER_VALIDATE_INT) : null);
    $id_productItem = (isset($_POST['id_item']) ? filter_var($_POST['id_item'], FILTER_VALIDATE_INT) : null);

    $prod = new Productos($CodProducto);

    if ( !$prod ) die('false');

    $item = new Detalles();
    $item->Auto = $id_productItem;
    $item->Cantidad = $cant;
    $item->Notas = $note;
    $item->ImpTotal = $prod->PreVtaFinal1() * $cant;
    $item->updateDetalle();
    $item->closeConnection();
    $prod->closeConnection();

    die('true');
}

/**
 * Request of Delete Item Cart
 */
if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'deleteProductCart') {

    $id_productItem = (isset($_POST['id_item']) ? filter_var($_POST['id_item'], FILTER_VALIDATE_INT) : null);

    $item = new Detalles();
    $item->Auto = $id_productItem;
    $item->deleteDetalle();
    $item->closeConnection();

    die('true');
}