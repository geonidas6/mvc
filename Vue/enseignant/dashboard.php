<?php

require_once "header.php";
require_once "sidebar.php";
require_once "top.php";


$content =
    '<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Interface des réclamations</h3>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Formulaire <small>de demande  de reclamation</small></h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
								
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="?cl=enseignant&mt=addaction" method="post">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Passer une réclamation à propos de:<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control form-control-sm" name="data[objet]" id="objet">
                                                    <option value="Labo" seleted>Labo</option>
                                                    <option value="Salle">Salle</option>
                                                  
                                                 </select>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="contenue">Contenue <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
										        	<textarea name="data[contenue]" id="contenue" class="form-control form-control-sm"></textarea>
											</div>
										</div>
									
								
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												<button class="btn btn-primary" type="reset">Reset</button>
												<button type="submit" class="btn btn-success">Submit</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Liste <small>des demande  de reclamation envoyer</small></h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
								
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
								 <table id="datatable" class="table table-responsive-sm table-striped table-bordered table-dark" style="width:100%">
                                  <thead>
                                    <tr>
                                      <th  scope="col">ID</th>
                                      <th  scope="col">A propos de</th>
                                      <th  scope="col">Contenue</th>
                                      <th  scope="col">Status</th>
                                      <th  scope="col">Date</th>
                                    </tr>
                                  </thead>
            
            
                                  <tbody>';
foreach ($list_recl as $recl){
    if($recl['status'] == \App\Config::STATUS_TRAITEE){
        $tr_color = 'text-dark table-success';
    }else{
        $tr_color = 'text-dark table-light';
    }

    $content .=  '
                                 <tr scope="row"  class="'.$tr_color.'">
                                    <td>'.$recl['id'].'</td>
                                    <td>'.$recl['objet'].'</td>
                                    <td>'.$recl['contenue'].'</td>
                                    <td>'.$recl['status'].'</td>
                                    <td>'.$recl['datereclamation'].'</td>
                                 </tr>';
}


$content .=  '</tbody>
                                  <tfoot>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                  </tfoot>
                                </table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>';

echo $content;

require_once "footer.php";
unset($_SESSION['message']);