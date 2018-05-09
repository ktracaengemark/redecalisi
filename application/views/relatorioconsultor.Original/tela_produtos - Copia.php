<?php if ($msg) echo $msg; ?>

<div class="container-fluid">
    <div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8 ">


				<?php echo validation_errors(); ?>

				<div class="panel panel-primary">

					<div class="panel-heading"><strong><?php echo $titulo; ?></strong></div>
					<div class="panel-body">

						<?php echo form_open('relatorioconsultor/produtos', 'role="form"'); ?>

						<div class="form-group">
							<div class="row">
								
								<div class="col-md-6">
									<label for="Ordenamento">Desccri��o</label>
									<select data-placeholder="Selecione uma op��o..." class="form-control Chosen"
											id="Produtos" name="Produtos">
										<?php
										foreach ($select['Produtos'] as $key => $row) {
											if ($query['Produtos'] == $key) {
												echo '<option value="' . $key . '" selected="selected">' . $row . '</option>';
											} else {
												echo '<option value="' . $key . '">' . $row . '</option>';
											}
										}
										?>
									</select>
								</div>							
								<!--
								<div class="col-md-2">
									<label for="Ordenamento">Respons�vel da Tarefa:</label>
									<select data-placeholder="Selecione uma op��o..." class="form-control Chosen"
											id="NomeProfissional" name="NomeProfissional">
										<?php
										foreach ($select['NomeProfissional'] as $key => $row) {
											if ($query['NomeProfissional'] == $key) {
												echo '<option value="' . $key . '" selected="selected">' . $row . '</option>';
											} else {
												echo '<option value="' . $key . '">' . $row . '</option>';
											}
										}
										?>
									</select>
								</div>
								

								
								<div class="col-md-2">
									<label for="Ordenamento">Profissional:</label>
									<select data-placeholder="Selecione uma op��o..." class="form-control Chosen"
											id="Profissional" name="Profissional">
										<?php
										foreach ($select['Profissional'] as $key => $row) {
											if ($query['Profissional'] == $key) {
												echo '<option value="' . $key . '" selected="selected">' . $row . '</option>';
											} else {
												echo '<option value="' . $key . '">' . $row . '</option>';
											}
										}
										?>
									</select>
								</div>
								-->
								<div class="col-md-6">
									<label for="Ordenamento">Ordenamento:</label>

									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<select data-placeholder="Selecione uma op��o..." class="form-control Chosen"
														id="Campo" name="Campo">
													<?php
													foreach ($select['Campo'] as $key => $row) {
														if ($query['Campo'] == $key) {
															echo '<option value="' . $key . '" selected="selected">' . $row . '</option>';
														} else {
															echo '<option value="' . $key . '">' . $row . '</option>';
														}
													}
													?>
												</select>
											</div>

											<div class="col-md-4">
												<select data-placeholder="Selecione uma op��o..." class="form-control Chosen"
														id="Ordenamento" name="Ordenamento">
													<?php
													foreach ($select['Ordenamento'] as $key => $row) {
														if ($query['Ordenamento'] == $key) {
															echo '<option value="' . $key . '" selected="selected">' . $row . '</option>';
														} else {
															echo '<option value="' . $key . '">' . $row . '</option>';
														}
													}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>
						<div class="form-group">
							<div class="row">		
								<div class="col-md-2"></div>
								<div class="col-md-8 ">									
									<div class="col-md-6 text-left">
										<button class="btn btn-lg btn-primary " name="pesquisar" value="0" type="submit">
											<span class="glyphicon glyphicon-search"></span> Pesquisar
										</button>
									</div>
									<div class="col-md-6 text-right">											
											<a class="btn btn-lg btn-danger" href="<?php echo base_url() ?>produtos/cadastrar" role="button"> 
												<span class="glyphicon glyphicon-plus"></span> Novo Produto ou Servi�o
											</a>
									</div>
								</div>
								<div class="col-md-2"></div>
							</div>						
						</div>
						</form>
						<br>
						<?php echo (isset($list)) ? $list : FALSE ?>
					</div>
				</div>

		</div>	
		<div class="col-md-2"></div>			
    </div>
</div>
