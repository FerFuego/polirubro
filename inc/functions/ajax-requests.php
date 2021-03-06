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
        while ( $user = $result->fetch_object() ) :

            $_SESSION["id_user"]    = session_id();
            $_SESSION["Id_Cliente"] = $user->Id_Cliente;
            $_SESSION["user"]       = $user->Usuario;

            if ($user->is_admin == '1') {
                $login = 'admin';
            } else {
                $login = 'true';
            }

        endwhile;
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

    $html = '<div class="d-block"> <h5>SubCategorias</h5>';

    while ( $row = $result->fetch_object() ) {
        $html .= '<div>';
        $html .= '<a href="productos.php?id_rubro='. $row->Id_Rubro.'&id_subrubro='.$row->Id_SubRubro.'" class="item sub-item lastlistCTA '. $row->Id_SubRubro .'" data-subrubro="'. $row->Id_SubRubro .'">'. $row->Nombre .'<span onclick="loadGroupCategory('. $row->Id_SubRubro .')"></span></a>';
        $html .= '<div class="lastlist lastlist_'. $row->Id_SubRubro .'"></div>';
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

    $id_subrubro = filter_var($_POST["id_subrubro"], FILTER_VALIDATE_INT);

    $object = new Subrubros();
    $result = $object->getGrupoByIdSubRubro($id_subrubro);

    $html = '<div> <h5>Grupos</h5>';

    while ( $row = $result->fetch_object() ) {
        $html .= '<a href="productos.php?id_rubro='. $row->Id_Rubro.'&id_subrubro='.$row->Id_SubRubro.'&id_grupo='.$row->Id_Grupo.'" class="item sub-item">'. $row->Nombre .'</a>';
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

/**
 * Request of Finally Order
 */
if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'finallyOrder') {

    $id_pedido = (isset($_POST['id_pedido']) ? filter_var($_POST['id_pedido'], FILTER_VALIDATE_INT) : null);

    $order = new Pedidos($id_pedido);
    $order->FechaFin = date("Y-m-d");
    $order->Cerrado = 1;
    $order->finalizarPedido();
    
    $user = new Usuarios($_SESSION["Id_Cliente"]);

    $data = new Polirubro();
    $body = $data->getBodyEmail($id_pedido, $user);
    $data->sendMail($id_pedido, $user, $body);

    $user->closeConnection();
    $order->closeConnection();

    die('true');
}

/**
 * Request of Data Client
 */
if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'dataClient') {

    $id_client = (isset($_POST['id_client']) ? filter_var($_POST['id_client'], FILTER_VALIDATE_INT) : null);
    
    if ( $id_client ) {
        $user = new Usuarios($id_client);
        $user->closeConnection();

        echo json_encode($user); 
        die();
    }

    die('false');
}

/**
 * Request of Set data Client
 */
if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'operationClient') {

    $id   = (isset($_POST['id']) ? filter_var($_POST['id'], FILTER_VALIDATE_INT) : null);
    $type = (isset($_POST['type']) ? filter_var($_POST['type'], FILTER_SANITIZE_STRING) : null);
    $name = (isset($_POST['name']) ? filter_var($_POST['name'], FILTER_SANITIZE_STRING) : null);
    $mail = (isset($_POST['mail']) ? filter_var($_POST['mail'], FILTER_SANITIZE_STRING) : null);
    $price = (isset($_POST['price']) ? filter_var($_POST['price'], FILTER_VALIDATE_INT) : null);
    $locality = (isset($_POST['locality']) ? filter_var($_POST['locality'], FILTER_SANITIZE_STRING) : null);
    $username = (isset($_POST['username']) ? filter_var($_POST['username'], FILTER_SANITIZE_STRING) : null);
    $password = (isset($_POST['password']) ? filter_var($_POST['password'], FILTER_SANITIZE_STRING) : null);

    if ( $type == 'new') {
        $user = new Usuarios();
        $user->Id_Cliente = $id;
        $user->Nombre = $name;
        $user->Localidad = $locality;
        $user->Mail = $mail;
        $user->Usuario = $username;
        $user->Password = $password;
        $user->ListaPrecioDef = $price;
        $user->insert();
        $user->closeConnection();
        die('true');
    }

    if ( $type == 'edit' ) {
        $user = new Usuarios();
        $user->Id_Cliente = $id;
        $user->Nombre = $name;
        $user->Localidad = $locality;
        $user->Mail = $mail;
        $user->Usuario = $username;
        $user->Password = $password;
        $user->ListaPrecioDef = $price;
        $user->update();
        $user->closeConnection();
        die('true');
    }

    if ( $type == 'delete' ) {
        $user = new Usuarios();
        $user->Id_Cliente = $id;
        $user->delete();
        $user->closeConnection();
        die('true');
    }

    die('false');
}

/**
 * Request of Data Product
 */
if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'dataProduct') {

    $cod_product = (isset($_POST['cod_product']) ? filter_var($_POST['cod_product'], FILTER_VALIDATE_INT) : null);
    
    if ( $cod_product ) {
        $prod = new Productos($cod_product);
        $prod->closeConnection();

        echo json_encode($prod); 
        die();
    }

    die('false');
}

/**
 * Request of Set data Product
 */
if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'operationProduct') {

    $cod_prod   = (isset($_POST['cod_prod']) ? filter_var($_POST['cod_prod'], FILTER_VALIDATE_INT) : null);
    $name_prod  = (isset($_POST['name_prod']) ? filter_var($_POST['name_prod'], FILTER_SANITIZE_STRING) : null);
    $type   = (isset($_POST['type_prod']) ? filter_var($_POST['type_prod'], FILTER_SANITIZE_STRING) : null);
    $news   = (isset($_POST['news']) ? filter_var($_POST['news'], FILTER_VALIDATE_INT) : null);
    $offer  = (isset($_POST['offer']) ? filter_var($_POST['offer'], FILTER_VALIDATE_INT) : null);
    $observation = (isset($_POST['observation']) ? filter_var($_POST['observation'], FILTER_SANITIZE_STRING) : null);

    if ( $type == 'edit' ) {
        $prod = new Productos($cod_prod);
        $prod->nombre = $name_prod;
        if ($news) $prod->novedad = $news;
        if ($offer) $prod->oferta = $offer;
        $prod->observaciones = $observation;
        $prod->update();
        $prod->closeConnection();
        die('true');
    }

    if ( $type == 'delete' ) {
        $prod = new Productos($cod_prod);
        $prod->delete();
        $prod->closeConnection();
        die('true');
    }

    die('false');
}

/**
 * Request of Set data Banner
 */
if( !empty($_POST) && isset($_POST['action']) && $_POST['action'] == 'operationBanner') {

    $type   = (isset($_POST['type'])  ? filter_var($_POST['type'], FILTER_SANITIZE_STRING) : null);
    $orden  = (isset($_POST['order']) ? filter_var($_POST['order'], FILTER_VALIDATE_INT) : null);
    $title  = (isset($_POST['title']) ? filter_var($_POST['title'], FILTER_SANITIZE_STRING) : null);
    $text   = (isset($_POST['text'])  ? filter_var($_POST['text'], FILTER_SANITIZE_STRING) : null);
    $link   = (isset($_POST['link'])  ? filter_var($_POST['link'], FILTER_SANITIZE_STRING) : null);
    $id_banner = (isset($_POST['id_banner']) ? filter_var($_POST['id_banner'], FILTER_VALIDATE_INT) : null);
    $response  = 0;

    if ( $type == 'new' ) {
            
        if(isset($_FILES['file']['name'])){
            $filename = $_FILES['file']['name'];
            $prefijo = substr(md5(uniqid(rand())),0,6);
            $path = "img/slider/".$prefijo.'_'.$filename;
            $location = "../../img/slider/".$prefijo.'_'.$filename;
            $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
            $imageFileType = strtolower($imageFileType);
            // Valid extensions
            $valid_extensions = array("jpg","jpeg","png");
            // Check file extension
            if(in_array(strtolower($imageFileType), $valid_extensions)) {
                // Upload file
                if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                    $response = $path;
                }
            }
        }

        $banner = new Banners();
        $banner->orden = $orden;
        $banner->image = $response;
        $banner->title = $title;
        $banner->text = $text;
        $banner->link = $link;
        $banner->insert();
        $banner->closeConnection();
        die('true');
    }

    if ( $type == 'delete' ) {
        $banner = new Banners($id_banner);
        $banner->delete();
        $banner->closeConnection();
        die('true');
    }

    die('false');
}