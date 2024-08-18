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
                
                <li>
                    <a href="/" class="waves-effect">
                        <i class="mdi mdi-home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                
                <!-- <li>
                    <a href="{{ url('datapenilaian') }}" class="waves-effect">
                        <i class="mdi mdi-file-document-box"></i>
                        <span> Data Penilaian </span>
                    </a>
                </li> -->
                
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="mdi mdi-folder-outline"></i>
                        <span> Data Aspek </span>
                        <span class="float-right">
                            <i class="mdi mdi-chevron-right"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('datapenugasan') }}">Data Penugasan</a></li>
                        <li><a href="{{ url('dataabsensi') }}">Data Absensi</a></li>
                        <li><a href="{{ url('datasp') }}">Data SP</a></li>
                        <li><a href="{{ url('datapenilaian') }}">Data Nilai Evaluasi</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('hasilalgoritma') }}" class="waves-effect">
                        <i class="mdi mdi-file-document-box"></i>
                        <span> Hasil Algoritma </span>
                    </a>
                </li>
                
                <li class="menu-title">Data Master</li>
                
                <li class="has_sub">
                    <a href="{{ url('datakaryawan') }}" class="waves-effect">
                        <i class="mdi mdi-account-multiple"></i>
                        <span> Data Karyawan </span>
                    </a>
                </li>
                
                <li class="has_sub">
                    <a href="{{ url('datajabatan') }}" class="waves-effect">
                        <i class="mdi mdi-briefcase"></i>
                        <span> Data Jabatan </span>
                    </a>
                </li>
                
                <li class="has_sub">
                    <a href="{{ url('dataadmin') }}" class="waves-effect">
                        <i class="mdi mdi-security"></i>
                        <span> Data Admin </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end sidebarinner -->
</div>
