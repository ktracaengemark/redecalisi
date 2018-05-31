<nav class="navbar navbar-inverse navbar-fixed-top " role="banner">

		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="navbar-header ">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar1">
					<span class="sr-only">MENU</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
				<a href="<?php echo base_url(); ?>acessoempresamatriz/index" class="navbar-brand"> <?php echo $_SESSION['log']['NomeEmpresa2']; ?>/<?php echo $_SESSION['log']['Nome2']; ?></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar1">

				<ul class="nav navbar-nav navbar-center">
					<!--
					<li>
						<?php echo form_open(base_url() . 'funcionario/pesquisar', 'class="navbar-form navbar-left"'); ?>
						<div class="input-group">
							<span class="input-group-btn">
								<button class="btn btn-info" type="submit">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
							<input type="text" placeholder="Pesquisar Usuários" class="form-control" name="Pesquisa" value="">
						</div>
						</form>
					</li>
					-->
					<li class="btn-toolbar navbar-form navbar-left" role="toolbar" aria-label="...">
						<div class="btn-group">
							<button type="button" class="btn btn-md btn-success dropdown-toggle" data-toggle="dropdown">
								<span class="glyphicon glyphicon-pencil"></span> Cadastrar <span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo base_url() ?>relatorioempresa/funcionario"><span class="glyphicon glyphicon-user"></span> Funcionários </a></li>
								<li role="separator" class="divider"></li>
								<li><a href="<?php echo base_url() ?>relatorioempresa/empresafilial"><span class="glyphicon glyphicon-home"></span> Unidades/Filiais </a></li>
								<!--<li><a href="<?php echo base_url() ?>funcao/cadastrar"><span class="glyphicon glyphicon-pencil"></span> Cad Funçoes </a></li>
								<li role="separator" class="divider"></li>
								<li><a href="<?php echo base_url() ?>loginfuncionario/index"><span class="glyphicon glyphicon-log-in"></span> Acesso dos Func.</a></li>-->							
							</ul>
						</div>
						<div class="btn-group" role="group" aria-label="..."> </div>
					</li>
					<li class="btn-toolbar navbar-form navbar-left" role="toolbar" aria-label="...">
						<div class="btn-group">
							<button type="button" class="btn btn-md btn-warning dropdown-toggle" data-toggle="dropdown">
								<span class="glyphicon glyphicon-list"></span> Relatórios <span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo base_url() ?>relatorioempresa/balanco"><span class="glyphicon glyphicon-usd"></span> Balanço</a></li>
								<!--<li role="separator" class="divider"></li>
								<li><a href="<?php echo base_url() ?>relatorioempresa/orcamentoempresa"><span class="glyphicon glyphicon-list"></span> Rel.Orçam.</a></li>
								<li role="separator" class="divider"></li>								
								<li><a href="<?php echo base_url() ?>relatorio/estoque"><span class="glyphicon glyphicon-list"></span> Estoque</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="<?php echo base_url() ?>relatorio/rankingvendas"><span class="glyphicon glyphicon-list"></span> RankigVendas</a></li>
								<li role="separator" class="divider"></li>-->
							</ul>
						</div>
						<div class="btn-group" role="group" aria-label="..."> </div>
					</li>
					<!--
					<li class="btn-toolbar navbar-form navbar-left" role="toolbar" aria-label="...">

						<div class="btn-group" role="group" aria-label="...">
							<a href="<?php echo base_url(); ?>login/index">
								<button type="button" class="btn btn-md btn-success ">
									<span class="glyphicon glyphicon-log-in"></span> Acesso dos Usuários
								</button>
							</a>
						</div>												

						<div class="btn-group" role="group" aria-label="..."> </div>
					</li>
					
					<li class="btn-toolbar navbar-form navbar-left" role="toolbar" aria-label="...">
						<div class="btn-group" role="group" aria-label="...">
							<a href="<?php echo base_url(); ?>relatorioempresa/sistemaempresa">
								<button type="button" class="btn btn-md panel-danger ">
									<span class="glyphicon glyphicon-cog"></span> Pagar Manutenção
								</button>
							</a>
						</div>
						<div class="btn-group" role="group" aria-label="..."> </div>
					</li>
					-->
					<li class="btn-toolbar navbar-form navbar-right" role="toolbar" aria-label="...">
						<div class="btn-group" role="group" aria-label="...">
							<a href="<?php echo base_url(); ?>loginempresamatriz/sair">
								<button type="button" class="btn btn-md btn-danger ">
									<span class="glyphicon glyphicon-log-out"></span> Sair
								</button>
							</a>
						</div>
						<div class="btn-group" role="group" aria-label="..."> </div>
					</li>
					
				</ul>

			</div>
		</div>
		<div class="col-md-2"></div>

</nav>
<br>
