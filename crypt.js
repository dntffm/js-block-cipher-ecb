function xorBin(a,b)
{
    let chunks = []
    let temp = (parseInt(a,2) ^ parseInt(b,2)).toString(2)
    if(temp.length < 4){
        let x = ""
        for (let index = 0; index < 4 - temp.length; index++) {
            x+="0"
        }
        x += temp
        temp = x
    }
    chunks.push(temp)

    return chunks
}

function changePos(data)
{
    let chunks = []
    for (let index = 0; index < data.length; index++) {
        let temp = ''
        temp += data[index][1]
        temp += data[index][2]
        temp += data[index][3]
        temp += data[index][0]
        chunks.push(temp)
    }
    return chunks
}

function bin(string)
{
    let hasil = ""
    for (let index = 0; index < string.length; index++) {
        var dec = string.charCodeAt(index)
        var int = parseInt(dec)
        var bin = int.toString(2)
        
        if(bin.length < 8){
            let x = ''
            for (let index = 0; index < 8 - bin.length; index++) {
                x += '0'
            }
            
            x+=bin
            bin = x
        }
        hasil += bin
    }
    return hasil
}

function splitString(string)
{
    
    let temp = string.match(/[\s\S]{1,4}/g) || []
    return temp
}

function encrypt(plaintext)
{
    let splitedData = splitString(bin(plaintext))
    let hasil = []
    for (let index = 0; index < splitedData.length; index++) {
        
        hasil.push(changePos(xorBin(splitedData[index],"1000")))
    }
    return hasil
}

console.log(encrypt('halo'))
