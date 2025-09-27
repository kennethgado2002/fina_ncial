// Script for Time
        function updatePhilippinesTime() {
            const options = {
                timeZone: "Asia/Manila",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
                year: "numeric",
                month: "long",
                day: "numeric"
            };

            const now = new Date().toLocaleString("en-PH", options);
            document.getElementById("ph-time").innerHTML = now;
        }

        setInterval(updatePhilippinesTime, 1000);
        updatePhilippinesTime();

        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let dropdownLinks = document.querySelectorAll(".nav-list > li > a");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });

        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
            }
        }

        // Dropdown toggle
        dropdownLinks.forEach(link => {
            link.addEventListener("click", (e) => {
                let parentLi = link.parentElement;
                if (parentLi.querySelector(".submenu")) {
                    e.preventDefault();
                    // Only toggle submenu if sidebar is open
                    if (sidebar.classList.contains("open")) {
                        parentLi.classList.toggle("open");
                    } else {
                        // If sidebar is closed, open it first
                        sidebar.classList.add("open");
                        menuBtnChange();
                        // Then open the submenu after a slight delay
                        setTimeout(() => {
                            parentLi.classList.add("open");
                        }, 300);
                    }
                }
            });
        });

        // Logout confirmation modal
        const logoutBtn = document.querySelector("#log_out");
        const logoutModal = document.getElementById("logoutModal");
        const confirmLogout = document.getElementById("confirmLogout");
        const cancelLogout = document.getElementById("cancelLogout");

        logoutBtn.addEventListener("click", function(e) {
            e.preventDefault();
            logoutModal.style.display = "flex";
        });

        cancelLogout.addEventListener("click", function() {
            logoutModal.style.display = "none";
        });

        confirmLogout.addEventListener("click", function() {
            window.location.href = "../CONFIG/logout.php";
        });

        let idleTimer;         
        let countdownTimer;    
        let countdown = 240;    
        const idleLimit = 240000;
        const idleModal = document.getElementById("idleModal");
        const countdownEl = document.getElementById("countdown");
        const continueBtn = document.getElementById("continueSession");
        const cancelBtn = document.getElementById("cancelSession");

        function startIdleTimer() {
            clearTimeout(idleTimer);
            idleTimer = setTimeout(showIdleModal, idleLimit);
        }

        function showIdleModal() {
            idleModal.style.display = "flex";
            countdown = 60;
            countdownEl.textContent = countdown;

            countdownTimer = setInterval(() => {
                countdown--;
                countdownEl.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(countdownTimer);
                    window.location.href = "../CONFIG/logout.php";
                }
            }, 1000);
        }

        function activityHandler() {
            if (idleModal.style.display !== "flex") {
                startIdleTimer();
            }
        }

        window.onload = startIdleTimer;
        document.onmousemove = activityHandler;
        document.onkeypress = activityHandler;
        document.onclick = activityHandler;
        document.onscroll = activityHandler;

        continueBtn.addEventListener("click", () => {
            clearInterval(countdownTimer);
            idleModal.style.display = "none";
            startIdleTimer(); 
        });

        cancelBtn.addEventListener("click", () => {
            window.location.href = "../CONFIG/logout.php";
        });
        
        // Notification and Inbox dropdown functionality
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            dropdown.addEventListener('click', function(e) {
                if (e.target.classList.contains('fa-bell') || e.target.classList.contains('fa-envelope')) {
                    this.querySelector('.dropdown-content').classList.toggle('show');
                    
                    // Close other dropdowns when one is opened
                    document.querySelectorAll('.dropdown-content').forEach(otherDropdown => {
                        if (otherDropdown !== this.querySelector('.dropdown-content')) {
                            otherDropdown.classList.remove('show');
                        }
                    });
                }
            });
        });

        // Close dropdowns when clicking outside
        window.addEventListener('click', function(e) {
            if (!e.target.matches('.dropdown i')) {
                document.querySelectorAll('.dropdown-content').forEach(dropdown => {
                    if (dropdown.classList.contains('show')) {
                        dropdown.classList.remove('show');
                    }
                });
            }
        });

        // Auto-hide notification after 5 seconds
        setTimeout(function() {
            var alert = document.getElementById('notificationAlert');
            if (alert) alert.style.display = 'none';
        }, 5000);