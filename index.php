<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"



    "http://www.w3.org/TR/html4/strict.dtd"



    >



<html lang="en">



<head>



    <title>Devianart Flickr API</title>



    <link href="styles/style.css" rel="stylesheet" type="text/css" />



    <link rel="stylesheet" type="text/css" href="scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />



	 <link rel="shortcut icon" href="http://designm.ag/favicon.ico">



  <link rel="icon" href="http://designm.ag/favicon.ico">



  <link rel="stylesheet" type="text/css" href="styles.css">



  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Finger+Paint">



  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>



  <script type="text/javascript" src="deviant.js"></script>



 <!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">



<!-- Optional theme -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">



<!-- Latest compiled and minified JavaScript -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

  

  













    



    <script type="text/javascript" src="scripts/jquery.1.6.2.js"></script>



    <script type="text/javascript" src="scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>



	<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>



	



	



	



	



    <script type="text/javascript">



        function searchPics(yourKeywords) {



            



            $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?",



            {



                lang    : 'en-us',



                tags    : yourKeywords,



                tagmode : 'all',



                limit   : '60',



                format  : 'json'



            },



            function(data){



                    



                var imgInsert = "";



                var items = [];



                



                //create the element that holds the images



                $('<div/>', {



                    'id': 'content2',



                    html: items.join('')



                }).appendTo('#wrapper').insertAfter('#left_sidebar');



                



                /* each image loaded from flickr will have a div as parent then the main parent



                will apend to the wrapper */



                $.each(data.items, function(i,item){



                    if (i == 20) return false;



                    var imgThumb = item.media.m.split('m.jpg')[0] + 'm.jpg'; //size of the image small max 240px



                    var imgLarge = item.media.m.split('m.jpg')[0] + 'b.jpg'; //large size of the image for fancybox







                    imgInsert += '<div class="avatar">';



                    imgInsert += '<a href="' + imgLarge + '" rel="flickr_group" class="big_img" title="' + item.title + '">';



                    imgInsert += '<img title="' + item.title + '" src="' + imgThumb + '" alt="' + item.title + '" />';



                    imgInsert += '</a></div>';



                });



                var cachedItems = $(imgInsert).data('cached', imgInsert);



                



                $('#content2').append(imgInsert).addClass(yourKeywords).data('cached', data.items);



                



                /* create a history list and insert it into the left sidebar */



                var listChached = '';



                listChached += '<div class="history_list">';



                listChached += '<a class="' + yourKeywords + '_chached" href="javascript:;">';



                listChached +=  yourKeywords + '</a></div>';







                $(listChached).appendTo('#left_sidebar').insertAfter('form');



    



                $('.' + yourKeywords + '_chached').click(function(){



                    



                    /* if the content has items then remove them



                    and insert the chathed itmes */



                    if ( $('#content2').length > 0 ) {  



                        $('#content2').empty();



                        $('#content2').html(cachedItems);



                        



                        //open the images using fancybox for the cached images



                        $("a[rel=flickr_group]").fancybox({



                            'transitionIn': 'none',



                            'transitionOut': 'none',



                            'titlePosition': 'over',



                            'titleFormat': function (title, currentArray, currentIndex, currentOpts) {



                                return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';



                            }



                        });                             



                    }                        



                })







                //open the images using fancybox for the new search



                $("a[rel=flickr_group]").fancybox({



                    'transitionIn': 'none',



                    'transitionOut': 'none',



                    'titlePosition': 'over',



                    'titleFormat': function (title, currentArray, currentIndex, currentOpts) {



                        return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';



                    }



                });                



            });



        }



        



        $(function(){



            $('.search_form').submit(function(){



                //if it has been a search allready remove the old content and replace it with the new search



                if ( $('#content2').length > 0 ) {



                    $('#content2').remove();



                }                        



                searchPics(document.getElementById('keywords').value );



				return false;



            })



        })



    </script>



</head>



<body>



<nav class="navbar navbar-default" role="navigation">



  <div class="container-fluid">



    <!-- Brand and toggle get grouped for better mobile display -->



    <div class="navbar-header">



      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">



        <span class="sr-only">Toggle navigation</span>



        <span class="icon-bar"></span>



        <span class="icon-bar"></span>



        <span class="icon-bar"></span>



      </button>



      <a class="navbar-brand" href="#">Devianart & Flickr API </a>



    </div>







    <!-- Collect the nav links, forms, and other content for toggling -->



    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">



      <ul class="nav navbar-nav">



        <li class="active"><a href="#">Link</a></li>



        <li><a href="#">Link</a></li>



        <li class="dropdown">



          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>



          <ul class="dropdown-menu" role="menu">



            <li><a href="#">Action</a></li>



            <li><a href="#">Another action</a></li>



            <li><a href="#">Something else here</a></li>



            <li class="divider"></li>



            <li><a href="#">Separated link</a></li>



            <li class="divider"></li>



            <li><a href="#">One more separated link</a></li>



          </ul>



        </li>



      </ul>



      <form class="navbar-form navbar-left" role="search">



        <div class="form-group">



          <input type="text name="s" id="s" class="form-control" placeholder="Search">



        </div>



      </form>



         <div id="wrapper">







            <form action="" method="post" class="search_form">



                <input type="text" id="keywords" />



                <button name="search" id="search">Search</button>



            </form>



        </div>



    </div>  





    </div><!-- /.navbar-collapse -->



  </div><!-- /.container-fluid -->



</nav>











	<div id="w">



		<h1>DeviantArt Instant Search</h1>



		<center id="loader"><img src="img/loader.gif" alt="loading..."></center>



		



	</div>



			 <!-- Page Content -->



    <div class="container" >



		<h1 class="page-header">Art Gallery </h1>	



	    <div class="row" id="content"> 



         <div class="clear" id="content2"> 





           



            



        </div>



    </div>



    <!-- /.container -->















   



</body>



</html>



