const pwShowHide = document.querySelectorAll(".eye-icon");


    // console.log(forms, pwShowHide, links);
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", () =>{
            let pwfields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");

            pwfields.forEach(password => {
                if(password.type === "password"){
                    password.type = "text";
                    eyeIcon.classList.replace("bx-hide", "bx-show");
                    return;

                }
                password.type = "password";
                eyeIcon.classList.replace("bx-show", "bx-hide")
            })
        })
    })

// const login = document.getElementById('login-btn')
// login.addEventListener("click", async(e)=>{

//     e.preventDefault()
//     const username = document.getElementById("username").value;
//     const password = document.getElementById("password").value;

//     if(password == "" | username == ""){
//         document.getElementById('login-message').innerHTML = "Please fill out the fields";
//     }
    
//     else{
//         console.log({username, password});
//         document.getElementById('login-message').innerHTML = "";
        // try{
        //     const response = await axios.post('http://127.0.0.1:8000/log/',{username, password})   
        //     document.getElementById('login-message').innerHTML = `<i class='bx bx-error-circle err-icon'></i> ${response.data}`;
        //     console.log(response);
        //     if(response.data == "success"){
        //         window.location.href = "LoginSuccess.html";
        //     }
        // }
        // catch(error){
        //     console.error('Error',error);
        // }
//     }
// })