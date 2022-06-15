    $token = substr(str_shuffle(MD5(microtime())), 0, 20);
    $_SESSION["ajaxToken"] = $token;

    function sendResult(stg) {
    let infoline
    let info = stg.split(',');
    info.forEach(function(element, counter) {
    eval("infoline" + counter + " = element");
    console.log(infoline);
});
    window.location.href = "listing.php?0=" + infoline0 + "&1=" + infoline1 + "&2=" + infoline2 + "&3=" +
    infoline3 + "&4=" + infoline4 + "&5=" + infoline5 + "&6=" + infoline6;
}

    function showHint(str) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
    let lots = JSON.parse(this.responseText);
    let uic = document.getElementById("txtHint");
    uic.innerHTML = "";

    console.log(lots);

    lots.forEach(function (obj) {
    uic.innerHTML += '<li class="list-group-item"><p onclick="sendResult(\'' +
    obj._id + ',' + obj._title + ',' + obj._model + ',' + obj._image + ',' + obj._year + ',' + obj._colour + ',' + obj._auctionID + '\')">' +
    obj._id + '<img width ="60px" class="mg-thumbnail" src="images/' + obj._image + '">' + obj._title + '</p></li>'
}
    );
}
};

    let uic = document.getElementById("txtHint");
    if (str.length > 1)
{
    xmlhttp.open("GET", "Ajax/ajaxSearch.php?q=" + str + "&token=<?php echo $token; ?>", true);
    xmlhttp.send();
    return;
    }

    if (str.length < 2)
    {
    uic.innerHTML = "";
    return;
    }
    }