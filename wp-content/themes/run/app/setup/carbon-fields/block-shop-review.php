<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make( __( 'Shop review' ) )
     ->add_fields( [
	     Field::make( 'text', 'crb_shop_review_title', __( 'Title', 'run' ) ),
	     Field::make( 'text', 'crb_shop_review_type', __( 'Type', 'run' ) )
	          ->set_help_text( 'May be one of: only online, only offline, online/offline' ),
	     Field::make( 'text', 'crb_shop_review_url', __( 'URL', 'run' ) ),
	     Field::make( 'text', 'crb_shop_review_country', __( 'country', 'run' ) ),
     ] )
     ->set_icon( 'cart' )
     ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) { ?>
	     <div class="shop-review">
		     <ul class="shop-review__list">
			     <li class="shop-review__item">
				     <span class="shop-review__item-title">Название:</span>
				     <span class="shop-review__item-value"><?php echo $fields['crb_shop_review_title']; ?></span>
			     </li>
			     <?php if ( isset( $fields['crb_shop_review_url'] ) && ! empty( $fields['crb_shop_review_url'] ) ) : ?>
				     <li class="shop-review__item">
					     <span class="shop-review__item-title">Сайт:</span>
					     <span class="shop-review__item-value">
						     <a href="<?php echo $fields['crb_shop_review_url']; ?>"
						        target="_blank"
						        rel="nofollow">
							     <?php echo str_replace( [
								     'http://',
								     'https://'
							     ], '', $fields['crb_shop_review_url'] ); ?>
						     </a>
					     </span>
				     </li>
			     <?php endif; ?>
			     <li class="shop-review__item">
				     <span class="shop-review__item-title"> Тип:</span>
				     <span class="shop-review__item-value"><?php echo $fields['crb_shop_review_type']; ?></span>
			     </li>
			     <li class="shop-review__item">
				     <span class="shop-review__item-title"> Страна:</span>
				     <span class="shop-review__item-value"><?php echo $fields['crb_shop_review_country']; ?></span>
			     </li>
		     </ul>
	     </div>
     <?php } );
