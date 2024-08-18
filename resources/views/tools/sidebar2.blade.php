<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="mdi mdi-close"></i>
    </button>

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="logo-container">
            <a href="/" class="logo">
                <span class="logo-text" style="font-family: 'Edu AU VIC WA NT Hand', cursive; font-weight: 500;">Lanting Estate</span>
            </a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft" id="sidebar-main">
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                
                <!-- Dashboard Menu Item -->
                <li>
                    <a href="{{ url('homepenilai') }}" class="waves-effect">
                        <i class="mdi mdi-home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                
                <!-- Data Penilaian Menu Item -->
                <li>
                    <a href="{{ url('datapenilaian2') }}" class="waves-effect">
                        <i class="mdi mdi-file-document-box"></i>
                        <span> Data Nilai Evaluasi </span>
                    </a>
                </li>

                <!-- Hasil Algoritma Menu Item -->
                @if(auth()->check() && auth()->user()->jabatan->jabatan == 'Manager')
                <li>
                    <a href="{{ url('hasilalgoritma2') }}" class="waves-effect">
                        <i class="mdi mdi-file-document-box"></i>
                        <span> Validasi Hasil </span>
                    </a>
                </li>
                @endif

                <!-- Form Penilaian Menu Item -->
                @if(auth()->check() && auth()->user()->jabatan->jabatan == 'Asisten')
                <li>
                    <a href="{{ url('formpenilaian') }}" class="waves-effect">
                        <i class="mdi mdi-file-document-box"></i>
                        <span> Form Penilaian </span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end sidebarinner -->
</div>
