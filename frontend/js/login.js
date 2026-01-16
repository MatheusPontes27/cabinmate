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
      localStorage.setItem("token", data.token);
      alert("Login realizado com sucesso!");
      console.log(data);
      // futuramente: window.location.href = "dashboard.html";
    } else {
      document.getElementById("erro").innerText = data.error;
    }
  })
  .catch(() => {
    document.getElementById("erro").innerText = "Login ou Senha incorreto";
  });
}
