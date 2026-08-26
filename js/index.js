// lista de páginas
const pages = ["p1", "p2", "p3"];
                
let index = 0;

// função para mostrar página
function showPage(i){
    pages.forEach(id => {
        document.getElementById(id).classList.remove("active");
    });
    document.getElementById(pages[i]).classList.add("active");
}

// rotação automática
function startRotation(){
    let interval = setInterval(() => {
        index++;
        
        if(index < pages.length){
            showPage(index);
        } else {
            clearInterval(interval); // PARA automaticamente
        }

    }, 3000); // tempo entre páginas (2 segundos)
}

// iniciar
startRotation();


    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/12.12.1/firebase-app.js";
    import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/12.12.1/firebase-auth.js";
    import { getDatabase, ref, set } from "https://www.gstatic.com/firebasejs/12.12.1/firebase-database.js";

    // Your web app's Firebase configuration
    const firebaseConfig = {
      apiKey: "AIzaSyBCyYUltUoPgpAD-P3IFjLSM4GMvCbVdYQ",
      authDomain: "login-cadastro-b241c.firebaseapp.com",
      databaseURL: "https://login-cadastro-b241c-default-rtdb.firebaseio.com",
      projectId: "login-cadastro-b241c",
      storageBucket: "login-cadastro-b241c.firebasestorage.app",
      messagingSenderId: "151418430525",
      appId: "1:151418430525:web:bcfe19c46cbe1f87fa3654"
    };

    // Initialize Firebase app once
    const app = initializeApp(firebaseConfig);

    // Initialize Firebase services
    const auth = getAuth(app); // Serviço de Autenticação
    const database = getDatabase(app); // Serviço de Realtime Database

    // Referências aos elementos HTML
    const loginForm = document.getElementById('loginForm');
    const cadastroForm = document.getElementById('cadastroForm');
    const loginEmailInput = document.getElementById('loginEmail');
    const loginPasswordInput = document.getElementById('loginPassword');
    const cadastroNomeInput = document.getElementById('cadastroNome');
    const cadastroEmailInput = document.getElementById('cadastroEmail');
    const cadastroPasswordInput = document.getElementById('cadastroPassword');
    const mensagemDiv = document.getElementById('mensagem');
    const showRegisterLink = document.getElementById('showRegister');
    const showLoginLink = document.getElementById('showLogin');
    const loginSection = document.getElementById('loginSection');
    const cadastroSection = document.getElementById('cadastroSection');

    // --- Funções para alternar formulários ---
    function showLoginForm() {
        loginSection.style.display = 'block';
        cadastroSection.style.display = 'none';
        mensagemDiv.textContent = ''; // Limpa mensagens
    }

    function showCadastroForm() {
        loginSection.style.display = 'none';
        cadastroSection.style.display = 'block';
        mensagemDiv.textContent = ''; // Limpa mensagens
    }

    // --- Event Listeners para alternar formulários ---
    showRegisterLink.addEventListener('click', (e) => {
        e.preventDefault();
        showCadastroForm();
    });

    showLoginLink.addEventListener('click', (e) => {
        e.preventDefault();
        showLoginForm();
    });

    // Exibir formulário de login por padrão ao carregar a página
    showLoginForm();

    // --- Lógica de Cadastro (Registro) ---
    cadastroForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const nomeCompleto = cadastroNomeInput.value;
        const email = cadastroEmailInput.value;
        const password = cadastroPasswordInput.value;

        mensagemDiv.textContent = 'Aguarde... Registrando usuário.';
        mensagemDiv.style.color = 'blue';

        try {
            // Cria o usuário com e-mail e senha no Firebase Authentication
            const userCredential = await createUserWithEmailAndPassword(auth, email, password);
            const user = userCredential.user;

            // Salva dados adicionais (nome completo) no Realtime Database, 
            // usando o UID do Firebase Auth como chave para garantir unicidade e link com a autenticação.
            await set(ref(database, 'users/' + user.uid), {
                nome: nomeCompleto,
                email: email,
                dataCadastro: new Date().toISOString()
            });

            mensagemDiv.textContent = `Sucesso! Bem-vindo, ${nomeCompleto}!`;
            mensagemDiv.style.color = 'green';
            cadastroForm.reset(); // Limpa o formulário
            showLoginForm(); // Volta para a tela de login

        } catch (error) {
            let errorMessage = 'Erro ao cadastrar.';
            if (error.code === 'auth/email-already-in-use') {
                errorMessage = 'Este e-mail já está em uso. Tente outro ou faça login.';
            } else if (error.code === 'auth/weak-password') {
                errorMessage = 'A senha deve ter pelo menos 6 caracteres.';
            } else if (error.code === 'auth/invalid-email') {
                errorMessage = 'O formato do e-mail é inválido.';
            }
             else {
                errorMessage += ` Detalhes: ${error.message}`;
            }
            mensagemDiv.textContent = errorMessage;
            mensagemDiv.style.color = 'red';
            console.error("Erro de cadastro:", error);
        }
    });

    // --- Lógica de Login ---
    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const email = loginEmailInput.value;
        const password = loginPasswordInput.value;

        mensagemDiv.textContent = 'Aguarde... Fazendo login.';
        mensagemDiv.style.color = 'blue';

        try {
            // Tenta fazer login com e-mail e senha
            const userCredential = await signInWithEmailAndPassword(auth, email, password);
            const user = userCredential.user;

            mensagemDiv.textContent = `Login bem-sucedido! Bem-vindo de volta!`;
            mensagemDiv.style.color = 'green';
            loginForm.reset(); // Limpa o formulário
            
            // Redireciona para a página após o login
            window.location.href = "Index.html";


        } catch (error) {
            let errorMessage = 'Erro ao fazer login.';
            if (error.code === 'auth/user-not-found' || error.code === 'auth/wrong-password') {
                errorMessage = 'E-mail ou senha inválidos. Verifique suas credenciais.';
            } else if (error.code === 'auth/invalid-email') {
                errorMessage = 'O formato do e-mail é inválido.';
            }
             else {
                errorMessage += ` Detalhes: ${error.message}`;
            }
            mensagemDiv.textContent = errorMessage;
            mensagemDiv.style.color = 'red';
            console.error("Erro de login:", error);
        }
    });



