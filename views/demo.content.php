<?php
	LazyLoadStyle ("libraries/BootstrapValidator-0.5.2/css/bootstrapValidator.min.css");
	LazyLoadScript("libraries/BootstrapValidator-0.5.2/js/bootstrapValidator.min.js");

	LazyLoadStyle ("libraries/Swagger-UI-3.23.8/swagger-ui.css");
	LazyLoadScript("libraries/Swagger-UI-3.23.8/swagger-ui-bundle.js");
	LazyLoadScript("libraries/Swagger-UI-3.23.8/swagger-ui-standalone-preset.js");

	LazyLoadScript("views/scripts/demo.sign.io.js");
	LazyLoadScript("views/scripts/demo.swagger.js");
?>

<div class="row padding-bottom padding-top">
	<div class="col-sm-12">
		<h1><center>DEMO</center></h1>

		<div id="md_signio" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<ul class="nav nav-tabs bg">
						<li class="active">
							<a data-toggle="tab" href="#tab_signin">
								<i class="fa fa-sign-in"></i>
								<span> Sign In</span>
							</a>
						</li>

						<li>
							<a data-toggle="tab" href="#tab_signout">
								<i class="fa fa-sign-out"></i>
								<span> Sign Out</span>
							</a>
						</li>
					</ul>

					<div class="tab-content bg">
						<div id="tab_signin" class="tab-pane fade in active">
							<div class="modal-body mb-1">
								<div id="msg_signin" class="alert alert-default display-none">
									<p></p>
								</div>

								<form id="frm_signin" role="form">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
											<input type="text" name="user_name" class="form-control" placeholder="User Name" required>
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
											<input type="text" name="user_pass" class="form-control" placeholder="User Password" required>
										</div>
									</div>

									<button type="submit" class="btn btn-primary btn-block">Sign In</button>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>

						<div id="tab_signout" class="tab-pane fade">
							<div class="modal-body mb-1">
								<div id="msg_signout" class="alert alert-default display-none">
									<p></p>
								</div>

								<form id="frm_signout" role="form">
									<button type="submit" class="btn btn-primary btn-block">Sign Out</button>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<center>
			<button
				type="button"
				id="btn_signio"
				class="btn btn-default"
				data-toggle="modal"
				data-target="#md_signio">
				Sign In / Sign Out
			</button>
		</center>
	</div>
</div>

<div class="row padding-bottom">
	<div class="col-sm-12">
		<div id="swagger-ui" style="background-color: white; padding-bottom: 1px; margin-bottom: 10px;"></div>
	</div>
</div>

<div class="row padding-bottom"></div><!-- padding for dynamic footer -->