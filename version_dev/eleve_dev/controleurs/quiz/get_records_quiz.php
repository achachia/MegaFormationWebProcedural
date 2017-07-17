<?php
session_start();
session_regenerate_id();
require_once './../../connection/config.php';
require_once root_dossier_modeles.'/quiz/list_quiz_theme.php';
$random_theme = $_POST['random_theme'];

if (isset($_POST["page"])) {
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if (!is_numeric($page_number)) {
        die('Invalid page number!');
    } //incase of invalid page number
} else {
    $page_number = 1;
}
$position = (($page_number - 1) * $item_per_page);

$list_quiz = list_quiz($random_theme, $_SESSION ['membre']['code_eleve'], $position, $item_per_page);
//var_dump($list_quiz);

foreach ($list_quiz as $value) {
    ?>   
    <!---------------------------------------------------> 

    <div class="row">
        <div class="col-md-12">
            <ul class="list-listings">
                <li class="featured">
                    <div class="listing-header bg-base">
                        <?= $value['nom']; ?>
                    </div>
                    <div class="listing-image">
                        <img src="<?= url_media_local; ?>/images/<?= $value['img_quiz']; ?>" class="img-responsive" alt="">
                    </div>
                    <div class="listing-body">

                        <p> <?= $value['description_content']; ?></p>
                        <div class="meta-info">
                            <ul>
                                <li><?= $value['type_quiz']; ?></li>
                                <li>Score requis :  <?= $value['score_requis']; ?> Points</li>
                                <li><?= $value['nb_quest']; ?> Questions</li>
                                <li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?= $value['nbr_like']; ?> <i class="fa fa-thumbs-o-down" aria-hidden="true"></i> <?= $value['nbr_dislike']; ?></li>
                            </ul>
                        </div><br/>
                        <div class="meta-info">
                            <ul>
                                <li>Note moyenne : <?= $value['note_vote_eleve']; ?>  (Basée sur <span id="totalrat"><?= $value['total_votes_eleve']; ?></span> évaluation)</li>
                                <li><?= $value['difficulte']; ?></li>
                                <li>Nombre essai autorisé : <?= $value['nbr_essai']; ?></li>

                            </ul>
                        </div><br/>
                        <div class="meta-info">
                            <ul>
                                <li>    <i class="fa fa-tags" aria-hidden="true"></i> Mots clés : <?= $value['tags']; ?></li>


                            </ul>
                        </div>
                        <div class="meta-info">
                            <ul>
                                <li>

                                    <?php
                                    if ($value['barre_progression_reussite'] != '') {
                                        echo $value['barre_progression_reussite'];
                                    }
                                    ?>
                                </li>
                            </ul>

                        </div><br/>
                        <div class="meta-info">
                            <ul>
                                <li>
                                    <button type="button" class="btn btn-primary btn-md"  data-toggle="modal" id="#comments_quiz_<?= $value['random_quiz']; ?>"   onClick="bootpage_comment('<?= $value['random_quiz']; ?>', '#comments_quiz_<?= $value['random_quiz']; ?>', '.paging_link_<?= $value['random_quiz']; ?>', '<?= $value['nbr_pages']; ?>', '#list_comments_<?= $value['random_quiz']; ?>')">
                                        <a href="#" style="color:#ffffff"><i class="fa fa-comment-o" aria-hidden="true"></i> <?= $value['total_comments']; ?> Commentaires</a>

                                    </button>
                                </li>
                                <li>

                                    <a href="<?= url_espace_eleve; ?>/index.php?module=quiz&action=exec_quiz&&code_matiere=<?= $_SESSION['code_matiere']; ?>&random_quiz=<?= $value['random_quiz']; ?>">
                                        <button type="button" class="btn btn-success btn-md"  >
                                            COMMENCER LE QUIZ <i class="fa fa-angle-double-right" aria-hidden="true"></i>

                                        </button>
                                    </a>
                                </li>
                            </ul>

                        </div>






                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-------------------------------------------------------------------->
    <div class="row">
        <div class="modal fade" id="comments_quiz_<?= $value['random_quiz']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"  style="color:blue">
                            <?= $value['nom']; ?> [ LES COMMENTAIRES ]
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div id="list_comments_<?= $value['random_quiz']; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="paging_link_<?= $value['random_quiz']; ?>"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"  style="color:blue">FERMER</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------------------------------->
    <style>
        /**********************************************/
        .paging_link_<?= $value['random_quiz']; ?> {
            padding: 0px;
            margin: 0px;
            height: 50px;
            display: block;
            text-align: center;
        }
        .paging_link_<?= $value['random_quiz']; ?> li {
            display: inline-block;
            list-style: none;
            padding: 0px;
            margin-right: 1px;
            width: 40px;
            text-align: center;
            // background: #4CC2AF;
            //background: #00A2D1;
            line-height: 25px;
        }
        .paging_link_<?= $value['random_quiz']; ?> .disabled {
            display: inline-block;
            list-style: none;
            padding: 0px;
            margin-right: 1px;
            width: 30px;
            text-align: center;
            line-height: 25px;
            //  background-color: #666666;
            cursor:inherit;

        }
        .paging_link_<?= $value['random_quiz']; ?> li a{
            //  color:#FFFFFF;
            text-decoration:none;
        }
    </style>

<?php } ?>  


<style>

    ul.list-listings {
        margin: 0 0 20px 0;
        padding: 0;
        list-style: none;
    }

    ul.list-listings>li {
        margin-bottom: 30px;
        border: 1px solid #e0eded;
        border-radius: 2px;
    }

    ul.list-listings .listing-image {
        width: 30%;
        display: table-cell;
    }

    ul.list-listings .listing-image img {
        border-bottom-left-radius: 2px;
    }

    ul.list-listings .listing-body {
        padding: 10px 15px;
        display: table-cell;
        vertical-align: top;
    }

    ul.list-listings .listing-body h3 {
        margin: 0;
        padding: 0;
        font-size: 18px;
        font-weight: 500;
        line-height: 25px;
    }

    ul.list-listings .listing-body p {
        margin: 5px 0;
    }

    ul.list-listings .listing-body .meta-info {
        border-top: 1px solid #e0eded;
        padding-top: 7px;
    }

    ul.list-listings .listing-body .meta-info ul {
        width: 100%;
        display: table;
        table-layout: auto;
    }

    ul.list-listings .listing-body .meta-info ul li {
        display: table-cell;
        border-right: 1px solid #e0eded;
        text-align: center;
    }

    ul.list-listings .listing-body .meta-info ul li i {
        color: #333;
        margin-right: 5px;
    }

    ul.list-listings .listing-body {
        padding: 10px 15px;
        display: table-cell;
        vertical-align: top;
    }

    .bg-base {
        background: #3498db;
        color: #fff;
    }

    ul.list-listings>li.featured {
        border-color: #3498db;
    }

    ul.list-listings>li {
        margin-bottom: 30px;
        border: 1px solid #e0eded;
        border-radius: 2px;
    }

    ul.list-listings>li:before, ul.list-listings li:after {
        content: "";
        display: table;
    }

    ul.list-listings .listing-header {
        display: block;
        clear: both;
        padding: 8px 15px;
        font-weight: 600;
        text-transform: uppercase;
    }
</style>    

