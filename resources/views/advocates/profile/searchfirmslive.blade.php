<?php
if(!empty($posts_data ))
{ 
$set_count = 1;
$output_head = '';
$output_body = '';
$output_footer ='';
 
$output_head .= '<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th>Name</th>
<th>Options</th>
</tr>
</thead>
<tbody>
';
 
foreach ($posts_data as $post_val)
{
$set_body = substr(strip_tags($post->body),0,45)."....";
$show_title = url('blog/'.$post_val->slug);
$output_body .=  '<tr>
<td>'.$post_val->name.'</td>
<td><a href="'.$show_title.'" target="_blank" title="SHOW" ><span class="search glyphicon glyphicon-list"></span></a></td>
</tr>';
}
 
$output_footer .= '
</tbody>
</table>
</div>';
 
echo $output_head;
echo $output_body;
echo $output_footer;
}
 
else
{ 
echo 'We Not Found Any Data.';
}
?>