function password_check(){
    let get_password = document.getElementById("password");
    if (get_password.type === "password"){
        get_password.type = "text";
    }else{
        get_password.type = "password";
    }
}