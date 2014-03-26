<?php  

function print_card_subset($which_set,$card_arrays){

        $abs_url = "/robotics/cards/";
        echo "<div class=\"row\">";

        $ctr = 0;
        while($ctr < count($card_arrays[$which_set]) ){

       //first, generate the unique id for this card
       $my_id = "card_spot_".$ctr."_".$which_set;

        //only display first two cards of computer set
        if($which_set == 0 && $ctr>=2){
            $image_url = $abs_url."covered.jpg";
        }
        else{
            $image_url = $abs_url.$card_arrays[$which_set][$ctr].".jpg";
        }

        $image_html = "<img src=\"".$image_url."\" height=\"90px\">"; 

        //only the player cards are clickable
        if($which_set == 2){
                   $click_action = 
                         "<div onclick=\"select_card('$my_id')\" > 
                             <a class=\"btn btn-default\"  href=\"#\" role=\"button\">".$image_html."</a>".
                          "</div>";
        }
        else $click_action = $image_html;

         echo ("  <div id=\"".$my_id."\"> <div class=\"col-3 col-sm-3 col-lg-2\">".
                      $click_action.
                       "</div> </div>
              ");
              $ctr = $ctr + 1;
	}
 
      echo "</div>";

}

?>
