// Parsing data JSON
var uniqueYearsString = document.getElementById('uniqueYearsJSON').value;
var jumlahSiswaDanalainPerTahunString = document.getElementById('jumlahSiswaDanalainPerTahunJSON').value;

var uniqueYearsJSON = JSON.parse(uniqueYearsString);
var jumlahSiswaDanalainPerTahunJSON = JSON.parse(jumlahSiswaDanalainPerTahunString);

var totalPenerimaBantuanPerTahunString = document.getElementById('totalPenerimaBantuanPerTahunJSON').value;
var totalPenerimaBantuanPerTahunJSON = JSON.parse(totalPenerimaBantuanPerTahunString);

// Ubah struktur data JSON agar sesuai
var years = uniqueYearsJSON.map(function(item) {
    return item.tahun;
});

var dataBSM = years.map(function(year) {
    return (jumlahSiswaDanalainPerTahunJSON[year] && jumlahSiswaDanalainPerTahunJSON[year]['BSM']) || 0;
});

var dataSIABAZKu = years.map(function(year) {
    return (jumlahSiswaDanalainPerTahunJSON[year] && jumlahSiswaDanalainPerTahunJSON[year]['SIABAZKu']) || 0;
});

var dataLainnya = years.map(function(year) {
    return (jumlahSiswaDanalainPerTahunJSON[year] && jumlahSiswaDanalainPerTahunJSON[year]['Lainnya']) || 0;
});

var dataPIP = years.map(function(year) {
    return (totalPenerimaBantuanPerTahunJSON[year]) || 0;
});

var datasets = [
    {
        label: 'BSM',
        data: dataBSM,
        borderColor: '#FF5733',
        backgroundColor: 'rgba(255, 87, 51, 0.2)',
    },
    {
        label: 'SIABAZKu',
        data: dataSIABAZKu,
        borderColor: '#33FF57',
        backgroundColor: 'rgba(51, 255, 87, 0.2)',
    },
    {
        label: 'Lainnya',
        data: dataLainnya,
        borderColor: '#3357FF',
        backgroundColor: 'rgba(51, 87, 255, 0.2)',
    },
    {
        label: 'PIP',
        data: dataPIP,
        borderColor: '#FF33FF',
        backgroundColor: 'rgba(255, 51, 255, 0.2)',
    }
];



// Buat dataset untuk grafik
var chartData = {
    labels: years,
    datasets: datasets
};

// Buat chart menggunakan Chart.js
var ctx = document.getElementById('visitors-chart');
var chart = new Chart(ctx, {
    type: 'line',
    data: chartData,
    options: {
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    stepSize: 20, // Atur rentang nilai sumbu-x
                    max: 100 // Atur nilai maksimum sumbu-x
                }
            }],
            xAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
