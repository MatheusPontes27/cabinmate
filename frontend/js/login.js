function login(event) {
  function login(event) {
  alert("LOGIN CHAMADO");
  event.preventDefault();
}

  event.preventDefault();

  const email = document.getElementById("loginEmail").value;
  const senha = document.getElementById("loginSenha").value;

  fetch("http://localhost/cabinmate/backend/auth/login.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({ email, senha })
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        localStorage.setItem("token", data.token);
        localStorage.setItem("usuario", JSON.stringify(data.user));

        window.location.href = "dashboard.html";
      } else {
        alert(data.error || "Login inválido");
      }
    })
    .catch(() => {
      alert("Erro ao conectar ao servidor");
    });
}
