 <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="prezente.php" style="color: #34495e; float: left;"><img src="img/sigla.png" height="20"></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Delogare</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="prezente.php"><i class="fa fa-check fa-fw"></i> Prezente</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Rapoarte<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="istoric.php">Raport plati</a>
                                </li>
                                <li>
                                    <a href="lista_prezente.php">Raport prezente</a>
                                </li>
								                <li>
                                    <a href="raport_ajustari.php">Raport ajustari salariu</a>
                                </li>
                                <li>
                                    <a href="raport_general.php">Raport general</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="adauga_ajustare.php"><i class="fa fa-adjust fa-fw"></i> Ajustare salariu</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Persoane<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="adauga_persoana.php">Adauga persoana</a>
                                </li>
                                <li>
                                    <a href="lista_persoane.php">Listeaza persoane</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

						<li>
                            <a href="#"><i class="fa fa-legal fa-fw"></i> Utilizatori<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="adauga_utilizator.php">Adauga utilizator</a>
                                </li>
                                <li>
                                    <a href="lista_utilizatori.php">Listeaza utilizatori</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

						<!-- <li>
                            <a href="#"><i class="fa fa-money fa-fw"></i> Cashflow<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="cheltuieli.php">Cheltuieli</a>
                                </li>
                                <li>
                                    <a href="raport_cheltuieli.php">Incasari</a>
                                </li>
								<li>
                                    <a href="cf_setari.php">Setari</a>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                    <p class="version">Versiunea 1.3</p>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
