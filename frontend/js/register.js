function registrar() {
  const nome  = document.getElementById("nome").value;
  const email = document.getElementById("email").value;
  const senha = document.getElementById("senha").value;

  fetch("http://localhost/cabinmate/backend/auth/register.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({ nome, email, senha })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert("Cadastro realizado! Faça login.");
      window.location.href = "login.html";
    } else {
      document.getElementById("erro").innerText = data.error;
    }
  })
  .catch(() => {
    document.getElementById("erro").innerText = "Erro ao conectar com o servidor";
  });
}
