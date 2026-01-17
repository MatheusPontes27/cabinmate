// PROTEÇÃO COM JWT
const token = localStorage.getItem("token");

if (!token) {
  window.location.href = "/cabinmate/index.html";
}

// LOGOUT
document.getElementById("logout").onclick = () => {
  localStorage.removeItem("token");
  window.location.href = "/cabinmate/index.html";
};

// CANVAS
const hoursChart = document.getElementById("hoursChart");
const routeChart = document.getElementById("routeChart");
const companyChart = document.getElementById("companyChart");

// GRÁFICOS
new Chart(hoursChart, {
  type: 'line',
  data: {
    labels: ['Jan','Fev','Mar','Abr','Mai','Jun'],
    datasets: [{
      label: 'Horas',
      data: [80,120,95,140,110,160],
      borderColor: '#0056b3',
      fill: false
    }]
  }
});

new Chart(routeChart, {
  type: 'doughnut',
  data: {
    labels: ['Nacional','Internacional'],
    datasets: [{
      data: [65,35],
      backgroundColor: ['#0056b3','#00aaff']
    }]
  }
});

new Chart(companyChart, {
  type: 'bar',
  data: {
    labels: ['GOL','LATAM','AZUL'],
    datasets: [{
      data: [42,31,18],
      backgroundColor: '#0056b3'
    }]
  }
});
