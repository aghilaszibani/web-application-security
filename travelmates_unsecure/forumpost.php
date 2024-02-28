<?php 


include("include/session.php");

                if (isset($_POST['postsujet'])) {
                  ?>
                  <?php
                  $text = $_POST['text_sujet'];
                  $sujet = $_POST['sujet'];

                  $reqajout = "INSERT INTO forum (id_utilisateur, texte_discussion, sujet) VALUES ($id_session, '$text', '$sujet')";
                  mysqli_query($con,$reqajout);
                   if(!$reqajout){
                    die("QUERY FAILED".mysqli_error($con));
                }
                  header('Location:forum.php');
                }

                ?>