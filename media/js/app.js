



/******* fonction qui calcule le total de la facture ******/
var total_facture = function () {
    
    if ($("#prix_heure_HT").val() != '0' && $("#nb_heure").val() != '0') {
        if ($("#type_remise").val() && $("#valeur_remise").val()) {           
            var type_remise = $("#type_remise").val();
            if (type_remise == 'espece' && $("#valeur_remise").val() != '0') {           
                $("#total_HT").val(($('#prix_heure_HT').val()  * $("#nb_heure").val())- $("#valeur_remise").val());
            }
            else if(type_remise == 'pourcentage' && $("#valeur_remise").val() != '0'){
              $("#total_HT").val(($("#prix_heure_HT").val() * $("#nb_heure").val()) * (1 - $("#valeur_remise").val() / 100));  
            }  
          
        }
        else {
            $("#total_HT").val($('#prix_heure_HT').val() * $("#nb_heure").val());
        }
    }
}
/******* fonction qui qui charge le fichier div_form_acompte.php ******/
var view_section_acompte = function () {

    if ($(this).prop("checked") == true) {
        $('#section_acompte_view').load('./vues/facturation/div_form_acompte.php', function () {
            $("#date_acompte").datepicker();
        }).fadeIn("slow");

    }
    else if ($(this).prop("checked") == false) {
        $('#section_acompte_view').html('');
    }
}
/*******************  fonction qui verifie la date   ***************************/
    function isDate(txtDate)
    {
        var currVal = txtDate;
        //  var rxDatePattern = /^(\d{4})(\/|-)(\d{1,2})(\/|-)(\d{1,2})$/; //Declare Regex
        var rxDatePattern = /^(\d{4})(-)(\d{2})(-)(\d{2})$/; //Declare Regex
        var dtArray = currVal.match(rxDatePattern); // is format OK?

        if (dtArray == null)
            return false;
        //Checks for mm/dd/yyyy format.
        dtMonth = dtArray[3];
        dtDay = dtArray[5];
        dtYear = dtArray[1];
        if (dtMonth < 1 || dtMonth > 12)
            return false;
        else if (dtDay < 1 || dtDay > 31)
            return false;
        else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)
            return false;
        else if (dtMonth == 2)
        {
            var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
            if (dtDay > 29 || (dtDay == 29 && !isleap))
                return false;
        }
        return true;
    }

/*******************  fonction qui genere un contenu html (bilan-premier-cours ***************************/
       function popup_generer_mes(data) {
                objet_bilan_premier_cours = data.bilan_premier_cours;
                var table = '<table class="table table-striped table-hover ">';
                table += '<tr>';
                table += '<th>&Eacute;l&egrave;ve</th><td>' + objet_bilan_premier_cours.eleve + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Date</th><td>' + objet_bilan_premier_cours.date_bilan + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Rythme cours</th><td>' + objet_bilan_premier_cours.rythme_cours + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Dernier note de controle</th><td>' + objet_bilan_premier_cours.dernier_note + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Les notions travaillées</th><td>' + objet_bilan_premier_cours.notions_travaille + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Les points forts</th><td>' + objet_bilan_premier_cours.points_forts + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Les points faibles</th><td>' + objet_bilan_premier_cours.points_faibles + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Les objectifs fixés</th><td>' + objet_bilan_premier_cours.objectifs_fixe + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Le plan de progression</th><td>' + objet_bilan_premier_cours.plan_progression + '</td>';
                table += '</tr>';
                table += '</table>';
                return table;
            }
  /*******************  fonction qui genere un contenu html (mes comptes-rendus) ***************************/  
              function popup_generer_mes(data) {
                objet_compte_rendu = data.compte_rendu;
                var table = '<table class="table table-striped table-hover ">';
                table += '<tr>';
                table += '<th>&Eacute;l&egrave;ve</th><td>' + objet_compte_rendu.eleve + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Date</th><td>' + objet_compte_rendu.date_cours + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Heure</th><td>' + objet_compte_rendu.heure_cours + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>E-coupon</th><td>' + objet_compte_rendu.e_coupon + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Progression-cours</th><td>' + objet_compte_rendu.progression_cours + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Compte-rendu</th><td>' + objet_compte_rendu.resume_cours + '</td>';
                table += '</tr>';
                table += '</table>';
                return table;
            }
  /*******************  fonction qui genere un contenu html (autres comptes-rendus ***************************/
   function generer_popup_autre(data) {
                objet_compte_rendu = data.compte_rendu;
                var table = '<table class="table table-striped table-hover ">';
                table += '<tr>';
                table += '<th>El�ve</th><td>' + objet_compte_rendu.eleve + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Date</th><td>' + objet_compte_rendu.date_cours + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Progression </th><td>' + objet_compte_rendu.progression_cours + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Compte-rendu </th><td>' + objet_compte_rendu.resume_cours + '</td>';
                table += '</tr>';
                table += '</table>';
                return table;
   }
   /*********************************************************/
(function($, window, document){

  if (typeof $ === 'undefined') { throw new Error('This application\'s JavaScript requires jQuery'); }

  $(window).load(function() {

    $('.scroll-content').slimScroll({
        height: '250px'
    });

  });
}(jQuery, window, document));


/**=========================================================
 * Module: dropdown-animate.js
 * Animated transition for dropdown open state
 * Animation name placed in [data-play="animationName"]  (http://daneden.github.io/animate.css/)
 * Optionally add [data-duration=seconds]
 * 
 * Requires animo.js
 =========================================================*/

(function($, window, document){

  $(function() {
    var Selector = '.dropdown-toggle[data-play]',
        parent = $(Selector).parent(); /* From BS-Doc: All dropdown events are fired at the .dropdown-menu's parent element. */

    parent.on('show.bs.dropdown', function (e) {
      //e.preventDefault();

      var $this     = $(this),
          toggle    = $this.children('.dropdown-toggle'),
          animation = toggle.data('play'),
          duration  = toggle.data('duration') || 0.5,
          target    = $this.children('.dropdown-menu');

      if(!target || !target.length)
        $.error('No target for play-animation');
      else
        if( $.fn.animo && animation)
          target.animo( { animation: animation,  duration: duration} );

    });
  
  });

}(jQuery, window, document));