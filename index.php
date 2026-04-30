<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Ambiental</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        background: #f4f6f9;
    }

    .card {
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border: none;
        border-radius: 12px;
    }

    canvas {
        max-height: 300px;
    }
</style>
</head>

<body>

<div class="container py-4">

    <h2 class="text-center mb-4">🌎 Dashboard Ambiental</h2>

    <!-- FORMULÁRIO -->
    <div class="card mb-4">
        <div class="card-body">

            <h5 class="mb-3">Inserir Dados</h5>

            <form id="formDados">

                <div class="row g-3">

                    <div class="col-md-3">
                        <input
                            type="text"
                            id="local"
                            class="form-control"
                            placeholder="Local"
                            required
                        >
                    </div>

                    <div class="col-md-3">
                        <input
                            type="number"
                            id="temp"
                            class="form-control"
                            placeholder="Temperatura (°C)"
                            required
                        >
                    </div>

                    <div class="col-md-3">
                        <input
                            type="number"
                            id="ar"
                            class="form-control"
                            placeholder="Qualidade do Ar (%)"
                            required
                        >
                    </div>

                    <div class="col-md-3">
                        <input
                            type="number"
                            id="ruido"
                            class="form-control"
                            placeholder="Ruído (dB)"
                            required
                        >
                    </div>

                </div>

                <button class="btn btn-primary mt-3 w-100">
                    Adicionar
                </button>

            </form>

        </div>
    </div>

    <!-- GRÁFICOS -->
    <div class="row g-4">

        <div class="col-md-6">
            <div class="card p-3">
                <canvas id="linha"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3">
                <canvas id="barra"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3">
                <canvas id="pizza"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3">
                <canvas id="radar"></canvas>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card p-3">
                <canvas id="area"></canvas>
            </div>
        </div>

    </div>

</div>

<script>

// DADOS INICIAIS
let dados = [
    {
        local: "Centro",
        temp: 28,
        ar: 70,
        ruido: 60
    },
    {
        local: "Parque",
        temp: 25,
        ar: 90,
        ruido: 40
    },
    {
        local: "Industrial",
        temp: 30,
        ar: 50,
        ruido: 80
    }
];

// FUNÇÕES
function getLabels() {
    return dados.map(d => d.local);
}

function getTemp() {
    return dados.map(d => d.temp);
}

function getAr() {
    return dados.map(d => d.ar);
}

function getRuido() {
    return dados.map(d => d.ruido);
}

// GRÁFICO LINHA
const linha = new Chart(document.getElementById('linha'), {
    type: 'line',
    data: {
        labels: getLabels(),
        datasets: [{
            label: 'Temperatura',
            data: getTemp(),
            borderWidth: 2
        }]
    }
});

// GRÁFICO BARRA
const barra = new Chart(document.getElementById('barra'), {
    type: 'bar',
    data: {
        labels: getLabels(),
        datasets: [{
            label: 'Ruído',
            data: getRuido()
        }]
    }
});

// GRÁFICO PIZZA
const pizza = new Chart(document.getElementById('pizza'), {
    type: 'pie',
    data: {
        labels: getLabels(),
        datasets: [{
            label: 'Qualidade do Ar',
            data: getAr()
        }]
    }
});

// GRÁFICO RADAR
const radar = new Chart(document.getElementById('radar'), {
    type: 'radar',
    data: {
        labels: getLabels(),
        datasets: [{
            label: 'Comparação Ambiental',
            data: getTemp()
        }]
    }
});

// GRÁFICO ÁREA
const area = new Chart(document.getElementById('area'), {
    type: 'line',
    data: {
        labels: getLabels(),
        datasets: [{
            label: 'Qualidade do Ar',
            data: getAr(),
            fill: true
        }]
    }
});

// ATUALIZAR GRÁFICOS
function atualizarGraficos() {

    linha.data.labels = getLabels();
    linha.data.datasets[0].data = getTemp();
    linha.update();

    barra.data.labels = getLabels();
    barra.data.datasets[0].data = getRuido();
    barra.update();

    pizza.data.labels = getLabels();
    pizza.data.datasets[0].data = getAr();
    pizza.update();

    radar.data.labels = getLabels();
    radar.data.datasets[0].data = getTemp();
    radar.update();

    area.data.labels = getLabels();
    area.data.datasets[0].data = getAr();
    area.update();
}

// FORMULÁRIO
document.getElementById("formDados").addEventListener("submit", function(e){

    e.preventDefault();

    const novo = {
        local: document.getElementById("local").value,
        temp: parseFloat(document.getElementById("temp").value),
        ar: parseFloat(document.getElementById("ar").value),
        ruido: parseFloat(document.getElementById("ruido").value)
    };

    dados.push(novo);

    atualizarGraficos();

    this.reset();

});

</script>

</body>
</html>