<?php 
    $newsData = $_POST;
    $response = '';
    if(!empty($newsData) && !empty($newsData['articles']) && !empty($newsData['articles']['results'])){
        foreach($newsData['articles']['results'] as $key => $news){
			$temp = '';
			if(($news['image'] == null || $news['image'] == "") && $news['source']['uri'] == 'dawn.com'){
				$temp = 'images/social-default.jpg';
			}elseif(($news['image'] == null || $news['image'] == "") && $news['source']['uri'] == 'nation.com.pk'){
				$temp = 'images/nation.png';
			}elseif($news['source']['uri'] == 'profit.pakistantoday.com.pk'){
				$temp = 'images/pakistan-today.png';
			}elseif($news['image'] == null || $news['image'] == ""){
				$temp = 'images/news.jpg';
			}else{
				$temp = $news['image'];
			}
            $response .= '<div class="row NewsGrid">
                    <div class="col-md-3">
                        <img class="set_img" src="'.$temp.'" alt="News Thumbnail">
                    </div>
                    <div class="col-md-9">
                        <h2>Title: '.$news['title'].'</h2>
                        <h5>Date: '.$news['date'].'</h5>
                        <p>Content: '.$news['body'].'</p>
                        <a href="'.$news['url'].'" class="btn btn-sm btn-primary" style="float:right;" target="_blank">Read More>></a>
                    </div>
                </div>';
        }
    }
    echo $response;
?>