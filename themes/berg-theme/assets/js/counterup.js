import { CountUp } from "../node_modules/countup.js/dist/countUp.js";

$(() => {
    $.each($("[data-counterup]"), (index, item) => {
        let dataOptions = item.getAttribute("data-options");
        let counterOptions = JSON.parse(dataOptions);
        let waypoint = new Waypoint({
            element: item,
            handler: function () {
                const countUp = new CountUp(
                    item,
                    counterOptions.endVal,
                    counterOptions
                );
                if (!countUp.error) {
                    countUp.start();
                } else {
                    console.error(countUp.error);
                }
            },
            offset: "bottom-in-view",
        });
    });
});
