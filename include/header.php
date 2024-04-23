<header class="mb-3">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #222425">
        <div class="container p-2">
            <span class="navbar-brand text-danger h1">Student Manager</span>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="/CRUD/index.php" class="nav-link">Accueil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Élèves</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a href="/CRUD/eleves/liste.php" class="dropdown-item">Liste des élèves</a>
                            </li>
                            <li>
                                <a href="/CRUD/eleves/ajout.php" class="dropdown-item">Ajouter un élève</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Classes</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a href="/CRUD/classes/liste_classe.php" class="dropdown-item">Liste des classes</a>
                            </li>
                            <li>
                                <a href="/CRUD/classes/classe.php" class="dropdown-item">Ajouter une classe</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Diplomes</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a href="/CRUD/diplomes/liste_diplomes.php" class="dropdown-item">Liste des diplômes</a>
                            </li>
                            <li>
                                <a href="/CRUD/diplomes/diplome.php" class="dropdown-item">Ajouter un diplôme</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>