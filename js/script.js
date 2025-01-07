// Remover popup de notificacao
if(document.getElementById("popup")) {
    var time = setInterval(() => {
        document.body.removeChild(document.getElementById("popup"));
        clearInterval(time);
    }, 5000);
}