function tabOverflowDetect() {
    const container = document.querySelector(".tabs");
    if (container != null) {
        const primary = container.querySelector(".-primary");
        const primaryItems = container.querySelectorAll(
            ".-primary > li:not(.-more)"
        );
        container.classList.add("--jsfied");
        primary.insertAdjacentHTML(
            "beforeend",
            `
                <li class="-more mr-2">
                    <button class="inline-block p-4 rounded-t-lg border-b-2 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700" type="button" aria-haspopup="true" aria-expanded="false" id="tabDropdownToggle" data-dropdown-toggle="tabDropdown">
                    More <span>&darr;</span>
                    </button>
                    <div id="tabDropdown" class="-secondary hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="tabDropdownToggle">
                           ${primary.innerHTML}
                        </ul>
                    </div>
               </li>`
        );

        const secondary = container.querySelector(".-secondary");
        const secondaryItems = secondary.querySelectorAll("li");
        const allItems = container.querySelectorAll("li");
        const moreLi = primary.querySelector(".-more");
        const moreBtn = moreLi.querySelector("button");
        moreBtn.addEventListener("click", (e) => {
            e.preventDefault();
            container.classList.toggle("--show-secondary");
            moreBtn.setAttribute(
                "aria-expanded",
                container.classList.contains("--show-secondary")
            );
        });
        // adapt tabs
        const doAdapt = () => {
            // reveal all items for the calculation
            allItems.forEach((item) => {
                item.classList.remove("--hidden");
            });

            // hide items that won't fit in the Primary
            let stopWidth = moreBtn.offsetWidth;
            let hiddenItems = [];
            const primaryWidth = primary.offsetWidth;
            primaryItems.forEach((item, i) => {
                if (primaryWidth >= stopWidth + item.offsetWidth) {
                    stopWidth += item.offsetWidth;
                } else {
                    item.classList.add("--hidden");
                    hiddenItems.push(i);
                }
            });

            // toggle the visibility of More button and items in Secondary
            if (!hiddenItems.length) {
                moreLi.classList.add("--hidden");
                container.classList.remove("--show-secondary");
                moreBtn.setAttribute("aria-expanded", false);
            } else {
                secondaryItems.forEach((item, i) => {
                    if (!hiddenItems.includes(i)) {
                        item.classList.add("--hidden");
                    }
                });
            }
        };

        doAdapt(); // adapt immediately on load
        window.addEventListener("resize", doAdapt); // adapt on window resize

        // hide Secondary on the outside click
        document.addEventListener("click", (e) => {
            let el = e.target;
            while (el) {
                if (el === secondary || el === moreBtn) {
                    return;
                }
                el = el.parentNode;
            }
            container.classList.remove("--show-secondary");
            moreBtn.setAttribute("aria-expanded", false);
        });
    }
}

function detectTheme() {
    if (
        localStorage.getItem("color-theme") === "dark" ||
        (!("color-theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
}

function toggleTheme(){
    var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
    var themeToggleLightIcon = document.getElementById(
        "theme-toggle-light-icon"
    );

    // Change the icons inside the button based on previous settings
    if (
        localStorage.getItem("color-theme") === "dark" ||
        (!("color-theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        themeToggleLightIcon.classList.remove("hidden");
    } else {
        themeToggleDarkIcon.classList.remove("hidden");
    }

    var themeToggleBtn = document.getElementById("theme-toggle");

    themeToggleBtn.addEventListener("click", function () {
        // toggle icons inside button
        themeToggleDarkIcon.classList.toggle("hidden");
        themeToggleLightIcon.classList.toggle("hidden");

        // if set via local storage previously
        if (localStorage.getItem("color-theme")) {
            if (localStorage.getItem("color-theme") === "light") {
                document.documentElement.classList.add("dark");
                localStorage.setItem("color-theme", "dark");
            } else {
                document.documentElement.classList.remove("dark");
                localStorage.setItem("color-theme", "light");
            }

            // if NOT set via local storage previously
        } else {
            if (document.documentElement.classList.contains("dark")) {
                document.documentElement.classList.remove("dark");
                localStorage.setItem("color-theme", "light");
            } else {
                document.documentElement.classList.add("dark");
                localStorage.setItem("color-theme", "dark");
            }
        }
    });
}
detectTheme();
tabOverflowDetect();
document.addEventListener("DOMContentLoaded", function(event) { 
    toggleTheme();
});


