(() => {
  // classic theme enable/disable buttons
  const classicThemeControls = document
    .querySelectorAll('[name="berg_classic_theme_enabled_on_post"]')
    Array.from(classicThemeControls).forEach((element) => {
      element.addEventListener("click", (event) => {
        const classicThemeClass = "berg-classic-theme";
        let themeEnabled = event.currentTarget.value == 1;
        let bodyElement = document.querySelector("body");
        if (themeEnabled) {
          bodyElement.classList.add(classicThemeClass);
        } else {
          bodyElement.classList.remove(classicThemeClass);
        }
      });
    });
})();
