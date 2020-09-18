<?php
/**
	 * Shortcodes
	 *
	 */
	 
	 //
	 
  global $onetone_shortcodes , $portfolio_categories;
	  
 function onetone_get_nav_array(){
	 $menus = get_terms('nav_menu');
	 $items = array();
		  foreach($menus as $menu){
			$items[$menu->term_id] = $menu->name;
		  } 
	 return $items;
	 }
	 
	 
 function onetone_get_post_categories(){
	  $post_categories = array();
 $post_type_array      = array();
 $args = array( 'hide_empty=0' );
 $terms = get_terms('category', $args);
 $post_categories[""] = "All";
 $count = count($terms); $i=0;
	if ($count > 0) {
		foreach ($terms as $term) {
			$i++;
			if(isset($term->slug) && isset($term->name)){
			$post_categories[$term->slug] = $term->name;
			}
		}
	}
	return $post_categories;
	 }

 //
 
 $portfolio_categories = array();
 $post_type_array      = array();
 $args = array( 'hide_empty'=>0,'post_type' => 'portfolio','posts_per_page' => -1 );
 $terms = get_terms('portfolio-category', $args);
 $portfolio_categories[""] = "All";
 
 $count = 0;
 if(is_array($terms))
 $count = count($terms);
 $i=0;
 
 if ($count > 0) {
	foreach ($terms as $term) {
		$i++;
		if(isset($term->slug) && isset($term->name)){
		$portfolio_categories[$term->slug] = $term->name;
		}
	}
 }
	 
 $onetone_shortcodes = array(
	 'align' => array(
  array("type"=>"select","std"=>"left","id"=>"align","title"=>__("Align",'onetone') ,"desc"=>'',"options"=>array("left"=>"left","right"=>"right","center"=>"center")), 
  array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone')),
  array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'onetone') ,"desc"=>'')
  ) ,
  'animation' => array(
 array("type"=>"select","std"=>"1.5","id"=>"animation_speed","title"=>__("Animation Speed",'onetone') ,"desc"=>'',"options"=>array("0.1"=>"0.1","0.2"=>"0.2","0.3"=>"0.3","0.4"=>"0.4","0.5"=>"0.5","0.6"=>"0.6","0.7"=>"0.7","0.8"=>"0.8","0.9"=>"0.9","1"=>"1","1.2"=>"1.2","1.4"=>"1.4","1.6"=>"1.6","1.8"=>"1.8","2"=>"2","2.4"=>"2.4","2.6"=>"2.6","2.8"=>"2.8","3"=>"3")), 
  array("type"=>"select","std"=>"bounce","id"=>"animation_type","title"=>__("Animation Type",'onetone') ,"desc"=>'',"options"=>array("flash"=>"flash","shake"=>"shake","bounce"=>"bounce","scale"=>"scale","smush"=>"smush","spin"=>"spin","fade"=>"fade","fade-left"=>"fade-left","fade-right"=>"fade-right","fade-up"=>"fade-up","fade-down"=>"fade-down","slide-left"=>"slide-left","slide-right"=>"slide-right","slide-up"=>"slide-up","slide-down"=>"slide-down")),
  array("type"=>"select","std"=>"no","id"=>"image_animation","title"=>__("Image Animation",'onetone') ,"desc"=>__('Image animation only','onetone'),"options"=>array("no"=>"no","yes"=>"yes")),
  array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone')),
  array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'onetone') ,"desc"=>'')
  ),
  'button' => array(
	 array("type"=>"select","std"=>"normal","id"=>"size","title"=>__("Size",'onetone') ,"desc"=>'',"options"=>array("normal"=>"normal","large"=>"large")),
	 array("type"=>"select","std"=>"no","id"=>"rounded","title"=>__("Rounded",'onetone') ,"desc"=>'',"options"=>array("no"=>"no","yes"=>"yes")),
	 array("type"=>"text","std"=>"#","id"=>"link","title"=>__("Button Link",'onetone') ,"desc"=>''),
	  array("type"=>"select","std"=>"_blank","id"=>"target","title"=>__("Target",'onetone') ,"desc"=>'',"options"=>array("_blank"=>"_blank","_self"=>"_self","_parent"=>"_parent","_top"=>"_top")),
	  array("type"=>"text","std"=>"#666","id"=>"color","title"=>__("Color",'onetone') ,"desc"=>''),
	  
	 array("type"=>"textarea","std"=>" Button ","id"=>"text_content","title"=>__("Button Text",'onetone') ,"desc"=>''),	
     	
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone'))	
	
	
  ),	 
  'boxed'  => array(
	// array("type"=>"text","std"=>"","id"=>"width","title"=>__("Box Width",'onetone') ,"desc"=>__('Default 1170','onetone')),
     array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone'))
  ),				   
  'column' => array(
   array("type"=>"select","std"=>"","id"=>"col_xs","title"=>__("Extra small grid( &lt; 768px)",'onetone') ,"desc"=>__("Select column width. This width will be calculated depend page width.",'onetone'),"options"=>array(""=>"default","1"=>"1/12","2"=>"2/12","3"=>"3/12","4"=>"4/12","5"=>"5/12","6"=>"6/12","7"=>"7/12","8"=>"8/12","9"=>"9/12","10"=>"10/12","11"=>"11/12","12"=>"12/12")),
  array("type"=>"select","std"=>"6","id"=>"col_sm","title"=>__("Small grid(&ge;  768px)",'onetone')  ,"desc"=>'',"options"=>array("1"=>"1/12","2"=>"2/12","3"=>"3/12","4"=>"4/12","5"=>"5/12","6"=>"6/12","7"=>"7/12","8"=>"8/12","9"=>"9/12","10"=>"10/12","11"=>"11/12","12"=>"12/12")),
    array("type"=>"select","std"=>"3","id"=>"col_md","title"=>__("Medium grid( &ge;  992px)",'onetone'),"desc"=>'',"options"=>array("1"=>"1/12","2"=>"2/12","3"=>"3/12","4"=>"4/12","5"=>"5/12","6"=>"6/12","7"=>"7/12","8"=>"8/12","9"=>"9/12","10"=>"10/12","11"=>"11/12","12"=>"12/12")),
    array("type"=>"select","std"=>"","id"=>"col_lg","title"=>__("Large grid( &ge;  1200px)",'onetone') ,"desc"=>'',"options"=>array(""=>"default","1"=>"1/12","2"=>"2/12","3"=>"3/12","4"=>"4/12","5"=>"5/12","6"=>"6/12","7"=>"7/12","8"=>"8/12","9"=>"9/12","10"=>"10/12","11"=>"11/12","12"=>"12/12")),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone')),
	array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'onetone') ,"desc"=>'')
	),
   'divider'  => array(
	 array("type"=>"select","std"=>"","id"=>"style","title"=>__("Style",'onetone') ,"options"=>array(""=>"blank","1"=>"1","2"=>"2","3"=>"3","4"=>"4")),
	 array("type"=>"text","std"=>"20","id"=>"height","title"=>__("Divider Height",'onetone') ,"desc"=>'px'),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone'))
  )
   , 
  
	'menu' => array(
					
		array("type"=>"select","std"=>"","id"=>"item","title"=>__("Menu",'onetone') ,"options"=>onetone_get_nav_array()) ,
		array("type"=>"select","std"=>"static","id"=>"position","title"=>__("Position",'onetone') ,"options"=>array("static"=>"static","fixed"=>"fixed")),
		array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone'))			
		),
	
	
	 'contact'  => array(
	array("type"=>"select","std"=>"3","id"=>"style","title"=>__("Style",'onetone') ,"options"=>array("1"=>"1","2"=>"2","3"=>"3")),
	array("type"=>"text","std"=>get_option( 'admin_email' ),"id"=>"email","title"=>__("Contact Email",'onetone') ,"desc"=>''),
	 array("type"=>"textarea","std"=>"\n[form_field type='input' name='YOUR NAME' required='1'  options='']\n
[form_field type='input' is_email='1' name='YOUR EMAIL' required='1'  options='']\n
[form_field type='input' name='SUBJECT' required='1'  options='']\n
[form_field type='select' name='QUESTION TYPE' required='1'  options='Type Item One,Type Item Two,Type Item Three']\n
[form_field type='textarea' name='MESSAGE' required='1'  options='']\n","id"=>"text_content","title"=>__("List Items",'onetone') ,"desc"=>''),
	 
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone'))
	 
  ), 
	 
 'portfolio'  => array(
	array("type"=>"text","std"=>"4","id"=>"num","title"=>__("List Num",'onetone') ,"desc"=>''),
	array("type"=>"select","std"=>"4","id"=>"columns","title"=>__("Columns",'onetone') ,"options"=>array("2"=>"2","3"=>"3","4"=>"4")),
	array("type"=>"select","std"=>"","id"=>"category","title"=>__("Category",'onetone') ,"options"=>$portfolio_categories),
	array("type"=>"select","std"=>"0","id"=>"pagenav","title"=>__("Display Pagenav",'onetone') ,"options"=>array("0"=>"no","1"=>"yes")),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone'))
	 
  ),
	  'pricing'  => array(
	 array("type"=>"select","std"=>"1","id"=>"style","title"=>__("Style",'onetone') ,"options"=>array("1"=>"1","2"=>"2")),  
	 array("type"=>"text","std"=>"$","id"=>"currency","title"=>__("Currency",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"29","id"=>"price","title"=>__("Price",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"title","title"=>__("Title",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"sub_title","title"=>__("Sub-title",'onetone') ,"desc"=>''),
	 array("type"=>"select","std"=>"0","id"=>"featured","title"=>__("Featured",'onetone') ,"options"=>array("0"=>"no","1"=>"yes")),
	 array("type"=>"text","std"=>"","id"=>"btn_text","title"=>__("Button Text",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"#","id"=>"btn_link","title"=>__("Button Link",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"fa-shopping-cart","id"=>"btn_icon","title"=>__("Button Icon",'onetone') ,"desc"=>__('Font Awesome Icon.','onetone')),
	 array("type"=>"textarea","std"=>"[pricing_item]5 GB Bandwidth[/pricing_item]\n[pricing_item]1 GB[/pricing_item]\n[pricing_item]8 GB Storage[/pricing_item]\n[pricing_item]Limited[/pricing_item]\n[pricing_item]2 Projects[/pricing_item]\n","id"=>"text_content","title"=>__("List Items",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone'))
  )
	 ,
'pricing_item'  => array(
	array("type"=>"textarea","std"=>"","id"=>"text_content","title"=>__("Content",'onetone') ,"desc"=>'')
	 
  ),
	 
  'row'  => array(
	 array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone'))
  ),
  
   'section'  => array(
	 array("type"=>"text","std"=>"#ffffff","id"=>"background_color","title"=>__("Section Background Color",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"background_image","title"=>__("Section Background Image",'onetone') ,"desc"=>''),
	 array("type"=>"select","std"=>"","id"=>"background_repeat","title"=>__("Background Repeat",'onetone') ,"options"=>array("repeat"=>"repeat all","no-repeat"=>"no-repeat","repeat-x"=>"repeat-x","repeat-y"=>"repeat-y")),
	 array("type"=>"select","std"=>"off","id"=>"background_size","title"=>__("100% Background Image",'onetone') ,"options"=>array("off"=>"off","on"=>"on")),
	 array("type"=>"select","std"=>"","id"=>"parallax","title"=>__("Parallax Scrolling Background Image",'onetone') ,"options"=>array("off"=>"off","on"=>"on")),
	 array("type"=>"text","std"=>"","id"=>"heading_color","title"=>__("Heading Font Color",'onetone') ,"desc"=>__('h1-h6 color, e.g. #ffffff','onetone')),
	 array("type"=>"text","std"=>"","id"=>"color","title"=>__("Font Color",'onetone') ,"desc"=>'e.g. #ffffff'),
	 array("type"=>"text","std"=>"","id"=>"padding","title"=>__("Section Padding",'onetone') ,"desc"=>__('e.g. 60px 0','onetone')),
     array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"id","title"=>__("ID",'onetone') ,"desc"=>__('Scrolling to a specified target.','onetone')),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone'))
  )
   ,
     'team'  => array(
	 array("type"=>"select","std"=>"1","id"=>"style","title"=>__("Style",'onetone') ,"options"=>array("1"=>"1","2"=>"2","3"=>"3")),  
	 array("type"=>"text","std"=>"","id"=>"name","title"=>__("Member Name",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"byline","title"=>__("Byline",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"avatar","title"=>__("Avatar",'onetone') ,"desc"=>__('Size 238 x 271 px for 3/12 column','onetone')),
	 array("type"=>"select","std"=>"","id"=>"social_icon_1","title"=>__("Social Icon 1",'onetone') ,"options"=>
																		array("skype"=>"skype","facebook"=>"facebook","twitter"=>"twitter","google-plus"=>"google+","youtube"=>"youtube","linkedin"=>"linkedin","pinterest"=>"pinterest","email"=>"email","instagram"=>"instagram","deviantart"=>"deviantart","soundcloud"=>"soundcloud","vimeo"=>"vimeo","flickr"=>"flickr")),
	 array("type"=>"text","std"=>"","id"=>"social_link_1","title"=>__("Social Link 1",'onetone') ,"desc"=>''),
	 array("type"=>"select","std"=>"","id"=>"social_icon_2","title"=>__("Social Icon 2",'onetone') ,"options"=>array("skype"=>"skype","facebook"=>"facebook","twitter"=>"twitter","google-plus"=>"google+","youtube"=>"youtube","linkedin"=>"linkedin","pinterest"=>"pinterest","email"=>"email","instagram"=>"instagram","deviantart"=>"deviantart","soundcloud"=>"soundcloud","vimeo"=>"vimeo","flickr"=>"flickr")),
	 array("type"=>"text","std"=>"","id"=>"social_link_2","title"=>__("Social Link 2",'onetone') ,"desc"=>''),
	 array("type"=>"select","std"=>"","id"=>"social_icon_3","title"=>__("Social Icon 3",'onetone') ,"options"=>array("skype"=>"skype","facebook"=>"facebook","twitter"=>"twitter","google-plus"=>"google+","youtube"=>"youtube","linkedin"=>"linkedin","pinterest"=>"pinterest","email"=>"email","instagram"=>"instagram","deviantart"=>"deviantart","soundcloud"=>"soundcloud","vimeo"=>"vimeo","flickr"=>"flickr")),
	 array("type"=>"text","std"=>"","id"=>"social_link_3","title"=>__("Social Link 3",'onetone') ,"desc"=>''),
	 array("type"=>"select","std"=>"","id"=>"social_icon_4","title"=>__("Social Icon 4",'onetone') ,"options"=>array("skype"=>"skype","facebook"=>"facebook","twitter"=>"twitter","google-plus"=>"google+","youtube"=>"youtube","linkedin"=>"linkedin","pinterest"=>"pinterest","email"=>"email","instagram"=>"instagram","deviantart"=>"deviantart","soundcloud"=>"soundcloud","vimeo"=>"vimeo","flickr"=>"flickr")),
	 array("type"=>"text","std"=>"","id"=>"social_link_4","title"=>__("Social Link 4",'onetone') ,"desc"=>''),
	 array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Description",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone'))
  ),
	 
  'service'  => array(
	 array("type"=>"select","std"=>"","id"=>"style","title"=>__("Style",'onetone') ,"options"=>array("1"=>"1","2"=>"2","3"=>"3","4"=>"4")),
     array("type"=>"text","std"=>"Our Service","id"=>"title","title"=>__("Title",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"fa-gift","id"=>"icon","title"=>__("Icon",'onetone') ,"desc"=>__('Font Awesome Icon or Image URL','onetone')),
	 //array("type"=>"text","std"=>"","id"=>"icon_color","title"=>__("Icon Color",'onetone') ,"desc"=>'e.g. #00b7ee'),
	 array("type"=>"text","std"=>"#","id"=>"link","title"=>__("Link",'onetone') ,"desc"=>__('Read more link.','onetone')),
	 array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'onetone') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'onetone') ,"desc"=>__('Extra CSS class','onetone'))
  ),
 
  'timeline'  => array(
	array("type"=>"text","std"=>"3","id"=>"num","title"=>__("Blog List Num",'onetone') ,"desc"=>''),
	array("type"=>"select","std"=>"","id"=>"category","title"=>__("Category",'onetone') ,"options"=>onetone_get_post_categories()),
	array("type"=>"text","std"=>"60","id"=>"excerpt_length","title"=>__("Excerpt Length",'onetone') ,"desc"=>__('Number of words.','onetone'))
	 
  )
  
	);
	
	
	foreach($onetone_shortcodes as $onetone_shortcode => $std){
  add_shortcode($onetone_shortcode,'onetone_'.$onetone_shortcode.'_shortcode');
}


		  
/**
	 * Shortcode: align
	 *
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */ 
	 function onetone_align_shortcode($atts,$content=NULL){
	 extract( shortcode_atts( array(
	  'align' =>'left',
	  'css_class'   => ''
	  ), $atts ) );
	  $return = '<div class="onetone-shortcode align-'.$align.' '.$css_class.'" style="width:100%;">'.do_shortcode(onetone_fix_shortcodes( $content) ).'</div>';
	 
	 return $return;
	 }
	 
	  /**
	 * Shortcode: css animation
	 *
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */ 
	 function onetone_animation_shortcode($atts,$content=NULL){
	 extract( shortcode_atts( array(
	  'css_class'   => '',
	  'animation_speed' => '0.5',
	  'animation_type' => 'bounce',
	  'image_animation' =>'no'
	  ), $atts ) );
	 
	 $animation = 'data-animationduration="'.$animation_speed.'" data-animationtype="'.$animation_type.'" data-imageanimation="'.$image_animation.'"';
	 
	  $return = '<div class="animated '.$css_class.'" '.$animation.'>'.do_shortcode(onetone_fix_shortcodes( $content) ).'</div>';
	 
	 return $return;
	 }
	 
/**
	 * Shortcode: button
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function onetone_button_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'size' => '',
  'rounded' =>'',
  'link' => '#',
  'target' => '_blank',
  'color' => '#666'
  ), $atts ) );
   
   $css_style = "";
 if( $size == "large" ){
	 $css_class .= " btn-lg";
	 }
 if( $rounded == "yes" ){
	 $css_class .= " btn-rd";
	 }
  if( $color != "" ){
	  $css_style .= 'color:'.$color.';border-color:'.$color.';';
	  }
 $return = '<a  href="'.$link.'" target="'.$target.'" ><button class="onetone-shortcode btn '.$css_class.'" style="'.$css_style.'">'.do_shortcode( onetone_fix_shortcodes( $content ) ).'</button></a>';
							
	 return $return ;	
							
 }
 
 /**
	 * Shortcode: boxed
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function onetone_boxed_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'width'=> ''
  ), $atts ) );
 if($width != ""){
	 if(is_numeric($width))
	 $width = $width."px";
	 
	 $width = "width:".$width.";";
	 }
 $return = '<div class="onetone-shortcode  container '.$css_class.'" style="'.$width.'">'.do_shortcode( onetone_fix_shortcodes( $content ) ).'</div>';
							
	 return $return ;	
							
 }
 
	 
/**
	 * Shortcode: column
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function onetone_column_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'col_xs' => '',
  'col_sm' => '',
  'col_md' => '',
  'col_lg' => '',
  
  'col_sm_offset' =>'', 
  'col_md_offset' =>'', 
  'col_lg_offset' =>'', 
  
  'col_sm_push' =>'', 
  'col_md_push' =>'', 
  'col_lg_push' =>'', 
  
  'col_sm_pull' =>'', 
  'col_md_pull' =>'', 
  'col_lg_pull' =>'',
  'css_class'   =>''

  ), $atts ) );
  
  $col_class = "";
  if(trim($col_xs) != "" && is_numeric($col_xs)){  $col_class .= "col-xs-".$col_xs." ";}
  if(trim($col_sm) != "" && is_numeric($col_sm)){  $col_class .= "col-sm-".$col_sm." ";}
  if(trim($col_md) != "" && is_numeric($col_md)){  $col_class .= "col-md-".$col_md." ";}
  if(trim($col_lg) != "" && is_numeric($col_lg)){  $col_class .= "col-lg-".$col_lg." ";}
  
  if(trim($col_sm_offset) != "" && is_numeric($col_sm_offset)){  $col_class .= "col-sm-offset-".$col_sm_offset." ";}
  if(trim($col_md_offset) != "" && is_numeric($col_md_offset)){  $col_class .= "col-md-offset-".$col_md_offset." ";}
  if(trim($col_lg_offset) != "" && is_numeric($col_lg_offset)){  $col_class .= "col-lg-offset-".$col_lg_offset." ";}
  
  if(trim($col_sm_push) != "" && is_numeric($col_sm_push)){  $col_class .= "col-sm-push-".$col_sm_push." ";}
  if(trim($col_md_push) != "" && is_numeric($col_md_push)){  $col_class .= "col-md-push-".$col_md_push." ";}
  if(trim($col_lg_push) != "" && is_numeric($col_lg_push)){  $col_class .= "col-lg-push-".$col_lg_push." ";}
  
  if(trim($col_sm_pull) != "" && is_numeric($col_sm_pull)){  $col_class .= "col-sm-pull-".$col_sm_pull." ";}
  if(trim($col_md_pull) != "" && is_numeric($col_md_pull)){  $col_class .= "col-md-pull-".$col_md_pull." ";}
  if(trim($col_lg_pull) != "" && is_numeric($col_lg_pull)){  $col_class .= "col-lg-pull-".$col_lg_pull." ";}
  
  if(trim($css_class) != ""){  $col_class .= $css_class;}
  
  $return  = '<div class="onetone-shortcode '.$col_class.'">';
  $return .= do_shortcode(onetone_fix_shortcodes( $content) );
  $return .= '<div class="clear"></div>';
  $return .= '</div>';
  return $return ;
 }
 
  /**
	 * Shortcode: Contact Form
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function onetone_form_field_shortcode( $atts,$content=NULL ){
	  extract( shortcode_atts( array(
      'type'   => 'input',
      'name'=> '',
	  'required'=>'',
	  'is_email' =>'',
	  'options' =>''
  ), $atts ) );
	  $inupt_type = 'text';
	  if($is_email == '1' || $is_email == 'yes' || $is_email == 'true' )
	  $inupt_type = 'email';
	  $return = "";
	  $required_str = "";
	  if($required == '1' || $required == 'yes' || $required == 'true' )
		   $required_str = ' required="required" aria-required="true" data-required="1" ';
		  
	  if( $name != "" ){ 
	  $field_id = sanitize_title( $name );
	  switch($type){
		  case "select":
		  $options_array = explode(",",$options);
		  $return .= '<section><select class="'.$field_id.'" '.$required_str.' data-name="'.$name.'" name="'.$field_id.'" id="'.$field_id.'">';
		  
		  $return .= '<option value="">=='.$name.'==</option>';
		  
		  foreach( $options_array as $option )
		  {
		 $return .= '<option value="'.$option.'">'.$option.'</option>';
			  }
		 $return .= '</select></section>'; 
		  break;
		  case "textarea":
		 $return .= '<section><textarea name="'.$field_id.'" data-name="'.$name.'"  '.$required_str.' id="'.$field_id.'" cols="39" rows="5" tabindex="3" placeholder="'.$name.'"></textarea></section>';
		  break;
		  case "input":
		  default:
		  $return .= '<section><input type="'.$inupt_type.'" name="'.$field_id.'" data-name="'.$name.'" value="" id="'.$field_id.'" placeholder="'.$name.'" tabindex="1" '.$required_str.'></section>';
         break;
		  
		  }
	  }
	  return $return;
	 
	 }
	 
	 add_shortcode('form_field','onetone_form_field_shortcode');
	  
 function onetone_contact_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'email'=> get_option( 'admin_email' ),
  'style' => '1'
  ), $atts ) );
   $return = "";
   
   if( $content != NULL ){
	   
	    switch($style){
	  case "1":
 $return = '<div class="onetone-shortcode contact-area '.$css_class.'"><form onsubmit="return false;" action="'.esc_url(home_url('/')).'" class="onetone-shortcode contact-form style1 " method="post">
                                                <fieldset>
                                                  '.do_shortcode( onetone_fix_shortcodes( $content ) ).'
                                                </fieldset>
                                                <section>
												<span class="noticefailed"></span>
												    <input type="hidden" name="sendto" id="sendto" value="'.base64_encode($email).'">
                                                    <input type="button" id="submit" name="submit" value="'.__("SEND","onetone").'" class="contact-submit btn-normal">
													<input type="hidden" name="contact-form-ver" class="contact-form-ver" value="2">
													<input type="hidden" name="email_error" value="'.__("Please enter valid email.",'onetone').'">
													<input type="hidden" name="name_error" value="'.__("Please enter your name.",'onetone').'">
													<input type="hidden" name="message_error" value="'.__("Message is required.",'onetone').'">
													
                                                </section>
                                            </form></div>';
 break;
 case "2":
 default:

 $return = '<div class="onetone-shortcode contact-area '.$css_class.'"><form onsubmit="return false;" action="'.esc_url(home_url('/')).'" class="onetone-shortcode contact-form style2 " method="post">
                                                <fieldset>
                                                 '.do_shortcode( onetone_fix_shortcodes( $content ) ).'
                                                </fieldset>
                                                <section>
												<span class="noticefailed"></span>
												    <input type="hidden" name="sendto" id="sendto" value="'.base64_encode($email).'">
                                                    <input type="button" id="submit" name="submit" value="'.__("SEND","onetone").'" class="contact-submit btn-normal">
													<input type="hidden" name="contact-form-ver" class="contact-form-ver" value="2">
													<input type="hidden" name="email_error" value="'.__("Please enter valid email.",'onetone').'">
													<input type="hidden" name="name_error" value="'.__("Please enter your name.",'onetone').'">
													<input type="hidden" name="message_error" value="'.__("Message is required.",'onetone').'">
                                                </section>
                                            </form></div>';
											break;
											case 3:
$return = '<div class="onetone-shortcode contact-area '.$css_class.'"><form action="'.esc_url(home_url('/')).'" method="post" class="onetone-shortcode contact-form style3 ">
<fieldset>
			   '.do_shortcode( onetone_fix_shortcodes( $content ) ).'
			   </fieldset>
			   <p class="noticefailed"></p>
			   <input type="hidden" value="'.base64_encode($email).'" id="sendto" name="sendto">
			   <input type="button" value="'.__("SEND","onetone").'" id="submit" name="submit">
			   <input type="hidden" name="contact-form-ver" class="contact-form-ver" value="2">
			   <input type="hidden" name="email_error" value="'.__("Please enter valid email.",'onetone').'">
													<input type="hidden" name="name_error" value="'.__("Please enter your name.",'onetone').'">
													<input type="hidden" name="message_error" value="'.__("Message is required.",'onetone').'">
			  </form></div>';
           break;
  }
	    return $return ;	
	   
	   }
 
     switch($style){
	  case "1":
 $return = '<div class="onetone-shortcode contact-area '.$css_class.'"><form onsubmit="return false;" action="'.esc_url(home_url('/')).'" class="onetone-shortcode contact-form style1 " method="post">
                                                <fieldset>
                                                    <section>
                                                        
                                                        <input type="text" name="name" id="name" placeholder="'.__("YOUR NAME","onetone").'*" tabindex="1" required="required" aria-required="true">
                                                    </section>
                                                    <section>
                                                        
                                                        <input type="email" name="email" id="email" placeholder="'.__("YOUR E-MAIL","onetone").'*" tabindex="2" required="required" aria-required="true">
                                                    </section>
                                                    <section>
                                                        
                                                        <textarea name="message" aria-required="true" required="required" id="message" cols="39" rows="5" tabindex="3" placeholder="'.__("YOUR MESSAGE","onetone").'*"></textarea>
                                                    </section>
                                                </fieldset>
                                                <section>
												<span class="noticefailed"></span>
												    <input type="hidden" name="sendto" id="sendto" value="'.base64_encode($email).'">
                                                    <input type="button" id="submit" name="submit" value="'.__("SEND","onetone").'" class="contact-submit btn-normal">
													<input type="hidden" name="email_error" value="'.__("Please enter valid email.",'onetone').'">
													<input type="hidden" name="name_error" value="'.__("Please enter your name.",'onetone').'">
													<input type="hidden" name="message_error" value="'.__("Message is required.",'onetone').'">
                                                </section>
                                            </form></div>';
 break;
 case "2":
 default:

 $return = '<div class="onetone-shortcode contact-area '.$css_class.'"><form onsubmit="return false;" action="'.esc_url(home_url('/')).'" class="onetone-shortcode contact-form style2 " method="post">
                                                <fieldset>
                                                    <section>
                                                        
                                                        <i class="fa fa-user fa-fw"></i>
                                                        <input type="text" name="name" id="name" placeholder="'.__("Your Name","onetone").'" tabindex="1" required="required" aria-required="true">
                                                    </section>
                                                    <section>
                                                        
                                                        <i class="fa fa-envelope fa-fw"></i>
                                                        <input type="email" name="email" id="email" placeholder="'.__("Your Email","onetone").'" tabindex="2" required="required" aria-required="true">
                                                    </section>
                                                    <section>
                                                        
                                                        <textarea name="message" aria-required="true" required="required" id="message" cols="39" rows="5" tabindex="3" placeholder="'.__("Message","onetone").'"></textarea>
                                                    </section>
                                                </fieldset>
                                                <section>
												<span class="noticefailed"></span>
												    <input type="hidden" name="sendto" id="sendto" value="'.base64_encode($email).'">
                                                    <input type="button" id="submit" name="submit" value="'.__("SEND","onetone").'" class="contact-submit btn-normal">
													<input type="hidden" name="email_error" value="'.__("Please enter valid email.",'onetone').'">
													<input type="hidden" name="name_error" value="'.__("Please enter your name.",'onetone').'">
													<input type="hidden" name="message_error" value="'.__("Message is required.",'onetone').'">
                                                </section>
                                            </form></div>';
											break;
											case 3:
$return = '<div class="onetone-shortcode contact-area '.$css_class.'"><form action="'.esc_url(home_url('/')).'" method="post" class="onetone-shortcode contact-form style3 ">
<fieldset>
			   <input type="text" aria-required="true" required="required" tabindex="1" size="22" placeholder="'.__("Name","onetone").'" value="" id="name" name="name">
			   <input type="email" aria-required="true" required="required" tabindex="2" size="22" placeholder="'.__("Email","onetone").'" value="" id="email" name="email"> 
			   <textarea placeholder="'.__("Message","onetone").'" required="required" tabindex="4" rows="7" cols="39" id="message" name="message"></textarea>
			   </fieldset>
			   <p class="noticefailed"></p>
			   <input type="hidden" value="'.base64_encode($email).'" id="sendto" name="sendto">
			   <input type="button" value="'.__("SEND","onetone").'" id="submit" name="submit">
			   <input type="hidden" name="email_error" value="'.__("Please enter valid email.",'onetone').'">
													<input type="hidden" name="name_error" value="'.__("Please enter your name.",'onetone').'">
													<input type="hidden" name="message_error" value="'.__("Message is required.",'onetone').'">
			  </form></div>';
           break;
  }
	 return $return ;	
							
 }
 
 
 /**
	 * Shortcode: divider
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function onetone_divider_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'height'=> '10',
  'style' => ''
  ), $atts ) );
 if($height != ""){
	 if(is_numeric($height))
	 $height = $height."px";
	 $height = "margin-bottom:".$height.";";
	 }
 $return = '<div class="onetone-shortcode divider style'.$style.' '.$css_class.'" style='.$height.'></div>';
							
	 return $return ;	
							
 }
 
/**
	 * Shortcode: menu
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function onetone_menu_shortcode( $atts,$content=NULL ){
	 
	  extract( shortcode_atts( array(
	  'item' =>'',
	  'css_class'   => '',
	  'position' =>'static'
	  ), $atts ) );
    $css_style = 'position:'.$position.';';
    $return    = '<div class="onetone-shortcode onetone-nav '.$css_class.'" style="'.$css_style.'">';
	$return   .= wp_nav_menu( array( 'echo'=> false,'menu' => $item,'depth'=>0,'fallback_cb' =>false,'container'=>'' ,'items_wrap'=> '<ul class="shortcode-nav">%3$s</ul>') );
	$return   .= '</div>';
	return $return;
	 }
	 

 /**
	 * Shortcode: portfolio
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function onetone_portfolio_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'columns'=> '4',
  'num' => '4',
  'category' => '',
  'pagenav' =>''
  ), $atts ) );
   global $paged;
   
   if(!is_numeric($category)){
		$term      = get_term_by('name', $category, 'portfolio-category');
		}else{
		$term      = get_term_by('id', $category, 'portfolio-category');
		}
  $return = '<div class="onetone-shortcode portfolio-wrapper">';
  $items  = '';
  $term_slug = isset($term->slug)?$term->slug:"";
  if(!is_numeric($columns) || $columns<2 || $columns>4)
  $columns  = 4;
  $i        = 1;
  $col      = 12/$columns ;
  if(!$paged){$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;}
 
  $query = new WP_Query('post_type=portfolio&paged='.$paged.'&orderby=menu_order&post_status=publish&portfolio-category='.$term_slug.'&posts_per_page='.$num);
  
    if($query->have_posts() ):
	while ($query->have_posts() ) :
    $query->the_post();
	
	$postid            = get_the_ID();
	$permalink         = get_permalink();
	$title             = get_the_title();
	$image             = "";
	$thumb             = "";
	 if (has_post_thumbnail( $postid) ): 
	$thumb = get_the_post_thumbnail( $postid , "portfolio-grid-thumb" ); 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'large' );
	$image = $image[0];
	endif;
	
	
	$tags = get_the_tags(get_the_ID());
	   $tags_list = '<ul>';
	   if(is_array($tags)){
	   foreach ( $tags as $tag ) {
		  $tag_link   = get_tag_link( $tag->term_id );
		  $tags_list .= "<li><a href='{$tag_link}' title='{$tag->name}' class='{$tag->slug}'>";
		  $tags_list .= "{$tag->name}</a></li>";
	   }
	   }
	  $tags_list .= '</ul>';

     
       $items  .=  '<div class="portfolio-col col-sm-6 col-md-'.$col.' '.$css_class.'"><div class="portfolio-box text-center">';
	   
  
	   $items  .=  '<a href="'.get_permalink().'">';
	   $items  .= $thumb;
	   $items  .=  '</a>'; 
					
	  $items  .=  '<div class="portfolio-box-title"><a href="'.$permalink.'"><h3>'.$title.'</h3></a>
	  									'.$tags_list.'
									</div>
								</div>
							</div>';
							
	
/* $items  .= '<div class="col-md-'.$col.' col-sm-6 '.$css_class.'">
 
 <figure class="portfolio-list-box">
								'. $thumb.'
								<figcaption>
									<a href="'.$permalink.'"><h3>'.$title.'</h3></a>
									'.get_the_excerpt().'
								</figcaption>
							</figure></div>';*/
	  if($i%$columns == 0) 
	  {  
	      $return .= '<div class="row">'. $items.'</div>';
		  $items  = '';
		  }
     $i++ ;
		endwhile;
		endif;
		if($items  != '') $return .= '<div class="row">'. $items.'</div>';
		
		if($pagenav == "yes" || $pagenav == "1"){	
		$return .= '<div class="list-pagition text-center">'.get_the_post_pagination( array(
		'mid_size' => 3,
												'prev_text' => '<i class="fa fa-angle-double-left"></i><span class="screen-reader-text">' . __( 'Previous page', 'onetone' ) . '</span>',
												'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'onetone' ) . '</span><i class="fa fa-angle-double-right"></i>' ,
												'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'onetone' ) . ' </span>',
											) ).'</div>';
		}
		$return .= '</div>';
		wp_reset_postdata();
	 return $return ;	
							
 }
 

  /**
	 * Shortcode: pricing
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function onetone_pricing_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class' => '',
  'currency' =>'$',
  'price' => '',
  'title' => '',
  'sub_title' => '',
  'color' => '',
  'btn_text' => 'BUY',
  'btn_link' => '#',
  'btn_icon' => 'fa-shopping-cart',
  'style'    => '1',
  'featured' => '0'
  ), $atts ) );
   $css_style = '';
  if($color !=""){
	  $css_style = 'background-color: '.$color.';color: #fff;border-color: '.$color.';';
  }
 $is_featured = "" ;
 if($featured == '1' || $featured == 'yes') $is_featured = " featured";
 $css_class  .= " style".$style;
 $css_class  .= $is_featured;
 switch($style){
	 
	 case "2":
	 $return = '<div class="onetone-shortcode price-box '.$css_class.'">
                                                <ul>
                                                    <li class="price-title">
                                                        <h3>'.$title.'</h3>
                                                        <div class="price-tag">
                                                            <sup>'.$currency.'</sup>'.$price.'
                                                        </div>
                                                        <h4>'.$sub_title.'</h4>
                                                    </li>
                                                    '.do_shortcode( onetone_fix_shortcodes($content) ).'
                                                    <li><a href="'.$btn_link.'" target="_blank"><button class="btn"><i class="fa '.$btn_icon.'"></i> '.$btn_text.'</button></a></li>
                                                </ul>
                                            </div>';
	 break;
	 case "1":
	 default:
 $return = '<div class="onetone-shortcode price-box '.$css_class.'">
								<div class="price-tag" style="'.$css_style.'">
									<sup>'.$currency.'</sup>'.$price.'
								</div>
								<ul>
									<li class="price-title">
										<h3>'.$title.'</h3>
										<h4>'.$sub_title.'</h4>
									</li>
									'.do_shortcode( onetone_fix_shortcodes($content) ).'
									<li><a href="'.$btn_link.'" target="_blank"><button class="btn" style="'.$css_style.'"><i class="fa '.$btn_icon.'"></i> '.$btn_text.'</button></a></li>
								</ul>
							</div>';
			break;				
     }
	 return $return ;	
							
 }
 
  function onetone_pricing_item_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class' => ''
  ), $atts ) );
   $return = '<li>'.do_shortcode( onetone_fix_shortcodes($content) ).'</li>';
   return $return ;
  }

/**
	 * Shortcode: row
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
  function onetone_row_shortcode($atts,$content=NULL)
  {
  
  extract( shortcode_atts( array(
  'css_class'   => '' 
  ), $atts ) );
  
  $return   = '<div class="onetone-shortcode row '.$css_class.'">';
  $return  .=  do_shortcode(onetone_fix_shortcodes( $content) );
  $return  .= '</div>'; 
  return $return ;
  }
  
   /**
	 * Shortcode: section
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function onetone_section_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'background_color' => '',
  'background_image' => '',
  'background_repeat' => '',
  'background_size' => 'off',
  'padding' =>'',
  'parallax' => 'off',
  'color' =>'',
  'heading_color'=>'',
  'id' => ''
  
  ), $atts ) );
 $style   = "";
 $bg_pos  = "";
 if( $parallax == "on" ){
 $css_class .= " onetone-parallax";
 }
 if($background_color != "")
 $style .= 'background-color:'.$background_color.';';
  if($background_image != "")
  {
	  if( $parallax == "on" )
    $style .= 'background:url('.$background_image.')  50% 0 no-repeat fixed;';
      else
    $style .= 'background-image:url('.$background_image.');';
  }
 if( $background_repeat != "" && $parallax != "on" )
 $style .= 'background-repeat:'.$background_repeat.' ;';
 if( $color != "" )
 $style .= 'color:'.$color.' ;';
 if( $background_size == "on" )
 $style .= '-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;';
 
 if($padding != ""){
	  if(is_numeric($padding))
	 $padding = $padding."px";
	 
	 $style .= "padding:".$padding.";";
	 }
	 
	 
 
 $return = '<section id="'.$id.'" data-headingcolor="'.$heading_color.'" class="onetone-shortcode '.$css_class.'" style="'.$style.'">'.do_shortcode( onetone_fix_shortcodes($content) ).'<div class="clear"></div></section>';
							
	 return $return ;	
							
 }
  
  /**
	 * Shortcode: service
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function onetone_service_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'title' => '',
  'icon' => '',
  'link' => '',
  'icon_color'=>'',
  'style' => '1'
  ), $atts ) );
   if($icon_color != "")
   $icon_color = 'style="color:'.$icon_color.'"';
   $css_class .= ' style'.$style; 
   $more_link  = '';
   
	
   switch($style){
	   case "2":
	   case "4":
	   if($link != "")
      $more_link  = '<div class="text-right"><a href="'.esc_url($link).'" class="text-right">'.__("Read More","onetone").'&gt;&gt;</a></div>';
	  $return      = '<div class="onetone-shortcode  service-box '.$css_class.' text-left">';
	  
	   if(strstr($icon,"http")){
		  $return     .= '<h3><img src="'.$icon.'" alt="'.$title.'" />'.$title.'</h3>';
		}else{
		 $return      .= '<h3><i class="fa '.$icon.' '.$icon_color.'"></i>'.$title.'</h3>';
		}
	  
      $return     .= '<p>'.do_shortcode(onetone_fix_shortcodes( $content) ).'</p>'.$more_link.'</div>';
	   break;
	   
	  case "1":
	  case "3":
	  default:
   $return   = '<div class="onetone-shortcode  service-box text-center '.$css_class.'">';
   if($icon != ""){
	   
	   if(strstr($icon,"http")){
  $return .= '<img src="'.$icon.'" alt="'.$title.'" />';
  }else{
   $return  .= '<i class="fa '.$icon.'" '.$icon_color.'></i>';
  }
   
   }
   if($title != "")
   $return  .= '<h3>'.$title.'</h3>';
   $return  .= '<p>'.do_shortcode(onetone_fix_shortcodes( $content) ).'</p>';
   if($link != "")
   $return  .= '<a href="'.esc_url($link).'">'.__("Read More","onetone").'&gt;&gt;</a>';
   $return  .= '</div>';
   break;
    }
   
   
   return $return ;	  
 }
 
  /**
 * Shortcode: blog timeline
 *
 * @param array $atts Shortcode attributes
 * @return string Output html
 * author: quan
 */ 
 function onetone_timeline_shortcode($atts,$content=NULL){
	 extract( shortcode_atts( array(
	  'css_class'   => '',
	  'num' => '3',
      'category' => '',
	  'excerpt_length' => '60'
	  ), $atts ) );
	 
	  global $paged;
   $return = '<div class="onetone-shortcode timeline '.$css_class.'"><div class="time-stick"></div>';
   
   // $paged =(get_query_var('paged'))? get_query_var('paged'): 1;
    $wp_query = new WP_Query( 'showposts='.$num.'&category_name='.$category.'&post_status=publish&ignore_sticky_posts=1' );

	$i = 1 ;
	if ($wp_query -> have_posts()) :
    while ( $wp_query -> have_posts() ) : $wp_query -> the_post();

	$return .= '<div class="time-box">
      <a href="'.get_permalink().'"><h2 class="time-title">'.get_the_title().'</h2></a>
      <p class="time-content">'.onetone_cover_content( $excerpt_length,get_the_excerpt() ).'
      </p>             
    </div>';
									   
	endwhile;
	endif;
	
	$return .= '</div>';
	wp_reset_postdata();
	 
	 return $return;
	 }
	 
	 /**
	 * Shortcode: team
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function onetone_team_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
   'name' => '',
   'avatar' => '',
   'byline'   => '',
   'social_icon_1'   => '',
   'social_link_1'   => '',
   'social_icon_2'   => '',
   'social_link_2'   => '',
   'social_icon_3'   => '',
   'social_link_3'   => '',
   'social_icon_4'   => '',
   'social_link_4'   => '',
   'style' => '1'
   
  ), $atts ) );

 $css_class .= " style".$style; 
 switch($style){
 case "2":
 $return = '<div class="onetone-shortcode team-box '.$css_class.'">
                                                <div class="team-img-box">
                                                    <img src="'.esc_url($avatar).'">
                                                </div>
                                                <div class="team-info">
                                                    <h4>'.$name.'</h4>
                                                    <h5>'.$byline.'</h5>
                                                    <p>'.do_shortcode( onetone_fix_shortcodes($content) ).'</p>
                                                    <div>
                                                        <div class="team-sns">';
                                                     	for($i = 1; $i<=4 ; $i++){
												if(${"social_icon_$i"} != "" && ${"social_link_$i"} != ""){
												$return .= '<a href="'.${"social_link_$i"}.'"><i class="fa fa-'.${"social_icon_$i"}.'"></i></a>';
												}
											}
      $return .= ' </div></div></div></div>';
 break;
 case "3":
 $return = '<div class="onetone-shortcode team-box '.$css_class.'">
                                                <div class="team-img-box">
                                                    <img src="'.esc_url($avatar).'">
                                                </div>
                                                <div class="team-info">
                                                    <h4>'.$name.'</h4>
                                                    <h5>'.$byline.'</h5>
                                                    <p>'.do_shortcode( onetone_fix_shortcodes($content) ).'</p>
                                                    <div>
                                                        <div class="team-sns">';
                                                         for($i = 1; $i<=4 ; $i++){
												if(${"social_icon_$i"} != "" && ${"social_link_$i"} != ""){
												$return .= '<a href="'.${"social_link_$i"}.'"><i class="fa fa-'.${"social_icon_$i"}.'"></i></a>';
												}
											}
  $return .= '</div>
                                                    </div>
                                                </div>                                                
                                            </div>';
 break ; 
 case "1":
 default:
 $return = '<div class="onetone-shortcode team-box '.$css_class.'">
								<div class="team-img-box">
									<img src="'.esc_url($avatar).'">
									<div class="team-info">
										<h4>'.$name.'</h4>
										<h5>'.$byline.'</h5>
										<img src="'.esc_url($avatar).'">
										<div>
											<div class="team-sns">';
											for($i = 1; $i<=4 ; $i++){
												if(${"social_icon_$i"} != "" && ${"social_link_$i"} != ""){
												$return .= '<a href="'.${"social_link_$i"}.'"><i class="fa fa-'.${"social_icon_$i"}.'"></i></a>';
												}
											}
												
	$return .= '</div>
         </div>  </div>
 </div><p>'.do_shortcode( onetone_fix_shortcodes($content) ).'</p></div>';
   break;
 }
							
	 return $return ;	
							
 }
	 
################################################
#
#      Onetone Shortcodes Generator
#
################################################

function onetone_form_generator($value){
	
		if(!isset($value['id'])){exit;}
		$value['std'] = isset($value['std'])?$value['std']:"";
			$value['std'] = str_replace("\r\n",' ', $value['std']);
	?>
		<div class="onetone-shortcode-attr-container">
			<label for="onetone-<?php echo $value['id']; ?>"><h5><?php  echo $value['title']; ?></h5></label>
		<?php
		switch ( $value['type'] ) {
		
			case 'text': ?>
				<input  name="<?php echo $value['id']; ?>" id="onetone-<?php  echo $value['id']; ?>" type="text" value="<?php echo $value['std']; ?>" />
			<?php 
			break;
	
			case 'checkbox':
				if($value['id']){$checked = "checked=\"checked\"";  $checkbox_switch = "on";} else{$checked = "";$checkbox_switch = "off";} ?>
				
					<input class="on-of" type="checkbox" name="onetone-<?php echo $value['id'] ?>" id="<?php echo $value['id'] ?>" value="true" <?php echo $checked; ?> />
			<?php	
			break;
			case 'radio':
			?>
				<div style="float:left; width: 295px;">
					<?php foreach ($value['options'] as $key => $option) { ?>
					<label style="display:block; margin-bottom:8px;"><input name="<?php echo $value['id']; ?>" id="onetone-<?php echo $value['id']; ?>" type="radio" value="<?php echo $key ?>" <?php if ( $value['id'] == $key) { echo ' checked="checked"' ; } ?>> <?php echo $option; ?></label>
					<?php } ?>
				</div>
			<?php
			break;
			
			case 'select':
			?>
				<select name="<?php echo $value['id']; ?>" id="onetone-<?php echo $value['id']; ?>">
					<?php foreach ($value['options'] as $key => $option) { ?>
					<option value="<?php echo $key ?>" <?php if (  $value['std'] == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
					<?php } ?>
				</select>
			<?php
			break;
			
			case 'textarea':
			?>
				<textarea name="<?php echo $value['id']; ?>" id="onetone-<?php echo $value['id']; ?>" type="textarea" cols="100%" rows="8" tabindex="4"><?php echo $value['std'];  ?></textarea>
			<?php
			break;
	
			case 'upload':
			?>
		
			<input id="<?php echo $value['id']; ?>" class="img-path upload_box" type="text" size="56" style="direction:ltr; text-laign:left" name="<?php echo $value['id']; ?>" value="<?php echo $value['std']; ?>" />
					<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="upload_image_button" value="Upload" />
					<?php
					if(isset($value['std']) && $value['std'] != ""){
					$img_preview = '<div id="'.$value['id'].'-preview" class="img-preview"><img src="'.$value['std'].'" alt="" /><a class="del-img" title="Delete"></a></div>';}
					?>
		
			<?php
			break;
			case 'color':
			?>
			<input type="text" value="<?php echo $value['std'] ; ?>" class="minicolors" data-theme="bootstrap" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" />					
			<?php
			break;
			}
			?>
			<?php if( isset( $value['desc'] ) ) : ?><div class="onetone-shortcode-attr-desc"><?php echo $value['desc'] ?></div><?php endif; ?>
		
			<div class="clear"></div>
		</div>
<?php
	}
	
/*	
	*	Shortcode  generator Form
	*	---------------------------------------------------------------------
	*/
	
 function onetone_shortcode_form(){
   global $onetone_shortcodes ;
   $shortcode = $_POST['shortcode'];
  if(isset($onetone_shortcodes[$shortcode]) && is_array($onetone_shortcodes[$shortcode])){
	foreach($onetone_shortcodes[$shortcode] as $key=>$value){
		if(is_array($value)){
		  array_push($value,array("id"=>$key));
		  onetone_form_generator($value);
		  }
	 }

 echo '<input type="hidden" id="onetone-curr-shortcode" value="'.$shortcode.'" />';
 echo '<div class="clear"></div>';

	}

	exit();
	}
	add_action('wp_ajax_onetone_shortcode_form', 'onetone_shortcode_form');
	add_action('wp_ajax_nopriv_onetone_shortcode_form', 'onetone_shortcode_form');

	/*	
	*	Shortcode Generator
	*	---------------------------------------------------------------------
	*/
	
 function onetone_get_shortcode(){
	global $onetone_shortcodes ;
	$attr      = isset($_POST['attr'])?$_POST['attr']:"";
	$shortcode = isset($_POST['shortcode'])?$_POST['shortcode']:"";
	$content   = "";
	$result    = "";
	$shortcodes_attr = array();

	if(is_array($attr) && $attr != null && array_key_exists( $shortcode,$onetone_shortcodes))
	{
	foreach($onetone_shortcodes[$shortcode] as $key=>$value){
	$shortcodes_attr[] = $value['id'];
	}
	$result = '['.$shortcode.' ';
	  foreach($attr as $k=>$v){
	  if($v["name"] != "content" && $v["name"] != "text_content"){
	      if($v["value"] !="" && in_array($v["name"],$shortcodes_attr)){
	       $result .= $v["name"].'=\''.$v["value"].'\' ';
		   }
	    }
		else{
		   $content = $v["value"] . '[/'.$shortcode.']';
		}
	  }
	  $result .= ']';
	  $result .= $content ;
	}
	$result = stripslashes($result);
//	$result = str_replace("\r\n",' ', $result);
	echo $result; 
	exit();
	}
	
	add_action('wp_ajax_onetone_get_shortcode', 'onetone_get_shortcode');
	add_action('wp_ajax_nopriv_onetone_get_shortcode', 'onetone_get_shortcode');
	


//add a button to the content editor, next to the media button
//this button will show a popup that contains inline content
add_action('media_buttons_context', 'onetone_add_my_custom_button');

//add some content to the bottom of the page 
//This will be shown in the inline modal
if(is_admin()){
add_action('admin_footer', 'onetone_add_inline_popup_content');
}
//action to add a custom button to the content editor
function onetone_add_my_custom_button($context) {
 
  //our popup's title
  $title = __('Onetone Shortcodes','onetone');

  //append the icon
  $context .= "<a class='onetone_shortcodes button' title='{$title}'>".__('Onetone Shortcodes','onetone')."</a>";
  
  return $context;
}

function onetone_add_inline_popup_content() {
global $onetone_shortcodes ;

?>
<div class="white-popup onetone_shortcodes_container mfp-with-anim mfp-hide" id="onetone_shortcodes_container" style="display:none;" >
 <form>
  <h4><?php _e("Onetone Shortcodes Generator",'onetone');?></h4>
  <ul class="onetone_shortcodes_list">
  <?php if(is_array($onetone_shortcodes )):foreach($onetone_shortcodes as $key => $val){ 	
         if(in_array($key ,array("testimonial_item","pricing_item","testimonial",'tab','accordion'))){continue;}
  ?>
  
  <li><a class='onetone_shortcode_item <?php //echo $key;?>' title='<?php echo ucwords(str_replace("_"," ",$key));?>' data-shortcode="<?php echo $key;?>" href="javascript:;"><?php echo ucwords(str_replace("_"," ",$key));?></a></li>
  <?php } ?>
  <?php endif;?>
	  </ul>
	  <div id="onetone-shortcodes-settings">
	  
	 
  <div id="onetone-generator-breadcrumbs">
  <a title="Click to return to the shortcodes list" class="onetone-shortcodes-home" href="javascript:void(0);"><?php  _e("All shortcodes",'onetone');?></a>  &rarr; <span class="current_shortcode"></span>
    <div class="clear"></div>
  </div>
	        <div id="onetone-shortcodes-settings-inner"></div>
			<input name="onetone-shortcode" type="hidden" id="onetone-shortcode" value="" />
			<input name="onetone-shortcode-textarea" type="hidden" id="onetone-shortcode-textarea" value="" />
			<div class="onetone-shortcode-actions onetone-shortcode-clearfix">
			<!--<a class="button button-secondary button-large onetone-shortcode-preview "  href="javascript:void(0);"><?php _e("Preview shortcode",'onetone');?></a>-->
			<a class="button button-primary button-large onetone-shortcode-insert "  href="javascript:void(0);"><?php _e("Insert shortcode",'onetone');?></a>
			
	  </div>
	  <div class="clear"></div>
	  </div></form>
	  <div class="clear"></div>
</div>
<div id="onetone-shortcode-preview" style="display:none;">

</div>
<?php } 
	
################################################
#
#      End Onetone Shortcodes Generator
#
################################################