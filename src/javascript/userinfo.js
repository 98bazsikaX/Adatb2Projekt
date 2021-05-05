function delete_order(id){
    sessionId = document.getElementById("SessionEmail").value;
    if(window.confirm("Biztos törölni akarja a " + id + "-jű rendelést?")){
        window.location.href = `/php/functions/deleteOrder.php?id=${id}&session=${sessionId}`;
    }else{
        console.log("Mégsem");
    }
}