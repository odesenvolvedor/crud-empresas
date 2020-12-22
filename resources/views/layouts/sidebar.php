<!-- Sidebar  -->
<nav id="sidebar" class="active">
    <div class="sidebar-header">
        <h3 class="text-center">Cadastro de empresas</h3>
        <strong>CE</strong>
    </div>

    <ul class="list-unstyled components">
        <li class="<?= isset($route) && $route == 'lista' ? 'active' : '' ?>">
            <a href="<?=BASE_URL?>/empresa">
                <i class="fa fa-bank fa-2x"></i>
                <span>Lista de Empresas</span>
            </a>
        </li>
        <li class="<?= isset($route) && $route == 'manter' ? 'active' : '' ?>">
            <a href="<?=BASE_URL?>/empresa/adicionar">
            <i class="fa fa-plus fa-2x"></i>
                <span>Manter Empresa</span>
            </a>
        </li>
    </ul>
</nav>