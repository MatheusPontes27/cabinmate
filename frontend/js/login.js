function login() {
  const email = document.getElementById("email").value;
  const senha = document.getElementById("senha").value;

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
      // 🔐 Salva o token
      localStorage.setItem("token", data.token);

      console.log("Login OK, redirecionando...");
      console.log("Token:", data.token);

      // 🚀 REDIRECT CORRETO
      window.location.href = "/cabinmate/dashboard.html";
    } else {
      document.getElementById("erro").innerText = data.error;
    }
  })
  .catch(err => {
    console.error("Erro no login:", err);
    document.getElementById("erro").innerText = "Erro ao conectar ao servidor";
  });
}

