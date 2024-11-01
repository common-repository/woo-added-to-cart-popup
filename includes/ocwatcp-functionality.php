<?php 
if (!defined('ABSPATH'))
  exit;

if (!class_exists('OCWATCP_functionality')) {

  class OCWATCP_functionality {

    /**
    * Constructor.
    *
    * @version 3.2.3
    */
    public $ocwatcp_enablepopup,$ocwatcp_enableminicart_desktop,$ocwatcp_enableminicart_mobile,$ocwatcp_spt_color,$ocwatcp_spt_size,$ocwatcp_spt_position,$ocwatcp_spt_style,$ocwatcp_sms_color,$ocwatcp_sms_bgcolor,$ocwatcp_bs_color,$ocwatcp_bs_bgcolor,$ocwatcp_pis_color,$ocwatcp_pis_size,$ocwatcp_pis_position,$ocwatcp_pis_style,$ocwatcp_pis_pricecolor,$ocwatcp_pis_totalcolor,$ocwatcp_mcs_color,$ocwatcp_mcs_size,$ocwatcp_mcs_position,$ocwatcp_mcs_style;

    function __construct() {
        //Enable Popup
        if ( 'yes' === get_option( 'ocwatcp_enablepopup') ) {
            $this->ocwatcp_enablepopup = get_option('ocwatcp_enablepopup');
        }
        if ( 'yes' === get_option( 'ocwatcp_enableminicart_desktop') ) {
            $this->ocwatcp_enableminicart_desktop = get_option('ocwatcp_enableminicart_desktop', 'yes' ) == 'yes';
        }
        if ( 'yes' === get_option( 'ocwatcp_enableminicart_mobile') ) {
            $this->ocwatcp_enableminicart_mobile = get_option('ocwatcp_enableminicart_mobile', 'yes' ) == 'yes';
        }
        if ( !empty(get_option( 'ocwatcp_spt_color')) ) {
            $this->ocwatcp_spt_color = get_option('ocwatcp_spt_color');
        }
        if ( !empty(get_option( 'ocwatcp_spt_size')) ) {
            $this->ocwatcp_spt_size = get_option('ocwatcp_spt_size');
        }
        if ( !empty(get_option( 'ocwatcp_spt_position')) ) {
            $this->ocwatcp_spt_position = get_option('ocwatcp_spt_position');
        }
        if ( !empty(get_option( 'ocwatcp_spt_style')) ) {
            $this->ocwatcp_spt_style = get_option('ocwatcp_spt_style');
        }
        if ( !empty(get_option( 'ocwatcp_sms_color')) ) {
            $this->ocwatcp_sms_color = get_option('ocwatcp_sms_color');
        }
        if ( !empty(get_option( 'ocwatcp_sms_bgcolor')) ) {
            $this->ocwatcp_sms_bgcolor = get_option('ocwatcp_sms_bgcolor');
        }
        if ( !empty(get_option( 'ocwatcp_bs_color')) ) {
            $this->ocwatcp_bs_color = get_option('ocwatcp_bs_color');
        }
        if ( !empty(get_option( 'ocwatcp_bs_bgcolor')) ) {
            $this->ocwatcp_bs_bgcolor = get_option('ocwatcp_bs_bgcolor');
        }
        if ( !empty(get_option( 'ocwatcp_pis_color')) ) {
            $this->ocwatcp_pis_color = get_option('ocwatcp_pis_color');
        }
        if ( !empty(get_option( 'ocwatcp_pis_size')) ) {
            $this->ocwatcp_pis_size = get_option('ocwatcp_pis_size');
        }
        if ( !empty(get_option( 'ocwatcp_pis_position')) ) {
            $this->ocwatcp_pis_position = get_option('ocwatcp_pis_position');
        }
        if ( !empty(get_option( 'ocwatcp_pis_style')) ) {
            $this->ocwatcp_pis_style = get_option('ocwatcp_pis_style');
        }
        if ( !empty(get_option( 'ocwatcp_pis_pricecolor')) ) {
            $this->ocwatcp_pis_pricecolor = get_option('ocwatcp_pis_pricecolor');
        }
        if ( !empty(get_option( 'ocwatcp_pis_totalcolor')) ) {
            $this->ocwatcp_pis_totalcolor = get_option('ocwatcp_pis_totalcolor');
        }
        if ( !empty(get_option( 'ocwatcp_mcs_color')) ) {
            $this->ocwatcp_mcs_color = get_option('ocwatcp_mcs_color');
        }
        if ( !empty(get_option( 'ocwatcp_mcs_size')) ) {
            $this->ocwatcp_mcs_size = get_option('ocwatcp_mcs_size');
        }
        if ( !empty(get_option( 'ocwatcp_mcs_position')) ) {
            $this->ocwatcp_mcs_position = get_option('ocwatcp_mcs_position');
        }
        if ( !empty(get_option( 'ocwatcp_mcs_style')) ) {
            $this->ocwatcp_mcs_style = get_option('ocwatcp_mcs_style');
        }
    }
      
    protected static $OCWATCP_instance;

      /** Load POPUP **/
      function ocwatcp_open_cartpopup_fragments( $datas ) {

            $show_image = get_option( 'ocwatcp_showffeatures_img', 'yes' ) == 'yes';
            $show_productinfo = get_option( 'ocwatcp_showinfo', 'yes' ) == 'yes';
            $show_viewcart = get_option( 'ocwatcp_showviewcart', 'yes' ) == 'yes';
            $show_contshop = get_option( 'ocwatcp_showcontshop', 'yes' ) == 'yes';
            $show_checkout = get_option( 'ocwatcp_showcheckout', 'yes' ) == 'yes';
            $carturl   = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url();
            $checkouturl   = function_exists( 'wc_get_checkout_url' ) ? wc_get_checkout_url() : WC()->cart->get_checkout_url();
            $product    = isset( $_REQUEST['product_id'] ) ? wc_get_product( $_REQUEST['product_id'] ) : false;
            $show_suggestedproducts = get_option( 'ocwatcp_enablesuggestedpro', 'yes' ) == 'yes';
            // add to cart popup
            ob_start();
            ?>

            <?php if( $product ){ ?>
              <div class="ocwatcp-mainscrolling">
                <a href="#" class="ocwatcp_close">X</a>
                <div class="ocwatcp-added-message" style="background-color: <?php echo $this->ocwatcp_sms_bgcolor;?>; color: <?php echo $this->ocwatcp_sms_color;?>;">
                  <span><?php echo get_option( 'ocwatcp_popupmessage'); ?></span>
                </div>
                <div class="productdata_main">

                  <?php if( $show_image ){ ?>
                    <div class="product_image">
                      <?php echo $product->get_image(); ?>
                    </div>
                  <?php } ?>

                  <?php if( $show_productinfo ){ ?>
                    <div class="product_info">
                      <h3 class="product_title" style="text-align: <?php echo $this->ocwatcp_pis_position;?>; font-size: <?php echo $this->ocwatcp_pis_size."px";?>; font-weight: <?php echo $this->ocwatcp_pis_style;?>;">
                        <a href="<?php echo get_permalink( $product->get_id() );?>" style="color: <?php echo $this->ocwatcp_pis_color;?>;">
                          <?php echo $product->get_title();?>
                        </a>
                      </h3>
                      <div class="product_price" style="color: <?php echo $this->ocwatcp_pis_pricecolor;?>;">
                        <?php echo $product->get_price_html(); ?>
                      </div>
                      <div class="carttotal" style="color:<?php echo $this->ocwatcp_pis_totalcolor;?>">
                        <p>Total: <span class="cart-totalcost"><?php echo WC()->cart->get_cart_total();?></span></p>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <?php if( $show_viewcart || $show_contshop || $show_checkout ){ ?>
                    <div class="product_action">
                      <?php if( $show_contshop ){ ?>
                        <a class="button contshop" style="background-color: <?php echo $this->ocwatcp_bs_bgcolor;?>; color: <?php echo $this->ocwatcp_bs_color;?>;" href="#"><?php echo get_option( 'ocwatcp_showcontshoptxt'); ?></a>
                      <?php } ?>

                      <?php if( $show_viewcart ){ ?>
                        <a class="button carturl" style="background-color: <?php echo $this->ocwatcp_bs_bgcolor;?>; color: <?php echo $this->ocwatcp_bs_color;?>;" href="<?php echo esc_url( $carturl ); ?>"><?php echo get_option( 'ocwatcp_showviewcarttxt'); ?></a>
                      <?php } ?>

                      <?php if( $show_checkout ){ ?>
                        <a class="button checkouturl" style="background-color: <?php echo $this->ocwatcp_bs_bgcolor;?>; color: <?php echo $this->ocwatcp_bs_color;?>;" href="<?php echo esc_url( $checkouturl ); ?>"><?php echo get_option( 'ocwatcp_showcheckouttxt'); ?></a>
                      <?php } ?>
                    </div>
                <?php } ?> 

                <?php if( $show_suggestedproducts){ ?>
                  <div class="woocommmerce suggestedproducts">
                    <h3 class="suggestedproducts_title" style="text-align: <?php echo $this->ocwatcp_spt_position;?>; font-size: <?php echo $this->ocwatcp_spt_size."px";?>; font-weight: <?php echo $this->ocwatcp_spt_style;?>; color: <?php echo $this->ocwatcp_spt_color;?>;">
                        <?php echo get_option( 'ocwatcp_suggestedprotitle' );?>
                    </h3>
                    <?php 
                      $ocwatcp_protype = get_option( 'ocwatcp_protype' );
                      $ocwatcp_suggestedprono = get_option( 'ocwatcp_suggestedprono' );
                      $ocwatcp_suggestedprocolumns = get_option( 'ocwatcp_suggestedprocolumns' );
                      if($ocwatcp_protype == 'related'){
                        $args = array(
                            'posts_per_page' => $ocwatcp_suggestedprono,
                            'columns'        => $ocwatcp_suggestedprocolumns,
                            'orderby'        => 'rand',
                            'order'          => 'desc',
                        );

                        $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
                        $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

                        // Set global loop values.
                        wc_set_loop_prop( 'name', 'related' );
                        wc_set_loop_prop( 'columns', $args['columns'] );

                        $related_products = $args['related_products'];
                        if(!empty($related_products)){
                          if ( $related_products ) : ?>

                            <?php woocommerce_product_loop_start(); ?>

                              <?php foreach ( $related_products as $related_product ) : ?>

                                <?php
                                  $post_object = get_post( $related_product->get_id() );

                                  setup_postdata( $GLOBALS['post'] =& $post_object );

                                  wc_get_template_part( 'content', 'product' ); ?>

                              <?php endforeach; ?>

                            <?php woocommerce_product_loop_end(); ?>

                          <?php endif;

                          wp_reset_postdata();
                          } else { ?>
                            <p class="woocommerce-info"><?php esc_html_e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>
                          <?php }  
                      } else {
                          if($ocwatcp_protype == 'upsell'){
                            $sells_ids = $product->get_upsells();
                          } else if($ocwatcp_protype == 'crossell'){
                            $sells_ids = $product->get_cross_sell_ids();
                          }
                          if(!empty($sells_ids)){
                            $args = array( 
                              'post_type' => 'product', 
                              'posts_per_page' => $ocwatcp_suggestedprono, 
                              'post__in' => $sells_ids 
                            );
                            
                            $upsells = get_posts($args);

                            wc_set_loop_prop( 'columns', $ocwatcp_suggestedprocolumns );

                            if ( $upsells ) : ?>

                              <?php woocommerce_product_loop_start(); ?>

                                <?php foreach ( $upsells as $upsell ) : ?>

                                  <?php
                                    $post_object = get_post( $upsell);

                                    setup_postdata( $GLOBALS['post'] =& $post_object );

                                    wc_get_template_part( 'content', 'product' ); ?>

                                <?php endforeach; ?>

                              <?php woocommerce_product_loop_end(); ?>

                            <?php endif;

                            wp_reset_postdata();
                          } else { ?>
                            <p class="woocommerce-info"><?php esc_html_e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>
                          <?php
                          }
                      } 
                    ?>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>

            <?php
            $carttotal =WC()->cart->get_cart_contents_count();
            $datas['ocwatcp_carttotal'] = $carttotal;
            $datas['ocwatcp_message'] = ob_get_clean();
            $minicart_html = '<div class="ocwatcp-minicart-main-block"><div class="product_cartdata_main">';
            $minicart_html .= '<a href="#" class="ocwatcp_mincart_close">X</a>';
            $minicart_html .= '<h3 class="ocwatcp_cart_title">'.get_option( 'ocwatcp_minicart_title' ).'</h3>';
            $minicart_html .= '<table class="ocwatcp_cartlist"><tbody>';
            $items = WC()->cart->get_cart();
            $current_item = $_REQUEST['product_id'];
            foreach($items as $item => $values) {
              $_product =  wc_get_product( $values['data']->get_id() );
              $minicart_html .= '<tr class="single-cart-item" data-custcartkey="'.$values['key'].'">';
              $minicart_html .= '<td class="item-remove"><span class="remove_itemcartkey">×</span></td>';
              $minicart_html .= '<td class="item-thumb">'. $_product->get_image() .'</td>';
              $minicart_html .= '<td class="item-info"><a href="'.get_permalink( $_product->get_id() ).'">'. $_product->get_title() .'</a></td>';
              $minicart_html .= '<td class="item-price">'.apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $values, $item ).'</td>';
              $minicart_html .= '<td class="item-quantity">'. $values['quantity'] .'</td>';
              $minicart_html .= '<td class="item-subtotal">'. wc_price($values['line_subtotal']) .'</td>';
              $minicart_html .= '</tr>';
            }
            $minicart_html .= '</tbody></table>';
            $minicart_html .= '<div class="cart_info" ><p>Total: <span class="cart-totalcost">'. WC()->cart->get_cart_total().'</span></p></div>';
            if( $show_viewcart || $show_contshop || $show_checkout ){
              $minicart_html .= '<div class="product_action">';
              if( $show_contshop ){ 
                $minicart_html .= '<a class="button contshop1" href="#">'.get_option( 'ocwatcp_showcontshoptxt').'</a>';
              } 
              if( $show_viewcart ){
                $minicart_html .= '<a class="button carturl" href="'.esc_url( $carturl ).'">'.get_option( 'ocwatcp_showviewcarttxt').'</a>';
              }
              if( $show_checkout ){
                $minicart_html .= '<a class="button checkouturl" href="'.esc_url( $checkouturl ).'">'.get_option( 'ocwatcp_showcheckouttxt').'</a>';
              }
              $minicart_html .= '</div>';


            }

            if( $current_item ){ 
              $current_product = wc_get_product( $current_item );
              if( $show_suggestedproducts){ 
                $minicart_html .= '<div class="woocommmerce suggestedproducts ocwatcp_sugminicart"><h3 class="suggestedproducts_title">'.get_option( 'ocwatcp_suggestedprotitle' ).'</h3>'; 
                    $ocwatcp_protype = get_option( 'ocwatcp_protype' );
                    $ocwatcp_suggestedprono = get_option( 'ocwatcp_suggestedprono' );
                    $ocwatcp_suggestedprocolumns = get_option( 'ocwatcp_suggestedprocolumns' );
                    if($ocwatcp_protype == 'related'){

                        $args = array(
                            'posts_per_page' => $ocwatcp_suggestedprono,
                            'columns'        => $ocwatcp_suggestedprocolumns,
                            'orderby'        => 'rand',
                            'order'          => 'desc',
                        );

                        $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $current_product->get_id(), $args['posts_per_page'], $current_product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
                        $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

                        // Set global loop values.
                        wc_set_loop_prop( 'name', 'related' );
                        wc_set_loop_prop( 'columns', $args['columns'] );

                        $related_products = $args['related_products'];
                     
                        ob_start();
                        if(!empty($related_products)){
                          if ( $related_products ) : 

                             woocommerce_product_loop_start();
                              $x = 1;

                              $countrelated = sizeof($related_products);
                               foreach ( $related_products as $related_product ) : 
                                  $post_object = get_post( $related_product->get_id() );
                                  $reated_pro = wc_get_product( $post_object->ID );
                                  if($x % $ocwatcp_suggestedprocolumns == 1  ){ ?>
                                  <li class="product first">
                                  <?php } else if($x % $ocwatcp_suggestedprocolumns == 0 ){ ?>
                                  <li class="product last">
                                  <?php } else {  ?>
                                  <li class="product">
                                  <?php } ?>
                                    <a href="<?php echo get_permalink($post_object->ID); ?>">
                                      <?php echo $reated_pro->get_image(); ?>
                                      <h2 class="woocommerce-loop-product__title"><?php echo $post_object->post_title; ?></h2>
                                      <span class="price">
                                        <?php echo $reated_pro->get_price_html(); ?>
                                      </span>
                                    </a>
                                    <a href="<?php echo get_permalink($post_object->ID); ?>" class="button">View Product</a>
                                  </li>
                                  <?php 
                                  $x++;
                              endforeach; 

                               woocommerce_product_loop_end();

                           endif;

                          wp_reset_postdata(); 
                        } else { ?>
                          <p class="woocommerce-info"><?php esc_html_e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>
                        <?php
                        }   
                    } else {
                        if($ocwatcp_protype == 'upsell'){
                          $sells_ids = $current_product->get_upsells();
                        } else if($ocwatcp_protype == 'crossell'){
                          $sells_ids = $current_product->get_cross_sell_ids();
                        }

                        if(!empty($sells_ids)){

                          $args = array( 
                            'post_type' => 'product', 
                            'posts_per_page' => $ocwatcp_suggestedprono, 
                            'post__in' => $sells_ids 
                          );
                          
                          $upsells = get_posts($args);

                          wc_set_loop_prop( 'columns', $ocwatcp_suggestedprocolumns );

                          if ( $upsells ) :

                            $x = 1;
                            $countupsells = sizeof($upsells);
                           ?>

                            <?php woocommerce_product_loop_start(); ?>

                              <?php foreach ( $upsells as $upsell ) : ?>

                                <?php
                                  $post_object = get_post( $upsell);
                                  $upsell_pro = wc_get_product( $post_object->ID );
                                  if($x == 1){ ?>
                                  <li class="product first">
                                  <?php } else if($x == $countupsells){ ?>
                                  <li class="product last">
                                  <?php } else {  ?>
                                  <li class="product">
                                  <?php } ?>
                                    <a href="<?php echo get_permalink($post_object->ID); ?>">
                                      <?php echo $upsell_pro->get_image(); ?>
                                      <h2 class="woocommerce-loop-product__title"><?php echo $post_object->post_title; ?></h2>
                                      <span class="price">
                                        <?php echo $upsell_pro->get_price_html(); ?>
                                      </span>
                                    </a>
                                    <a href="<?php echo get_permalink($post_object->ID); ?>" class="button">View Product</a>
                                  </li>
                                  <?php 
                                  $x++;
                                  endforeach; ?>

                            <?php woocommerce_product_loop_end(); ?>

                          <?php endif;

                          wp_reset_postdata();
                        } else { ?>
                          <p class="woocommerce-info"><?php esc_html_e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>
                        <?php
                        }
                    }

                      $related_cartval = ob_get_clean(); 
                      $minicart_html .= $related_cartval;  
                $minicart_html .= '</div>';
              }
            }
           
            $minicart_html .= '</div></div>';
            $datas['div.ocwatcp-minicart-main-block'] = $minicart_html;
            return $datas;   
      }

      function ocwatcp_load_template(){ ?>
        <div id="ocwatcp-popup">
          <div class="ocwatcp-overpage"></div>
            <div class="ocwatcp-popupsize">
              <div class="ocwatcp-main-block">
              </div>
            </div>
        </div>
      <?php }

      function ocwatcp_load_minicart_template(){
        global $woocommerce;
        $ocwatcp_showcounter = get_option('ocwatcp_showcounter', 'yes' ) == 'yes';
        $items = WC()->cart->get_cart();
        ?>
        <div id="ocwatcp-minicart-popup">
          <div class="ocwatcp-minicart-overpage"></div>
            <div class="ocwatcp-minicart-popupsize">
              <div class="ocwatcp-minicart-main-block">
                <div class="ocwatcp-minicart-main-block">
                <?php
                  $minicart_html = '<div class="product_cartdata_main" style="display:none">';
                  $minicart_html .= '<a href="#" class="ocwatcp_mincart_close">X</a>';
                  $minicart_html .= '<h3 class="ocwatcp_cart_title">'.get_option( 'ocwatcp_minicart_title' ).'</h3>';
                  $minicart_html .= '<table class="ocwatcp_cartlist"><tbody>';
                  $items = WC()->cart->get_cart();
                  $current_item = $_REQUEST['product_id'];
                  foreach($items as $item => $values) {
                    $_product =  wc_get_product( $values['data']->get_id() );
                    $minicart_html .= '<tr class="single-cart-item" data-custcartkey="'.$values['key'].'">';
                    $minicart_html .= '<td class="item-remove"><span class="remove_itemcartkey">×</span></td>';
                    $minicart_html .= '<td class="item-thumb">'. $_product->get_image() .'</td>';
                    $minicart_html .= '<td class="item-info"><a href="'.get_permalink( $_product->get_id() ).'">'. $_product->get_title() .'</a></td>';
                    $minicart_html .= '<td class="item-price">'.apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $values, $item ).'</td>';
                    $minicart_html .= '<td class="item-quantity">'. $values['quantity'] .'</td>';
                    $minicart_html .= '<td class="item-subtotal">'. wc_price($values['line_subtotal']) .'</td>';
                    $minicart_html .= '</tr>';
                  }
                  $minicart_html .= '</tbody></table>';
                  $minicart_html .= '<div class="cart_info" ><p>Total: <span class="cart-totalcost">'. WC()->cart->get_cart_total().'</span></p></div>';
                  if( $show_viewcart || $show_contshop || $show_checkout ){
                    $minicart_html .= '<div class="product_action">';
                    if( $show_contshop ){ 
                      $minicart_html .= '<a class="button contshop1" href="#">'.get_option( 'ocwatcp_showcontshoptxt').'</a>';
                    } 
                    if( $show_viewcart ){
                      $minicart_html .= '<a class="button carturl" href="'.esc_url( $carturl ).'">'.get_option( 'ocwatcp_showviewcarttxt').'</a>';
                    }
                    if( $show_checkout ){
                      $minicart_html .= '<a class="button checkouturl" href="'.esc_url( $checkouturl ).'">'.get_option( 'ocwatcp_showcheckouttxt').'</a>';
                    }
                    $minicart_html .= '</div>';


                  }

                  if( $current_item ){ 
                    $current_product = wc_get_product( $current_item );
                    if( $show_suggestedproducts){ 
                      $minicart_html .= '<div class="woocommmerce suggestedproducts ocwatcp_sugminicart"><h3 class="suggestedproducts_title">'.get_option( 'ocwatcp_suggestedprotitle' ).'</h3>'; 
                          $ocwatcp_protype = get_option( 'ocwatcp_protype' );
                          $ocwatcp_suggestedprono = get_option( 'ocwatcp_suggestedprono' );
                          $ocwatcp_suggestedprocolumns = get_option( 'ocwatcp_suggestedprocolumns' );
                          if($ocwatcp_protype == 'related'){

                              $args = array(
                                  'posts_per_page' => $ocwatcp_suggestedprono,
                                  'columns'        => $ocwatcp_suggestedprocolumns,
                                  'orderby'        => 'rand',
                                  'order'          => 'desc',
                              );

                              $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $current_product->get_id(), $args['posts_per_page'], $current_product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
                              $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

                              // Set global loop values.
                              wc_set_loop_prop( 'name', 'related' );
                              wc_set_loop_prop( 'columns', $args['columns'] );

                              $related_products = $args['related_products'];
                           
                              ob_start();
                              if(!empty($related_products)){
                                if ( $related_products ) : 

                                   woocommerce_product_loop_start();
                                    $x = 1;

                                    $countrelated = sizeof($related_products);
                                     foreach ( $related_products as $related_product ) : 
                                        $post_object = get_post( $related_product->get_id() );
                                        $reated_pro = wc_get_product( $post_object->ID );
                                        if($x % $ocwatcp_suggestedprocolumns == 1  ){ ?>
                                        <li class="product first">
                                        <?php } else if($x % $ocwatcp_suggestedprocolumns == 0 ){ ?>
                                        <li class="product last">
                                        <?php } else {  ?>
                                        <li class="product">
                                        <?php } ?>
                                          <a href="<?php echo get_permalink($post_object->ID); ?>">
                                            <?php echo $reated_pro->get_image(); ?>
                                            <h2 class="woocommerce-loop-product__title"><?php echo $post_object->post_title; ?></h2>
                                            <span class="price">
                                              <?php echo $reated_pro->get_price_html(); ?>
                                            </span>
                                          </a>
                                          <a href="<?php echo get_permalink($post_object->ID); ?>" class="button">View Product</a>
                                        </li>
                                        <?php 
                                        $x++;
                                    endforeach; 

                                     woocommerce_product_loop_end();

                                 endif;

                                wp_reset_postdata(); 
                              } else { ?>
                                <p class="woocommerce-info"><?php esc_html_e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>
                              <?php
                              }   
                          } else {
                              if($ocwatcp_protype == 'upsell'){
                                $sells_ids = $current_product->get_upsells();
                              } else if($ocwatcp_protype == 'crossell'){
                                $sells_ids = $current_product->get_cross_sell_ids();
                              }

                              if(!empty($sells_ids)){

                                $args = array( 
                                  'post_type' => 'product', 
                                  'posts_per_page' => $ocwatcp_suggestedprono, 
                                  'post__in' => $sells_ids 
                                );
                                
                                $upsells = get_posts($args);

                                wc_set_loop_prop( 'columns', $ocwatcp_suggestedprocolumns );

                                if ( $upsells ) :

                                  $x = 1;
                                  $countupsells = sizeof($upsells);
                                 ?>

                                  <?php woocommerce_product_loop_start(); ?>

                                    <?php foreach ( $upsells as $upsell ) : ?>

                                      <?php
                                        $post_object = get_post( $upsell);
                                        $upsell_pro = wc_get_product( $post_object->ID );
                                        if($x == 1){ ?>
                                        <li class="product first">
                                        <?php } else if($x == $countupsells){ ?>
                                        <li class="product last">
                                        <?php } else {  ?>
                                        <li class="product">
                                        <?php } ?>
                                          <a href="<?php echo get_permalink($post_object->ID); ?>">
                                            <?php echo $upsell_pro->get_image(); ?>
                                            <h2 class="woocommerce-loop-product__title"><?php echo $post_object->post_title; ?></h2>
                                            <span class="price">
                                              <?php echo $upsell_pro->get_price_html(); ?>
                                            </span>
                                          </a>
                                          <a href="<?php echo get_permalink($post_object->ID); ?>" class="button">View Product</a>
                                        </li>
                                        <?php 
                                        $x++;
                                        endforeach; ?>

                                  <?php woocommerce_product_loop_end(); ?>

                                <?php endif;

                                wp_reset_postdata();
                              } else { ?>
                                <p class="woocommerce-info"><?php esc_html_e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>
                              <?php
                              }
                          }

                            $related_cartval = ob_get_clean(); 
                            $minicart_html .= $related_cartval;  
                      $minicart_html .= '</div>';
                    }
                  }
                 
                  $minicart_html .= '</div>';
                  echo $minicart_html;
                ?>
                </div>
              </div>
            </div>
        </div>
       <div id="ocwatcp-mini-cart">
          <div class="carticon-img"><img src="<?php echo OCWATCP_PLUGIN_DIR . '/assets/images/shopping-cart.png';?>"></div>
            <?php if($ocwatcp_showcounter){ ?>
              <div class="cartitem-count">
                <span class="ocwatcp_countc"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
              </div>
            <?php } ?>
       </div>
      <?php
      }

      //Extra style
      function ocwatcp_extra_style(){ ?>
        <style type="text/css">
          .suggestedproducts a.button{
            background-color: <?php echo $this->ocwatcp_bs_bgcolor;?> !important; 
            color: <?php echo $this->ocwatcp_bs_color;?> !important;
          }
          .suggestedproducts span.price{
            color: <?php echo $this->ocwatcp_pis_pricecolor;?> !important;
          }
          .suggestedproducts .woocommerce-loop-product__title{
            color: <?php echo $this->ocwatcp_pis_color;?> !important;
          }
          h3.ocwatcp_cart_title
          {
            text-align: <?php echo $this->ocwatcp_mcs_position;?>; 
            font-size: <?php echo $this->ocwatcp_mcs_size.'px';?>; 
            font-weight: <?php echo $this->ocwatcp_mcs_style;?>; 
            color: <?php echo $this->ocwatcp_mcs_color;?>;
          }
          .ocwatcp_cartlist tr.single-cart-item td.item-price{
            color: <?php echo $this->ocwatcp_pis_pricecolor;?>;
          }
          .ocwatcp_cartlist tr.single-cart-item td.item-quantity{
            color: <?php echo $this->ocwatcp_pis_pricecolor;?>;
          }
          .ocwatcp_cartlist tr.single-cart-item td.item-subtotal{
            color: <?php echo $this->ocwatcp_pis_pricecolor;?>;
          }
          .ocwatcp_cartlist td.item-info a{
            color: <?php echo $this->ocwatcp_pis_color;?>;
          }
          .product_cartdata_main .cart_info{
            color:<?php echo $this->ocwatcp_pis_totalcolor;?>;
          }
          .product_cartdata_main a.button{
            background-color : <?php echo $this->ocwatcp_bs_bgcolor;?>;
            color : <?php echo $this->ocwatcp_bs_color;?>;
          }
          .woocommmerce.suggestedproducts.ocwatcp_sugminicart h3.suggestedproducts_title{
            text-align:<?php echo $this->ocwatcp_spt_position;?>;
            font-size:<?php echo $this->ocwatcp_spt_size.'px';?>;
            font-weight:<?php echo $this->ocwatcp_spt_style;?>;
            color:<?php echo $this->ocwatcp_spt_color;?>;

          }
        </style>

      <?php  
      }

      //Update cart quantity
      function ocwatcp_remove_item_from_cart() {
        $custcartkey = $_POST['custcartkey'];
        if($custcartkey){
           WC()->cart->remove_cart_item($custcartkey);
        } 
        $ocwatcp_data = array('cartkey' => $custcartkey ,
                              'cartcount' => WC()->cart->get_cart_contents_count(),
                              'carttotal' => WC()->cart->get_cart_total());
        $ocwatcp_data_json = json_encode($ocwatcp_data);
        echo $ocwatcp_data_json;
        exit();
      }

      function init() {
          if($this->ocwatcp_enablepopup === 'yes'){

            //load popup data
            add_filter( 'woocommerce_add_to_cart_fragments',  array( $this, 'ocwatcp_open_cartpopup_fragments' ), 10, 1 );

            //create popup 
            add_action( 'wp_footer', array( $this, 'ocwatcp_load_template' ) );

            //create minicart 
            if($this->ocwatcp_enableminicart_desktop && !wp_is_mobile()){
              add_filter( 'wp_footer', array( $this, 'ocwatcp_load_minicart_template' ) ); 
            }
            if($this->ocwatcp_enableminicart_mobile && wp_is_mobile()){
              add_filter( 'wp_footer', array( $this, 'ocwatcp_load_minicart_template' ) ); 
            }
            add_action('wp_head', array( $this, 'ocwatcp_extra_style' ) ); 
            add_action('wp_ajax_remove_item_from_cart', array( $this, 'ocwatcp_remove_item_from_cart' ) ); 
            add_action('wp_ajax_nopriv_remove_item_from_cart', array( $this, 'ocwatcp_remove_item_from_cart' ) ); 

          }
      }

        public static function OCWATCP_instance() {
          if (!isset(self::$OCWATCP_instance)) {
            self::$OCWATCP_instance = new self();
            self::$OCWATCP_instance->init();
          }
          return self::$OCWATCP_instance;
        }
  }

  OCWATCP_functionality::OCWATCP_instance();
}
