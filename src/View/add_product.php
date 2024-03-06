
<form action="/add_product" method="POST">
    <div class="container">
        <h2>Add product</h2>
        <p>
            Please fill in this form to add a product.</p>
        <hr>

        <label for="name"><b>Product ID</b></label>
        <label style="color: red;">
            <?php echo $error['product_id']??"";?></label>
        <input type="text" placeholder="Enter Product ID" name="product_id" id="name" required>

        <label for="email"><b>Quantity</b></label>
        <label style="color: red;">
            <?php echo $error['quantity']??"";?></label>
        <input type="text" placeholder="Enter Quantity" name="quantity" id="email" required>
        <label style="color: red;">
            <?php echo $error['userID']??"";?></label>
        <hr>

        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
        <button type="submit" class="registerbtn">Add</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="#">Sign in</a>.</p>
    </div>
</form>

<style>
    * {box-sizing: border-box}

    /* Add padding to containers */
    .container {
        padding: 16px;
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    /* Set a style for the submit/register button */
    .registerbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .registerbtn:hover {
        opacity:1;
    }

    /* Add a blue text color to links */
    a {
        color: dodgerblue;
    }

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
        background-color: #f1f1f1;
        text-align: center;
    }
</style>

