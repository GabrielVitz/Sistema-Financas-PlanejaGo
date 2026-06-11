<h1 align="center">🎯 PlanejaGo — Gestão de Finanças Pessoais</h1>
<img width="1292" height="467" alt="image" src="https://github.com/user-attachments/assets/0a232f0b-e9e8-4d1c-a08f-c89632bae33e" />

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/SQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="SQL" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS" />
</p>

---

## 📖 Sobre o Projeto

O **PlanejaGo** é um sistema web intuitivo e moderno desenvolvido para a gestão de finanças pessoais. Este projeto foi concebido como parte prática da disciplina de **Desenvolvimento Web**.

O principal objetivo do PlanejaGo é desmistificar o controle financeiro doméstico, entregando uma plataforma simples, limpa e altamente funcional que auxilie as pessoas a organizarem suas despesas e receitas, entenderem seus hábitos de consumo e planejarem uma vida financeira mais saudável e equilibrada.

---

## 🚀 Principais Funcionalidades

O sistema centraliza ferramentas indispensáveis para o controle do seu dinheiro:

* **💰 Cadastro de Despesas e Receitas:** Registro prático e rápido de entradas e saídas financeiras, permitindo categorizar cada operação para análises futuras.
* **📊 Dashboard Dinâmico:** Painel visual completo com gráficos explicativos, balanço mensal automatizado e indicadores de saúde financeira em tempo real.
* **🧮 Calculadora Comum Integrada:** Uma ferramenta de cálculo rápido embutida diretamente na interface, evitando a necessidade de abrir outros aplicativos.
* **📈 Calculadora de Juros (Simples e Compostos):** Módulo inteligente focado em simulações financeiras, ideal para prever rendimentos de investimentos ou o custo real de parcelamentos e empréstimos.
* **📋 Relatórios Personalizados:** Geração de relatórios detalhados e filtrados por período, tipo ou categoria, facilitando o diagnóstico das finanças.

---

## 📱 Demonstração Visual

### 🎬 Teste de Funcionamento
*Abaixo, veja uma demonstração prática do fluxo de cadastro rápido de lançamentos no sistema:*



### 📸 Capturas de Tela (Interface)

<table align="center">
  <tr>
    <td align="center">
      <b>📊 Dashboard Interativo</b>
    </td>
    <td align="center">
      <b>🧮 Calculadora Financeira</b>
    </td>
    <td align="center">
      <b>📋 Relatórios Personalizados</b>
    </td>
  </tr>

  <tr>
    <td align="center">
      <img src="https://github.com/user-attachments/assets/7c7fb0e5-4e1f-4bed-a438-0a0f43ac80d3" width="350" alt="Dashboard Interativo"/>
    </td>
    <td align="center">
      <img src="https://github.com/user-attachments/assets/be71434d-3226-43b5-8949-4897077bf0d3" width="350" alt="Calculadora Financeira"/>
    </td>
    <td align="center">
      <img src="https://github.com/user-attachments/assets/de16f58a-9f44-4247-8142-6c231810a0da" width="350" alt="Relatórios Personalizados"/>
    </td>
  </tr>
</table>

---

## 🛠️ Tecnologias Utilizadas

A arquitetura do projeto foi desenvolvida utilizando tecnologias consolidadas do mercado:

* **Backend:** [PHP](https://www.php.net/) utilizando o robusto framework [Laravel](https://laravel.com/) (arquitetura MVC, Migrations e Eloquent ORM).
* **Banco de Dados:** [SQL](https://en.wikipedia.org/wiki/SQL) (MySQL) estruturado de forma relacional.
* **Frontend:** HTML5, CSS3 e JavaScript para dinamização dos componentes visuais e lógicas matemáticas.

---

## ⚙️ Configuração e Execução do Projeto

Siga os passos abaixo para configurar e executar o **PlanejaGo** em seu ambiente local.

### 📋 Pré-requisitos

Antes de começar, certifique-se de ter instalado:

* PHP 8.1 ou superior
* Composer
* Node.js e NPM
* MySQL
* Git
* VS Code (recomendado)

---

### 📥 1. Clone o Repositório

```bash
git clone https://github.com/seu-usuario/planejago.git
cd sistema-planejago
```

---

### ⚙️ 2. Configure o Arquivo de Ambiente

Crie uma cópia do arquivo de configuração padrão:

```bash
cp .env.example .env
```

---

### 📦 3. Instale as Dependências

Instale as dependências do backend e frontend:

```bash
composer install
npm install
```

---

### 🔑 4. Gere a Chave da Aplicação

```bash
php artisan key:generate
```

---

### 🗄️ 5. Configure o Banco de Dados

Crie um banco de dados chamado **planejago** no MySQL.

Em seguida, abra o arquivo `.env` e configure as credenciais:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=planejago
DB_USERNAME=root
DB_PASSWORD=
```

---

### 🏗️ 6. Execute as Migrations e Seeders

Crie as tabelas e popule o banco com os dados iniciais:

```bash
php artisan migrate --seed
```

---

### 🚀 7. Inicie a Aplicação

Para executar o projeto corretamente, abra **dois terminais**.

#### Terminal 1 — Servidor Laravel

```bash
php artisan serve
```

A aplicação estará disponível em:

```text
http://127.0.0.1:8000
```

---

#### Terminal 2 — Servidor Vite/Tailwind

```bash
npm run dev
```

Este comando habilita a compilação automática dos arquivos CSS e JavaScript durante o desenvolvimento.

---
---

### ✅ Pronto!

Após concluir todos os passos, o sistema estará disponível para uso localmente.

Agora você já pode cadastrar receitas e despesas, gerar relatórios financeiros, utilizar as calculadoras e acompanhar sua evolução financeira através do dashboard do **PlanejaGo**. 🎯

<br>

## 👨‍💻 Desenvolvedores

<p align="center">
  Desenvolvido com dedicação por:
</p>

<table align="center">
  <tr>
    <td align="center">
      <a href="https://github.com/GlendaArruda">
        <img src="https://github.com/GlendaArruda.png" width="120px;" alt="Glenda Kelly"/><br>
        <sub><b>Glenda Kelly</b></sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/IsabellaT29">
        <img src="https://github.com/IsabellaT29.png" width="120px;" alt="Isabella Tereza"/><br>
        <sub><b>Isabella Tereza</b></sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/GabrielVitz">
        <img src="https://github.com/GabrielVitz.png" width="120px;" alt="Gabriel Albuquerque"/><br>
        <sub><b>Gabriel Albuquerque</b></sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/Dev-Morais">
        <img src="https://github.com/Dev-Morais.png" width="120px;" alt="Gabriel Morais"/><br>
        <sub><b>Gabriel Morais</b></sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/GabsStarCoder8">
        <img src="https://github.com/GabsStarCoder8.png" width="120px;" alt="Gabriel Vilas Boas"/><br>
        <sub><b>Gabriel Vilas Boas</b></sub>
      </a>
    </td>
  </tr>
</table>

<br>

<p align="center">
  ⭐ Se este projeto foi útil para você, considere deixar uma estrela no repositório!
</p>

<p align="center">
  Feito com ❤️ utilizando Laravel, PHP, MySQL e JavaScript.
</p>

