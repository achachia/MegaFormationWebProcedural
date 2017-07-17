<page style="font-size:14px" backtop="15mm">
    <page_header>
        <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
            <tr>
                <td style="width: 33%">
                    MEGACOURS : COURS A DOMICILE
                </td>          
                <td style="width: 100%;margin-left: 2px">
                    MATHEMATIQUES
                </td>
            </tr>
        </table>
        <hr/>
    </page_header>
    <page_footer>
        <hr/>
        <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
            <tr>
                <td style="width: 33%">
                    SITE-WEB : MEGA-COURS.COM
                </td>
                <td style="width: 33%;text-align: center">
                    page [[page_cu]]/[[page_nb]] 
                </td>
                <td style="width: 33%;">
                    NOUS CONTACTER : 06 72 73 01 40
                </td>
            </tr>
        </table>
    </page_footer>   
    <table border='1' align="center"  style=" height:50px;cellpadding: -5px">
        <?php
        $i = 1;
        foreach ($liste_coupon as $value) {
            ?>    
            <tr>
                <td style=" height:50px;">
                    <table>
                        <tr>
                            <td style="padding-top:0px;width:80px;" >
                                <img src="http://mega-cours.fr/media/images/favicon.png" alt="" style="width:100%;"/>
                            </td>

                            <td rowspan="9">
                                <table>
                                    <tr>
                                        <th>COURS A DOMICILE<br/>Année <?php echo $infos['annee_scolaire']; ?></th>
                                    </tr>
                                    <tr>
                                        <th><u>Partie à donner à l’intervenant : </u></th>
                                    </tr>
                                    <tr>
                                        <td>Séance N° : <?php echo $i; ?>/<?php echo $infos['nbre_cours'] . ' [Cours de ' . $infos['duree_coupon'] . ']'; ?></td>
                                    </tr>
                                    <tr>
                                        <td style='width: 50%'></td>
                                        <td style='width: 50%'></td>
                                    </tr>   
                                    <tr>
                                        <td>Elève :  <?php echo $infos['eleve']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            Coupon-contrat n° : <?php echo $value['code_facture']; ?>                               

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Code-coupon n° : <?php echo $value['code_coupon']; ?>                               

                                        </td>
                                    </tr>
        <!--                                    <tr>
                                            <td colspan="2" style="text-align: center">     
                                        <barcode type="EAN13" value="<?php echo $value['code_coupon']; ?>" label="label" style="width:30mm; height:6mm; color: black; font-size: 4mm"></barcode>
                                </td>  
                            </tr>-->
                                    <tr>
                                        <td colspan="1" style="text-align: center">
                                            <?php /* echo $infos['parent_eleve']; */ ?><br/>
                                            Valable jusqu'au <?php echo $value['date_limite']; ?>

                                        </td>  
                                    </tr>
                                    <tr>
                                        <td>Nom du formateur :...........................</td> 
                                    </tr>
                                    <tr>
                                        <td>Date : ....................................</td> 

                                    </tr>
                                    <tr>
                                        <td>Signature : ................................</td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>         
                        <tr>
                            <td>&nbsp;</td>

                        </tr>


                    </table>




                </td>
                <!---------------------------------------------------------->

                <td style=" height:50px;">
                    <table>
                        <tr>
                            <td style="padding-top:0px;width:80px;" >
                                <img src="http://mega-cours.fr/media/images/favicon.png" alt="" style="width:100%;"/>
                            </td>

                            <td rowspan="9">
                                <table>
                                    <tr>
                                        <th>COURS A DOMICILE<br/>Année <?php echo $infos['annee_scolaire']; ?></th>
                                    </tr>
                                    <tr>
                                        <th><u>Partie à conserver par la famille : </u></th>
                                    </tr>
                                    <tr>
                                        <td>Séance N° : <?php echo $i; ?>/<?php echo $infos['nbre_cours'] . ' [Cours de ' . $infos['duree_coupon'] . ']'; ?></td>
                                    </tr>
                                    <tr>
                                        <td style='width: 50%'></td>
                                        <td style='width: 50%'></td>
                                    </tr> 
                                    <tr>
                                        <td>Parent employeur : <?php echo $infos['parent_eleve']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Elève :  <?php echo $infos['eleve']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            Coupon-contrat n° : <?php echo $value['code_facture']; ?>                               

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Code-coupon n° : <?php echo $value['code_coupon']; ?>                               

                                        </td>
                                    </tr>
        <!--                                    <tr>
                                            <td colspan="2" style="text-align: center">     
                                        <barcode type="EAN13" value="<?php echo $value['code_coupon']; ?>" label="label" style="width:30mm; height:6mm; color: black; font-size: 4mm"></barcode>
                                </td>  
                            </tr>-->
                                    <tr>
                                        <td colspan="1" style="text-align: center">
                                            <?php /* echo $infos['parent_eleve']; */ ?><br/>
                                            Valable jusqu'au <?php echo $value['date_limite']; ?>

                                        </td>  
                                    </tr>
                                    <tr>
                                        <td>Nom du formateur :...........................</td> 
                                    </tr>
                                    <tr>
                                        <td>Date : ....................................</td> 

                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>

                        </tr>         
                        <tr>
                            <td>&nbsp;</td>

                        </tr>


                    </table>




                </td>
      <!--            <td>
                    
                  <table>
                        <tr>
                            <th>COURS A DOMICILE<br/>Année <?php echo $infos['annee_scolaire']; ?></th>
                        </tr>
                        <tr>
                            <th><u>Partie à conserver par la famille :</u></th>
                        </tr>
                        <tr>
                            <td>Séance N° : <?php echo $i; ?>/<?php echo $infos['nbre_cours']; ?></td>
                        </tr>
                        <tr>
                            <td>Parent employeur : <?php echo $infos['parent_eleve']; ?></td>
                        </tr>
                        <tr>
                            <td>Elève : <?php echo $infos['eleve']; ?></td>
                        </tr>
                        <tr>
                            <td>Cours <?php echo $infos['duree_coupon']; ?></td>
                        </tr>
                        <tr>
                            <td>Nom du formateur :....................................</td>
                        </tr>
                        <tr>
                            <td>Coupon-contrat n° : <?php echo $value['code_facture'] . ' - ' . $value['code_coupon']; ?>        
                            </td>
                        </tr>
                        <tr>
                            <td>Date : ....................</td>
                        </tr>
                    </table>
                </td>-->
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>

</page>
