import variables from "../sass/_variables.scss";

$(document).ready(function() {
    const pieCtx = document.getElementById("pie");
    const barCtx = document.getElementById("bar");
    console.log(Laravel.data);
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
            title: {
                display: false,
                text: "対応状況"
            }
        }
    });
    var myBarChart = new Chart(barCtx, {
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
                        labelString: "月",
                        stacked: true,
                        ticks: {
                            suggestedMax: 100,
                            suggestedMin: 0,
                            stepSize: 50,
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