<?php 
    $newsData = $_POST;
    $response = '';
    foreach($newsData['articles']['results'] as $key => $news){
        $response .= '<div class="row NewsGrid">
                <div class="col-md-3">
                    <img class="set_img" src="'.$news['image'].'" alt="News Thumbnail">
                </div>
                <div class="col-md-9">
                    <h2>Title: '.$news['title'].'</h2>
                    <h5>Date: '.$news['date'].'</h5>
                    <p>Content: '.$news['body'].'</p>
                    <a href="'.$news['url'].'" class="btn btn-sm btn-primary" style="float:right;" target="_blank">Read More>></a>
                </div>
            </div>';
    }
    echo $response;
?>