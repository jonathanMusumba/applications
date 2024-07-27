                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <!-- Profile Modal Trigger -->
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">My Profile</a>
                    <!-- Change Password Modal Trigger -->
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePasswordModal">Change Password</a>
                    <!-- Logout Form -->
                    <form action="logout.php" method="post">
                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to logout?')">Logout</button>
                    </form>
                </div>