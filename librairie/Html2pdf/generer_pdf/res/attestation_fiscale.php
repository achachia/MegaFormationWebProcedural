<?php ?>
<style type="text/css">
    table {
        width: 100%;
        margin-left:20%; 
    }
</style>
<page style="font-size:14px" backtop="15mm">
    <H3 style="text-align: center">
        <b>ATTESTATION DESTINEE AU CENTRE DES IMPOTS</b>
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
    <table cellspacing="0" style="width: 100%">
        <tr>
            <td><strong> Je soussign&eacute;, Mr <?php echo $infos_gerant['nom'] . "    " . $infos_gerant['prenom']; ?> ,
                    auto-entrepreneur agr&eacute;e certifie que  <?php echo $infos_famille['civilite'] . " " . $infos_famille['nom'] . "    " . $infos_famille['prenom']; ?> <br />
                    <br />a b&eacute;n&eacute;fici&eacute; de services &agrave; la personne :
                    soutien scolaire.<br /> <br /> En <?php echo $infos_attestation['annee_fiscale']; ?>, le montant des factures
                    effectivement acquitt&eacute;es repr&eacute;sente une somme totale
                    de : <?php echo $infos_attestation['total_regle']; ?>&euro;,<br /> <br /> dont  <?php echo " " . $infos_attestation['total_regle']; ?>&euro; acquitt&eacute;s au
                    moyen de Ch&egrave;que(s) .
                </strong></td>
        </tr>
    </table>
    <br />
    <br />
    <table border="1" cellspacing="0" style="width: 100%">
        <tr>
            <th style="text-align: center; width: 30%; height: 5%;">Nom et
                pr&eacute;nom de l'intervenant</th>
            <th style="text-align: center; width: 20%">Nature de la prestation</th>
            <th style="text-align: center; width: 20%">Nombre d'heure</th>
            <th style="text-align: center; width: 20%">Montant</th>
        </tr>
        <?php foreach ($liste_interventions as $value) { ?>
            <tr>
                <td style="text-align: center; height: 3%;"><?php echo $value['identite_intervenant']; ?></td>
                <td style="text-align: center; height: 3%;">Soutien Scolaire</td>
                <td style="text-align: center; height: 3%;"><?php echo $value['total_h']; ?></td>
                <td style="text-align: center; height: 3%;"><?php echo $value['total_regle']; ?></td>
            </tr>
        <?php } ?>

        <tr>
            <td COLSPAN=2 style="text-align: center; height: 3%;">TOTAL :</td>
            <td style="text-align: center; height: 3%;"><?php echo $infos_attestation['total_h']; ?></td>
            <td style="text-align: center; height: 3%;"><?php echo $infos_attestation['total_regle']; ?>&euro;</td>
        </tr>
    </table>
    <br />
    <br />
    <table>
        <tr>
            <td style="text-align: left; height: 3%; width: 40%"><strong>Fait pour
                    valoir ce que de droit,</strong></td>
            <td style="text-align: left; height: 3%; width: 20%"></td>
            <td style="text-align: left; height: 3%; width: 40%"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: left; height: 3%; width: 40%">A V&eacute;nissieux, le
                <?php echo $infos_attestation['date_attestation']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: left; height: 3%; width: 40%">Signature :</td>

        </tr>
    </table>

</page>