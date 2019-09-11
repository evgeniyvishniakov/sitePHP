<?php


$connect = new PDO("mysql:host=localhost;dbname=avenue", "root", "");

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM tires WHERE id > 0
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["width"]))
	{
		$width_filter = implode(",", $_POST["width"]);
		$query .= "
		 AND width_id IN(".$width_filter.")
		";
	}
	if(isset($_POST["height"]))
	{
		$height_filter = implode("','", $_POST["height"]);
		$query .= "
		 AND height_id IN('".$height_filter."')
		";
	}
	if(isset($_POST["diameter"]))
	{
		$diameter_filter = implode(",", $_POST["diameter"]);
		$query .= "
		 AND diameter_id IN(".$diameter_filter.")
		";
	}
    if(isset($_POST["season"]))
    {
        $season_filter = implode(",", $_POST["season"]);
        $query .= "
		 AND season_id IN(".$season_filter.")
		";
    }
    if(isset($_POST["brands"]))
    {
        $brands_filter = implode(",", $_POST["brands"]);
        $query .= "
		 AND brands_id IN(".$brands_filter.")
		";
    }



	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="oneTovarPlitka">
                                    <div class="tovarImgBox">
                                        <div class="tovar-labels">
                                        </div>
                                        <!--<div class="icons">
                                            <div><img src="" alt="Зима" title="Зима"></div>
                                            <div><img src="" alt="automobile" title="automobile"></div>
                                </div>-->
                                        <a href="" class="imag">
                                            <img src="app/userfile/'. $row['foto'] .'"  height="240" alt="Росава Росава BC-10 155/70 R13 75Q п/ш" title="Росава Росава BC-10 155/70 R13 75Q п/ш">
                                        </a>
                                    </div>
                                    <div class="oneTovarPlitka__comment">
                                        <input type="hidden" data-readonly class="bootstrap-rating" data-filled="fa fa-star" data-empty="fa fa-star" value="4.00"/>
                                        Отзывов:
                                        1
                                    </div>
                                    <div class="text-center name">
                                        <a href="https://alfashina.ua/shiny/rosava/bc-10/">'. $row['name'] .'</a>
                                    </div>
                                    <div class="text-center">
                                        <div class="price">'. $row['price'] .'<span>грн</span></div>
                                        <a class="btn btn-buy" href="">Добавить в корзину</a>
                                    </div>
                                </div>
                            </div>
			';
		}
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}

?>