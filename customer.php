 <?php

include("include/header.php");
include("include/config.php");

if(isset($_REQUEST['card_number'])){
    //For creating token
    try{
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

        $token=\Stripe\Token::create(array(
          "card" => array(
            
            "number" => $_REQUEST['card_number'],
            "exp_month" => $_REQUEST['exp_month'],
            "exp_year" => $_REQUEST['exp_year'],
            "cvc" => $_REQUEST['cvv']
          )
        ));
        $token_id=$token->id;
    }
    catch(Exception $e) {
            $_SESSION['error_msg'] = "Error :".$e->getMessage();
        } 
        if(!empty($token_id)){
        // For charge
            try{


            $charging=\Stripe\Charge::create(array(
              "amount" => $_REQUEST['amount'],
              "currency" => "usd",
              "source" => $token_id, 
              "description" => "Payment for testing"
            ));
            $_SESSION['charging_id']=$charging->id;
        }
        catch(Exception $e) {
            $_SESSION['error_msg'] = "Error :".$e->getMessage();
            } 
        }
        

}

if(isset($_REQUEST['card_number'])){
    //For creating token
    try{
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

        $token=\Stripe\Token::create(array(
          "card" => array(
            "number" => $_REQUEST['card_number'],
            "exp_month" => $_REQUEST['exp_month'],
            "exp_year" => $_REQUEST['exp_year'],
            "cvc" => $_REQUEST['cvv']
          )
        ));
        $token_id=$token->id;
    }
    catch(Exception $e) {
            $_SESSION['error_msg'] = "Error :".$e->getMessage();
        } 
        if(!empty($token_id)){
        // For create customer
            try{
            

            $charging=\Stripe\Customer::create(array(
                "description" => "create testing customer",
                "source" => $token_id // obtained with Stripe.js
));
            $_SESSION['customer_id']=$charging->id;
        }
        catch(Exception $e) {
            $_SESSION['error_msg'] = "Error :".$e->getMessage();
            } 
        }
        

}

?>
<style>
    .form-basic{

        max-width: 741px !important;
    }

    #account {
        text-align: center;
    }

    p {
        font-weight: bolder;
        font-size: 20px;
    }
</style>
       <div class="main-content">

    <form class="form-basic" method="post" action="">
     <div class="form-title-row">
                <h1>Payment History </h1>
            </div>
    <?php
        
            echo "<table><tr>
                    <th>Date</th>
                    <th>Item</th>
                    <th>Amount</th>
                </tr>
                <tr>
                <td>12/21/2016</td>
                <td>PS4 Game</td>
                <td>$59.99</td>
                </tr>";
     
            echo "</table>";


            
        ?>

    <?php

                if(!empty($_REQUEST)){
            echo "<p style='color:green;' >Amount Paid Successfully . Token id "."</p></br>";
            
        }
    ?>

            <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            id="nick"
            data-key="<?php echo STRIPE_PUBLIC_KEY; ?>" 
            data-amount="5999"
            data-name="Product name"
            data-description="Pay the amount for this product"
            data-image="assets/logo.png"
            data-locale="auto">
     </script>

</form>

 <form class="form-basic" method="post" action="">
    <?php
        
            echo "<table><tr>
                    <th>Date</th>
                    <th>Item</th>
                    <th>Amount</th>
                </tr>
                <tr>
                <td>01/17/2016</td>
                <td>PS4</td>
                <td>$399.99</td>
                </tr>";
     
            echo "</table>";


            
        ?>

    <?php

                if(!empty($_REQUEST)){
            echo "<p style='color:green;' >Amount Paid Successfully . Token id "."</p></br>";
            
        }
    ?>

            <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            id="nick"
            data-key="<?php echo STRIPE_PUBLIC_KEY; ?>" 
            data-amount="39999"
            data-name="Product name"
            data-description="Pay the amount for this product"
            data-image="assets/logo.png"
            data-locale="auto">
     </script>

</form>

    <form class="form-basic" method="post" action="">
       <?php
        
            echo "<table><tr>
                    <th>Date</th>
                    <th>Item</th>
                    <th>Amount</th>
                </tr>
                <tr>
                <td>02/21/2016</td>
                <td>Macbook Pro</td>
                <td>$1799.99</td>
                </tr>";
     
            echo "</table>";


            
        ?>

    <?php

                if(!empty($_REQUEST)){
            echo "<p style='color:green;' >Amount Paid Successfully . Token id "."</p></br>";
            
        }
    ?>

            <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            id="nick"
            data-key="<?php echo STRIPE_PUBLIC_KEY; ?>" 
            data-amount="179999"
            data-name="Product name"
            data-description="Pay the amount for this product"
            data-image="assets/logo.png"
            data-locale="auto">
     </script>

</form>



</div>
 

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script
            src="https://cdn.datatables.net/1.10.12/js/dataTables.material.min.js"></script>

 <form class="form-basic" method="post" action="">
        <div id="account">
          <div class="form-title-row">
          <h1>Account Balance</h1>
        </div>

                <p>Available: $500</p>
                <p>Pending: $1000</p>

        </div>
        </form>
   




        <!-- You only need this form and the form-basic.css -->

        <form class="form-basic" method="post" action="">

            <div class="form-title-row">
                <h1>Create Customer </h1>
            </div>
    <?php


    if(!empty($msg)){
        echo "<p style='color:green;' >Customer created Successfully . Customer id ".$msg."</p></br>";
        unset($_SESSION['customer_id']);
    }
    if(!empty($err)){
        echo "<p style='color:red;' >".$err."</p></br>";
        unset($_SESSION['error_msg']);
    }
    ?>
            <div class="form-row">
                <label>
                    <span>Full name</span>
                    <input type="text" name="name" required>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Card number</span>
                    <input type="text" name="card_number" required>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Exp Month</span>
                    <input type="text" name="exp_month" placeholder="MM(eg:11)" required>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Exp Year</span>
                    <input type="text" name="exp_year" placeholder="YYYY(eg:2022)" required>
                </label>
            </div>
             <div class="form-row">
                <label>
                    <span>cvv</span>
                    <input type="text" name="cvv" placeholder="cvv" required>
                </label>
            </div>

             

            
            <div class="form-row">
                <button type="submit" name="submit">Submit Form</button>
            </div>

        </form>

 



        <!-- You only need this form and the form-basic.css -->

        <form class="form-basic" method="post" action="">

            <div class="form-title-row">
                <h1>Payment form </h1>
            </div>
    <?php

 
    if(!empty($msg)){
        echo "<p style='color:green;' >Amount Paid Successfully . Charge id ".$msg."</p></br>";
        unset($_SESSION['charging_id']);
    }
    if(!empty($err)){
        echo "<p style='color:red;' >".$err."</p></br>";
        unset($_SESSION['error_msg']);
    }
    ?>
            <div class="form-row">
                <label>
                    <span>Full name</span>
                    <input type="text" name="name" required>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Card number</span>
                    <input type="text" name="card_number" required>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Exp Month</span>
                    <input type="text" name="exp_month" placeholder="MM(eg:11)" required>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Exp Year</span>
                    <input type="text" name="exp_year" placeholder="YYYY(eg:2022)" required>
                </label>
            </div>
             <div class="form-row">
                <label>
                    <span>cvv</span>
                    <input type="text" name="cvv" placeholder="cvv" required>
                </label>
            </div>

             <div class="form-row">
                <label>
                    <span>Amount</span>
                    <input type="text" name="amount" required>
                </label>
            </div>

            
            <div class="form-row">
                <button type="submit" name="submit">Submit Form</button>
            </div>

        </form>

    </div>


    </body>
    </html>
