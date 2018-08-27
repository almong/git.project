const WebSocket = require('ws')

const wss = new WebSocket('wss://api.bitfinex.com/ws/')
wss.onmessage = (msg) => {
    console.log(msg.data);
    var data=JSON.parse(msg.data);
    JSON.stringify(data);
    if (data.event ==='info'){
        console.log('Подключение установленно, версия сервера '+data.version);
    }
    if (data.event ==='subscribed'){
        console.log('Подписка на трейд в паре '+data.pair+ ' оформлена');  
    }
}
wss.onopen = () => {
    var obj = {
        "event": "subscribe",
        "channel": "trades",
        "pair": "BTCUSD"
    }
    wss.send(JSON.stringify(obj));
  // API keys setup here (See "Authenticated Channels")
}

