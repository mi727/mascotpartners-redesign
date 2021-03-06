<?php
/*
template Name: Pagination
*/
global $wpdb;
get_header();
echo  '<div align="center">';
echo  paginate_function($limit, $page, $total_records, $total_pages);
echo  '</div>';

     function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
       
        $right_links    = $current_page + 3;
        $previous       = $current_page - 3; //previous link
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
       
        if($current_page > 1){
            $previous_link = ($previous==0)?1:$previous;
            $pagination .= '<li class="first"><a style="cursor:pointer;" onclick="changePagination4(1)" data-page="1" title="First">First</a></li>'; //first link
            $pagination .= '<li><a style="cursor:pointer;" onclick="changePagination4('.$previous_link.')" data-page="'.$previous_link.'" title="Previous">Previous</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a  style="cursor:pointer;" onclick="changePagination4('.$i.')" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }  
            $first_link = false; //set first link to false
        }
       
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first active"><a  style="cursor:pointer;" onclick="changePagination4('.$current_page.')" data-page="'.$current_page.'" title="Page'.$current_page.'">'.$current_page.'</a></li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active"><a  style="cursor:pointer;" onclick="changePagination4('.$current_page.')" data-page="'.$current_page.'" title="Page'.$current_page.'">'.$current_page.'</a></li>';
        }else{ //regular current link
            $pagination .= '<li class="active"><a  style="cursor:pointer;" onclick="changePagination4('.$current_page.')" data-page="'.$current_page.'" title="Page'.$current_page.'">'.$current_page.'</a></li>';
        }
               
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a style="cursor:pointer;" onclick="changePagination4('.$i.')" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){
                $next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= '<li><a style="cursor:pointer;" onclick="changePagination4('.$next_link.')" data-page="'.$next_link.'" title="Next">Next</a></li>'; //next link
                $pagination .= '<li class="last"><a style="cursor:pointer;" onclick="changePagination4('.$total_pages.')" data-page="'.$total_pages.'" title="Last">Last</a></li>'; //last link
        }
       
        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
}

get_footer();
?>
<script type="text/javascript">
function changePagination4(page) {
  if(page== "") {
    page = 1;
  }
  $.ajax({
            type : 'GET',
            url  : 'api/v1/get_allwords.php?page='+page,
            dataType: "html",
            success :  function(data) {
              //alert(data);
              $('#blendingdiv').html(data);
            }
        });

}
    </script>