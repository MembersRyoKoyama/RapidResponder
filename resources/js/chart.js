import variables from "../sass/_variables.scss";

$(document).ready(function() {
    const pieCtx = document.getElementById("pie");
    const barCtx = document.getElementById("bar");
    const myPieChart = new Chart(pieCtx, {
        type: "pie",
        data: {
            labels: ["未対応", "対応中", "対応済"],
            datasets: [
                {
                    backgroundColor: [
                        variables.end1,
                        variables.end2,
                        variables.end3
                    ],
                    data: Laravel.pie,
                    borderWidth: 0
                }
            ]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: false,
                text: "対応状況"
            }
        }
    });
    const myBarChart = new Chart(barCtx, {
        type: "bar",
        data: {
            labels: Laravel.bar.labels,
            datasets: [
                {
                    label: "未対応",
                    data: Laravel.bar.datas.end1,
                    backgroundColor: variables.end1
                },
                {
                    label: "対応中",
                    data: Laravel.bar.datas.end2,
                    backgroundColor: variables.end2
                },
                {
                    label: "対応済",
                    data: Laravel.bar.datas.end3,
                    backgroundColor: variables.end3
                }
            ]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: false,
                text: "月別対応状況"
            },
            scales: {
                xAxes: [
                    {
                        stacked: true
                    }
                ],
                yAxes: [
                    {
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "質問件数"
                        },

                        stacked: true,
                        ticks: {
                            stepSize: 25,
                            callback: function(value, index, values) {
                                return value;
                            }
                        }
                    }
                ]
            }
        }
    });
});
