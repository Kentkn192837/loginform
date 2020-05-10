window.onload = function() {
    let logout = document.getElementById( "logout" );

    logout.addEventListener( "click" , ( ev ) => {
        const result = confirm("ログアウトしますか？");

        if ( result ) {
            location.href = "logout.php";
        }
    });
}