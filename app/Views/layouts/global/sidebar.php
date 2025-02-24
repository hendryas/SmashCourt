<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <?php if ($role_id == 'admin'): ?>

                    <li class="menu-title">Admin</li>
                    <li>
                        <a href="<?= base_url('dashboard'); ?>" class="waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('field-list'); ?>" class=" waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Daftar Lapangan</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('field-booking'); ?>" class=" waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Booking Lapangan</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('user-booking'); ?>" class=" waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Booking Pengguna</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('booking-history'); ?>" class=" waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Histori Booking</span>
                        </a>
                    </li>

                    <li>
                        <a href="transaction" class=" waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Transaksi</span>
                        </a>
                    </li>

                    <li class="menu-title">Staff Lapangan</li>
                    <li>
                        <a href="daily-booking-list" class=" waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Daftar Booking Harian</span>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="menu-title">Staff Lapangan</li>
                    <li>
                        <a href="daily-booking-list" class=" waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Daftar Booking Harian</span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>