document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
    const scrollLinks = document.querySelectorAll(".scroll-link");
    const sections = document.querySelectorAll("section");
    const navbarHeight = document.querySelector(".navbar").offsetHeight;

    
    scrollLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            const targetId = this.getAttribute("href");

            if (targetId && targetId.startsWith("#")) {
                e.preventDefault();
                const targetSection = document.querySelector(targetId);

                if (targetSection) {
                    document.querySelectorAll(".navbar-nav .nav-item").forEach((item) => {
                        item.classList.remove("active");
                    });
                    if (this.parentElement.classList.contains("nav-item")) {
                        this.parentElement.classList.add("active");
                    }

                    const offsetTop = targetSection.offsetTop - navbarHeight + 5;

                    window.scrollTo({
                        top: offsetTop,
                        behavior: "smooth"
                    });

                    const navbarCollapse = document.querySelector(".navbar-collapse");
                    if (navbarCollapse.classList.contains("show")) {
                        $(".navbar-collapse").collapse("hide");
                    }
                }
            }
        });
    });

   
    window.addEventListener("scroll", function () {
        let currentSectionId = "";

        sections.forEach((section) => {
            const sectionTop = section.offsetTop - navbarHeight - 50;
            const sectionHeight = section.offsetHeight;

            if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                currentSectionId = section.getAttribute("id");
            }
        });

        if (currentSectionId) {
            navLinks.forEach((link) => {
                link.parentElement.classList.remove("active");
                if (link.getAttribute("href") === `#${currentSectionId}`) {
                    link.parentElement.classList.add("active");
                }
            });
        }
    });

    
    const ctx = document.getElementById("performanceChart");
    if (ctx) {
        const performanceChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: [],
                datasets: [
                    {
                        label: "Proyek Selesai",
                        data: [],
                        backgroundColor: "rgba(220, 53, 69, 0.85)", // Merah tema racing
                        borderColor: "rgba(220, 53, 69, 1)",
                        borderWidth: 1,
                        borderRadius: 6
                    },
                    {
                        label: "Skor Performa (%)",
                        data: [],
                        type: "line",
                        borderColor: "#0f172a", // Navy gelap
                        backgroundColor: "rgba(15, 23, 42, 0.1)",
                        borderWidth: 3,
                        tension: 0.3,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 500
                },
                plugins: {
                    legend: {
                        position: "top"
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 110
                    }
                }
            }
        });

        function updateChartRealtime() {
            fetch("get_performa.php")
                .then((response) => response.json())
                .then((data) => {
                    const isDataChanged =
                        JSON.stringify(performanceChart.data.labels) !== JSON.stringify(data.labels) ||
                        JSON.stringify(performanceChart.data.datasets[0].data) !== JSON.stringify(data.proyek) ||
                        JSON.stringify(performanceChart.data.datasets[1].data) !== JSON.stringify(data.skor);

                    if (isDataChanged) {
                        performanceChart.data.labels = data.labels;
                        performanceChart.data.datasets[0].data = data.proyek;
                        performanceChart.data.datasets[1].data = data.skor;
                        performanceChart.update();
                    }
                })
                .catch((error) => console.error("Gagal memuat data grafik:", error));
        }

       
        updateChartRealtime();

        
        setInterval(updateChartRealtime, 3000);
    }
});