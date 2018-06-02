<?php if (isset($msg)) echo $msg; ?>
<?php if ( !isset($evento) && isset($_SESSION['Consultor'])) { ?>

<div class="container-fluid">
	<div class="row">
	
		<div class="col-md-2"></div>
		<div class="col-md-8">
		

				
				

			
					<nav class="navbar navbar-inverse">
					  <div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span> 
							</button>
							<a class="navbar-brand" href="<?php echo base_url() . 'consultor/prontuario/' . $_SESSION['Consultor']['idApp_Consultor']; ?>">
								<?php echo '<small>' . $_SESSION['Consultor']['NomeConsultor'] . '</small> - <small>' . $_SESSION['Consultor']['idApp_Consultor'] . '</small>' ?> 
							</a>
						</div>
						<div class="collapse navbar-collapse" id="myNavbar">

							<ul class="nav navbar-nav navbar-center">
								<li>
									<a href="<?php echo base_url() . 'consultor/alterar/' . $_SESSION['Consultor']['idApp_Consultor']; ?>">
										<span class="glyphicon glyphicon-edit"></span> Edit. Consultor
									</a>
								</li>
								<li>
									<a href="<?php echo base_url() . 'orcatrata/listar/' . $_SESSION['Consultor']['idApp_Consultor']; ?>">
										<span class="glyphicon glyphicon-usd"></span> Listar Orçams.
									</a>
								</li>
								<li>
									<a href="<?php echo base_url() . 'orcatrata/cadastrar/' . $_SESSION['Consultor']['idApp_Consultor']; ?>">
										<span class="glyphicon glyphicon-plus"></span> Cad. Orçam.
									</a>
								</li>
							</ul>

						</div>
					  </div>
					</nav>

					<?php } ?>
					
					<div class="row">
						<div class="col-md-12 col-lg-12">	
							
							<?php echo validation_errors(); ?>

							<div class="panel panel-<?php echo $panel; ?>">

								<div class="panel-heading"><strong>Consultor</strong></div>
								<div class="panel-body">
									<div class="form-group">
										<div class="panel panel-info">
											<div class="panel-heading">
											
												<?php echo form_open_multipart($form_open_path); ?>

												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label for="NomeConsultor">Nome do Consultor:</label>
															<input type="text" class="form-control" id="NomeConsultor" maxlength="45" 
																	name="NomeConsultor" autofocus value="<?php echo $query['NomeConsultor']; ?>">
														</div>																		
														<div class="col-md-3">
															<label for="Celular">Tel.- Fixo ou Celular*</label>
															<input type="text" class="form-control Celular CelularVariavel" id="Celular" maxlength="11" <?php echo $readonly; ?>
																   name="Celular" placeholder="(XX)999999999" value="<?php echo $query['Celular']; ?>">
														</div>
														<div class="col-md-3">
															<label for="DataNascimento">Data de Nascimento:</label>
															<input type="text" class="form-control Date" maxlength="10" <?php echo $readonly; ?>
																   name="DataNascimento" placeholder="DD/MM/AAAA" value="<?php echo $query['DataNascimento']; ?>">
														</div>						
														<div class="col-md-3">
															<label for="Sexo">Sexo:</label>
															<select data-placeholder="Selecione uma opção..." class="form-control" <?php echo $readonly; ?>
																	id="Sexo" name="Sexo">
																<option value="">--Selec. o Sexo--</option>
																<?php
																foreach ($select['Sexo'] as $key => $row) {
																	if ($query['Sexo'] == $key) {
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
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label for="Email">E-mail:</label>
															<input type="text" class="form-control" id="Bairro" maxlength="100" <?php echo $readonly; ?>
																   name="Email" value="<?php echo $query['Email']; ?>">
														</div>
														<!--
														<div class="col-md-3">
															<label for="Usuario">Usuário:</label>
															<input type="text" class="form-control" id="Usuario" maxlength="45" 
																   autofocus name="Usuario" value="<?php echo $query['Usuario']; ?>">
															<?php echo form_error('Usuario'); ?>
														</div>						
														<div class="col-md-3">
															<label for="Senha">Senha:</label>
															<input type="password" class="form-control" id="Senha" maxlength="45"
																   name="Senha" value="<?php echo $query['Senha']; ?>">
															<?php echo form_error('Senha'); ?>
														</div>
														<div class="col-md-3">
															<label for="Senha">Confirmar Senha:</label>
															<input type="password" class="form-control" id="Confirma" maxlength="45"
																   name="Confirma" value="<?php echo $query['Confirma']; ?>">
															<?php echo form_error('Confirma'); ?>
														</div>
														-->
													</div>
												</div>
												<!--
												<div class="form-group">
													<div class="row">
														
														<div class="col-md-6">
															<label for="Permissao">Nível / Permissão:*</label>
															<select data-placeholder="Selecione uma opção..." class="form-control" <?php echo $readonly; ?>
																	id="Permissao" name="Permissao">
																<option value="">-- Selecione uma Permissao --</option>
																<?php
																foreach ($select['Permissao'] as $key => $row) {
																	if ($query['Permissao'] == $key) {
																		echo '<option value="' . $key . '" selected="selected">' . $row . '</option>';
																	} else {
																		echo '<option value="' . $key . '">' . $row . '</option>';
																	}
																}
																?>   
															</select>          
														</div>
														
														<div class="col-md-6">
															<label for="Funcao">Funcao:*</label>
															<a class="btn btn-xs btn-info" href="<?php echo base_url() ?>funcao/cadastrar/funcao" role="button"> 
																<span class="glyphicon glyphicon-plus"></span> <b>Nova Funcao</b>
															</a>
															<select data-placeholder="Selecione uma opção..." class="form-control" <?php echo $readonly; ?>
																	id="Funcao" name="Funcao">
																<option value="">-- Selecione uma Funcao --</option>
																<?php
																foreach ($select['Funcao'] as $key => $row) {
																	if ($query['Funcao'] == $key) {
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
												-->
												<br>
												<div class="form-group">
													<div class="row">
														<div class="col-md-12 text-center">
															<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#DadosComplementares" aria-expanded="false" aria-controls="DadosComplementares">
																<span class="glyphicon glyphicon-menu-down"></span> Completar Dados
															</button>
														</div>
													</div>
												</div>

												<div <?php echo $collapse; ?> id="DadosComplementares">

													<div class="form-group">
														<div class="row">
															<div class="col-md-3">
																<label for="Cpf">CPF:</label>
																<input type="text" class="form-control" maxlength="11" <?php echo $readonly; ?>
																	   name="Cpf" value="<?php echo $query['Cpf']; ?>">
															</div>
															<div class="col-md-3">
																<label for="Telefone2">Tel.2 - Fixo ou Celular:</label>
																<input type="text" class="form-control Celular CelularVariavel" id="Telefone2" maxlength="11" <?php echo $readonly; ?>
																	   name="Telefone2" placeholder="(XX)999999999" value="<?php echo $query['Telefone2']; ?>">
															</div>
															<div class="col-md-3">
																<label for="Telefone3">Tel.3 - Fixo ou Celular:</label>
																<input type="text" class="form-control Celular CelularVariavel" id="Telefone3" maxlength="11" <?php echo $readonly; ?>
																	   name="Telefone3" placeholder="(XX)999999999" value="<?php echo $query['Telefone3']; ?>">
															</div>																			
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-3">
																<label for="Rg">RG:</label>
																<input type="text" class="form-control" maxlength="9" <?php echo $readonly; ?>
																	   name="Rg" value="<?php echo $query['Rg']; ?>">
															</div>
															<div class="col-md-3">
																<label for="OrgaoExp">Orgão Exp.:</label>
																<input type="text" class="form-control" maxlength="45" <?php echo $readonly; ?>
																	   name="OrgaoExp" value="<?php echo $query['OrgaoExp']; ?>">
															</div>
															<div class="col-md-3">
																<label for="EstadoExp">Estado Emissor:</label>
																<input type="text" class="form-control" maxlength="2" <?php echo $readonly; ?>
																	   name="EstadoExp" value="<?php echo $query['EstadoExp']; ?>">
															</div>
															<div class="col-md-3">
																<label for="DataExp">Data de Emissão:</label>
																<input type="text" class="form-control Date" maxlength="10" <?php echo $readonly; ?>
																	   name="DataExp" placeholder="DD/MM/AAAA" value="<?php echo $query['DataExp']; ?>">
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-3">
																<label for="Endereco">Endreço:</label>
																<input type="text" class="form-control" id="Endereco" maxlength="100" <?php echo $readonly; ?>
																	   name="Endereco" value="<?php echo $query['Endereco']; ?>">
															</div>
															<div class="col-md-3">
																<label for="Bairro">Bairro:</label>
																<input type="text" class="form-control" id="Bairro" maxlength="100" <?php echo $readonly; ?>
																	   name="Bairro" value="<?php echo $query['Bairro']; ?>">
															</div>
															<div class="col-md-3">
																<label for="Municipio">Municipio:</label>
																<input type="text" class="form-control" maxlength="100" <?php echo $readonly; ?>
																	   name="Municipio" value="<?php echo $query['Municipio']; ?>">
															</div>												
															<div class="col-md-1">
																<label for="Estado">Estado:</label>
																<input type="text" class="form-control" id="Estado" maxlength="2" <?php echo $readonly; ?>
																	   name="Estado" value="<?php echo $query['Estado']; ?>">
															</div>
															<div class="col-md-2">
																<label for="Cep">Cep:</label>
																<input type="text" class="form-control" id="Cep" maxlength="8" <?php echo $readonly; ?>
																	   name="Cep" value="<?php echo $query['Cep']; ?>">
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">											
															<div class="col-md-6">
																<label for="Obs">OBS:</label>
																<textarea class="form-control" id="Obs" <?php echo $readonly; ?>
																		  name="Obs"><?php echo $query['Obs']; ?></textarea>
															</div>
															<div class="col-md-2">
																<label for="Inativo">Ativo?</label><br>
																<div class="form-group">
																	<div class="btn-group" data-toggle="buttons">
																		<?php
																		foreach ($select['Inativo'] as $key => $row) {
																			(!$query['Inativo']) ? $query['Inativo'] = '0' : FALSE;

																			if ($query['Inativo'] == $key) {
																				echo ''
																				. '<label class="btn btn-warning active" name="radiobutton_Inativo" id="radiobutton_Inativo' . $key . '">'
																				. '<input type="radio" name="Inativo" id="radiobutton" '
																				. 'autocomplete="off" value="' . $key . '" checked>' . $row
																				. '</label>'
																				;
																			} else {
																				echo ''
																				. '<label class="btn btn-default" name="radiobutton_Inativo" id="radiobutton_Inativo' . $key . '">'
																				. '<input type="radio" name="Inativo" id="radiobutton" '
																				. 'autocomplete="off" value="' . $key . '" >' . $row
																				. '</label>'
																				;
																			}
																		}
																		?>
																	</div>
																</div>
															</div>
														</div>
													</div>										
												</div>

												<div class="form-group">
													<div class="row">
														<input type="hidden" name="idApp_Consultor" value="<?php echo $query['idApp_Consultor']; ?>">
														<?php if ($metodo == 2) { ?>

															<div class="col-md-6">
																<button class="btn btn-lg btn-primary" id="inputDb" data-loading-text="Aguarde..." type="submit">
																	<span class="glyphicon glyphicon-save"></span> Salvar
																</button>
															</div>
															<!--
															<div class="col-md-6 text-right">
																<button  type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-loading-text="Aguarde..." data-target=".bs-excluir-modal-sm">
																	<span class="glyphicon glyphicon-trash"></span> Excluir
																</button>
															</div>
															-->
															<div class="modal fade bs-excluir-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
																<div class="modal-dialog" role="document">
																	<div class="modal-content">
																		<div class="modal-header bg-danger">
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																			<h4 class="modal-title">Tem certeza que deseja excluir?</h4>
																		</div>
																		<div class="modal-body">
																			<p>Ao confirmar esta operação todos os dados serão excluídos permanentemente do sistema.
																				Esta operação é irreversível.</p>
																		</div>
																		<div class="modal-footer">
																			<div class="col-md-6 text-left">
																				<button type="button" class="btn btn-warning" data-dismiss="modal">
																					<span class="glyphicon glyphicon-ban-circle"></span> Cancelar
																				</button>
																			</div>
																			<div class="col-md-6 text-right">
																				<a class="btn btn-danger" href="<?php echo base_url() . 'consultor/excluir/' . $query['idApp_Consultor'] ?>" role="button">
																					<span class="glyphicon glyphicon-trash"></span> Confirmar Exclusão
																				</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>

														<?php } elseif ($metodo == 3) { ?>
															<div class="col-md-12 text-center">
																<button class="btn btn-lg btn-danger" id="inputDb" data-loading-text="Aguarde..." name="submit" value="1" type="submit">
																	<span class="glyphicon glyphicon-trash"></span> Excluir
																</button>
																<button class="btn btn-lg btn-warning" id="inputDb" onClick="history.go(-1);
																		return true;">
																	<span class="glyphicon glyphicon-ban-circle"></span> Cancelar
																</button>
															</div>
														<?php } else { ?>
															<div class="col-md-6">
																<button class="btn btn-lg btn-primary" id="inputDb" data-loading-text="Aguarde..." name="submit" value="1" type="submit">
																	<span class="glyphicon glyphicon-save"></span> Salvar
																</button>
															</div>
														<?php } ?>
													</div>
												</div>

												</form>
											</div>
										</div>
									</div>
								</div>
							</div>							
						</div>
					</div>

		
		</div>
		<div class="col-md-2"></div>
	</div>	
</div>
