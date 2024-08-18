<div class="topbar">
    <nav class="navbar-custom">
        <!-- Search Box -->
        <div class="dropdown notification-list nav-pro-img">
            <div class="list-inline-item hide-phone app-search">
                <form role="search" class="">
                    <div class="form-group pt-1">
                        <input type="text" class="form-control" placeholder="Search..">
                        <a href=""><i class="fa fa-search"></i></a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Header Section -->
        <ul class="list-inline float-right mb-0 mr-3">
            <!-- Real-time Clock -->
            <li class="list-inline-item">
                <div id="real-time-clock" class="nav-link" style="color: white;"></div>
            </li>

            <!-- User Name and Image -->
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <!-- Display User Name -->
                    <span style="color: white; margin-right: 10px;">{{ auth()->user()->karyawan->nama }}</span>
                    
                    @php
                        $user = auth()->user();
                        $avatarUrl = $user->avatar_url ? asset('storage/avatars/' . $user->avatar_url) : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?d=mp&s=200';
                    @endphp

                    <img src="{{ $avatarUrl }}" alt="user" class="rounded-circle img-thumbnail avatar">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5>Welcome</h5>
                    </div>
                    <a class="dropdown-item"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> {{ auth()->user()->karyawan->nama }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('logout') }}"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                </div>
            </li>
        </ul>

        <!-- Left Header Section -->
        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>
</div>

<!-- JavaScript for Real-time Clock -->
<script>
    function updateClock() {
        var now = new Date();
        
        // Adjust time to WITA (UTC +8)
        var utcOffset = 8; // WITA is UTC +8
        var localOffset = now.getTimezoneOffset() / 60; // Get local timezone offset in hours
        var timeZoneOffset = utcOffset + localOffset; // Total timezone offset
        
        now.setHours(now.getHours() + timeZoneOffset); // Adjust hours
        
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        
        // Add leading zeros if needed
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        var timeString = hours + ':' + minutes + ':' + seconds;

        document.getElementById('real-time-clock').innerHTML = timeString;
    }

    setInterval(updateClock, 1000); // Update the clock every second
    window.onload = updateClock; // Initial call to display the clock immediately
</script>

<!-- Add some custom CSS to style the avatar -->
<style>
    .avatar {
        width: 40px;
        height: 40px;
        object-fit: cover;
    }
</style>
