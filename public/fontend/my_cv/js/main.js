const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const tabs = $$(".option-item");
const panes = $$(".pane-item");
const tabActive = $(".option-item.active");


tabs.forEach((tab, index) => {
    const pane = panes[index];
    tab.onclick = function() {
        $(".option-item.active").classList.remove("active");
        $(".pane-item.active").classList.remove("active");
        this.classList.add("active");
        pane.classList.add("active");
    };
});