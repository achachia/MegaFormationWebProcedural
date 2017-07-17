<page style="font-size:14px" backtop="5mm">
    <?= $toto; ?> 
    <table style="border: none;width: 100%">
        <tr>
            <td style="width:60px;height:100px;padding-left:-5px " >
                <img src="http://mega-cours.fr/media/images/favicon.png" alt="" style="width:30%;height:100% "/>
            </td>
        </tr>   
        <tr>
            <td style="width: 55%;">
                <?= $infos_gerant['nom']; ?><br /> 
                <?= $infos_gerant['adresse']; ?><br />
                <?= $infos_gerant['code_postale'] . "&nbsp;" . $infos_gerant['ville']; ?><br />
                <?= $infos_gerant['pays']; ?><br />
                Siret : <?= $infos_gerant['n_siret']; ?><br />
                Num&eacute;ro de l'agr&eacute;ment : <?= $infos_gerant['n_agrement']; ?><br />
                E-mail : <?= $infos_gerant['email']; ?>
            </td>
            <td style="width: 40%;">
                <table style="width: 100%">
                    <tr>
                        <td style="border: solid 1px #000000; text-align: center; border-radius: 3mm; width: 90%; height: 50px;">
                            <!-- Numero de la facture -->
                             <table style="width: 100%">
                                <tr>
                                    <td style="text-align: center" colspan='2'>Facture N&#176; <?= $infos_facture['N_facture']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Date : <?= $infos_facture['date_facture']; ?></td>
                                    <td style="width: 50%">page [[page_cu]]-[[page_nb]]</td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br />
    <br />
    <!-- Identite de la famille -->
    <table style="width: 100%">
        <tr>
            <td style="width: 55%"></td>
            <td	style="border: solid 1px #000000; text-align: left; border-radius: 3mm; width: 40%; height: 80px; padding: 10px">
                <?= $infos_famille['nom']; ?><br /><br />
                <?= $infos_famille['adresse']; ?>
                <?php if (isset($infos_famille ['adresse_suite'])) {
                    echo $infos_famille ['adresse_suite'];
                } ?><br/>
                <?= $infos_famille['code_postale'] . " " . $infos_famille['ville']; ?><br />
                <?= $infos_famille['pays']; ?><br />
            </td>
        </tr>
    </table>
    <br/>
    <b><u>Objet </u>:  <?php echo $infos_facture['objet_facture']; ?></b> <br/><br/>
    Dispens&eacute; d'immatriculation au registre du commerce et des soci&eacute;t&eacute;s
    (RCS) et au r&eacute;pertoire des m&eacute;tiers (RM)<br /><br />
    <table border="1" cellspacing="0" style="width: 100%">
        <tr>
            <th style="text-align: center; width: 50%">D&Eacute;SIGNATION</th>
            <th style="text-align: center; width: 11%">QT&Eacute;</th>
            <th style="text-align: center; width: 11%">PU HT</th>
            <?php if (!empty($infos_facture['remise'])) { ?>     
            <th style="text-align: center; width: 11%">REMISE(&euro;)</th>
            <th style="text-align: center; width: 16%">TOTAL HT</th>
            <?php } else { ?> 
            <th style="text-align: center; width: 25%">TOTAL HT</th>
            <?php } ?> 
        </tr>
        <tr>
            <td  style="width: 50%; height: 280px; vertical-align: top"><?= $infos_facture['designation_facture']; ?></td>
            <td  style="width: 11%; height: 280px; vertical-align: top; text-align: center"><?=  $infos_facture['Qte']; ?></td>
            <td  style="width: 11%; height: 280px; vertical-align: top; text-align: center"><?= $infos_facture['PU_HT']; ?></td>
            <?php if (!empty($infos_facture['remise'])) { ?>    
            <td  style="width: 11%; height: 280px; vertical-align: top; text-align: center"><?= $infos_facture['remise']; ?></td>
            <?php } ?> 
            <td  style="width: 16%; height: 280px; vertical-align: top; text-align: center"><?= $infos_facture['total_paye']; ?>&euro;</td>
        </tr>
    </table>
    <br />
    <table style="border: none;width: 92%">
        <tr>
            <td style="width: 70%">
                    <?php if (!empty($infos_facture['total_acompte'])) { ?>    
                    <table border="1" cellspacing="0">
                        <tr>
                            <td>FACTURE(S) D'ACOMPTE LI&Eacute;E(S)</td>
                        </tr>
                        <tr>
                            <td> Facture d'acompte n° <?= $infos_facture['numero_acompte']; ?> du <?= $infos_facture['date_acompte']; ?> de <?= $infos_facture['total_acompte']; ?>&euro; - Pay&eacute;</td>
                        </tr>
                    </table> <br />
                    <?php } ?>
                Paiement comptant &agrave;� r&eacute;ception de la facture <br />
                Mode de paiement : <?php echo $infos_facture['mode_paiement']; ?>
            </td>
            <td style="text-align:right;">
                <table style="border: none;width: 62%">
                    <tr>
                        <td style="border:solid 1px #000000; text-align: left; width: 100%; height: 10px">
                            <table style="border: none;">
                                    <?php if (!empty($infos_facture['remise'])) { ?> 
                                    <tr>
                                        <td style="width: 50%">Remise (&euro;)  :</td>
                                        <td style="width: 50%"><?= $infos_facture['remise']; ?></td>
                                    </tr>
                                    <?php } ?> 
                                    <tr>
                                       <td style="width: 50%">Montant HT :</td>
                                       <td style="width: 50%"><?= $infos_facture['total_paye']; ?>&euro;</td>
                                    </tr>
                                    <?php if (!empty($infos_facture['total_acompte'])) { ?>
                                    <tr>
                                        <td style="width: 50%">Acompte :</td>
                                        <td style="width: 50%"><?= $infos_facture['total_acompte']; ?>&euro;</td>
                                    </tr>
                                    <?php } ?>
                                     <?php if (!empty($infos_facture['TauxTVA'])) { ?>
                                     <tr>
                                        <td style="width: 50%">TOTAL TVA <?= $infos_facture['TauxTVA'];?> %     :</td>
                                        <td style="width: 50%"><?= $infos_facture['MontantTva']; ?>&euro;</td>
                                    </tr>
                                     <tr>
                                        <td style="width: 50%">Total TTC     :</td>
                                        <td style="width: 50%"><?= $infos_facture['TotalTva']; ?>&euro;</td>
                                    </tr>
                                    <?php } else {?>
                                     <tr>
                                        <td style="width: 50%">Total r&eacute;gl&eacute;     :</td>
                                        <td style="width: 50%"><?= $infos_facture['total_restant']; ?>&euro;</td>
                                    </tr>
                                    <?php } ?>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td  style="border: solid 1px #000000; text-align: left; width: 100%; height: 10px">
                            <table style="border: none;">
                                <?php if (!empty($infos_facture['TauxTVA'])) { ?>
                                <tr>
                                    <td style="width: 50%">NET A PAYER :</td>
                                    <td style="width: 50%"> <?= $infos_facture['TotalTva']; ?> €</td>
                                </tr>
                                <?php }else{ ?>
                                <tr>
                                    <td style="width: 50%">NET A PAYER :</td>
                                    <td style="width: 50%"> <?= $infos_facture['total_paye']; ?> €</td>
                                </tr>
                                <?php }  ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>TVA non applicable, art. 293 B du CGI</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</page>