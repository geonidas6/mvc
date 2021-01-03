<?php
require_once "head.php";
$content  =   '<body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post">
              <h1>Formulaire de connexion</h1>
              <div>
                <input type="email" class="form-control" placeholder="email" name="data[email]" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="data[password]"  required="" />
              </div>
              <div>
                <button class="btn btn-primary submit" type="submit">Log in</button>
                <a class="btn btn-warning reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Créer un compte </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> '.\App\Config::APP_NAME.'</h1>
                  <p>'.\App\Config::COPIWRIT.'</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="post" action="?cl=user&mt=addaction">
              <h1>Créer un compte</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="data[username]" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" name="data[email]" required="" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="nom complet" name="data[nomcomplet]" required="" />
              </div>
              <div>
                <input type="tel" class="form-control" placeholder="telephone" name="data[tel]" required="" />
              </div>
              <div>
              <select class="form-control" name="data[role]">
                <option value="1" seleted>Enseignant</option>
                <option value="2">Technicien</option>
              
              </select>
              </div>
              <br/>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="data[password]" required="" />
              </div>
               <div>
                <input type="password" class="form-control" placeholder="Confirm Password" name="data[password_cnf]" required="" />
              </div>
              <div>
                <button class="btn btn-primary submit" type="submit">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i>'.\App\Config::APP_NAME.'</h1>
                  <p>'.\App\Config::COPIWRIT.'</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
';
echo $content;

require_once "footer.php";

unset($_SESSION['message']);