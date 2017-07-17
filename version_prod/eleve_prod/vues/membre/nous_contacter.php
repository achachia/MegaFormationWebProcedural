
<div class="row">
    <div class="col-md-8">      
        <h2>Nous contacter</h2>
        <form class="form-horizontal" action="<?= url_espace_eleve; ?>/controleurs/membre/traitement_nous_contacter.php" method="POST">
   
                <div class="well well-sm">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="objet_message">
                                        Objet de votre message</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name" required="required" />
                                </div>
                                <div class="form-group">
                                    <label for="email">
                                        Email addresse</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                        </span>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email" required="required" /></div>
                                </div>
<!--                                <div class="form-group">
                                    <label for="subject">
                                        Subject</label>
                                    <select id="subject" name="subject" class="form-control" required="required">
                                        <option value="na" selected="">Choose One:</option>
                                        <option value="service">General Customer Service</option>
                                        <option value="suggestions">Suggestions</option>
                                        <option value="product">Product Support</option>
                                    </select>
                                </div>-->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message">
                                        Message</label>
                                    <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                              placeholder="Message"></textarea>
                                </div>
                            </div>                            
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                    Envoyer le message</button>
                            </div>
                        </div>

                </div>
        </form>
    </div>
</div>


