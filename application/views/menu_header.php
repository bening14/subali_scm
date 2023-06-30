<div>
    <div class="container-fluid px-4 mt-3">
        <ul class="nav nav-pills">
            <li class="nav-item dropdown">
                <a class="nav-link <?= $menu == 'customer' ? 'active' : '' ?> dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">CUSTOMER</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= base_url('xyz') ?>">Chat Tokopedia & WA</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('xyz/customer') ?>">List Customer</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link <?= $menu == 'project' ? 'active' : '' ?> dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">PROJECT</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= base_url('prjt') ?>">List Project</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('prjt/kpi') ?>">Key Performance</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link <?= $menu == 'hr' ? 'active' : '' ?> dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">HR</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= base_url('hr') ?>">Karyawan</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('hr/absensi') ?>">Absensi</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('hr/overtime') ?>">Overtime</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('hr/payroll') ?>">Payroll</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">FINANCE</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= base_url('prjt/petty') ?>">Petty Cash</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('prjt/asset') ?>">Asset</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('prjt/ppn') ?>">SPT Masa PPN</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout') ?>">Logout</a>
            </li>
        </ul>
    </div>
</div>