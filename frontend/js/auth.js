const API_URL = "http://localhost/cabinmate/backend/auth";

/* REGISTRO */
async function registrar(event) {

    const nome = document.getElementById("regNome").value;
    const email = document.getElementById("regEmail").value;
    const senha = document.getElementById("regSenha").value;

    const response = await fetch(`${API_URL}/register.php`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ nome, email, senha })
    });

    const data = await response.json();

    if (!response.ok) {
        alert(data.error || "Erro ao cadastrar");
        return;
    }

    alert("Cadastro realizado com sucesso!");
    document.body.className = "sign-in-js";
}

/* LOGIN */
async function login(event) {

    const email = document.getElementById("loginEmail").value;
    const senha = document.getElementById("loginSenha").value;

    const response = await fetch(`${API_URL}/login.php`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ email, senha })
    });

    const data = await response.json();

    if (!response.ok) {
        alert(data.error || "Login inválido");
        return;
    }

    // 🔐 SALVANDO JWT (ESSENCIAL)
    localStorage.setItem("token", data.token);
    localStorage.setItem("usuario", JSON.stringify(data.user));

    alert("Login realizado com sucesso!");
    // window.location.href = "dashboard.html";

    
}
