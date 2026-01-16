const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
  container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
  container.classList.remove("right-panel-active");
});

document.getElementById("loginForm").addEventListener("submit", async e => {
  e.preventDefault();
  const email = document.getElementById("loginEmail").value;
  const senha = document.getElementById("loginSenha").value;

  const res = await fetch("http://localhost/cabinmate/backend/auth/login.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ email, senha })
  });
  const data = await res.json();
  console.log(data);
});
