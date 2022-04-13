$(document).ready(function () {
})

// DATATABLE INIT
LANG_DT = {
    "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
    "sProcessing": "Sedang memproses...",
    "sLengthMenu": "Tampilkan _MENU_ entri",
    "sZeroRecords": "Tidak ditemukan data yang sesuai",
    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
    "sInfoPostFix": "",
    "sSearch": "Cari:",
    "sUrl": "",
    "oPaginate": {
        "sFirst": "Pertama",
        "sPrevious": "Sebelumnya",
        "sNext": "Selanjutnya",
        "sLast": "Terakhir"
    }
}
DT_USER = $("#article_notassigned_table").DataTable({
    "language": LANG_DT,
    "fnDrawCallback": function (oSettings) {
    }
})

document.addEventListener("DOMContentLoaded", function () {
    console.log(scorePerQuestion);
    console.log(scorePerUser);

    var questions = [];
    var series = [{
        name: "positive",
        data: []
    }, {
        name: "neutral",
        data: []
    }, {
        name: "negative",
        data: []
    }, {
        name: "no answer",
        data: []
    }];

    scorePerQuestion.forEach(function (e, i) {
        questions.push(e.no);

        var positive = 0;
        var neutral = 0;
        var negative = 0;
        var noanswer = 0;
        var total = e.article_questionnaire.length;
        e.article_questionnaire.forEach(function (f, j) {
            if (f.score == 1) {
                positive += 1;
            } else if (f.score == 0) {
                neutral += 1;
            } else if (f.score == -1) {
                negative += 1;
            } else {
                noanswer += 1;
            }
        });

        series[0].data.push(Math.round(positive*100/total));
        series[1].data.push(Math.round(neutral*100/total));
        series[2].data.push(Math.round(negative*100/total));
        series[3].data.push(Math.round(noanswer*100/total));
    });

    // Bar chart
    var spqbaropt = {
        chart: {
            height: 350,
            type: "bar",
            stacked: true,
        },
        plotOptions: {
            bar: {
                horizontal: true,
            },
        },
        stroke: {
            width: 1,
            colors: ["#fff"]
        },
        series: series,
        xaxis: {
            categories: questions,
            labels: {
                formatter: function (val) {
                    return val
                }
            }
        },
        yaxis: {
            title: {
                text: undefined
            },
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val+"%"
                }
            }
        },
        dataLabels: {
          formatter: function(val, opt) {
              return val + "%"
          }
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: "top",
            horizontalAlign: "left",
            offsetX: 40
        }
    }
    var spqbar = new ApexCharts(
        document.querySelector("#spq-bar"),
        spqbaropt
    );
    spqbar.render();


    // Column chart
    var spqcolopt = {
        chart: {
            height: 350,
            type: "bar",
        },
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: "rounded",
                columnWidth: "55%",
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ["transparent"]
        },
        series: series,
        xaxis: {
            categories: questions,
        },
        yaxis: {
            title: {
                text: "$ (thousands)"
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val
                }
            }
        }
    }
    var spqcol = new ApexCharts(
        document.querySelector("#spq-column"),
        spqcolopt
    );
    spqcol.render();



    // Pie chart
    // var spqpieopt = {
    //     chart: {
    //         height: 350,
    //         type: "donut",
    //     },
    //     dataLabels: {
    //         enabled: false
    //     },
    //     series: [44, 55, 13, 33]
    // }
    // var spqpie = new ApexCharts(
    //     document.querySelector("#spq-pie"),
    //     spqpieopt
    // );
    // spqpie.render();




















    var users = [];
    var nseries = [{
        name: "positive",
        data: []
    }, {
        name: "neutral",
        data: []
    }, {
        name: "negative",
        data: []
    }, {
        name: "no answer",
        data: []
    }];

    scorePerUser.forEach(function (e, i) {
        users.push(e.name);

        var positive = 0;
        var neutral = 0;
        var negative = 0;
        var noanswer = 0;
        e.article_questionnaire.forEach(function (f, j) {
            if (f.score == 1) {
                positive += 1;
            } else if (f.score == 0) {
                neutral += 1;
            } else if (f.score == -1) {
                negative += 1;
            } else {
                noanswer += 1;
            }
        });

        nseries[0].data.push(positive);
        nseries[1].data.push(neutral);
        nseries[2].data.push(negative);
        nseries[3].data.push(noanswer);
    });


    // Bar chart
    var spubaropt = {
        chart: {
            height: 350,
            type: "bar",
            stacked: true,
        },
        plotOptions: {
            bar: {
                horizontal: true,
            },
        },
        stroke: {
            width: 1,
            colors: ["#fff"]
        },
        series: nseries,
        xaxis: {
            categories: users,
            labels: {
                formatter: function (val) {
                    return val
                }
            }
        },
        yaxis: {
            title: {
                text: undefined
            },
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val
                }
            }
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: "top",
            horizontalAlign: "left",
            offsetX: 40
        }
    }
    var spubar = new ApexCharts(
        document.querySelector("#spu-bar"),
        spubaropt
    );
    spubar.render();


    // Column chart
    var spucolopt = {
        chart: {
            height: 350,
            type: "bar",
        },
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: "rounded",
                columnWidth: "55%",
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ["transparent"]
        },
        series: nseries,
        xaxis: {
            categories: users,
        },
        yaxis: {
            title: {
                text: "$ (thousands)"
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands"
                }
            }
        }
    }
    var spucol = new ApexCharts(
        document.querySelector("#spu-column"),
        spucolopt
    );
    spucol.render();



    // // Pie chart
    // var spupieopt = {
    //     chart: {
    //         height: 350,
    //         type: "donut",
    //     },
    //     dataLabels: {
    //         enabled: false
    //     },
    //     series: [44, 55, 13, 33]
    // }
    // var spupie = new ApexCharts(
    //     document.querySelector("#spu-pie"),
    //     spupieopt
    // );
    // spupie.render();
});
