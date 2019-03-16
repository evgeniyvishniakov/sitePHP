<?php 

include './class/class_categories.php';

$categories = new Categories;
$map_tree = $categories->map_tree();

$_GET['category'];

function categories_to_string($data){
	foreach($data as $item){
		$string .= categories_to_template($item);
	}
	return $string;
}


function categories_to_template($category){
	ob_start();
	include 'category_template.php';
	return ob_get_clean();
}

?>

<div class="left_sidebar">
<?php echo $cat = categories_to_string($map_tree); ?>

</div>



			