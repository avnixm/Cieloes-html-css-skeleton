function sendOTP(){
    console.log("OTP Function called");
    const email = document.getElementById('username');
    var OTPlabel = document.getElementById("OTPlabel");
    const otpverify = document.getElementsByClassName('otpverify')[0];


    let otp_val = Math.floor(Math.random() * (999999 - 100000 + 1)) + 100000;


    let emailbody = `
    <h1>Hi!</h1>
    <p>We hope this email finds you well. To enhance the security of your CIELOES account, we've implemented a one-time password (OTP) login verification process.</p>
    <p>If you're attempting to log in to your CIELOES account, please use the OTP provided below within the designated field:</p>
    <h4><strong>OTP: ${otp_val}</strong></h4>
    <p>If you haven't attempted to log in recently or if this login attempt was not initiated by you, please disregard this email and ensure the security of your account credentials.</p>
    <p>Best regards,</p>
    CIELOES Support Team</p>
    `;

    Email.send({
        SecureToken : "0c55be4d-881e-4eb4-aab3-0ec5e407becc",
        To : email.value,
        From : "cieloes.demo@gmail.com",
        Subject : "Login OTP for CIELOES Account",
        Body : emailbody
    }).then(
      message => {
        if(message === "OK"){
            if (OTPlabel) {
                OTPlabel.style.display = "block";
            }

            otpverify.style.display = "block";
            const otp_inp = document.getElementById('otp-text');
            const otp_btn = document.getElementById('otp-btn');

            otp_btn.addEventListener('click', () => {
                if (otp_inp.value == otp_val) {
                    alert("Email verified!");
                    otpverify.style.display = "none";
                    OTPlabel.style.display = "none";
                    window.location.href = 'dashboard.html';
                } else {
                    alert("Invalid OTP");
                }
            });            
        }
      }
    );
}


function sendOTPSignUp(){
    console.log("OTP Function called");
    const email = document.getElementById('s-email');
    var OTPlabel = document.getElementById("OTPlabel");
    const otpverify = document.getElementsByClassName('otpverify')[0];


    let otp_val = Math.floor(Math.random() * (999999 - 100000 + 1)) + 100000;


    let emailbody = `
    <h1>Hi!</h1>
    <p>Welcome to CIELOES! We're thrilled to have you on board. To ensure the security of your account, we require a quick verification step.</p>
    <p>If you've recently registered with CIELOES, please enter the OTP (One-Time Password) provided below to verify your account:</p>
    <p><strong>OTP:</strong> ${otp_val}</p>
    <p>If you haven't registered for a CIELOES account recently, you can disregard this email. Rest assured, your account security is our top priority.</p>
    <p>Thank you for choosing CIELOES. If you have any questions or concerns, feel free to reach out to our support team.</p>
    <p>Best regards,</p>
    CIELOES Support Team</p>
    `;

    Email.send({
        SecureToken : "0c55be4d-881e-4eb4-aab3-0ec5e407becc",
        To : email.value,
        From : "cieloes.demo@gmail.com",
        Subject : "One-Time Password (OTP) for CIELOES Account Verification",
        Body : emailbody
    }).then(
      message => {
        if(message === "OK"){
            if (OTPlabel) {
                OTPlabel.style.display = "block";
            }

            otpverify.style.display = "block";
            const otp_inp = document.getElementById('otp-text');
            const otp_btn = document.getElementById('otp-btn');

            otp_btn.addEventListener('click', () => {
                if (otp_inp.value == otp_val) {
                    alert("Email verified! Please proceed to complete your registration.");
                    otpverify.style.display = "none";
                    OTPlabel.style.display = "none";
                } else {
                    alert("Invalid OTP");
                }
            });     
        }
      }
    );
}