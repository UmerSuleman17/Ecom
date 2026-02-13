<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signature Payment </title>
      <link rel="icon" type="image/jpg" href="project images/IMG_3949.jpg">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            padding: 20px;
        }
        
        .payment-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            font-size: clamp(1.5rem, 2.5vw, 2rem);
        }
        
        .step {
            margin-bottom: 25px;
            padding-left: 15px;
            border-left: 3px solid #3498db;
            position: relative;
        }
        
        .step-number {
            font-weight: bold;
            color: #3498db;
            font-size: 1.1rem;
            margin-bottom: 8px;
        }
        
        .important-note {
            background-color: #fff8e1;
            padding: 15px;
            border-left: 4px solid #ffc107;
            margin: 20px 0;
            border-radius: 0 5px 5px 0;
        }
        
        .payment-details {
            background-color: #e8f5e9;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
            word-break: break-all;
        }
        
        .whatsapp-btn {
            display: inline-block;
            background-color: #25D366;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s;
        }
        
        .whatsapp-btn:hover {
            background-color: #128C7E;
        }
        
        ul {
            padding-left: 20px;
            margin: 10px 0;
        }
        
        li {
            margin-bottom: 8px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .payment-container {
                padding: 20px;
            }
            
            .step {
                padding-left: 12px;
            }
            
            .payment-details, .important-note {
                padding: 12px;
            }
            
            .whatsapp-btn {
                display: block;
                width: 100%;
                padding: 15px;
            }
        }
        
        @media (max-width: 480px) {
            body {
                padding: 15px;
            }
            
            .payment-container {
                padding: 15px;
            }
            
            h1 {
                margin-bottom: 20px;
            }
            
            .step {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h1>Payment Instructions</h1>
        
        <div class="important-note">
            <strong>Note:</strong> We currently don't have an online payment gateway. Please follow these instructions to complete your payment manually.
        </div>
        
        <div class="step">
            <div class="step-number">STEP 1: Make Payment</div>
            <p>Send your payment to our official payment number:</p>
            <div class="payment-details">
                <strong>Payment Number:</strong> +92 3140263753<br>
                <strong>Payment Methods:</strong> Bank Transfer / Mobile Payment
            </div>
        </div>
        
        <div class="step">
            <div class="step-number">STEP 2: Capture Proof</div>
            <p>After making the payment, take a clear screenshot of the successful transaction confirmation.</p>
        </div>
        
        <div class="step">
            <div class="step-number">STEP 3: Send Details</div>
            <p>Send the screenshot along with these details to our WhatsApp:</p>
            <ul>
                <li><strong>Full Name:</strong> As per your ID</li>
                <li><strong>Complete Address:</strong> Including postal code</li>
                <li><strong>Order Number:</strong> If available</li>
                <li><strong>Amount Paid:</strong> Exact payment amount</li>
                <li><strong>Payment Date/Time:</strong> When you sent payment</li>
            </ul>
            <a href="https://wa.link/6n7vz8" class="whatsapp-btn">
                <i class="fab fa-whatsapp"></i> Send Payment Proof via WhatsApp
            </a>
        </div>
        
        <div class="step">
            <div class="step-number">STEP 4: Confirmation</div>
            <p>We will verify and confirm your payment within 24 hours. You'll receive:</p>
            <ul>
                <li>Payment confirmation message</li>
                <li>Order processing details</li>
                <li>Estimated delivery timeline</li>
            </ul>
        </div>
        
        <div class="important-note">
            <strong>Security Alert:</strong> Our team will never ask for your bank details, OTP codes, or payment passwords. Only send screenshots of completed transactions.
        </div>
    </div>

    <!-- Font Awesome for WhatsApp icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>
</html>