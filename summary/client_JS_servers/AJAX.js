/**
 * 发送一个 AJAX 请求
 * @param {String}      url       请求地址
 * @param {String}      method    请求方法
 * @param {Object}      data      请求参数
 * @param {Function}    callback  请求完成后需要做的事情(委托/回调)
 */
function ajax (url, method, data, callback) {
    url = url || '';
    url = typeof url === 'string' ? url : url.toString();
    method = method || "GET";
    method = typeof method === 'string' ? method.toUpperCase() : method.toString().toUpperCase();
    // var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var xhr = new XMLHttpRequest();
    var tempArr = [];
    var sendData = null;
    if (typeof data === 'object') {
        for (var k in data) {
            var value = data[k];
            tempArr.push(k + '=' + value);
        }
        data = tempArr.join('&');
    }
    if (method === 'GET') url += '?' + data;
    xhr.open(method, url);
    if (method === 'POST') {
        sendData = data;
        xhr.setRequestHeader('Content-Type', 'appplication/x-www-form-urlencoded');
    }
    xhr.send(sendData);
    xhr.onreadystatechange = function () {
        if (this.readyState !== 4) return;
        if (typeof callback === 'function') {
            try {
                callback(JSON.parse(this.responseText));
            } catch (e) {
                callback(this.responseText);
            }
        }
        return this.responseText;
    }
}
