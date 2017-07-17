<?php ?>
<style type="text/css">
    table {
        width: 100%;
        margin-left:20%; 
    }
</style>
<page style="font-size:14px" backtop="15mm">
    <H2 style="text-align: center">
        <b>LIVRES CHRONOLOGIQUE DES RECETTES</b>
    </H2>
    <H3 style="text-align: center">
        <b>LISTE DES RECETTES  <?php echo $periode; ?></b>
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
    <table border="1" cellspacing="0" style="width: 100%">
        <tr>
            <th style="text-align: center; width: 10%; height: 5%;">N°Facture</th>
            <th style="text-align: center; width: 12%">Date facture</th>
            <th style="text-align: center; width: 30%">Nom client</th>
            <th style="text-align: center; width: 20%">Nature prestation</th>
            <th style="text-align: center; width: 10%">Montant</th>
            <th style="text-align: center; width: 10%">Mode reglement</th>
        </tr>
        <?php foreach ($liste as $value) { ?>
            <tr>
                <td style="text-align: center; height: 3%;"><?php echo $value['N_facture']; ?></td>
                <td style="text-align: center; height: 3%;"><?php echo $value['date_facture']; ?></td>
                <td style="text-align: center; height: 3%;"><?php echo $value['nom_client']; ?></td>
                <td style="text-align: center; height: 3%;"><?php echo $value['nature_prestation']; ?></td>
                <td style="text-align: center; height: 3%;"><?php echo $value['montant']; ?>&euro;</td>
                <td style="text-align: center; height: 3%;"><?php echo $value['mode_paiement']; ?></td>
            </tr>
        <?php } ?>

        <tr>
            <td COLSPAN=4 style="text-align: center; height: 3%;">TOTAL :</td>           
            <td COLSPAN=2 style="text-align: center; height: 3%;"><?php echo $detail_recettes['regle']; ?></td>
        </tr>
    </table>
</page>