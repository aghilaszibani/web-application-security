
<!--
=========================================================
 Paper Kit 2 - v2.2.0
=========================================================

 Product Page: https://www.creative-tim.com/product/paper-kit-2
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/paper-kit-2/blob/master/LICENSE.md)

 Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->


<?php 

include("include/session.php");

if (isset($_SESSION['user'])) {
    header('Location:index.php');
}



    if (isset($_POST['inscrire'])){

        $email = $_POST['email'];
        $pseudo = $_POST['pseudo'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mot_de_passe = $_POST['mot_de_passe'];
        $mot_de_passe2 = $_POST['mot_de_passe2'];
        $date_naissance = $_POST['date_naissance'];
        $num_tel = $_POST['num_tel'];
        $sexe = $_POST['sexe'];
        $pays = $_POST['pays'];
        $role = "user";
        $ville = $_POST['ville'];
        $zip = $_POST['zip'];
        $adress = $_POST['adress'];


        $imgprofil =$_FILES['img_profil']['name'];
        $target = 'uploads/profil/' . $imgprofil;
        $extension_fichier = strtolower(pathinfo($imgprofil, PATHINFO_EXTENSION));
        $extensions_autorisees = array("jpg", "jpeg", "png", "gif");
        if (in_array($extension_fichier, $extensions_autorisees)) {
        move_uploaded_file($_FILES['img_profil']['tmp_name'], $target);
        }

        else{
            die('Type de fichier invalide (jpg, png, gif, jpeg');
        }

    //  $mot_de_passe = hash('sha512', $mot_de_passe);
    //  $mot_de_passe2 = hash('sha512', $mot_de_passe2);

        $error = '';

        function validatePassword($password) {
            // Longueur minimale du mot de passe
            $minLength = 8;

            // Vérifier la longueur minimale
            if (strlen($password) < $minLength) {
                return false;
            }

            // Vérifier la présence de chiffres
            if (!preg_match('/[0-9]/', $password)) {
                return false;
            }

            // Vérifier la présence de lettres majuscules
            if (!preg_match('/[A-Z]/', $password)) {
                return false;
            }

            // Vérifier la présence de lettres minuscules
            if (!preg_match('/[a-z]/', $password)) {
                return false;
            }

            // Vérifier la présence de caractères spéciaux
            //if (!preg_match('/[\W]/', $password)) {
            //    return false;
            //}

            // Le mot de passe satisfait toutes les conditions
            return true;
        }

        if (!validatePassword($mot_de_passe)){

            $error .= 'Mot de passe pas assez complexe';
        }else{
            try{
                $conexion = new PDO('mysql:host=localhost;dbname=projetgl', 'root', '');
            }catch(PDOException $prueba_error){
                echo "Error: " . $prueba_error->getMessage();
            }

            $statement = $conexion->prepare('SELECT id_utilisateur, nom, prenom, email, mot_de_passe,  pays, date_naissance, num_tel, sexe, pseudo, zip, ville, adress, img_profil FROM utilisateur WHERE pseudo = :pseudo LIMIT 1');
            $statement->execute(array(':pseudo' => $pseudo));
            $resultado = $statement->fetch();


            if ($resultado != false){
                $error .= '<i>Cet utilisateur existe déjà</i>';
            }


            if ($mot_de_passe != $mot_de_passe2){
                $error .= '<i> Les mots de passe ne correspondent pas</i>';
            }


        }

        if ($error == ''){
            $hashedPassword = sha1($mot_de_passe);
            $statement = $conexion->prepare('INSERT INTO utilisateur (id_utilisateur, nom, prenom, email, mot_de_passe, num_tel, pays, date_naissance, sexe, role, pseudo, zip, ville, adress, img_profil)
                                                                  VALUES (null, :nom, :prenom, :email, :mot_de_passe, :num_tel, :pays, :date_naissance, :sexe, :role, :pseudo, :zip, :ville, :adress, :img_profil)');
            $statement->execute(array(
                  ':nom' => $nom,
                  ':prenom' => $prenom,
                  ':email' => $email,
                  ':mot_de_passe' => $hashedPassword,
                  ':pays' => $pays,
                  ':num_tel' => $num_tel,
                  ':role' => $role,
                  ':date_naissance' => $date_naissance,
                  ':sexe' => $sexe,
                  ':pseudo' => $pseudo,
                  ':zip' => $zip,
                  ':ville' => $ville,
                  ':adress' => $adress,
                  ':img_profil' => $imgprofil
            ));

            $error .= '<i style="color: green;">Utilisateur enregistré avec succès</i>';
            $_SESSION['user']=$_POST['pseudo'];
              header("location:index.php");
        }

    }


?>

  <!-- Navbar -->
  <?php 
  include ("include/header.php");?>

  <!-- End Navbar -->
  <!-- <div class="page-header" style="background-image: url('../assets/img/login-image.jpg');">

    <div class="container">
        <div class="row">

















        <div class="page-header" style="background-image: url('../assets/img/login-image.jpg');">
            <div class="filter"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 ml-auto mr-auto">
                            <div class="card card-register">
                                <h3 class="title mx-auto">Welcome</h3>
								<div class="social-line text-center">
                                    <a href="#pablo" class="btn btn-neutral btn-facebook btn-just-icon">
                                        <i class="fa fa-facebook-square"></i>
                                    </a>
                                    <a href="#pablo" class="btn btn-neutral btn-google btn-just-icon">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
									<a href="#pablo" class="btn btn-neutral btn-twitter btn-just-icon">
										<i class="fa fa-twitter"></i>
									</a>
                                </div>
                                <form class="register-form">
                                    <label>Email</label>
                                    <input type="text" class="form-control" placeholder="Email">

                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password">
                                    <button class="btn btn-danger btn-block btn-round">Register</button>
                                </form>
                                <div class="forgot">
                                    <a href="#" class="btn btn-link btn-danger">Forgot password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer register-footer text-center">
						<h6>© <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by Creative Tim</h6>
					</div>
        </div>

        </div>
    </div>
</div> -->
<div class="page-header" style="background-image: url('assets/img/login-image.jpg');">

  <div class=" py-3 ">


        <style type="text/css">
            .down{
                margin-top: 100px;
            }
        </style>
      <div class="row container py-3 down">
          <div class="col-md-12 mx-auto  ">
                  <div class="card card-body" style="background-color: #FF8F5E;">

                  <form method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Email</label>
              <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email">
            </div>
            <div class="form-group col-md-6">
              <label for="inputText4">Pseudo</label>
              <input type="text" class="form-control" name="pseudo"id="inputText4" placeholder="Pseudo" name="pseudo">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputText5">Nom</label>
              <input type="text" class="form-control" id="inputText5" placeholder="Nom" name="nom">
            </div>
            <div class="form-group col-md-6">
              <label for="inputText6">Prenom</label>
              <input type="text" class="form-control" id="inputText6" placeholder="Prenom" name="prenom">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputPassword4">Mot de passe</label>
              <input type="password" class="form-control"id="inputPassword4" placeholder="Mot de passe" name="mot_de_passe">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword5">Confirmer mot de passe</label>
              <input type="password" class="form-control"   name="mot_de_passe2" placeholder="Confirmer mot de passe" >
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputDate4">Date de naissance</label>
              <input type="date" class="form-control" id="inputDate4" placeholder="" name="date_naissance">
            </div>
            <div class="form-group col-md-4">
              <label for="inputDate4">Numero de telephone</label>
              <input type="text" class="form-control" id="inputNum4" placeholder="" name="num_tel">
            </div>  
            <div class="form-group col-md-4">
              <label for="inputSexe">Sexe</label>
              <select  class="form-control" name="sexe">
                <option selected>Sexe</option>
                <option>Homme</option>
                <option>Femme</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputState">Pays</label>
              <select id="inputState" class="form-control" name="pays">
                <option selected>Pays</option>
                <option value="Afganistan">Afghanistan</option>
        <option value="Albania">Albania</option>
        <option value="Algeria" selected>Algeria</option>
        <option value="American Samoa">American Samoa</option>
        <option value="Andorra">Andorra</option>
        <option value="Angola">Angola</option>
        <option value="Anguilla">Anguilla</option>
        <option value="Antigua & Barbuda">Antigua & Barbuda</option>
        <option value="Argentina">Argentina</option>
        <option value="Armenia">Armenia</option>
        <option value="Aruba">Aruba</option>
        <option value="Australia">Australia</option>
        <option value="Austria">Austria</option>
        <option value="Azerbaijan">Azerbaijan</option>
        <option value="Bahamas">Bahamas</option>
        <option value="Bahrain">Bahrain</option>
        <option value="Bangladesh">Bangladesh</option>
        <option value="Barbados">Barbados</option>
        <option value="Belarus">Belarus</option>
        <option value="Belgium">Belgium</option>
        <option value="Belize">Belize</option>
        <option value="Benin">Benin</option>
        <option value="Bermuda">Bermuda</option>
        <option value="Bhutan">Bhutan</option>
        <option value="Bolivia">Bolivia</option>
        <option value="Bonaire">Bonaire</option>
        <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
        <option value="Botswana">Botswana</option>
        <option value="Brazil">Brazil</option>
        <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
        <option value="Brunei">Brunei</option>
        <option value="Bulgaria">Bulgaria</option>
        <option value="Burkina Faso">Burkina Faso</option>
        <option value="Burundi">Burundi</option>
        <option value="Cambodia">Cambodia</option>
        <option value="Cameroon">Cameroon</option>
        <option value="Canada">Canada</option>
        <option value="Canary Islands">Canary Islands</option>
        <option value="Cape Verde">Cape Verde</option>
        <option value="Cayman Islands">Cayman Islands</option>
        <option value="Central African Republic">Central African Republic</option>
        <option value="Chad">Chad</option>
        <option value="Channel Islands">Channel Islands</option>
        <option value="Chile">Chile</option>
        <option value="China">China</option>
        <option value="Christmas Island">Christmas Island</option>
        <option value="Cocos Island">Cocos Island</option>
        <option value="Colombia">Colombia</option>
        <option value="Comoros">Comoros</option>
        <option value="Congo">Congo</option>
        <option value="Cook Islands">Cook Islands</option>
        <option value="Costa Rica">Costa Rica</option>
        <option value="Cote DIvoire">Cote DIvoire</option>
        <option value="Croatia">Croatia</option>
        <option value="Cuba">Cuba</option>
        <option value="Curaco">Curacao</option>
        <option value="Cyprus">Cyprus</option>
        <option value="Czech Republic">Czech Republic</option>
        <option value="Denmark">Denmark</option>
        <option value="Djibouti">Djibouti</option>
        <option value="Dominica">Dominica</option>
        <option value="Dominican Republic">Dominican Republic</option>
        <option value="East Timor">East Timor</option>
        <option value="Ecuador">Ecuador</option>
        <option value="Egypt">Egypt</option>
        <option value="El Salvador">El Salvador</option>
        <option value="Equatorial Guinea">Equatorial Guinea</option>
        <option value="Eritrea">Eritrea</option>
        <option value="Estonia">Estonia</option>
        <option value="Ethiopia">Ethiopia</option>
        <option value="Falkland Islands">Falkland Islands</option>
        <option value="Faroe Islands">Faroe Islands</option>
        <option value="Fiji">Fiji</option>
        <option value="Finland">Finland</option>
        <option value="France">France</option>
        <option value="French Guiana">French Guiana</option>
        <option value="French Polynesia">French Polynesia</option>
        <option value="French Southern Ter">French Southern Ter</option>
        <option value="Gabon">Gabon</option>
        <option value="Gambia">Gambia</option>
        <option value="Georgia">Georgia</option>
        <option value="Germany">Germany</option>
        <option value="Ghana">Ghana</option>
        <option value="Gibraltar">Gibraltar</option>
        <option value="Great Britain">Great Britain</option>
        <option value="Greece">Greece</option>
        <option value="Greenland">Greenland</option>
        <option value="Grenada">Grenada</option>
        <option value="Guadeloupe">Guadeloupe</option>
        <option value="Guam">Guam</option>
        <option value="Guatemala">Guatemala</option>
        <option value="Guinea">Guinea</option>
        <option value="Guyana">Guyana</option>
        <option value="Haiti">Haiti</option>
        <option value="Hawaii">Hawaii</option>
        <option value="Honduras">Honduras</option>
        <option value="Hong Kong">Hong Kong</option>
        <option value="Hungary">Hungary</option>
        <option value="Iceland">Iceland</option>
        <option value="Indonesia">Indonesia</option>
        <option value="India">India</option>
        <option value="Iran">Iran</option>
        <option value="Iraq">Iraq</option>
        <option value="Ireland">Ireland</option>
        <option value="Isle of Man">Isle of Man</option>
        <option value="Israel">Israel</option>
        <option value="Italy">Italy</option>
        <option value="Jamaica">Jamaica</option>
        <option value="Japan">Japan</option>
        <option value="Jordan">Jordan</option>
        <option value="Kazakhstan">Kazakhstan</option>
        <option value="Kenya">Kenya</option>
        <option value="Kiribati">Kiribati</option>
        <option value="Korea North">Korea North</option>
        <option value="Korea Sout">Korea South</option>
        <option value="Kuwait">Kuwait</option>
        <option value="Kyrgyzstan">Kyrgyzstan</option>
        <option value="Laos">Laos</option>
        <option value="Latvia">Latvia</option>
        <option value="Lebanon">Lebanon</option>
        <option value="Lesotho">Lesotho</option>
        <option value="Liberia">Liberia</option>
        <option value="Libya">Libya</option>
        <option value="Liechtenstein">Liechtenstein</option>
        <option value="Lithuania">Lithuania</option>
        <option value="Luxembourg">Luxembourg</option>
        <option value="Macau">Macau</option>
        <option value="Macedonia">Macedonia</option>
        <option value="Madagascar">Madagascar</option>
        <option value="Malaysia">Malaysia</option>
        <option value="Malawi">Malawi</option>
        <option value="Maldives">Maldives</option>
        <option value="Mali">Mali</option>
        <option value="Malta">Malta</option>
        <option value="Marshall Islands">Marshall Islands</option>
        <option value="Martinique">Martinique</option>
        <option value="Mauritania">Mauritania</option>
        <option value="Mauritius">Mauritius</option>
        <option value="Mayotte">Mayotte</option>
        <option value="Mexico">Mexico</option>
        <option value="Midway Islands">Midway Islands</option>
        <option value="Moldova">Moldova</option>
        <option value="Monaco">Monaco</option>
        <option value="Mongolia">Mongolia</option>
        <option value="Montserrat">Montserrat</option>
        <option value="Morocco">Morocco</option>
        <option value="Mozambique">Mozambique</option>
        <option value="Myanmar">Myanmar</option>
        <option value="Nambia">Nambia</option>
        <option value="Nauru">Nauru</option>
        <option value="Nepal">Nepal</option>
        <option value="Netherland Antilles">Netherland Antilles</option>
        <option value="Netherlands">Netherlands (Holland, Europe)</option>
        <option value="Nevis">Nevis</option>
        <option value="New Caledonia">New Caledonia</option>
        <option value="New Zealand">New Zealand</option>
        <option value="Nicaragua">Nicaragua</option>
        <option value="Niger">Niger</option>
        <option value="Nigeria">Nigeria</option>
        <option value="Niue">Niue</option>
        <option value="Norfolk Island">Norfolk Island</option>
        <option value="Norway">Norway</option>
        <option value="Oman">Oman</option>
        <option value="Pakistan">Pakistan</option>
        <option value="Palau Island">Palau Island</option>
        <option value="Palestine">Palestine</option>
        <option value="Panama">Panama</option>
        <option value="Papua New Guinea">Papua New Guinea</option>
        <option value="Paraguay">Paraguay</option>
        <option value="Peru">Peru</option>
        <option value="Phillipines">Philippines</option>
        <option value="Pitcairn Island">Pitcairn Island</option>
        <option value="Poland">Poland</option>
        <option value="Portugal">Portugal</option>
        <option value="Puerto Rico">Puerto Rico</option>
        <option value="Qatar">Qatar</option>
        <option value="Republic of Montenegro">Republic of Montenegro</option>
        <option value="Republic of Serbia">Republic of Serbia</option>
        <option value="Reunion">Reunion</option>
        <option value="Romania">Romania</option>
        <option value="Russia">Russia</option>
        <option value="Rwanda">Rwanda</option>
        <option value="St Barthelemy">St Barthelemy</option>
        <option value="St Eustatius">St Eustatius</option>
        <option value="St Helena">St Helena</option>
        <option value="St Kitts-Nevis">St Kitts-Nevis</option>
        <option value="St Lucia">St Lucia</option>
        <option value="St Maarten">St Maarten</option>
        <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
        <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
        <option value="Saipan">Saipan</option>
        <option value="Samoa">Samoa</option>
        <option value="Samoa American">Samoa American</option>
        <option value="San Marino">San Marino</option>
        <option value="Sao Tome & Principe">Sao Tome & Principe</option>
        <option value="Saudi Arabia">Saudi Arabia</option>
        <option value="Senegal">Senegal</option>
        <option value="Seychelles">Seychelles</option>
        <option value="Sierra Leone">Sierra Leone</option>
        <option value="Singapore">Singapore</option>
        <option value="Slovakia">Slovakia</option>
        <option value="Slovenia">Slovenia</option>
        <option value="Solomon Islands">Solomon Islands</option>
        <option value="Somalia">Somalia</option>
        <option value="South Africa">South Africa</option>
        <option value="Spain">Spain</option>
        <option value="Sri Lanka">Sri Lanka</option>
        <option value="Sudan">Sudan</option>
        <option value="Suriname">Suriname</option>
        <option value="Swaziland">Swaziland</option>
        <option value="Sweden">Sweden</option>
        <option value="Switzerland">Switzerland</option>
        <option value="Syria">Syria</option>
        <option value="Tahiti">Tahiti</option>
        <option value="Taiwan">Taiwan</option>
        <option value="Tajikistan">Tajikistan</option>
        <option value="Tanzania">Tanzania</option>
        <option value="Thailand">Thailand</option>
        <option value="Togo">Togo</option>
        <option value="Tokelau">Tokelau</option>
        <option value="Tonga">Tonga</option>
        <option value="Trinidad & Tobago">Trinidad & Tobago</option>
        <option value="Tunisia">Tunisia</option>
        <option value="Turkey">Turkey</option>
        <option value="Turkmenistan">Turkmenistan</option>
        <option value="Turks & Caicos Is">Turks & Caicos Is</option>
        <option value="Tuvalu">Tuvalu</option>
        <option value="Uganda">Uganda</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="Ukraine">Ukraine</option>
        <option value="United Arab Erimates">United Arab Emirates</option>
        <option value="United States of America">United States of America</option>
        <option value="Uraguay">Uruguay</option>
        <option value="Uzbekistan">Uzbekistan</option>
        <option value="Vanuatu">Vanuatu</option>
        <option value="Vatican City State">Vatican City State</option>
        <option value="Venezuela">Venezuela</option>
        <option value="Vietnam">Vietnam</option>
        <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
        <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
        <option value="Wake Island">Wake Island</option>
        <option value="Wallis & Futana Is">Wallis & Futana Is</option>
        <option value="Yemen">Yemen</option>
        <option value="Zaire">Zaire</option>
        <option value="Zambia">Zambia</option>
        <option value="Zimbabwe">Zimbabwe</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="inputCity">Ville</label>
              <input type="text" class="form-control" id="inputCity" name="ville">
            </div>
            <div class="form-group col-md-2">
              <label for="inputZip">Zip</label>
              <input type="text" class="form-control" id="inputZip" name="zip">
            </div>
          </div>

          <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="Votre adresse complete" name="adress">
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputFile4">Photo de profil</label>
              <input type="file" class="" name="img_profil">
            </div>
          </div>
        <button name="inscrire" type="submit" class="btn btn-danger btn-block btn-round">S'inscrire</button>

        <?php if(!empty($error)): ?>
        <div class="mensaje">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>
        </form>


                  </div>
          </div>
      </div>
  </div>



</form>
  </div>
<?php 
  include ("include/footer.php");?>

</body>

</html>

