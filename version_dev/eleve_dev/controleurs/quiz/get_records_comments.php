<?php
require_once './../../connection/config.php';
require_once './../../librairie/fonctions_local.php';
require_once root_dossier_modeles.'/quiz/list_quiz_theme.php';

$random_quiz = $_POST['random_quiz'];
if (isset($_POST["page"])) {
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if (!is_numeric($page_number)) {
        die('Invalid page number!');
    } //incase of invalid page number
} else {
    $page_number = 1;
}
$position = (($page_number - 1) * $item_per_page);



$sql = " SELECT * FROM Comment_quiz_eleve  
                     UNION
                     SELECT * FROM Comment_quiz_prof

                     WHERE  random_quiz='$random_quiz'    ORDER BY  date_created DESC   LIMIT $position, $item_per_page_comments";

$results = $cxn->prepare($sql);
$results->execute();

while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
    $info = identite_comment($row['code_user']);
    ?>
    <div class="col-sm-12">
        <div class="panel panel-white post panel-shadow">
            <div class="post-heading">
                <div class="pull-left image">
                    <img src="<?= url_media_local; ?>/images/user_comment.jpg" class="img-circle avatar" alt="user profile image">
                </div>
                <div class="pull-left meta">
                    <div class="title h5">
                        <a href="#"><b style="color:blue"><?= $info['identite']; ?></b>&nbsp;&nbsp;<b style="color:red">[<?= $info['statut']; ?>]</b></a>                                                            
                    </div>
                    <h6 class="text-muted time"><?= format_date_gregorien_comment($row['date_comment']); ?>à <?= format_heure_comment($row['heure_comment']); ?></h6>
                </div>
            </div> 
            <div class="post-description" style="padding-left:5%;"> 
                <p><?= $row['comment']; ?></p>

            </div>
        </div>
    </div>
<?php } ?>

