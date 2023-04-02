<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="card.css">
  <title>bKash Payment</title>
  
  <style>
  /* Google Font Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
body{
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #ffffff;
  box-sizing: border-box;
  font-family: "Poppins" , sans-serif;
}
.container{
  position: relative;
  max-width: 850px;
  width: 100%;
  background: #fff;
  padding: 40px 30px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.2);
  perspective: 2700px;
}
.container .forms{
  height: 100%;
  width: 100%;
  background: #fff;
}
.container .form-content{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.form-content .login-form,
.form-content .signup-form{
  width: calc(100% / 2 - 25px);
}
.forms .form-content .title{
  position: relative;
  font-size: 24px;
  font-weight: 500;
  color: #333;
}
.forms .form-content .title:before{
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 25px;
  background: #017661;
}
.forms .signup-form  .title:before{
  width: 20px;
}
.forms .form-content .input-boxes{
  margin-top: 30px;
}
.forms .form-content .input-box{
  display: flex;
  align-items: center;
  height: 50px;
  width: 100%;
  margin: 10px 0;
  position: relative;
}
.form-content .input-box input{
  height: 100%;
  width: 100%;
  outline: none;
  border: none;
  padding: 0 30px;
  font-size: 16px;
  font-weight: 500;
  border-bottom: 2px solid rgba(0,0,0,0.2);
  transition: all 0.3s ease;
}
.form-content .input-box input:focus,
.form-content .input-box input:valid{
  border-color: #017661;
}
.form-content .input-box i{
  position: absolute;
  color: #017661;
  font-size: 17px;
}
.forms .form-content .text{
  font-size: 14px;
  font-weight: 500;
  color: #333;
}
.forms .form-content .text a{
  text-decoration: none;
}
.forms .form-content .text a:hover{
  text-decoration: underline;
}
.forms .form-content .button{
  color: #fff;
  margin-top: 40px;
}
.forms .form-content .button input{
  color: #fff;
  background: #017661;
  border-radius: 6px;
  padding: 0;
  cursor: pointer;
  transition: all 0.4s ease;
}
.forms .form-content .button input:hover{
  background: #017661;
}
.forms .form-content label{
  color: #017661;
  cursor: pointer;
}
.forms .form-content label:hover{
  text-decoration: underline;
}
.forms .form-content .login-text,
.forms .form-content .sign-up-text{
  text-align: center;
  margin-top: 25px;
}
.container #flip{
  display: none;
}
@media (max-width: 730px) {
  .container .cover{
    display: none;
  }
  .form-content .login-form,
  .form-content .signup-form{
    width: 100%;
  }
  .form-content .signup-form{
    display: none;
  }
  .container #flip:checked ~ .forms .signup-form{
    display: block;
  }
  .container #flip:checked ~ .forms .login-form{
    display: none;
  }
}

</style>
  
  
</head>

<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Scan QR Code</div>
          <ul>
            <li>Go to your bKash App</li>
            <li>Scan the QR Code from below:</li>
          </ul>
          <img src="{{ url('1.jpg') }}"
            style="display: flex;position:relative;justify-content:center;width: fit-content;height: fit-content;left: 35px;">
            <li>Enter this Order ID- <span>{{$id}} </span>as reference.</li>
          <div class="text sign-up-text"> Having Trouble with QR Scaner? <label for="flip">Try Manually</label></div>
        </div>
        <div class="signup-form">
          <div class="title">Pay Manually</div>
          <strong>To make your payment with bKash, <br>follow the steps below:</strong>
          <ul style="text-align: justify;">
            <li>Go to your bKash Mobile Menu by dialing *247#</li>
            <li>Choose “Payment”</li>
            <li>Enter the Merchant bKash Account Number 01620008839</li>
            <li>Enter the amount you want to pay</li>
            <li>Enter this Order ID- <span>{{$id}}</span> as reference.</li>
            <li>Enter the Counter Number</li>
            <li>Now enter your bKash Mobile Menu PIN to confirm</li>
          </ul>
          <p>We will contact you as soon as we recived the payment.</p>
          <div class="text sign-up-text"> Pay with bKash App - <label for="flip">QR Scaner</label></div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>