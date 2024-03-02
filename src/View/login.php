<div class="container">
  <div class="card">
    <h2>Login</h2>
      <form action="" method="POST">
        <input type="text" id="email" name="email" placeholder="Enter email" required>
            <input type="password" id="psw" name="psw" placeholder="Enter password" required>
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
        background-color: dodgerblue;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    button:hover {
        background-color: dodgerblue;
    }

</style>