<div class="container">
  <div class="card">
    <h2>Login</h2>
      <form action="" method="POST">
        <input type="text" id="email" name="email" placeholder="Enter email" required>
          <label style="color: red;">
              <?php echo $error['email'] ?? "";?></label>
            <input type="password" id="psw" name="psw" placeholder="Enter password" required>
          <label style="color: red;">
              <?php echo $error['psw'] ?? "";?></label>
          <label style="color: red;">
                  <?php echo $err ?? "";?></label>
      <button type="submit">Login</button>
    </form>
  </div>
</div>

<style>
    body {
        font-family: "Comic Sans MS", cursive;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background: #f5f5f5;
        color: #333;
    }

    .container {
        width: 100%;
        max-width: 400px;
    }

    .card {
        width: 100%;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input {
        padding: 10px;
        margin-bottom: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: border-color 0.3s ease-in-out;
        outline: none;
        color: #333;
    }

    input:focus {
        border-color: dodgerblue;
    }

    button {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    button:hover {
        opacity:1;
    }

</style>