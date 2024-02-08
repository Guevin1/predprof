var sea = document.getElementById("sea-block")
sea.width = document.body.clientWidth
sea.height = document.documentElement.clientHeight
if(document.documentElement.clientHeight < document.body.clientHeight) {
    sea.height = document.body.clientHeight
}
var ctx = sea.getContext("2d");

let levels = 5
let offsetSeaLevels = 200
let dotInSea = 10
let Ws = sea.clientWidth
let Hs = sea.clientHeight
let colorS = [0,100,255]
let color = colorS
let colorE = [0,160,255]
let colorOffset = []
for (let colorI = 0; colorI < colorS.length; colorI++) {
    colorOffset[colorI] = Math.floor((colorE[colorI]-colorS[colorI])/levels);
}
let offset = [Ws/levels,Hs/levels]
for (let index = levels; index > 0; index--) {
    let x = Ws-offset[0]*index-offsetSeaLevels
    let y = Hs-offset[1]*index-offsetSeaLevels
    let start = [Ws,Hs]
    ctx.beginPath();
    ctx.moveTo(x,start[1])
    let oldDot = [x,y]
    dots = dotinLine(x,start[1],start[0],y,ctx,10)
    for (let i = 1; i < dots.length-1; i++) {
        let dot = dots[i];
        let xd = dot[0]
        let yd = dot[1]
        randomDotCount = 20
        
        randomDots = dotinLine(xd-randomDotCount,yd-randomDotCount,xd+randomDotCount,yd+randomDotCount,ctx,randomDotCount)
        randomDot = randomDots[getRndInteger(0,randomDots.length)]
        
        ctx.lineTo(randomDot[0],randomDot[1])
        oldDot = [randomDot[0],randomDot[1]]
    }
    ctx.lineTo(start[0],y)
    ctx.lineTo(Ws,Hs)       
    ctx.moveTo(x,start[1])
    ctx.closePath()
    colorR = color
    for (let colorIndex = 0; colorIndex < color.length; colorIndex++) {
        colorR[colorIndex] = color[colorIndex]+colorOffset[colorIndex]
    }
    color = colorR
    ctx.fillStyle = `rgb(${color[0]},${color[1]},${color[2]})`
    ctx.fill()
    
}
function getRndInteger(min, max) {
    return Math.floor(Math.random() * (max - min) ) + min;
}

function dotinLine(x1,y1,x2,y2,ctx,count) {
    let x = x1
    let y = y1
    let Px = x2-x1
    let Py = y2-y1
    d = ((x1-x2)**2+(y1-y2)**2)**0.5
    i = 1
    let dot = [[x,y]]
    while (x2 > x){
        i++
        
        x+=d/count
        y+=Py/Px*(d/count)
        if (count == i) {
            x = x2
            y = y2
        }
        dotE = [x,y]  
        dot.push(dotE)
    }
    return dot
    
}
