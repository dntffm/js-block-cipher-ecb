function toPlaintext(data){
    hasil = ""
    for (let index = 0; index < data.length; index++) {
        hasil += String.fromCharCode(parseInt(data[index],2))
    }
    console.log(hasil)
    
}

function xorBin(data,key){
    hasil = ''
    for (let index = 0; index < data.length; index++) {
        temp = (parseInt(data[index],2) ^ parseInt(key,2)).toString(2)
        if(temp.length < 4){
            let x = ""
            for (let index = 0; index < 4 - temp.length; index++) {
                x+="0"
            }
            x += temp
            temp = x
        }

        hasil+=temp
    }
    return hasil.match(/[\s\S]{1,8}/g) || []
}

function changePos(data)
{
    let chunks = []
    for (let index = 0; index < data.length; index++) {
        
        let temp = ''
        temp += data[index][0][3]
        temp += data[index][0][0]
        temp += data[index][0][1]
        temp += data[index][0][2]
        chunks.push(temp)
    }
    return chunks
}
function decrypt(cipher,key){
    toPlaintext(xorBin(changePos(cipher),key))
}

let cipher = [ [ '1101' ],
[ '0000' ],
[ '1101' ],
[ '0011' ],
[ '1101' ],
[ '1000' ],
[ '1101' ],
[ '1110' ] ]
let key = "1000"
decrypt(cipher,key)