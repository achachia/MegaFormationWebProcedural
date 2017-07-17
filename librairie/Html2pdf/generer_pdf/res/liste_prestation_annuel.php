<?php ?>
<style type="text/css">
    table {
        width: 100%;
        margin-left:20%; 
    }
</style>
<page style="font-size:14px" backtop="15mm">
    <H3 style="text-align: center">
        <b>LA LISTE DES PRESTATIONS DE L'ANN&Eacute;E : <?php echo $annee_fiscale; ?> </b>
    </H3>
    <br>
    <br>
    <br>
    <table>
        <tr>
            <td style="border: solid 1px #000000;  border-radius: 3mm; width: 70%; height: 50px;">
                <div style="margin:15px">
                    <strong>Nom de l'entreprise : </strong> <?php echo $infos_gerant['nom'] . "    " . $infos_gerant['prenom']; ?><br />
                    <br /> <strong>Adresse : </strong><?php echo $infos_gerant['adresse']; ?><br />
                    <br /> <strong>Code postale/Ville : </strong><?php echo $infos_gerant['code_postale'] . " / " . $infos_gerant['ville']; ?><br />
                    <br /> <strong>Num&eacute;ro d'identification : </strong><?php echo $infos_gerant['n_siret']; ?><br />
                    <br /> <strong>Num&eacute;ro de l'agr&eacute;ment : </strong><?php echo $infos_gerant['n_agrement']; ?><br />
                    <br /> <strong>Date d'obtention de l'agr&eacute;ment : </strong><?php echo $infos_gerant['date_agrement']; ?><br />
                </div>

            </td>
        </tr>
    </table>
    <br />
    <br />
    <table>
        <tr>
            <td style="border: solid 1px #000000;  border-radius: 3mm; width: 70%; height: 50px;">
                <div style="margin:15px">
                    <strong>Nom de pr&eacute;nom du b&eacute;n&eacute;ficiaire : </strong> <?php echo $infos_famille['nom'] . "    " . $infos_famille['prenom']; ?><br />
                    <br /> <strong>Adresse : </strong><?php echo $infos_famille['adresse']; ?><br />
                    <br /> <strong>Code postale/Ville : </strong><?php echo $infos_famille['code_postale'] . " / " . $infos_famille['ville']; ?><br />
                </div>

            </td>
        </tr>
    </table>
    <br>
    <br>
    <table border="1" cellspacing="0" style="width: 100%">
        <tr>
            <th style="text-align: center; width: 30%; height: 5%;">Nom et
                pr&eacute;nom de l'intervenant</th>
            <th style="text-align: center; width: 20%">Nature de la prestation</th>
            <th style="text-align: center; width: 20%">Date cours</th>
            <th style="text-align: center; width: 20%">Duree</th>
        </tr>
        <?php foreach ($liste_prestations_annuel as $value) { ?>
            <tr>
                <td style="text-align: center; height: 3%;"><?php echo $value['identite_intervenant']; ?></td>
                <td style="text-align: center; height: 3%;">Soutien Scolaire</td>
                <td style="text-align: center; height: 3%;"><?php echo $value['date_cours']; ?></td>
                <td style="text-align: center; height: 3%;"><?php echo $value['dure_cours']; ?></td>
            </tr>
        <?php } ?>

        <tr>
            <td COLSPAN=3 style="text-align: center; height: 3%;">TOTAL :</td>
            <td style="text-align: center; height: 3%;"><?php echo $infos_attestation['total_h']; ?> H</td>
           
        </tr>
    </table>



</page>

