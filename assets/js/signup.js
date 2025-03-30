const signup = document.getElementById('signup-btn')
signup.addEventListener("click", async(e) =>{

    e.preventDefault()
    // const newUsername = document.getElementById("username-new").value;
    // // const email = document.getElementById("email").value;
    // const password = document.getElementById("password-new").value;
    // const confirmPassword = document.getElementById("password-confirm").value;

    // const data = {
    //     username : newUsername,
    //     // email : email,
    //     password : password
    // }
    
    // if(password == "" | newUsername == ""){
    //     document.getElementById('signup-message').innerHTML = "Please fill out the fields";
    // }
    // else if(password != confirmPassword){
    //     document.getElementById('signup-message').innerHTML = `<i class='bx bx-error-circle'></i> Passwords are not matching`;
    // }
    // else if(!/[A-Z]/.test(password)){
    //     document.getElementById('signup-message').innerHTML = "Password must contain atleast one uppercase letter";
    // }
    // // if(!/[a-z]/.test(password)){
    // //     document.getElementById('signup-message').innerHTML = "Password must contain atleast one lowercase letter";
    // // }
    // else if(!/\d/.test(password)){
    //     document.getElementById('signup-message').innerHTML = "Password must contain atleast one digit";
    // }
    // else if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password)) {
    //     document.getElementById('signup-message').innerHTML = "Password must contain at least one special character.";
    // }
    // else if(password.length < 8){
    //     document.getElementById('signup-message').innerHTML = "Password must be atleast 8 characters long";
    // }
    
    // else{
    //     document.getElementById('signup-message').innerHTML = ""
    //     try{
    //         console.log(data);
    //         const res = await axios.post('http://127.0.0.1:8000/signup/', data)
    //         document.getElementById('signup-message').innerHTML = `<i class='bx bx-error-circle err-icon'></i> ${res.data.result}`;
    //         console.log(res);
    //         if(res.data.result == "success"){
    //             window.location.href = "SignupSuccess.html";
    //         }
    //     }
    //     catch(error){
    //         console.error('Error', error);
    //     }
    // }

})