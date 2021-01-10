<div class="col-lg-3">
    <div class="hero__categories">
        <div class="hero__categories__all">
            <i class="fa fa-bars"></i>
            <span>Categorias</span>
        </div>
        <ul>
            <?php 
                $rubros = new Rubros();
                $result = $rubros->getTreeRubros();

                foreach ( $result['rubros'] as $r ) : ?>
                    <li>
                        <a href="" data-rubro="<?php echo $r['id']; ?>" class="item sublistCTA">
                            <?php echo $r['rubro']; ?>
                            <span></span>
                        </a>
                        <div class="sublist">
                            <?php foreach ( $result['subrubros'] as $s ) : 
                                if ( $s['rubro'] == $r['id'] && $r['rubro'] !== $s['subrubro'] ) : ?>
                                    <a href="#" class="sub-item"><?php echo $s['subrubro']; ?></a>
                                <?php endif;
                            endforeach; ?>
                        </div>
                    </li>
            <?php endforeach; 
                $rubros->closeConnection(); ?>
        </ul>
    </div>
</div>