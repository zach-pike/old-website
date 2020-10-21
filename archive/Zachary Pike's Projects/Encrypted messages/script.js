function decryptData() {
    var dein = document.getElementById("dein").value
    var d = parseInt(document.getElementById("d").value, 10)
    var n = parseInt(document.getElementById("N").value, 10)
    document.getElementById("deout").value = decodeEncrypt(dein, d, n);
}
function encryptData() {
    var ein = document.getElementById("ein").value
    var e = parseInt(document.getElementById("e").value, 10)
    var n = parseInt(document.getElementById("N").value, 10)
    document.getElementById("eout").value = encodeEncrypt(ein, e, n);
}

function encodeEncrypt(message, e, n) {
    let data = [null, null, ' ', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '.', ',', '(', ')', '!', '?', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0']
    let split = message.split("");
    let inter = []
    let out = []
    let strout = ""

    for (let i=0; i < split.length; i++) {
       inter[inter.length] = data.indexOf(split[i])
    } 
    for (let m=0; m < inter.length; m++) {
        out[out.length] = parseInt(bigInt(inter[m]).pow(e).mod(n), 10)
    }
    for (let o=0; o < out.length; o++) {
        strout = strout + out[o] + "-"
    }
    return strout.substring(0, strout.length - 1);
}

function decodeEncrypt(message, d, n) {
    let data = [null, null, ' ', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '.', ',', '(', ')', '!', '?', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0']
    let split = message.split("-")
    let inter = []
    let strout = ""

    for (let i=0; i < split.length; i++) {
        inter[i] = data[parseInt(bigInt(split[i]).pow(d).mod(n), 10)]
    }
    for (let m=0; m < inter.length; m++) {
        strout = strout + inter[m]
    }
    return strout
}