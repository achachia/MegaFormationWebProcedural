<?php ?>
<style type="text/css">
    table
    {
        width:  100%;		
    }
</style>
<page style="font-size: 14px" backtop="15mm">
    <table style="border:none;">
        <tr>
            <td style="width:60%">
                CHACHIA ABDELILAH<br/>
                14 rue de commune de paris C104<br/>
                69200 lyon<br/>
                FRANCE<br/>
                Siret : 79922869700014<br/>
                E-mail : achachia2003@yahoo.fr<br/>
            </td>     
            <td style="width:40%">
                <table>
                    <tr>
                        <td style="border: solid 1px #000000; text-align:center;border-radius: 3mm;width:90%;height:50px;">                      
                            <table>
                                <tr>
                                    <td style="text-align:center"  colspan='2'>Facture d'acompte N <?php echo $infos_acompte['N_acompte']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">Date :<?php echo $infos_acompte['date_facture']; ?></td> 
                                    <td style="width:50%">page [[page_cu]]-[[page_nb]]</td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table><br/><br/>
    <table>
        <tr>
            <td style="width:55%"></td>
            <td style="border: solid 1px #000000; text-align:left;border-radius: 3mm;width:40%;height:80px;padding: 10px">
                <?php echo $infos_famille['civilité'] . " " . $infos_famille['nom'] . " " . $infos_famille['prenom']; ?><br/>
                <?php echo $infos_famille['adresse']; ?><br/>
                <?php
                if ($infos_famille['adresse_suite'] != '') {
                    echo $infos_famille['adresse_suite'] . "<br/>";
                }
                ?>
                <?php echo $infos_famille['code_postale'] . " " . $infos_famille['ville']; ?><br/>
                <?php echo $infos_famille['pays']; ?><br/><br/>
            </td>        
        </tr>
    </table><br>
    <b><u>Objet </u>:  <?php echo $infos_acompte['objet_acompte']; ?></b><br><br>
    Dispensé d'immatriculation au registre du commerce et des sociétés (RCS) et au répertoire des métiers (RM)<br/><br/>
    <table border="1" cellspacing="0" style="width:100%">
        <tr>
            <th style="text-align:center;width:70%">DESIGNATION</th>
            <th style="text-align:center;width:30%">TOTAL HT</th>
        </tr>
        <tr>
            <td style="width:50%;height:280px;vertical-align: top;text-align:center">Acompte</td>
            <td style="width:16%;height:280px;vertical-align: top;text-align:center"><?php echo $infos_acompte['total_acompte']; ?>€</td>       
        </tr>   
    </table><br/>
    <table style="border:none;">
        <tr>
            <td  style="width:70%">      
                Mode de paiement : <?php echo $infos_acompte['mode_paiement']; ?>
            </td>      
            <td  style="width:30%;text-align:right">
                <table style="border:none;">
                    <tr>
                        <td style="border: solid 1px #000000; text-align:left;width:100%;height:10px">
                            <table style="border:none;">                  
                                <tr>
                                    <td style="width:50%"> Montant HT</td>
                                    <td style="width:50%"><?php echo $infos_acompte['total_acompte']; ?>€</td>
                                </tr>                                       
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td style="border: solid 1px #000000; text-align:left;width:100%;height:10px">
                            <table style="border:none;">                       
                                <tr>                    
                                    <td style="width:50%">NET A PAYER</td>
                                    <td style="width:50%"> <?php echo $infos_acompte['total_acompte']; ?> €</td>
                                </tr>                                         
                            </table>                        
                        </td>     
                    </tr>
                    <tr>
                        <td>
                            TVA non applicable, art. 293 B du CGI
                        </td>  
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</page>
