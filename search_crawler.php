<?php 
  session_start(); 
  error_reporting(0);
  include('includes/config.php');
  // header("Content-Type: application/json");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>NewsBuzz | Search Crawler Page</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/modern-business.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <style>
    .set_img {
        width: calc(100% - 20px);
        height: 250px;
        margin: 10px;
    }

    .NewsGrid {
        margin: 10px;
        border: 1px solid lightgray;
    }

    .container-fluid {
        width: 110%;
        margin: -23px;
    }

    #source {
        width: 200px;
    }

    #source option {
        width: 100px;
    }

    #category {
        width: 200px;
    }

    #category option {
        width: 100px;
    }

    #domain {
        width: 200px;
    }

    #domain option {
        width: 100px;
    }

    #date {
        width: 200px;
    }

    select {
        -webkit-writing-mode: horizontal-tb !important;
        text-rendering: auto;
        color: -internal-light-dark(black, white);
        letter-spacing: normal;
        word-spacing: normal;
        text-transform: none;
        text-indent: 0px;
        text-shadow: none;
        display: inline-block;
        text-align: start;
        appearance: menulist;
        box-sizing: border-box;
        align-items: center;
        white-space: pre;
        -webkit-rtl-ordering: logical;
        background-color: -internal-light-dark(rgb(255, 255, 255), rgb(59, 59, 59));
        cursor: default;
        margin: 0em;
        font: 400 13.3333px Arial;
        border-radius: 0px;
        border-width: 1px;
        border-style: solid;
        border-color: -internal-light-dark(rgb(118, 118, 118), rgb(195, 195, 195));
        border-image: initial;
    }

    .dd {
        font-size: 14px !important;
        font-weight: 400 !important;
        color: #2b2f4c !important;
        border-radius: 3px !important;
        border: 1px solid #efefef !important;
        box-shadow: inset 0px 0px 0px rgba(0, 0, 0, 0.2) !important;
    }
    </style>
</head>

<body>
    <?php include('includes/header.php');?>
    <div class="container">
        <div class="row" style="margin-top: 4%">
            <div class="col-md-8">
                <div class="card mb-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <form name="search" action="search_crawler.php" method="post">
                            <div class="input-group">
                                <input type="text" id="searchtitle" name="searchtitle" class="form-control" placeholder="Search for..."
                                    required>
                                <span class="input-group-btn"> <button class="btn btn-secondary" name="searchBtn"
                                        id="searchBtn" type="submit">Search</button> </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="filter">
        <form name="filter" action="search_crawler.php" method="post">
            <div class="row">&nbsp;&nbsp;&nbsp;
                <select class="form-control dd" name="source" id="source" class="wgtmsr">
                    <option value="source"> ---Select Source--- </option>
                    <?php
                  // Feching active Sources
                  $ret=mysqli_query($con,"select id, source from tblsource where Is_Active=1");
                  while($result=mysqli_fetch_array($ret)) { ?>
                    <option value="<?php echo htmlentities($result['source']);?>">
                        <?php echo htmlentities($result['source']);?></option>
                    <?php } ?>
                </select>
                &nbsp;&nbsp;&nbsp;
                <select class="form-control" name="category" id="category">
                    <option value=""> ---Select Category--- </option>
                    <?php
                    // Feching active categories
                    $ret=mysqli_query($con,"select id, CategoryName from tblcategory where Is_Active=1 order by CategoryName asc");
                    while($result=mysqli_fetch_array($ret)) { ?>
                    <option value="<?php echo htmlentities($result['CategoryName']);?>">
                        <?php echo htmlentities($result['CategoryName']);?></option>
                    <?php } ?>
                </select>
                <span class="input-group-btn"> <button class="btn btn-secondary" name="filterBtn" id="filterBtn"
                        type="submit">Filter</button> </span>
            </div>
        </form>
    </div>
    <hr>
    <div><br> <br> </div>
    <!-- start of coding of web crawler -->
    <?php 
          $api_key = "43b9d6791de94774b4b6aa40f2f2f1a9";
          $apiKey = "0cd53df4-fdf8-4132-a211-6c646d60ba85";
          $today = date("Y-m-d");
          if(isset($_REQUEST['searchBtn']))
          {
            $search_value = $_REQUEST['searchtitle'];
            $url = 'http://newsapi.org/v2/everything?q='.urlencode($search_value).'&qInTitle='.urlencode($search_value).'&from='.$today.'&sortBy=publishedAt&apiKey='.$api_key;
            $url_headline = 'https://newsapi.org/v2/top-headlines?q='.urlencode($search_value).'&apiKey='.$api_key;
          }
          
          if(isset($_REQUEST['filterBtn']))
          {
			// if($_REQUEST['category'] != "" && $_REQUEST['source'] != "")
			// {
				// $url = 'https://newsapi.org/v2/top-headlines?sources='.$_REQUEST['source'].'&category='.$_REQUEST['category'] .'&apiKey='.$api_key;
			// }
            // else 
			if($_REQUEST['category'] != "")
            {
				$array = ['Business','Entertainment','General','Health','Science','Sports','Technology'];
				if(in_array($_REQUEST['category'],$array)){
					$url = 'https://newsapi.org/v2/top-headlines?country=us&category='.strtolower($_REQUEST['category']) .'&apiKey='.$api_key;
				}
            }
            else if ($_REQUEST['source'] != "")
            {
              $url = 'https://newsapi.org/v2/top-headlines?sources='.$_REQUEST['source'].'&apiKey='.$api_key;
            }			
			// print_r($url);exit;
            // else if ($_REQUEST['domain'] != "")
            // {
            //   $url = 'http://newsapi.org/v2/everything?domains='.$_REQUEST['domain'].'&apiKey='.$api_key;
            // }
            //$url = 'http://newsapi.org/v2/everything?q=apple&from=2020-12-05&to=2020-12-05&sortBy=popularity&apiKey='.$api_key;
            //$url = 'http://newsapi.org/v2/top-headlines?q=apple&country=us&category=business&apiKey='.$api_key;
          }
          //everything
          $response = file_get_contents($url);
          $newsData = json_decode($response);
		  // print_r($url);print_r($newsData);exit;

          //headlines
          $response_headline = file_get_contents($url_headline);
          $newsData_headline = json_decode($response);
          ?>

    <!-- headlines -->
    <div class="container-fluid">
        <?php 
          foreach($newsData_headline -> articles as $news){?>
        <div class="row NewsGrid">
            <div class="col-md-3">
                <img class="set_img" src="<?= $news->urlToImage ?>" alt="News Thumbnail">
            </div>
            <div class="col-md-9">
                <h2>Title: <?php echo $news->title; ?> </h2>
                <h5>Description: <?php echo $news->description;?> </h5>
                <p>Content: <?php echo $news->content;?> </p>
                <a href="<?php echo $news->url;?>" class="btn btn-sm btn-primary" style="float:right;"
                    target="_blank">Read More >></a>
            </div>
        </div>
        <?php } ?>
    </div>

    <!-- everything -->
    <div class="container-fluid">
        <?php 
          foreach($newsData -> articles as $news){?>
        <div class="row NewsGrid">
            <div class="col-md-3">
                <img class="set_img" src="<?= $news->urlToImage ?>" alt="News Thumbnail">
            </div>
            <div class="col-md-9">
                <h2>Title: <?php echo $news->title; ?> </h2>
                <h5>Description: <?php echo $news->description;?> </h5>
                <p>Content: <?php echo $news->content;?> </p>
                <a href="<?php echo $news->url;?>" class="btn btn-sm btn-primary" style="float:right;"
                    target="_blank">Read More >></a>
            </div>
        </div>
        <?php } ?>
    </div>
    </div>
</body>

</html>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
// $("#date").datepicker({
//     dateFormat: "dd-mm-yy"
// });

$('#source').on('change', function() {
    var source = $(this).val();
    if (source == 'jang.com.pk' || source == 'dawn.com' || source == 'urdupoint.com' 
	|| source == 'en.dailypakistan.com.pk' || source  == 'nation.com.pk'
	|| source == 'profit.pakistantoday.com.pk' || source == 'timesofislamabad.com' 
	|| source == 'inform.kz' || source == 'aninews.in' || source == 'thenews.com.pk') {
        var params = {
            "query": "{\"$query\":{\"$and\":[{\"locationUri\":\"http://en.wikipedia.org/wiki/Pakistan\"},{\"sourceUri\":\"" +
                source + "\"}]}}",
            "dataType": [
                "news"
            ],
            "resultType": "articles",
            "articlesSortBy": "date",
            "articlesCount": 10,
            "articleBodyLen": -1,
            "apiKey": "0cd53df4-fdf8-4132-a211-6c646d60ba85"
        };
        $.ajax({
            url: "https://newsapi.ai/api/v1/article/getArticles",
            crossDomain: true,
            data: params,
            method: 'GET',
        }).done(function(result) {
            console.log(result);
            $.ajax({
                url: 'ajax_calls.php',
                data: result,
                method: 'POST',
                success: function(data) {
                    // console.log(data);
                    $('.container-fluid').html(data);
                }
            })
        }).fail(function(err) {
            console.error(err.statusText);
        });
    } else if (source == 'news.bbc.co.uk' || source == 'businessinsider.com'
	|| source == 'engadget.com' || source == 'thenextweb.com' || source == 'usatoday.com' 
	|| source == 'techcrunch.com' || source == 'timesofindia.indiatimes' || source == 'express.pk'){
		var params = {
            "query": "{\"$query\":{\"$and\":[{\"sourceUri\":\"" +source + "\"}]}}",
            "dataType": [
                "news"
            ],
            "resultType": "articles",
            "articlesSortBy": "date",
            "articlesCount": 10,
            "articleBodyLen": -1,
            "apiKey": "0cd53df4-fdf8-4132-a211-6c646d60ba85"
        };
        $.ajax({
            url: "https://newsapi.ai/api/v1/article/getArticles",
            crossDomain: true,
            data: params,
            method: 'GET',
        }).done(function(result) {
            console.log(result);
            $.ajax({
                url: 'ajax_calls.php',
                data: result,
                method: 'POST',
                success: function(data) {
                    // console.log(data);
                    $('.container-fluid').html(data);
                }
            })
        }).fail(function(err) {
            console.error(err.statusText);
        });
	}
});

$('#searchtitle').on('keyup', function() {
    var search = $(this).val();
    var source = $('#source').val();
    var category = $('#category').val();
	if(source != '' && category != ''){
		var params = {
			"query": "{\"$query\":{\"$and\":[{\"keyword\":\""+search+"\",\"keywordLoc\":\"body\"},{\"categoryUri\":\"dmoz/"+category+"\"},{\"sourceUri\":\""+source+"\"}]},\"$filter\":{\"forceMaxDataTimeWindow\":\"31\"}}",
			"dataType": [
				"news"
			],
			"resultType": "articles",
			"articlesSortBy": "date",
			"articlesCount": 10,
			"articleBodyLen": -1,
			"apiKey": "0cd53df4-fdf8-4132-a211-6c646d60ba85"
		};
		$.ajax({
			url: "https://newsapi.ai/api/v1/article/getArticles",
			crossDomain: true,
			data: params,
			method: 'GET',
		}).done(function(result) {
			// console.log(result);
			$.ajax({
				url: 'ajax_calls.php',
				data: result,
				method: 'POST',
				success: function(data) {
					// console.log(data);
					$('.container-fluid').html(data);
				}
			})
		}).fail(function(err) {
			console.error(err.statusText);
		});
	}else{
		var params = {
			"query": "{\"$query\":{\"$and\":[{\"keyword\":\""+search+"\",\"keywordLoc\":\"body\"},{\"locationUri\":\"http://en.wikipedia.org/wiki/Pakistan\"}]},\"$filter\":{\"forceMaxDataTimeWindow\":\"31\"}}",
			"dataType": [
				"news"
			],
			"resultType": "articles",
			"articlesSortBy": "date",
			"articlesCount": 10,
			"articleBodyLen": -1,
			"apiKey": "0cd53df4-fdf8-4132-a211-6c646d60ba85"
		};
		$.ajax({
			url: "https://newsapi.ai/api/v1/article/getArticles",
			crossDomain: true,
			data: params,
			method: 'GET',
		}).done(function(result) {
			// console.log(result);
			$.ajax({
				url: 'ajax_calls.php',
				data: result,
				method: 'POST',
				success: function(data) {
					// console.log(data);
					$('.container-fluid').html(data);
				}
			})
		}).fail(function(err) {
			console.error(err.statusText);
		});
	}
});

$('#category').on('change', function() {
    var source = $('#source').val();
    var category = $(this).val();
    if (source == 'jang.com.pk' || source == 'dawn.com' || source == 'urdupoint.com' 
	|| source == 'en.dailypakistan.com.pk' || source  == 'nation.com.pk'
	|| source == 'profit.pakistantoday.com.pk' || source == 'timesofislamabad.com' 
	|| source == 'inform.kz' || source == 'aninews.in' || source == 'thenews.com.pk') {
        var params = {
            "query": "{\"$query\":{\"$and\":[{\"locationUri\":\"http://en.wikipedia.org/wiki/Pakistan\"},{\"categoryUri\":\"dmoz/"+category+"\"},{\"sourceUri\":\"" +source + "\"}]}}",
            "dataType": [
                "news"
            ],
            "resultType": "articles",
            "articlesSortBy": "date",
            "articlesCount": 10,
            "articleBodyLen": -1,
            "apiKey": "0cd53df4-fdf8-4132-a211-6c646d60ba85"
        };
        $.ajax({
            url: "https://newsapi.ai/api/v1/article/getArticles",
            crossDomain: true,
            data: params,
            method: 'GET',
        }).done(function(result) {
            // console.log(result);
            $.ajax({
                url: 'ajax_calls.php',
                data: result,
                method: 'POST',
                success: function(data) {
                    // console.log(data);
                    $('.container-fluid').html(data);
                }
            })
        }).fail(function(err) {
            console.error(err.statusText);
        });
    }else if(source == 'news.bbc.co.uk' || source == 'businessinsider.com' || source == 'engadget.com'
	|| source == 'thenextweb.com' || source == 'usatoday.com' || source == 'techcrunch.com'
	|| source == 'timesofindia.indiatimes' || source == 'express.pk'){
		var params = {
            "query": "{\"$query\":{\"$and\":[{\"categoryUri\":\"dmoz/"+category+"\"},{\"sourceUri\":\"" +source + "\"}]}}",
            "dataType": [
                "news"
            ],
            "resultType": "articles",
            "articlesSortBy": "date",
            "articlesCount": 10,
            "articleBodyLen": -1,
            "apiKey": "0cd53df4-fdf8-4132-a211-6c646d60ba85"
        };
        $.ajax({
            url: "https://newsapi.ai/api/v1/article/getArticles",
            crossDomain: true,
            data: params,
            method: 'GET',
        }).done(function(result) {
            // console.log(result);
            $.ajax({
                url: 'ajax_calls.php',
                data: result,
                method: 'POST',
                success: function(data) {
                    // console.log(data);
                    $('.container-fluid').html(data);
                }
            })
        }).fail(function(err) {
            console.error(err.statusText);
        });
	}else{
        var params = {
            "query": "{\"$query\":{\"$and\":[{\"locationUri\":\"http://en.wikipedia.org/wiki/Pakistan\"},{\"categoryUri\":\"dmoz/"+category+"\"}]}}",
            "dataType": [
                "news"
            ],
            "resultType": "articles",
            "articlesSortBy": "date",
            "articlesCount": 10,
            "articleBodyLen": -1,
            "apiKey": "0cd53df4-fdf8-4132-a211-6c646d60ba85"
        };
        $.ajax({
            url: "https://newsapi.ai/api/v1/article/getArticles",
            crossDomain: true,
            data: params,
            method: 'GET',
        }).done(function(result) {
            // console.log(result);
            $.ajax({
                url: 'ajax_calls.php',
                data: result,
                method: 'POST',
                success: function(data) {
                    // console.log(data);
                    $('.container-fluid').html(data);
                }
            })
        }).fail(function(err) {
            console.error(err.statusText);
        });
    }
});
</script>