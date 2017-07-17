<?php include './vues/side_bare_left.php'; ?>
<div class="col-lg-5" style="padding-top: 40px"></div> 

<div class="container">
    <div class="row">    
        <div class="col-md-8">
            <h3>
                Responsive 16:9 YouTube
            </h3>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="//www.youtube.com/embed/zpOULjyy-n8?rel=0"></iframe>
            </div>


            <h3>
                Responsive 4:3 YouTube
            </h3>
            <div class="embed-responsive embed-responsive-4by3">
                <iframe class="embed-responsive-item" src="//www.youtube.com/embed/TQl_Sv3LztQ"></iframe>
            </div>        
            <hr>
            <h3>
                Responsive 16:9 Vimeo
            </h3>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="//player.vimeo.com/video/22428395"></iframe>
            </div>
            <h3>
                Video local ou en ligne
            </h3>
              <video width="400" controls>
            <source src="http://www.w3schools.com/css/mov_bbb.mp4" type="video/mp4">
            <source src="mov_bbb.ogg" type="video/ogg">
            Your browser does not support HTML5 video.
        </video>
        </div><!--.col -->

    </div><!--./row -->
</div><!--./container -->

<style>
    video {
        width: 60%;
        height: auto;
    }
</style> 